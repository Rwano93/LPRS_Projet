<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Actualités') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold">Liste des actualités</h3>
                    <a href="{{ route('actualites.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Nouvelle actualité
                    </a>
                </div>

                @foreach ($actualites as $actualite)
                    <div class="mb-4 p-4 border rounded-lg">
                        <h4 class="text-xl font-bold mb-2">{{ $actualite->titre }}</h4>
                        <p class="text-gray-600 mb-2">Publié le {{ $actualite->date_publication->format('d/m/Y à H:i') }}</p>
                        <p class="mb-2">{{ Str::limit($actualite->contenu, 200) }}</p>
                        <div class="flex space-x-2">
                            <a href="{{ route('actualites.show', $actualite) }}" class="text-blue-500 hover:underline">Lire plus</a>
                            <a href="{{ route('actualites.edit', $actualite) }}" class="text-green-500 hover:underline">Modifier</a>
                            <form action="{{ route('actualites.destroy', $actualite) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette actualité ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Supprimer</button>
                            </form>
                        </div>
                    </div>
                @endforeach

                {{ $actualites->links() }}
            </div>
        </div>
    </div>
</x-app-layout>