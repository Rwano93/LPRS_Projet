<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                <div class="p-6 sm:p-10">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-3xl font-bold text-gray-900">{{ $evenement->titre }}</h1>
                        <span class="px-3 py-1 text-sm font-semibold text-indigo-600 bg-indigo-100 rounded-full">
                            {{ $evenement->type }}
                        </span>
                    </div>

                    <div class="mb-8">
                        <p class="text-gray-700 text-lg leading-relaxed">{{ $evenement->description }}</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="flex items-center">
                            <svg class="h-6 w-6 text-indigo-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-gray-700">{{ \Carbon\Carbon::parse($evenement->date)->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="h-6 w-6 text-indigo-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="text-gray-700">{{ $evenement->adresse }}</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="h-6 w-6 text-indigo-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                            <span class="text-gray-700">Requis : {{ $evenement->elementrequis }}</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="h-6 w-6 text-indigo-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span class="text-gray-700">{{ $evenement->nb_place }} place(s) restante(s)</span>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-8">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Actions</h2>
                        <div class="flex flex-wrap gap-4">
                            @auth
                                @if(!$evenement->isCreator && $evenement->date >= now())
                                    @if($evenement->isUserInscrit(Auth::id()))
                                        <button onclick="confirmDesinscription({{ $evenement->id }})"
                                                class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out transform hover:-translate-y-1">
                                            Se désinscrire
                                        </button>
                                    @else
                                        <button onclick="confirmInscription({{ $evenement->id }})"
                                                class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out transform hover:-translate-y-1"
                                                {{ $evenement->nb_place <= 0 ? 'disabled' : '' }}>
                                            {{ $evenement->nb_place <= 0 ? 'Complet' : 'S\'inscrire' }}
                                        </button>
                                    @endif
                                @endif
                                @if(Auth::user()->ref_role == 6)
                                    <a href="{{ route('evenement.edit', $evenement->id) }}"
                                       class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out transform hover:-translate-y-1">
                                        Modifier
                                    </a>
                                    <button onclick="confirmDelete({{ $evenement->id }})"
                                            class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out transform hover:-translate-y-1">
                                        Supprimer
                                    </button>
                                @endif
                            @endauth
                            <a href="{{ route('evenement.index') }}"
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
        <form id="inscription-form-{{ $evenement->id }}" action="{{ route('evenement.inscription', $evenement) }}"
              method="POST" style="display: none;">
            @csrf
        </form>
        <form id="desinscription-form-{{ $evenement->id }}" action="{{ route('evenement.desinscription', $evenement) }}"
              method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
        @if(Auth::user()->ref_role == 6)
            <form id="delete-form-{{ $evenement->id }}" action="{{ route('evenement.destroy', $evenement) }}" method="POST"
                  style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        @endif
    @endauth

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(evenementId) {
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
                    document.getElementById('delete-form-' + evenementId).submit();
                }
            });
        }

        function confirmInscription(evenementId) {
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "Voulez-vous vous inscrire à cet événement ?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, inscrire !',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('inscription-form-' + evenementId).submit();
                }
            });
        }

        function confirmDesinscription(evenementId) {
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "Voulez-vous vous désinscrire de cet événement ?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, désinscrire !',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('desinscription-form-' + evenementId).submit();
                }
            });
        }
    </script>
</x-app-layout>