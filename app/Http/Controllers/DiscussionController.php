<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscussionController extends Controller
{
    public function index()
    {
        $discussions = Discussion::with('category', 'user')->latest()->paginate(10);
        $categories = Category::all();
        return view('discussions.index', compact('discussions', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('discussions.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|min:5|max:255',
            'content' => 'required|string|min:10',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/discussion_images', $imageName);
            $validatedData['image'] = $imageName;
        }

        $validatedData['user_id'] = Auth::id();

        Discussion::create($validatedData);

        return redirect()->route('discussions.index')
            ->with('success', 'Votre discussion a été ajoutée avec succès.');
    }

    public function show($id)
    {
        $discussion = Discussion::with('replies.user')->findOrFail($id);
        return view('discussions.show', compact('discussion'));
    }

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

