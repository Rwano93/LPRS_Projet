<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier l\'événement') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('evenements.update', $evenement) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="type" class="block text-gray-700 text-sm font-bold mb-2">Type :</label>
                            <input type="text" name="type" id="type" value="{{ $evenement->type }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="mb-4">
                            <label for="titre" class="block text-gray-700 text-sm font-bold mb-2">Titre :</label>
                            <input type="text" name="titre" id="titre" value="{{ $evenement->titre }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description :</label>
                            <textarea name="description" id="description" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>{{ $evenement->description }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="adresse" class="block text-gray-700 text-sm font-bold mb-2">Adresse :</label>
                            <input type="text" name="adresse" id="adresse" value="{{ $evenement->adresse }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="mb-4">
                            <label for="elements_requis" class="block text-gray-700 text-sm font-bold mb-2">Éléments requis :</label>
                            <input type="text" name="elements_requis" id="elements_requis" value="{{ $evenement->elements_requis }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="mb-4">
                            <label for="nb_place" class="block text-gray-700 text-sm font-bold mb-2">Nombre de places :</label>
                            <input type="number" name="nb_place" id="nb_place" value="{{ $evenement->nb_place }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div  class="mb-4">
                            <label for="date" class="block text-gray-700 text-sm font-bold mb-2">Date :</label>
                            <input type="date" name="date" id="date" value="{{ $evenement->date->format('Y-m-d') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Mettre à jour l'événement
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>