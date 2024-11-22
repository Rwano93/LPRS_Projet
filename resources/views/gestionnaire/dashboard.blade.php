<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord du gestionnaire') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="bg-blue-100 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-2">Demandes en attente</h3>
                            <p class="text-3xl font-bold">{{ $demandesEnAttente }}</p>
                        </div>
                        <div class="bg-green-100 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-2">Demandes approuvées</h3>
                            <p class="text-3xl font-bold">{{ $demandesApprouvees }}</p>
                        </div>
                        <div class="bg-red-100 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-2">Demandes rejetées</h3>
                            <p class="text-3xl font-bold">{{ $demandesRejetees }}</p>
                        </div>
                        <div class="bg-yellow-100 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-2">Taux d'approbation</h3>
                            <p class="text-3xl font-bold">{{ number_format($tauxApprobation, 1) }}%</p>
                        </div>
                        <div class="bg-purple-100 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-2">Total utilisateurs</h3>
                            <p class="text-3xl font-bold">{{ $totalUtilisateurs }}</p>
                        </div>
                        <div class="bg-indigo-100 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-2">Nouveaux utilisateurs (7 jours)</h3>
                            <p class="text-3xl font-bold">{{ $nouveauxUtilisateurs }}</p>
                        </div>
                    </div>
                    <div class="mt-8">
                        <x-button-link href="{{ route('gestionnaire.demandes.index') }}">
                            {{ __('Gérer les demandes') }}
                        </x-button-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>