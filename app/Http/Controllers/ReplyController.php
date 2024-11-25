<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReplyController extends Controller
{
    /**
     * Store a newly created reply in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $discussionId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Discussion $discussion)
    {
        // Validation et création de la réponse
        $request->validate([
            'contenu' => 'required|string',
            'discussion_id' => 'required|exists:discussions,id',
        ]);

        Reply::create([
            'content' => $request->contenu,
            'discussion_id' => $discussion->id,
            'user_id' => auth()->id(), // Assurez-vous que l'utilisateur est authentifié
        ]);

        return redirect()->route('discussions.show', $discussion->id)->with('success', 'Réponse ajoutée avec succès.');
    }

    /**
     * Delete a reply.
     *
     * @param  int  $replyId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($replyId)
    {
        $reply = Reply::findOrFail($replyId);

        // Vérifie que l'utilisateur est le propriétaire de la réponse ou a les permissions nécessaires
        if (Auth::id() !== $reply->user_id) {
            return redirect()->route('discussions.show', $reply->discussion_id)->with('error', 'Vous n\'êtes pas autorisé à supprimer cette réponse.');
        }

        // Supprimer l'image associée si elle existe
        if ($reply->image) {
            Storage::disk('public')->delete($reply->image);
        }

        $reply->delete();

        return redirect()->route('discussions.show', $reply->discussion_id)->with('success', 'Réponse supprimée avec succès.');
    }
}
