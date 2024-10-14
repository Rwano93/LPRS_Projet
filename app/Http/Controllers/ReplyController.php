<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request, Discussion $discussion)
    {
        $request->validate([
            'content' => 'required',
        ]);

        Reply::create([
            'contenu' => $request->contenu,
            'discussion_id' => $discussion->id,
            'user_id' => auth()->id(),
        ]);

        return redirect()->back();
    }
}
