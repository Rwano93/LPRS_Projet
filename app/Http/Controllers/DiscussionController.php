<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscussionController extends Controller
{
    /**
     * Afficher la liste des discussions avec pagination.
     */
    public function index()
    {
        $discussions = Discussion::latest()->paginate(10); // Pagination de 10 éléments
        return view('discussions.index', compact('discussions'));
    }

    /**
     * Afficher le formulaire de création d'une nouvelle discussion.
     */
    public function create()
    {
        $categories = Category::all(); // Charger les catégories pour le formulaire
        return view('discussions.create', compact('categories'));
    }

    /**
     * Enregistrer une nouvelle discussion dans la base de données.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|min:5|max:255',
            'content' => 'required|string|min:10',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Gérer le téléchargement de l'image si fournie
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/discussion_images', $imageName);
            $validatedData['image'] = $imageName;
        }

        // Associer l'utilisateur connecté à la discussion
        $validatedData['user_id'] = Auth::id();

        // Créer la discussion
        Discussion::create($validatedData);

        return redirect()->route('discussions.index')
            ->with('success', 'Votre discussion a été ajoutée avec succès.');
    }

    /**
     * Afficher une discussion spécifique et ses réponses associées.
     */
    public function show($id)
    {
        $discussion = Discussion::with('replies.user')->findOrFail($id);
        return view('discussions.show', compact('discussion'));
    }

    /**
     * Afficher l'image associée à une discussion.
     */
    public function displayImage($id)
    {
        $discussion = Discussion::findOrFail($id);

        if ($discussion->image) {
            $path = storage_path('app/public/discussion_images/' . $discussion->image);

            if (file_exists($path)) {
                $file = file_get_contents($path);
                $type = mime_content_type($path);
                return response($file)->header('Content-Type', $type);
            }
        }

        return redirect()->route('discussions.index')->with('error', 'Image non trouvée.');
    }
}
