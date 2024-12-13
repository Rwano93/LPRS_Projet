<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReplyController extends Controller
{
    public function store(Request $request, $discussionId)
    {
        $request->validate([
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $discussion = Discussion::findOrFail($discussionId);

        $reply = new Reply([
            'content' => $request->content,
            'user_id' => Auth::id(),
            'discussion_id' => $discussion->id,
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/reply_images', $imageName);
            $reply->image = $imageName;
        }

        $reply->save();

        return view('discussions.show', compact('discussion'));
        
    }

    public function destroy($replyId)
    {
        $reply = Reply::findOrFail($replyId);

        if (Auth::id() !== $reply->user_id) {
            return response()->json([
                'success' => false,
                'message' => 'Vous n\'êtes pas autorisé à supprimer cette réponse.',
            ], 403);
        }

        if ($reply->image) {
            Storage::disk('public')->delete('reply_images/' . $reply->image);
        }

        $reply->delete();

        return response()->json([
            'success' => true,
            'message' => 'Réponse supprimée avec succès.',
        ]);
    }

    public function displayImage($id)
    {
        $reply = Reply::findOrFail($id);
        if ($reply->image) {
            $path = storage_path('app/public/reply_images/' . $reply->image);
            if (file_exists($path)) {
                $file = file_get_contents($path);
                $type = mime_content_type($path);
                return response($file)->header('Content-Type', $type);
            }
        }
        abort(404);
    }
}

