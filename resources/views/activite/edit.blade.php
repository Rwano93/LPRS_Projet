@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-semibold mb-6">Modifier l'Activité</h1>

        <form action="{{ route('activite.update', $activite->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="titre" class="block">Titre</label>
                <input type="text" name="titre" id="titre" class="border p-2 w-full" value="{{ old('titre', $activite->titre) }}" required>
            </div>

            <div class="mb-4">
                <label for="desc" class="block">Description</label>
                <textarea name="desc" id="desc" class="border p-2 w-full">{{ old('desc', $activite->desc) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="date" class="block">Date</label>
                <input type="datetime-local" name="date" id="date" class="border p-2 w-full" value="{{ old('date', $activite->date) }}" required>
            </div>

            <div class="mb-4">
                <label for="nb_place" class="block">Nombre de places</label>
                <input type="number" name="nb_place" id="nb_place" class="border p-2 w-full" value="{{ old('nb_place', $activite->nb_place) }}" required>
            </div>

            <button type="submit" class="bg-yellow-500 text-white py-2 px-4 rounded">
                Mettre à jour l'activité
            </button>
        </form>
    </div>
@endsection
