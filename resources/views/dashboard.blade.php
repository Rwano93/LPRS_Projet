<x-app-layout>
    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.5s ease-out forwards;
        }
        .animation-delay-300 { animation-delay: 0.3s; }
        .animation-delay-600 { animation-delay: 0.6s; }
        .bg-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%239C92AC' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>

    <!-- Hero Section -->
    <header class="bg-gradient-to-r from-gray-800 to-gray-900 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-pattern opacity-10"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-extrabold mb-4 animate-fade-in-up">
                    Bienvenue au Lycée Robert Schuman
                </h1>
                <p class="text-xl md:text-2xl mb-8 animate-fade-in-up animation-delay-300">
                    Découvrez l'excellence éducative à Dugny
                </p>
                <a href="#about" class="inline-block bg-white text-gray-800 px-8 py-4 rounded-full font-semibold text-lg transition-all duration-300 hover:bg-gray-200 hover:scale-105 animate-fade-in-up animation-delay-600">
                    Découvrir notre lycée
                </a>
            </div>
        </div>
    </header>

    <main class="bg-gray-50">
        <!-- About Section -->
        <section id="about" class="py-16 md:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-12">Notre établissement</h2>
                <div class="grid md:grid-cols-3 gap-8">
                    @php
                    $aboutItems = [
                        ['title' => 'Notre Histoire', 'color' => 'blue', 'content' => 'Le Lycée Robert Schuman, situé à Dugny, est reconnu pour son excellence académique et son engagement envers la réussite de ses élèves.'],
                        ['title' => 'Notre Mission', 'color' => 'green', 'content' => 'Former les citoyens de demain en offrant une éducation de qualité, alliant excellence académique et développement personnel.'],
                        ['title' => 'Notre Vision', 'color' => 'purple', 'content' => 'Devenir un établissement de référence en matière d\'innovation pédagogique et d\'accompagnement personnalisé des élèves.']
                    ];
                    @endphp

                    @foreach ($aboutItems as $item)
                    <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="h-2 w-20 bg-{{ $item['color'] }}-500 mb-4"></div>
                        <h3 class="text-xl font-semibold text-{{ $item['color'] }}-600 mb-3">{{ $item['title'] }}</h3>
                        <p class="text-gray-600">{{ $item['content'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Key Figures -->
        <section class="py-16 bg-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-12">Chiffres clés</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    @php
                    $keyFigures = [
                        ['number' => '800+', 'label' => 'Élèves', 'color' => 'blue'],
                        ['number' => '50+', 'label' => 'Enseignants', 'color' => 'green'],
                        ['number' => '95%', 'label' => 'Taux de réussite', 'color' => 'purple'],
                        ['number' => '15+', 'label' => 'Spécialités', 'color' => 'red'],
                    ];
                    @endphp

                    @foreach ($keyFigures as $figure)
                    <div class="bg-white p-6 rounded-lg shadow-lg text-center transform hover:scale-105 transition-all duration-300">
                        <div class="text-3xl md:text-4xl font-bold text-{{ $figure['color'] }}-600 mb-2">{{ $figure['number'] }}</div>
                        <div class="text-gray-600 font-medium">{{ $figure['label'] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- News and Events -->
        <section class="py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-12">Actualités et Événements</h2>
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- News -->
                    <div>
                        <h3 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center">
                            <span class="bg-blue-500 w-2 h-8 mr-3 rounded-full"></span>
                            Dernières actualités
                        </h3>
                        @if(isset($actualites) && $actualites->count() > 0)
                            @foreach ($actualites as $actualite)
                            <div class="bg-white p-6 rounded-lg shadow-lg mb-6 hover:shadow-xl transition-shadow duration-300">
                                <h4 class="text-xl font-medium text-gray-900 mb-2">{{ $actualite->evenement->titre }}</h4>
                                <p class="text-gray-600 mb-4">{{ Str::limit($actualite->evenement->description, 150) }}</p>
                                <a href="{{ route('evenement.show', $actualite->evenement) }}" class="text-blue-600 hover:text-blue-800 font-medium transition-colors duration-300">
                                    En savoir plus →
                                </a>
                            </div>
                            @endforeach
                        @else
                            <p class="text-gray-600 text-center">Aucune actualité disponible pour le moment.</p>
                        @endif
                    </div>

                    <!-- Events -->
                    <div>
                        <h3 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center">
                            <span class="bg-green-500 w-2 h-8 mr-3 rounded-full"></span>
                            Événements à venir
                        </h3>
                        @if(isset($evenement) && $evenement->count() > 0)
                            @foreach ($evenement as $event)
                            <div class="bg-white p-6 rounded-lg shadow-lg mb-6 hover:shadow-xl transition-shadow duration-300">
                                <h4 class="text-xl font-medium text-gray-900 mb-2">{{ $event->titre }}</h4>
                                <p class="text-sm text-gray-500 mb-2">
                                    <span class="inline-block mr-4">
                                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ $event->date->format('d/m/Y H:i') }}
                                    </span>
                                    <span>
                                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        {{ $event->adresse }}
                                    </span>
                                </p>
                                <p class="text-gray-600 mb-4">{{ Str::limit($event->description, 150) }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-500">Places : {{ $event->nb_place }}</span>
                                    @if (!$event->isInscrit)
                                        <form action="{{ route('evenement.inscription', $event) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-full transition-colors duration-300">
                                                S'inscrire
                                            </button>
                                        </form>
                                    @else
                                        <span class="bg-green-100 text-green-800 text-sm font-medium py-1 px-3 rounded-full">
                                            Inscrit
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        @else
                            <p class="text-gray-600 text-center">Aucun événement à venir pour le moment.</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="py-16 bg-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-12">Nous contacter</h2>
                <div class="bg-white rounded-lg shadow-xl overflow-hidden">
                    <div class="md:flex">
                        <div class="md:w-1/2 p-6 md:p-8">
                            <h3 class="text-2xl font-semibold text-gray-800 mb-6">Coordonnées</h3>
                            <div class="space-y-4">
                                <p class="flex items-center text-gray-600">
                                    <svg class="w-6 h-6 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    1-5 Boulevard de la République, 93440 Dugny
                                </p>
                                <p class="flex items-center text-gray-600">
                                    <svg class="w-6 h-6 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    contact@lycee-robertschuman.com
                                </p>
                                <p class="flex items-center text-gray-600">
                                    <svg class="w-6 h-6 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    01 48 37 74 26
                                </p>
                            </div>
                        </div>
                        <div class="md:w-1/2 p-6 md:p-8 bg-gray-50">
                            <h3 class="text-2xl font-semibold text-gray-800 mb-6">Horaires d'ouverture</h3>
                            <div class="space-y-2 text-gray-600">
                                <p class="flex items-center">
                                    <svg class="w-5 h-5 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Lundi - Vendredi : 8h00 - 18h00
                                </p>
                                <p class="flex items-center">
                                    <svg class="w-5 h-5 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Samedi : 8h00 - 12h00
                                </p>
                                <p class="flex items-center">
                                    <svg class="w-5 h-5 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Dimanche : Fermé
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-app-layout>