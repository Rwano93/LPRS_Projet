<x-app-layout>
    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-3xl font-bold mb-6 text-gray-800 flex items-center">
                    <span class="mr-2" aria-hidden="true">📅</span> Événements
                </h1>

                <div class="flex flex-col sm:flex-row justify-between items-center mb-6 space-y-4 sm:space-y-0">
                    <div class="w-full sm:w-2/3 pr-4">
                        <form action="{{ route('evenements.index') }}" method="GET" class="flex items-center">
                            <label for="search" class="sr-only">Rechercher un événement</label>
                            <input type="text" id="search" name="search" placeholder="🔍 Rechercher un événement..." 
                                   class="w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none focus:border-blue-500 transition duration-300 ease-in-out"
                                   value="{{ request('search') }}">
                        </form>
                    </div>
                    <a href="{{ route('evenements.create') }}" 
                       class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out transform hover:scale-105 shadow-lg flex items-center create-event">
                        <span class="mr-2" aria-hidden="true">✨</span> Créer un événement
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($evenements as $evenement)
                        <div class="bg-white shadow-lg rounded-lg overflow-hidden transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl" id="evenement-{{ $evenement->id }}">
                            <div class="p-6">
                                <h2 class="text-xl font-semibold mb-2 text-gray-800">{{ $evenement->titre }}</h2>
                                <p class="text-gray-600 mb-4">{{ Str::limit($evenement->description, 100) }}</p>
                                <div class="text-sm text-gray-500 space-y-2">
                                    <p class="flex items-center">
                                        <span class="mr-2" aria-hidden="true">🗓️</span> {{ $evenement->formatted_date }}
                                    </p>
                                    <p class="flex items-center">
                                        <span class="mr-2" aria-hidden="true">📍</span> {{ $evenement->lieu }}
                                    </p>
                                    <p class="flex items-center">
                                        <span class="mr-2" aria-hidden="true">👥</span> <span class="places-disponibles">{{ $evenement->places_disponibles }} places disponibles</span>
                                    </p>
                                </div>
                                <div class="mt-4 flex flex-wrap justify-between items-center">
                                    <div class="flex space-x-2 mb-2">
                                        <a href="{{ route('evenements.edit', $evenement) }}" class="text-yellow-600 hover:text-yellow-800 transition duration-300 ease-in-out transform hover:scale-110 edit-event" data-id="{{ $evenement->id }}">
                                            <span class="sr-only">Modifier</span>
                                            <span class="text-2xl" aria-hidden="true">✏️</span>
                                        </a>
                                        <button class="text-red-600 hover:text-red-800 transition duration-300 ease-in-out transform hover:scale-110 delete-event" data-id="{{ $evenement->id }}">
                                            <span class="sr-only">Supprimer</span>
                                            <span class="text-2xl" aria-hidden="true">🗑️</span>
                                        </button>
                                    </div>
                                    <div class="flex space-x-2">
                                        @auth
                                            @if($evenement->isUserInscrit())
                                                <button class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-full text-sm transition duration-300 ease-in-out transform hover:scale-105 desinscription-btn" data-id="{{ $evenement->id }}">
                                                    <span class="mr-1" aria-hidden="true">🚫</span> Se désinscrire
                                                </button>
                                            @else
                                                <button class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-full text-sm transition duration-300 ease-in-out transform hover:scale-105 inscription-btn" data-id="{{ $evenement->id }}" {{ $evenement->places_disponibles <= 0 ? 'disabled' : '' }}>
                                                    <span class="mr-1" aria-hidden="true">✅</span> {{ $evenement->places_disponibles <= 0 ? 'Complet' : 'S\'inscrire' }}
                                                </button>
                                            @endif
                                        @endauth
                                        <a href="{{ route('evenements.show', $evenement) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full text-sm transition duration-300 ease-in-out transform hover:scale-105">
                                            <span class="mr-1" aria-hidden="true">👁️</span> Voir plus
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $evenements->links() }}
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const createEventForm = document.getElementById('create-event-form');
        const inscriptionButtons = document.querySelectorAll('.inscription-btn');
        const desinscriptionButtons = document.querySelectorAll('.desinscription-btn');

        if (createEventForm) {
            createEventForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);

                axios.post(this.action, formData)
                    .then(response => {
                        if (response.data.success) {
                            Swal.fire({
                                title: 'Succès !',
                                text: response.data.message,
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                // Redirect to the events index page
                                window.location.href = '{{ route('evenements.index') }}';
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Erreur',
                            text: 'Une erreur est survenue lors de la création de l\'événement.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    });
            });
        }

        function addEventToList(evenement) {
            const eventsList = document.querySelector('.events-list'); // Make sure you have a container with this class
            if (eventsList) {
                const eventElement = document.createElement('div');
                eventElement.className = 'bg-white shadow-lg rounded-lg overflow-hidden transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl';
                eventElement.id = `evenement-${evenement.id}`;
                
                eventElement.innerHTML = `
                    <div class="p-6">
                        <h2 class="text-xl font-semibold mb-2 text-gray-800">${evenement.titre}</h2>
                        <p class="text-gray-600 mb-4">${evenement.description.substring(0, 100)}${evenement.description.length > 100 ? '...' : ''}</p>
                        <div class="text-sm text-gray-500 space-y-2">
                            <p class="flex items-center">
                                <span class="mr-2">🗓️</span> ${new Date(evenement.date).toLocaleString()}
                            </p>
                            <p class="flex items-center">
                                <span class="mr-2">📍</span> ${evenement.lieu}
                            </p>
                            <p class="flex items-center">
                                <span class="mr-2">👥</span> ${evenement.places_disponibles} places disponibles
                            </p>
                        </div>
                        <div class="mt-4 flex flex-wrap justify-between items-center">
                            <div class="flex space-x-2 mb-2">
                                <a href="/evenements/${evenement.id}/edit" class="text-yellow-600 hover:text-yellow-800 transition duration-300 ease-in-out transform hover:scale-110 edit-event" data-id="${evenement.id}">
                                    <span class="sr-only">Modifier</span>
                                    <span class="text-2xl" aria-hidden="true">✏️</span>
                                </a>
                                <button class="text-red-600 hover:text-red-800 transition duration-300 ease-in-out transform hover:scale-110 delete-event" data-id="${evenement.id}">
                                    <span class="sr-only">Supprimer</span>
                                    <span class="text-2xl" aria-hidden="true">🗑️</span>
                                </button>
                            </div>
                            <div class="flex space-x-2">
                                <button class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-full text-sm transition duration-300 ease-in-out transform hover:scale-105 inscription-btn" data-id="${evenement.id}">
                                    <span class="mr-1">✅</span> S'inscrire
                                </button>
                                <a href="/evenements/${evenement.id}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full text-sm transition duration-300 ease-in-out transform hover:scale-105">
                                    <span class="mr-1">👁️</span> Voir plus
                                </a>
                            </div>
                        </div>
                    </div>
                `;
                
                eventsList.prepend(eventElement);
                
                // Add event listeners to the new buttons
                const newInscriptionBtn = eventElement.querySelector('.inscription-btn');
                if (newInscriptionBtn) {
                    newInscriptionBtn.addEventListener('click', function(e) { handleInscriptionClick.call(this, e, true); });
                }
                
                const newDeleteBtn = eventElement.querySelector('.delete-event');
                if (newDeleteBtn) {
                    newDeleteBtn.addEventListener('click', handleDeleteClick);
                }
            }
        }

        function handleInscriptionClick(e, isInscription) {
            e.preventDefault();
            const eventId = this.dataset.id;
            const url = isInscription ? `/evenements/${eventId}/inscription` : `/evenements/${eventId}/desinscription`;
            const method = isInscription ? 'post' : 'delete';

            axios({
                method: method,
                url: url
            })
            .then(response => {
                Swal.fire({
                    title: isInscription ? 'Inscrit !' : 'Désinscrit !',
                    text: response.data.message,
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                });

                // Update button state
                this.textContent = isInscription ? '🚫 Se désinscrire' : '✅ S\'inscrire';
                this.classList.toggle('bg-green-500');
                this.classList.toggle('hover:bg-green-600');
                this.classList.toggle('bg-red-500');
                this.classList.toggle('hover:bg-red-600');
                this.classList.toggle('inscription-btn');
                this.classList.toggle('desinscription-btn');

                // Update available places
                const eventCard = this.closest('.bg-white');
                const placesElement = eventCard.querySelector('.places-disponibles');
                if (placesElement) {
                    let places = parseInt(placesElement.textContent);
                    places = isInscription ? places - 1 : places + 1;
                    placesElement.textContent = `${places} places disponibles`;
                }
            })
            .catch(error => {
                Swal.fire('Erreur', error.response?.data?.message || 'Une erreur est survenue.', 'error');
            });
        }

        function handleDeleteClick(e) {
            e.preventDefault();
            const eventId = this.dataset.id;
            
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "Vous ne pourrez pas revenir en arrière !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimer !',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`/evenements/${eventId}`)
                        .then(response => {
                            Swal.fire(
                                'Supprimé !',
                                'L\'événement a été supprimé.',
                                'success'
                            );
                            // Remove the event from the DOM
                            document.getElementById(`evenement-${eventId}`).remove();
                        })
                        .catch(error => {
                            Swal.fire('Erreur', 'Une erreur est survenue lors de la suppression.', 'error');
                            console.error('Error:', error);
                        });
                }
            });
        }

        inscriptionButtons.forEach(button => {
            button.addEventListener('click', function(e) { handleInscriptionClick.call(this, e, true); });
        });

        desinscriptionButtons.forEach(button => {
            button.addEventListener('click', function(e) { handleInscriptionClick.call(this, e, false); });
        });

        document.querySelectorAll('.delete-event').forEach(button => {
            button.addEventListener('click', handleDeleteClick);
        });
    });
    </script>
    @endpush
</x-app-layout>