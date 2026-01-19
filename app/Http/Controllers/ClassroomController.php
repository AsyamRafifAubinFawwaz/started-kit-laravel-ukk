<?php

namespace App\Http\Controllers;

use App\Constants\ResponseConst;
use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keywords = $request->keywords;

        $data = Classroom::when($keywords, function ($query) use ($keywords) {
            $query->where('class_name', 'like', '%' . $keywords . '%');
        })
            ->paginate(20)
            ->withQueryString();
        return view('admin.classrooms.index', compact('data', 'keywords'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.classrooms.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'class_name' => 'required|string|max:255',
        ]);

        Classroom::create($request->all());

        return redirect()->route('admin.classrooms.index')
                         ->with('success', ResponseConst::SUCCESS_MESSAGE_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function detail(Classroom $classroom)
    {
        $classroom = Classroom::findOrFail($classroom->id);
        return view('admin.classrooms.show', compact('classroom'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom)
    {
        $classroom = Classroom::findOrFail($classroom->id);
        return view('admin.classrooms.update', compact('classroom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classroom $classroom)
    {
        $request->validate([
            'class_name' => 'required|string|max:255',
        ]);

        $classroom = Classroom::findOrFail($classroom->id);
        $classroom->update($request->all());

        return redirect()->route('admin.classrooms.index')
                         ->with('success', ResponseConst::SUCCESS_MESSAGE_UPDATED);
    }

    /**c
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        $classroom = Classroom::findOrFail($classroom->id);
        $classroom->delete();

        return redirect()->route('admin.classrooms.index')
                         ->with('success', ResponseConst::SUCCESS_MESSAGE_DELETED);
    }
}
