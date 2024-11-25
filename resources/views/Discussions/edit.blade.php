
<!-- resources/views/discussions/create.blade.php -->

@extends('layouts.app')

@section('content')

    <form action="{{ route('discussions.store') }}" method="POST">
        @csrf
        <div>
            <label for="title">Titre</label>
            <input type="text" name="title" id="title" required>
        </div>
        <div>
            <label for="content">Contenu</label>
            <input type="text" name="contenu" id="content" required></input>
        </div>
        <div>
            <label for="category_id">Catégorie</label>
            <select name="category_id" id="category_id" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Créer une discussion</button>
    </form>

@endsection
