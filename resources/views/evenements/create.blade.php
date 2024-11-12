<x-app-layout>
    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-3xl font-bold mb-6 text-gray-800 flex items-center">
                    <span class="mr-2">✨</span> Créer un nouvel événement
                </h1>

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Oops!</strong>
                        <span class="block sm:inline">Veuillez corriger les erreurs suivantes :</span>
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="create-event-form" action="{{ route('evenements.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="titre" class="block text-sm font-medium text-gray-700">Titre de l'événement</label>
                        <input type="text" name="titre" id="titre" value="{{ old('titre') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>{{ old('description') }}</textarea>
                    </div>

                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700">Date et heure</label>
                        <input type="datetime-local" name="date" id="date" value="{{ old('date') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                    </div>

                    <div>
                        <label for="lieu" class="block text-sm font-medium text-gray-700">Lieu</label>
                        <input type="text" name="lieu" id="lieu" value="{{ old('lieu') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                    </div>

                    <div>
                        <label for="places_disponibles" class="block text-sm font-medium text-gray-700">Nombre de places disponibles</label>
                        <input type="number" name="places_disponibles" id="places_disponibles" value="{{ old('places_disponibles') }}" min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('evenements.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                            <span class="mr-1">🔙</span> Annuler
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue disabled:opacity-25 transition ease-in-out duration-150">
                            <span class="mr-1">💾</span> Créer l'événement
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>