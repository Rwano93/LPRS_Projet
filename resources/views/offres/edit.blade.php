<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Modifier l'offre d'emploi") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('offres.update', $offre) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="titre" class="block text-gray-700 text-sm font-bold mb-2">Titre</label>
                            <input type="text" name="titre" id="titre" value="{{ $offre->titre }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                            <textarea name="description" id="description" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>{{ $offre->description }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="missions" class="block text-gray-700 text-sm font-bold mb-2">Missions</label>
                            <textarea name="missions" id="missions" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>{{ $offre->missions }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="type" class="block text-gray-700 text-sm font-bold mb-2">Type</label>
                            <select name="type" id="type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="stage" {{ $offre->type == 'stage' ? 'selected' : '' }}>Stage</option>
                                <option value="alternance" {{ $offre->type == 'alternance' ? 'selected' : '' }}>Alternance</option>
                                <option value="CDD" {{ $offre->type == 'CDD' ? 'selected' : '' }}>CDD</option>
                                <option value="CDI" {{ $offre->type == 'CDI' ? 'selected' : '' }}>CDI</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="salaire" class="block text-gray-700 text-sm font-bold mb-2">Salaire</label>
                            <input type="text" name="salaire" id="salaire" value="{{ $offre->salaire }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Mettre à jour l'offre
                            </button>
                            <a href="{{ route('offres.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                                Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>