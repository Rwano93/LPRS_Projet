<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel Entreprises') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-700">Toutes les entreprises</h3>
                        <a href="{{ route('entreprises.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-150 ease-in-out">
                            Ajouter une entreprise
                        </a>
                    </div>

                    <div class="overflow-x-auto bg-white rounded-lg shadow overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ville</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Site Web</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Partenaire</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($entreprises as $entreprise)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $entreprise->nom }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $entreprise->ville }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ $entreprise->site_web }}" target="_blank" class="text-blue-600 hover:text-blue-900 transition duration-150 ease-in-out">
                                                {{ $entreprise->site_web }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($entreprise->is_partner)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Oui
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                    Non
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('entreprises.show', $entreprise) }}" class="text-blue-600 hover:text-blue-900 mr-3 transition duration-150 ease-in-out">Voir</a>
                                            @can('update', $entreprise)
                                                <a href="{{ route('entreprises.edit', $entreprise) }}" class="text-indigo-600 hover:text-indigo-900 mr-3 transition duration-150 ease-in-out">Modifier</a>
                                            @endcan
                                            @if(Auth::user()->role->libelle === 'Alumni' && !$entreprise->users->contains(Auth::id()))
                                                <a href="#" onclick="event.preventDefault(); document.getElementById('link-request-{{ $entreprise->id }}').classList.remove('hidden');" class="text-green-600 hover:text-green-900 transition duration-150 ease-in-out">
                                                    Demander le rattachement
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $entreprises->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach($entreprises as $entreprise)
        @if(Auth::user()->role->libelle === 'Alumni' && !$entreprise->users->contains(Auth::id()))
            <div id="link-request-{{ $entreprise->id }}" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
                <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                    <div class="mt-3 text-center">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Demande de rattachement</h3>
                        <form action="{{ route('entreprises.request-link', $entreprise) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="poste" class="block text-sm font-medium text-gray-700 mb-2">Poste</label>
                                <input type="text" name="poste" id="poste" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" required>
                            </div>
                            <div class="mb-4">
                                <label for="motif_inscription" class="block text-sm font-medium text-gray-700 mb-2">Motif de rattachement</label>
                                <textarea name="motif_inscription" id="motif_inscription" rows="3" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" required></textarea>
                            </div>
                            <div class="flex justify-end mt-4">
                                <button type="button" onclick="document.getElementById('link-request-{{ $entreprise->id }}').classList.add('hidden');" class="mr-2 px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Annuler
                                </button>
                                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Envoyer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</x-app-layout>

