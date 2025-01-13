<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Conversation;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MessageController extends Controller
{
    use AuthorizesRequests;
    /**
     * Créer une conversation avec un utilisateur.
     */
    public function create(User $user)
    {
        return view('messages.create', compact('user'));
    }

    /**
     * Enregistrer un message et créer une conversation si elle n'existe pas.
     */
    public function store(Request $request)
{
    $request->validate([
        'recipient_id' => 'required|exists:users,id',
        'message' => 'required|string|max:1000',
    ]);

    $senderId = auth()->id();
    $receiverId = $request->recipient_id;

    // Vérifier ou créer une conversation
    $conversation = Conversation::firstOrCreate(
        [
            'user_one_id' => min($senderId, $receiverId),
            'user_two_id' => max($senderId, $receiverId),
        ]
    );

    // Créer le message
    $message = Message::create([
        'sender_id' => $senderId,
        'receiver_id' => $receiverId,
        'conversation_id' => $conversation->id,
        'content' => $request->message,
    ]);

    // Retourner une réponse JSON pour AJAX
    if ($request->ajax()) {
        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }

    // Rediriger pour les requêtes classiques
    return redirect()->route('messages.show', $conversation)
        ->with('success', 'Message envoyé avec succès.');
}


    /**
     * Afficher la liste des conversations.
     */
    public function index()
    {
        $conversations = Conversation::where('user_one_id', auth()->id())
            ->orWhere('user_two_id', auth()->id())
            ->with(['userOne', 'userTwo'])
            ->get();

        return view('messages.index', compact('conversations'));
    }

    /**
     * Afficher les messages d'une conversation.
     */
    public function show(Conversation $conversation)
    {
        $this->authorize('view', $conversation); // Vérification d'autorisation si nécessaire

        $messages = $conversation->messages()->orderBy('created_at')->get();

        return view('messages.show', compact('conversation', 'messages'));
    }
}
