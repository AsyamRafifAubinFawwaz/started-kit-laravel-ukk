<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with(['user', 'classroom'])
            ->latest()
            ->paginate(10);

        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        $classrooms = Classroom::orderBy('class_name')->get();

        return view('admin.students.add', compact('classrooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email',
            'nisn'         => 'required|numeric|unique:students,nisn,NULL,id,deleted_at,NULL',
            'classroom_id' => 'required|exists:classrooms,id',
        ]);

        DB::transaction(function () use ($request) {

            $user = User::create([
                'name'        => $request->name,
                'email'       => $request->email,
                'password'    => Hash::make('password'),
                'access_type' => 'Siswa',
                'created_by'  => auth()->id(),
            ]);

            Student::create([
                'user_id'      => $user->id,
                'classroom_id' => $request->classroom_id,
                'nisn'         => $request->nisn,
                'created_by'   => auth()->id(),
            ]);
        });

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Siswa berhasil ditambahkan');
    }

    public function edit(Student $student)
    {
        $student->load('user');
        $classrooms = Classroom::orderBy('class_name')->get();

        return view('admin.students.update', compact('student', 'classrooms'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email,' . $student->user_id,
            'nisn'         => 'required|numeric|unique:students,nisn,' . $student->id,
            'classroom_id' => 'required|exists:classrooms,id',
        ]);

        DB::transaction(function () use ($request, $student) {

            $student->user->update([
                'name'       => $request->name,
                'email'      => $request->email,
                'updated_by' => auth()->id(),
            ]);

            $student->update([
                'nisn'         => $request->nisn,
                'classroom_id' => $request->classroom_id,
                'updated_by'   => auth()->id(),
            ]);
        });

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Data siswa berhasil diperbarui');
    }

    public function destroy(Student $student)
    {
        DB::transaction(function () use ($student) {

            $student->update([
                'deleted_by' => auth()->id(),
            ]);

            $student->user->update([
                'deleted_by' => auth()->id(),
            ]);

            $student->delete();
            $student->user->delete();
        });

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Siswa berhasil dihapus');
    }
}
