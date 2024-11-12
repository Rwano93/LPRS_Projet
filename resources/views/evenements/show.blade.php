<x-app-layout>
    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-3xl font-bold mb-6 text-gray-800 flex items-center">
                    <span class="mr-2">🎉</span> {{ $evenement->titre }}
                </h1>

                <div class="mb-6 text-gray-600">
                    <p class="mb-4">{{ $evenement->description }}</p>
                    <div class="flex items-center mb-2">
                        <span class="mr-2">🗓️</span> {{ $evenement->date->format('d/m/Y H:i') }}
                    </div>
                    <div class="flex items-center mb-2">
                        <span class="mr-2">📍</span> {{ $evenement->adresse }}
                    </div>
                    <div class="flex items-center">
                        <span class="mr-2">👥</span> {{ $evenement->nb_place }} places disponibles
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <div class="flex space-x-2">
                        <a href="{{ route('evenements.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                            <span class="mr-1">🔙</span> Retour à la liste
                        </a>
                        <a href="{{ route('evenements.edit', $evenement) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 active:bg-yellow-700 focus:outline-none focus:border-yellow-700 focus:shadow-outline-yellow disabled:opacity-25 transition ease-in-out duration-150">
                            <span class="mr-1">✏️</span> Modifier
                        </a>
                    </div>
                    
                    @auth
                        @if($evenement->isUserInscrit())
                            <form action="{{ route('evenements.desinscription', $evenement) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-800 focus:outline-none focus:border-red-700 focus:shadow-outline-red disabled:opacity-25 transition ease-in-out duration-150">
                                    <span class="mr-1">🚫</span> Se désinscrire
                                </button>
                            </form>
                        @else
                            <form action="{{ route('evenements.inscription', $evenement) }}" method="POST">
                                @csrf
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-800 focus:outline-none focus:border-green-700 focus:shadow-outline-green disabled:opacity-25 transition ease-in-out duration-150" {{ $evenement->nb_place <= 0 ? 'disabled' : '' }}>
                                    <span class="mr-1">✅</span> {{ $evenement->nb_place <= 0 ? 'Complet' : 'S\'inscrire' }}
                                </button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inscriptionForm = document.querySelector('form[action$="/inscription"]');
            const desinscriptionForm = document.querySelector('form[action$="/desinscription"]');

            function handleFormSubmit(e, isInscription) {
                e.preventDefault();
                const form = e.target;
                const confirmationTitle = isInscription ? 'Confirmation d\'inscription' : 'Confirmation de désinscription';
                const confirmationText = isInscription ? 'Êtes-vous sûr de vouloir vous inscrire à cet événement ?' : 'Êtes-vous sûr de vouloir vous désinscrire de cet événement ?';
                const confirmButtonText = isInscription ? 'Oui, m\'inscrire' : 'Oui, me désinscrire';

                Swal.fire({
                    title: confirmationTitle,
                    text: confirmationText,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: isInscription ? '#4CAF50' : '#f44336',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: confirmButtonText,
                    cancelButtonText: 'Annuler'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }

            if (inscriptionForm) {
                inscriptionForm.addEventListener('submit', (e) => handleFormSubmit(e, true));
            }

            if (desinscriptionForm) desinscriptionForm.addEventListener('submit', (e) => handleFormSubmit(e, false));
            }
        });
    </script>
    @endpush
</x-app-layout>