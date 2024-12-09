<x-app-layout>
    <div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg animate-fade-in-down" role="alert">
                    <p class="font-bold">Erreur</p>
                    <p>{{ session('error') }}</p>
                </div>
            @endif
            @if(session('status'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg animate-fade-in-down" role="alert">
                    <p class="font-bold">Succès</p>
                    <p>{{ session('status') }}</p>
                </div>
            @endif
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-4xl font-bold text-indigo-900">Offres d'emploi</h1>
                @auth
                    @if(Auth::user()->ref_role == 5 || Auth::user()->ref_role == 6)
                        <a href="{{ route('offres.create') }}"
                           class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 ease-in-out flex items-center shadow-md hover:shadow-lg transform hover:-translate-y-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Créer une offre
                        </a>
                    @endif
                @endauth
            </div>
            <div class="relative mb-8">
                <input type="text" id="searchInput" placeholder="Rechercher une offre..."
                       class="w-full pl-10 pr-4 py-2 rounded-lg border border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white shadow-sm">
                <svg class="absolute left-3 top-2.5 text-indigo-400 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
            </div>
            @if($offres->isNotEmpty())
                <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($offres as $offre)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden transition duration-300 ease-in-out transform hover:-translate-y-2 hover:shadow-xl flex flex-col">
                            <div class="flex-grow p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <h2 class="text-2xl font-bold text-indigo-900">{{ $offre->titre }}</h2>
                                    <span class="text-sm font-medium text-indigo-600 bg-indigo-100 rounded-full px-3 py-1">
                                        {{ $offre->type }}
                                    </span>
                                </div>
                                <p class="text-gray-600 mb-4">{{ Str::limit($offre->description, 100) }}</p>
                                <div class="space-y-2 text-sm text-gray-500">
                                    <div class="flex items-center">
                                        <svg class="mr-2 h-5 w-5 text-indigo-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd" />
                                            <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z" />
                                        </svg>
                                        {{ $offre->entreprise->nom }}
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="mr-2 h-5 w-5 text-indigo-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                        </svg>
                                        {{ $offre->entreprise->ville }}
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="mr-2 h-5 w-5 text-indigo-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                        </svg>
                                        {{ $offre->salaire ? number_format($offre->salaire, 0, ',', ' ') . ' €' : 'Non spécifié' }}
                                    </div>
                                </div>
                            </div>
                            <div class="bg-indigo-50 p-6">
                                <div class="flex justify-between items-center">
                                    @auth
                                        @if(Auth::user()->ref_role == 5 || Auth::user()->ref_role == 6)
                                            <div class="flex space-x-2">
                                                <a href="{{ route('offres.edit', $offre->id) }}"
                                                   class="text-yellow-600 hover:text-yellow-800 transition duration-300 ease-in-out">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                    </svg>
                                                </a>
                                                <button type="button"
                                                        class="text-red-600 hover:text-red-800 transition duration-300 ease-in-out"
                                                        onclick="confirmDelete({{ $offre->id }})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </div>
                                        @endif
                                    @endauth
                                    @auth
                                        @if(Auth::user()->ref_role == 2 || Auth::user()->ref_role == 3)
                                            <button onclick="applyForJob({{ $offre->id }})"
                                                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out transform hover:-translate-y-1 shadow-md hover:shadow-lg mr-2">
                                                Postuler
                                            </button>
                                        @endif
                                    @endauth
                                    <a href="{{ route('offres.show', $offre->id) }}"
                                       class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out transform hover:-translate-y-1 shadow-md hover:shadow-lg">
                                        Voir les détails
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-xl rounded-xl p-8 text-center">
                    <h2 class="text-2xl font-semibold text-indigo-900">Aucune offre d'emploi trouvée</h2>
                </div>
            @endif
        </div>
    </div>
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
        document.getElementById('searchInput').addEventListener('input', function () {
            var searchTerm = this.value.toLowerCase();
            var offreCards = document.querySelectorAll('.grid > div');
            offreCards.forEach(function (card) {
                var title = card.querySelector('h2').textContent.toLowerCase();
                var description = card.querySelector('p').textContent.toLowerCase();
                if (title.includes(searchTerm) || description.includes(searchTerm)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
        function applyForJob(offreId) {
            Swal.fire({
                title: 'Postuler à cette offre',
                text: "Êtes-vous sûr de vouloir postuler à cette offre ?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, postuler !',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Here you would typically send an AJAX request to your backend
                    // For now, we'll just show a success message
                    Swal.fire(
                        'Postulé !',
                        'Votre candidature a été envoyée avec succès.',
                        'success'
                    );
                }
            });
        }
    </script>
    @foreach($offres as $offre)
        <form id="delete-form-{{ $offre->id }}" action="{{ route('offres.destroy', $offre) }}" method="POST"
              style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    @endforeach
</x-app-layout>