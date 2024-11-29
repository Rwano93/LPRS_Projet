@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-semibold mb-6">Liste des Activités</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table-auto w-full border-collapse border">
            <thead>
                <tr>
                    <th class="border p-2">Titre</th>
                    <th class="border p-2">Description</th>
                    <th class="border p-2">Date</th>
                    <th class="border p-2">Nombre de places</th>
                    <th class="border p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($activites as $activite)
                    <tr>
                        <td class="border p-2">{{ $activite->titre }}</td>
                        <td class="border p-2">{{ $activite->desc }}</td>
                        <td class="border p-2">{{ $activite->date }}</td>
                        <td class="border p-2">{{ $activite->nb_place }}</td>
                        <td class="border p-2">
                            <a href="{{ route('activite.show', $activite->id) }}" class="text-blue-500">Voir</a> | 
                            <a href="{{ route('activite.edit', $activite->id) }}" class="text-yellow-500">Éditer</a> | 
                            <form action="{{ route('activite.destroy', $activite->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('activite.create') }}" class="mt-6 inline-block bg-blue-500 text-white py-2 px-4 rounded">
            Créer une activité
        </a>
    </div>
@endsection
