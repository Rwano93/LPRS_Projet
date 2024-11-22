<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Confirmer la suppression') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        Êtes-vous sûr de vouloir supprimer cette offre d'emploi ?
                    </h3>
                    <div class="mb-4">
                        <p class="text-gray-600"><strong>Titre :</strong> {{ $offre->titre }}</p>
                        <p class="text-gray-600"><strong>Type :</strong> {{ $offre->type }}</p>
                    </div>
                    <div class="flex items-center justify-start space-x-4">
                        <form action="{{ route('offres.destroy', $offre) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Confirmer la suppression
                            </button>
                        </form>
                        <a href="{{ route('offres.show', $offre) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Annuler
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>