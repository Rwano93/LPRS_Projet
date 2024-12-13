<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index()
    {
        $discussions = Discussion::with('category', 'user')->latest()->paginate(10);
        return view('discussions.index', compact('discussions'));
    }

    public function show($id)
    {
        $discussion = Discussion::with('replies.user')->findOrFail($id);
        return view('discussions.show', compact('discussion'));
    }
}