@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-semibold mb-6">{{ $activite->titre }}</h1>

        <p><strong>Description:</strong> {{ $activite->desc }}</p>
        <p><strong>Date:</strong> {{ $activite->date }}</p>
        <p><strong>Nombre de places:</strong> {{ $activite->nb_place }}</p>

        <a href="{{ route('activite.index') }}" class="mt-6 inline-block bg-blue-500 text-white py-2 px-4 rounded">
            Retour à la liste
        </a>
    </div>
@endsection
