<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails de l\'Entreprise') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-6">{{ $entreprise->nom }}</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <p class="text-gray-600"><strong class="text-gray-800">Adresse:</strong> {{ $entreprise->adresse }}</p>
                            <p class="text-gray-600"><strong class="text-gray-800">Code Postal:</strong> {{ $entreprise->code_postal }}</p>
                            <p class="text-gray-600"><strong class="text-gray-800">Ville:</strong> {{ $entreprise->ville }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600"><strong class="text-gray-800">Téléphone:</strong> {{ $entreprise->telephone }}</p>
                            <p class="text-gray-600"><strong class="text-gray-800">Site Web:</strong> <a href="{{ $entreprise->site_web }}" target="_blank" class="text-blue-600 hover:text-blue-800 transition duration-150 ease-in-out">{{ $entreprise->site_web }}</a></p>
                            <p class="text-gray-600"><strong class="text-gray-800">Partenaire:</strong> {{ $entreprise->is_partner ? 'Oui' : 'Non' }}</p>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="text-xl font-semibold text-gray-800 mb-4">Employés / Membres</h4>
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Poste</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($entreprise->users as $user)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->pivot->poste }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($user->pivot->is_verified)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        Vérifié
                                                    </span>
                                                @else
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                        En attente
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                @can('verifyLink', $entreprise)
                                                    @if(!$user->pivot->is_verified)
                                                        <form action="{{ route('entreprises.verify-link', $user->pivot->id) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="text-green-600 hover:text-green-900 mr-3 transition duration-150 ease-in-out">Vérifier</button>
                                                        </form>
                                                    @endif
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @can('update', $entreprise)
                        <div class="mt-8">
                            <a href="{{ route('entreprises.edit', $entreprise) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-150 ease-in-out">
                                Modifier l'entreprise
                            </a>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

