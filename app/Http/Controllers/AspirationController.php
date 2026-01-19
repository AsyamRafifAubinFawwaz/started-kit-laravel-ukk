<?php

namespace App\Http\Controllers;

use App\Models\Aspiration;
use Illuminate\Http\Request;

class AspirationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aspirations = Aspiration::with(['complaint.student.user', 'complaint.category'])
            ->latest()
            ->paginate(10);

        return view('admin.asirations.index', compact('aspirations'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Aspiration $aspiration)
    {
        $aspiration = Aspiration::with(['complaint.student.user', 'complaint.category', 'complaint.student.classroom'])->findOrFail($aspiration->id);
        return view('admin.asirations.detail', compact('aspiration'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aspiration $aspiration)
    {
        $aspiration = Aspiration::with(['complaint.student.user', 'complaint.category'])->findOrFail($aspiration->id);
        return view('admin.asirations.update', compact('aspiration'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aspiration $aspiration)
    {
        $validated = $request->validate([
            'status' => 'required|in:1,2,3',
            'feedback' => 'nullable|string',
        ]);

        $aspiration->update([
            'status' => $validated['status'],
            'feedback' => $validated['feedback'],
            'updated_by' => auth()->id(),
        ]);

        return redirect()
            ->route('admin.aspirations.index')
            ->with('success', 'Aspirasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aspiration $aspiration)
    {
        //
    }
}
