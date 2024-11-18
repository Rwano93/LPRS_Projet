<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $actualite->titre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="mb-4">
                    <p class="text-gray-600">Publié le {{ $actualite->date_publication->format('d/m/Y à H:i') }}</p>
                </div>
                @if($actualite->image_url)
                    <div class="mb-4">
                        <img src="{{ $actualite->image_url }}" alt="{{ $actualite->titre }}" class="max-w-full h-auto rounded-lg">
                    </div>
                @endif
                <div class="mb-4">
                    <p class="text-gray-800">{{ $actualite->contenu }}</p>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('actualites.edit', $actualite) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Modifier</a>
                    <form action="{{ route('actualites.destroy', $actualite) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette actualité ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Supprimer</button>
                    </form>
                    <a href="{{ route('actualites.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Retour à la liste</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>