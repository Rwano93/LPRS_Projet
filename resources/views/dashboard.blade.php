<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-800 via-gray-700 to-gray-800 text-white animate-fade-in-up">
        <!-- Hero Section -->
        <section class="relative overflow-hidden pb-24 lg:pb-32">
            <div class="absolute inset-0 bg-gradient-to-l from-indigo-600 to-purple-600 opacity-75"></div>
            <div class="max-w-7xl mx-auto py-24 px-4 sm:px-6 lg:px-8 lg:py-36 relative z-10">
                <div class="text-center">
                    <h1 class="text-5xl font-extrabold sm:text-6xl md:text-7xl lg:text-8xl text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-pink-500">
                        Bienvenue sur notre Plateforme Innovante
                    </h1>
                    <p class="mt-6 max-w-3xl mx-auto text-xl text-gray-300">
                        Explorez un monde d'opportunités et restez à jour avec nos offres exclusives et événements à venir.
                    </p>
                    <div class="mt-10">
                        <a href="{{ route('register') }}"
                           class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-full text-indigo-600 bg-white hover:bg-gray-100 transition duration-300 ease-in-out transform hover:scale-105">
                            Rejoindre Maintenant
                        </a>
                    </div>
                </div>
            </div>
            <div class="absolute bottom-24 left-1/2 transform -translate-x-1/2">
                <svg class="w-8 h-8 mx-auto text-white animate-bounce" fill="none" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </div>
        </section>

        <!-- Transition Section -->
        <div class="bg-gradient-to-b from-gray-800 to-transparent h-32"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 space-y-32">
            <!-- Offres Section -->
            <section>
                <h2 class="text-4xl font-extrabold mb-16 text-center bg-clip-text text-transparent bg-gradient-to-r from-green-400 to-blue-600">
                    Nos Offres de Carrière
                </h2>
                <div class="grid gap-12 md:grid-cols-2 lg:grid-cols-3">
                    @forelse($meilleuresOffres as $offre)
                        <div class="bg-gray-800 overflow-hidden rounded-3xl flex flex-col justify-between min-h-[350px] transform transition duration-300 hover:scale-105 hover:shadow-2xl">
                            <div class="p-8 flex-grow">
                                <h3 class="text-2xl font-semibold text-white flex items-center mb-4">
                                    <svg class="w-8 h-8 mr-3 text-blue-500 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                        </path>
                                    </svg>
                                    <span class="break-words">{{ $offre->titre }}</span>
                                </h3>
                                <p class="text-sm text-gray-400 mb-4">
                                    Publiée le {{ $offre->created_at->format('d/m/Y') }}
                                </p>
                                <p class="text-gray-300">
                                    {{ Str::limit($offre->description, 150) }}
                                </p>
                            </div>
                            <div class="bg-gray-700 px-8 py-4 mt-auto">
                                <a href="{{ route('offre.show', $offre) }}"
                                    class="text-sm font-medium text-indigo-400 hover:text-indigo-300 flex items-center justify-between transition duration-300">
                                    <span>En savoir plus</span>
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-400 col-span-full text-center text-lg">Aucune offre disponible pour le moment.</p>
                    @endforelse
                </div>
            </section>

            <!-- Événements Section -->
            <section>
                <h2 class="text-4xl font-extrabold mb-16 text-center bg-clip-text text-transparent bg-gradient-to-r from-purple-400 to-pink-600">
                    Nos Événements à Venir
                </h2>
                <div class="grid gap-12 md:grid-cols-2 lg:grid-cols-3">
                    @forelse($evenementAvants as $evenementAvant)
                        @if($evenementAvant->evenement)
                            <div class="bg-gray-800 overflow-hidden rounded-3xl flex flex-col justify-between min-h-[350px] transform transition duration-300 hover:scale-105 hover:shadow-2xl">
                                <div class="p-8 flex-grow">
                                    <h3 class="text-2xl font-semibold text-white flex items-center mb-4">
                                        <svg class="w-8 h-8 mr-3 text-green-500 flex-shrink-0" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <span class="break-words">{{ $evenementAvant->evenement->titre }}</span>
                                    </h3>
                                    <p class="text-sm text-gray-400 mb-4">
                                        Date : {{ $evenementAvant->evenement->date
                                        ? ($evenementAvant->evenement->date instanceof \DateTime
                                            ? $evenementAvant->evenement->date->format('d/m/Y')
                                            : date('d/m/Y', strtotime($evenementAvant->evenement->date)))
                                        : 'Non spécifiée' }}
                                    </p>
                                    <p class="text-gray-300">
                                        {{ Str::limit($evenementAvant->evenement->description, 150) }}
                                    </p>
                                </div>
                                <div class="bg-gray-700 px-8 py-4 mt-auto">
                                    <a href="{{ route('evenement.show', $evenementAvant->evenement) }}"
                                       class="text-sm font-medium text-green-400 hover:text-green-300 flex items-center justify-between transition duration-300">
                                        <span>En savoir plus</span>
                                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endif
                    @empty
                        <p class="text-gray-400 col-span-full text-center text-lg">Aucun événement à venir pour le moment.</p>
                    @endforelse
                </div>
            </section>

            <!-- Actualités Section -->
            <section>
                <h2 class="text-4xl font-extrabold mb-16 text-center bg-clip-text text-transparent bg-gradient-to-r from-yellow-400 to-red-600">
                    Dernières Actualités
                </h2>
                <div class="grid gap-12 md:grid-cols-2 lg:grid-cols-3">
                    @foreach(range(1, 3) as $index)
                        <div class="bg-gray-800 overflow-hidden rounded-3xl transform transition duration-300 hover:scale-105 hover:shadow-2xl">
                            <div class="p-8">
                                <h3 class="text-2xl font-semibold text-white flex items-center mb-4">
                                    <svg class="w-8 h-8 mr-3 text-yellow-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                        </path>
                                    </svg>
                                    Actualité {{ $index }}
                                </h3>
                                <p class="text-sm text-gray-400 mb-4">
                                    Publiée le {{ now()->subDays($index)->format('d/m/Y') }}
                                </p>
                                <p class="text-gray-300">
                                    Résumé de l'actualité {{ $index }}. Ceci est un exemple de contenu pour illustrer la
                                    mise en page.
                                </p>
                            </div>
                            <div class="bg-gray-700 px-8 py-4">
                                <a href="#"
                                    class="text-sm font-medium text-yellow-400 hover:text-yellow-300 flex items-center justify-between transition duration-300">
                                    <span>Lire la suite</span>
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>

    <style>
        @keyframes fade-in-up {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.5s ease-out;
        }
    </style>
</x-app-layout>
