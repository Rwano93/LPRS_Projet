<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Discussion;
use Illuminate\Support\Facades\Auth;
class DiscussionController extends Controller
{
    public function index(): Factory|View|Application
    {
        $discussions = Discussion::with('category', 'user')->latest()->paginate(10);
        return view('discussions.index', compact('discussions'));

    }

    public function create(): Factory|View|Application
    {
        $categories = Category::all(); // Récupère toutes les catégories
        return view('discussions.create', compact('categories'));
    }


    public function store(Request $request)
    {
        // Validation des champs
        $validatedData = $request->validate([
            'title' => 'required|string|min:5|max:255',
            'content' => 'required|string|min:10',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Gestion de l'upload de l'image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('discussion_images', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Ajout de l'utilisateur actuel
        $validatedData['user_id'] = Auth::id();

        // Création de la discussion
        Discussion::create($validatedData);

        return redirect()->route('forum.index')
            ->with('success', 'Votre discussion a été ajoutée avec succès.');
    }



    public function show($id)
    {
        // Récupérer la discussion avec les réponses
        $discussion = Discussion::with('replies.user')->findOrFail($id);

        return view('discussions.show', compact('discussion'));
    }
    public function displayImage($id)
    {
        // Récupérer la discussion par ID
        $discussion = Discussion::find($id);

        // Vérifier si l'image existe dans la discussion
        if ($discussion && $discussion->image) {
            $image = $discussion->image;
            $type = 'image/jpeg'; // Changez cela si vous utilisez un autre type (jpeg, png, etc.)

            // Retourner l'image avec le bon type de contenu
            return response($image)->header('Content-Type', $type);
        }

        // Rediriger vers le forum avec un message d'erreur si l'image n'existe pas
        return redirect()->route('forum.index')->with('error', 'Image non trouvée.');
    }


}
