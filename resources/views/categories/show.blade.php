<!-- resources/views/categories/show.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Catégorie : {{ $category->name }}</h1>

    <h2>Discussions</h2>
    <ul>
        @foreach ($category->discussions as $discussion)
            <li>
                <a href="{{ route('discussions.show', $discussion->id) }}">{{ $discussion->title }}</a>
            </li>
        @endforeach
    </ul>
@endsection
