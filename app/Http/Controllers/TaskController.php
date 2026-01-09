<?php

namespace App\Http\Controllers;

use App\Constants\ResponseConst;
use App\Models\task;
use App\Models\task_category;
use Illuminate\Http\Request;

class TaskController extends Controller
{
public function index(Request $request )
{
    $keywords = $request->keywords;
    $categories = task_category::all();
    $data = task::when($keywords, function ($query) use ($keywords) {
        $query->where(function ($q) use ($keywords) {
            $q->where('title', 'like', "%{$keywords}%")
              ->orWhere('description', 'like', "%{$keywords}%")
              ->orWhereHas('category', function ($cat) use ($keywords) {
                  $cat->where('name', 'like', "%{$keywords}%");
              });
        });
    })
    ->paginate(20)
    ->withQueryString();

    return view('tasks.index', compact('data', 'keywords', 'categories'));
}



    public function create()
    {
        $categories = task_category::all();
        return view('tasks.add', compact('categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:task_categories,id',
        ]);



        task::create($request->all());

        return redirect()->route('tasks.index')
                         ->with('success', ResponseConst::SUCCESS_MESSAGE_CREATED);
    }

    public function edit($id)
    {
        $data = task::findOrFail($id);
        $categories = task_category::all();
        return view('tasks.update', compact('data', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:task_categories,id',
        ]);

        $category = task::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('tasks.index')
                         ->with('success', ResponseConst::SUCCESS_MESSAGE_UPDATED);
    }

    public function destroy($id)
    {
        $category = task::findOrFail($id);
        $category->delete();

        return redirect()->route('tasks.index')
                         ->with('success', ResponseConst::SUCCESS_MESSAGE_DELETED);
    }
}
