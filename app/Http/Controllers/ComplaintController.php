<?php

namespace App\Http\Controllers;

use App\Models\Aspiration;
use App\Models\Category;
use App\Models\Complaint;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = auth()->user()->student;
        if (!$student) {
            abort(403, 'Akun Anda belum terdaftar sebagai siswa.');
        }

        $complaint = Complaint::with(['category', 'aspiration'])
            ->where('student_id', $student->id)
            ->latest()
            ->get();

        return view('student.complaints.index', compact('complaint'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::orderBy('name')->get();
        return view('student.complaints.add', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $student = auth()->user()->student;

        if (!$student) {
            return redirect()->back()->with('error', 'Profil siswa Anda belum lengkap.');
        }

        $validated = $request->validate([
            'category_id' => 'required|exists:category,id',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        DB::transaction(function () use ($request, $validated, $student) {

            $complaintData = [
                'student_id' => $student->id,
                'category_id' => $validated['category_id'],
                'description' => $validated['description'],
                'location' => $validated['location'],
                'created_by' => auth()->id(),
            ];

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('complaint_images', 'public');
                $complaintData['image'] = $path;
            }

            $complaint = Complaint::create($complaintData);

            Aspiration::create([
                'complaint_id' => $complaint->id,
                'status' => 1,
                'feedback' => null,
                'created_by' => auth()->id(),
            ]);
        });

        return redirect()
            ->route('student.complaints.index')
            ->with('success', 'Complaint submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Complaint $complaint)
    {
        $student = auth()->user()->student;

        if (!$student || $complaint->student_id !== $student->id) {
            abort(403, 'Anda tidak memiliki akses ke pengaduan ini.');
        }

        $complaint = Complaint::with(['student', 'category', 'aspiration'])->findOrFail($complaint->id);
        return view('student.complaints.detail', compact('complaint'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Complaint $complaint)
    {
        $student = auth()->user()->student;

        if (!$student || $complaint->student_id !== $student->id) {
            abort(403);
        }
        $complaint = Complaint::findOrFail($complaint->id);
        $category = Category::orderBy('name')->get();
        return view('student.complaints.update', compact('complaint', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Complaint $complaint)
    {
        $student = auth()->user()->student;

        if (!$student || $complaint->student_id !== $student->id) {
            abort(403);
        }

        $validated = $request->validate([
            'category_id' => 'required|exists:category,id',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        DB::transaction(function () use ($request, $validated, $complaint) {

            $complaintData = [
                'category_id' => $validated['category_id'],
                'description' => $validated['description'],
                'location' => $validated['location'],
                'updated_by' => auth()->id(),
            ];

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('complaint_images', 'public');
                $complaintData['image'] = $path;
            }

            $complaint->update($complaintData);
        });

        return redirect()
            ->route('student.complaints.index')
            ->with('success', 'Complaint updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Complaint $complaint)
    {
        $student = auth()->user()->student;
        $complaint = Complaint::findOrFail($complaint->id);

        if (!$student || $complaint->student_id !== $student->id) {
            abort(403);
        }

        $complaint->delete();
        return redirect()
            ->route('student.complaints.index')
            ->with('success', 'Complaint deleted successfully.');
    }
}
