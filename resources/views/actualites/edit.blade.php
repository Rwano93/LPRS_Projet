<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier une actualité') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('actualites.update', $actualite) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="titre" class="block text-gray-700 text-sm font-bold mb-2">Titre:</label>
                        <input type="text" name="titre" id="titre" value="{{ $actualite->titre }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                        <label for="contenu" class="block text-gray-700 text-sm font-bold mb-2">Contenu:</label>
                        <textarea name="contenu" id="contenu" rows="5" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>{{ $actualite->contenu }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label for="date_publication" class="block text-gray-700 text-sm font-bold mb-2">Date de publication:</label>
                        <input type="datetime-local" name="date_publication" id="date_publication" value="{{ $actualite->date_publication->format('Y-m-d\TH:i') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                        <label for="image_url" class="block text-gray-700 text-sm font-bold mb-2">URL de l'image:</label>
                        <input type="url" name="image_url" id="image_url" value="{{ $actualite->image_url }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Mettre à jour l'actualité
                        </button>
                        <a href="{{ route('actualites.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                            Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>