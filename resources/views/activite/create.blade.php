@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-semibold mb-6">Créer une Activité</h1>

        <form action="{{ route('activite.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="titre" class="block">Titre</label>
                <input type="text" name="titre" id="titre" class="border p-2 w-full" value="{{ old('titre') }}" required>
                @error('titre') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="desc" class="block">Description</label>
                <textarea name="desc" id="desc" class="border p-2 w-full">{{ old('desc') }}</textarea>
                @error('desc') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="date" class="block">Date</label>
                <input type="datetime-local" name="date" id="date" class="border p-2 w-full" value="{{ old('date') }}" required>
                @error('date') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="nb_place" class="block">Nombre de places</label>
                <input type="number" name="nb_place" id="nb_place" class="border p-2 w-full" value="{{ old('nb_place') }}" required>
                @error('nb_place') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded">
                Créer l'activité
            </button>
        </form>
    </div>
@endsection
