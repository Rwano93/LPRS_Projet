<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                <div class="p-6 sm:p-10">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-3xl font-bold text-gray-900">{{ $offre->titre }}</h1>
                        <span class="px-3 py-1 text-sm font-semibold text-indigo-600 bg-indigo-100 rounded-full">
                            {{ $offre->type }}
                        </span>
                    </div>

                    <div class="mb-8">
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">Description</h2>
                        <p class="text-gray-700 text-lg leading-relaxed">{{ $offre->description }}</p>
                    </div>

                    <div class="mb-8">
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">Missions</h2>
                        <p class="text-gray-700 text-lg leading-relaxed">{{ $offre->missions }}</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="flex items-center">
                            <svg class="h-6 w-6 text-indigo-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                            <span class="text-gray-700">Type de contrat : {{ $offre->type }}</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="h-6 w-6 text-indigo-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-gray-700">Salaire : {{ $offre->salaire ? number_format($offre->salaire, 2, ',', ' ') . ' €' : 'Non spécifié' }}</span>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-8">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Actions</h2>
                        <div class="flex flex-wrap gap-4">
                            @auth
                                @if(Auth::user()->ref_role == 5 || Auth::user()->ref_role == 6)
                                    <a href="{{ route('offres.edit', $offre->id) }}"
                                       class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out transform hover:-translate-y-1">
                                        Modifier
                                    </a>
                                    <button onclick="confirmDelete({{ $offre->id }})"
                                            class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out transform hover:-translate-y-1">
                                        Supprimer
                                    </button>
                                    <a href="{{ route('candidatures.index', $offre->id) }}"
                                       class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out transform hover:-translate-y-1">
                                        Gérer les candidatures
                                    </a>
                                @endif
                            @endauth
                            <a href="{{ route('offres.index') }}"
                               class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out transform hover:-translate-y-1">
                                Retour à la liste
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @auth
        @if(Auth::user()->ref_role == 5 || Auth::user()->ref_role == 6)
            <form id="delete-form-{{ $offre->id }}" action="{{ route('offres.destroy', $offre) }}" method="POST"
                  style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        @endif
    @endauth

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(offreId) {
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "Vous ne pourrez pas revenir en arrière !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, supprimer !',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + offreId).submit();
                }
            });
        }
    </script>
</x-app-layout>