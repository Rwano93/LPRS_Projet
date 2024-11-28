<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestion des demandes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Tableau avec une meilleure présentation -->
                    <table class="min-w-full divide-y divide-gray-200 table-auto">
                        <thead class="bg-indigo-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Utilisateur</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut demandé</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date de demande</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut actuel</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($demandes as $demande)
                                <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <span class="font-semibold text-indigo-600">{{ $demande->user->name }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        <span class="text-indigo-600 font-medium">{{ $demande->role->libelle }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $demande->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-3 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($demande->statut == 'en_attente') bg-yellow-100 text-yellow-800
                                            @elseif($demande->statut == 'approuve') bg-green-100 text-green-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ ucfirst($demande->statut) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('gestionnaire.demandes.show', $demande) }}" class="text-indigo-600 hover:text-indigo-900 hover:underline">Voir</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Si aucune demande n'est présente -->
                    @if ($demandes->isEmpty())
                        <div class="mt-4 text-center text-gray-500">
                            <p>Aucune demande n'a été effectuée pour le moment.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        @media (max-width: 640px) {
            .table-auto th, .table-auto td {
                padding: 8px;
            }
            .table-auto td {
                font-size: 14px;
            }
            .table-auto thead {
                display: none;  /* Masquer les en-têtes pour les petits écrans */
            }
            .table-auto tr {
                display: block;
                margin-bottom: 10px;
                border: 1px solid #ddd;
            }
            .table-auto td::before {
                content: attr(data-label);
                font-weight: bold;
                display: block;
                margin-bottom: 5px;
            }
        }
    </style>
</x-app-layout>
