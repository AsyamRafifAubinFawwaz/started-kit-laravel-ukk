<?php

namespace App\Http\Controllers;

use App\Constants\ResponseConst;
use App\Models\task_category;
use Illuminate\Http\Request;

class TaskCategoryController extends Controller
{
    public function index(Request $request)
{
    $keywords = $request->keywords;

    $data = task_category::when($keywords, function ($query) use ($keywords) {
        $query->where('name', 'like', '%' . $keywords . '%');
    })
    ->paginate(20)
    ->withQueryString(); 

    return view('task_categories.index', compact('data', 'keywords'));
}


    public function create()
    {
        return view('task_categories.add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        task_category::create($request->all());

        return redirect()->route('task_categories.index')
                         ->with('success', ResponseConst::SUCCESS_MESSAGE_CREATED);
    }

    public function edit($id)
    {
        $category = task_category::findOrFail($id);
        return view('task_categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = task_category::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('task_categories.index')
                         ->with('success', ResponseConst::SUCCESS_MESSAGE_UPDATED);
    }

    public function destroy($id)
    {
        $category = task_category::findOrFail($id);
        $category->delete();

        return redirect()->route('task_categories.index')
                         ->with('success', ResponseConst::SUCCESS_MESSAGE_DELETED);
    }
}
