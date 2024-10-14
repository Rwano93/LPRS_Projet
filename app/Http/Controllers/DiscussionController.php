<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiscussionController extends Controller
{
    public function index()
    {
        $discussions = Discussion::with('category', 'user')->latest()->paginate(10);
        return view('discussions.index', compact('discussions'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('discussions.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
        ]);

        Discussion::create([
            'title' => $request->title,
            'contenu' => $request->contenu,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('discussions.index');
    }

    public function show(Discussion $discussion)
    {
        return view('discussions.show', compact('discussion'));
    }
}
