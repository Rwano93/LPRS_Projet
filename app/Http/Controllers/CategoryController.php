<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($id)
    {
        $category = Category::with('discussions')->findOrFail($id);

        return view('categories.show', compact('category'));
    }
}


