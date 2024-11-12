<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails de l\'événement') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">{{ $evenement->titre }}</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p><strong>Type :</strong> {{ $evenement->type }}</p>
                            <p><strong>Date :</strong> {{ $evenement->date->format('d/m/Y H:i') }}</p>
                            <p><strong>Adresse :</strong> {{ $evenement->adresse }}</p>
                            <p><strong>Nombre de places :</strong> {{ $evenement->nb_place }}</p>
                        </div>
                        <div>
                            <p><strong>Description :</strong></p>
                            <p>{{ $evenement->description }}</p>
                            <p><strong>Éléments requis :</strong></p>
                            <p>{{ $evenement->elements_requis }}</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('evenements.edit', $evenement) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Modifier</a>
                        <a href="{{ route('evenements.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Retour à la liste</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>