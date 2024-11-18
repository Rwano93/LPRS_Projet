<x-app-layout>
    <div class="min-h-screen bg-gradient-to-b from-gray-100 to-gray-200">
        <!-- Hero Section -->
        <div class="relative h-[60vh] bg-gradient-to-r from-blue-600 to-indigo-700 overflow-hidden">
            <div class="absolute inset-0 bg-black opacity-50"></div>
            <div class="absolute inset-0 bg-[url('/placeholder.svg?height=1080&width=1920')] bg-cover bg-center mix-blend-overlay"></div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center">
                <div class="text-white space-y-6">
                    <h1 class="text-5xl md:text-6xl font-bold tracking-tight animate-fade-in-up">Lycée Robert Schuman</h1>
                    <p class="text-xl md:text-2xl max-w-2xl animate-fade-in-up animation-delay-300">Bienvenue dans notre établissement d'excellence à Dugny</p>
                    <a href="#about" class="inline-block bg-white text-blue-600 px-6 py-3 rounded-full font-semibold transition-all hover:bg-blue-100 animate-fade-in-up animation-delay-600">
                        Découvrir
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-24">
            <!-- About Section -->
            <section id="about" class="bg-white rounded-3xl shadow-2xl overflow-hidden transform hover:scale-[1.02] transition-all duration-300">
                <div class="p-8 md:p-12">
                    <h2 class="text-4xl font-bold text-gray-900 mb-8">Notre établissement</h2>
                    <div class="grid md:grid-cols-3 gap-12">
                        <div class="space-y-4 group">
                            <div class="h-2 w-20 bg-blue-600 group-hover:w-full transition-all duration-300"></div>
                            <h3 class="text-2xl font-semibold text-blue-600">Notre Histoire</h3>
                            <p class="text-gray-600 leading-relaxed">Le Lycée Robert Schuman, situé à Dugny, est un établissement reconnu pour son excellence académique et son engagement envers la réussite de ses élèves.</p>
                        </div>
                        <div class="space-y-4 group">
                            <div class="h-2 w-20 bg-green-600 group-hover:w-full transition-all duration-300"></div>
                            <h3 class="text-2xl font-semibold text-green-600">Notre Mission</h3>
                            <p class="text-gray-600 leading-relaxed">Former les citoyens de demain en leur offrant une éducation de qualité, alliant excellence académique et développement personnel.</p>
                        </div>
                        <div class="space-y-4 group">
                            <div class="h-2 w-20 bg-purple-600 group-hover:w-full transition-all duration-300"></div>
                            <h3 class="text-2xl font-semibold text-purple-600">Notre Vision</h3>
                            <p class="text-gray-600 leading-relaxed">Devenir un établissement de référence en matière d'innovation pédagogique et d'accompagnement personnalisé des élèves.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Key Figures -->
            <section class="grid grid-cols-2 md:grid-cols-4 gap-8">
                @php
                    $keyFigures = [
                        ['number' => '800+', 'label' => 'Élèves', 'color' => 'blue'],
                        ['number' => '50+', 'label' => 'Enseignants', 'color' => 'green'],
                        ['number' => '95%', 'label' => 'Taux de réussite', 'color' => 'purple'],
                        ['number' => '15+', 'label' => 'Spécialités', 'color' => 'red'],
                    ];
                @endphp

                @foreach ($keyFigures as $figure)
                    <div class="bg-white p-8 rounded-2xl shadow-lg text-center transform hover:scale-105 transition-all duration-300">
                        <div class="text-4xl font-bold text-{{ $figure['color'] }}-600 mb-2">{{ $figure['number'] }}</div>
                        <div class="text-gray-600 font-medium">{{ $figure['label'] }}</div>
                    </div>
                @endforeach
            </section>

            <!-- News and Events -->
            <section class="space-y-12">
                <h2 class="text-4xl font-bold text-gray-900 text-center">Actualités et Événements</h2>
                <div class="grid md:grid-cols-2 gap-12">
                    <!-- News -->
                    <div class="space-y-8">
                        <h3 class="text-2xl font-semibold text-gray-800 flex items-center">
                            <span class="bg-blue-600 w-2 h-8 mr-3 rounded-full"></span>
                            Dernières actualités
                        </h3>
                        @if(isset($actualites) && $actualites->count() > 0)
                            @foreach ($actualites as $actualite)
                                <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                    <div class="flex justify-between items-start mb-4">
                                        <h4 class="text-xl font-medium text-gray-900">{{ $actualite->evenement->titre }}</h4>
                                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                                            {{ $actualite->evenement->type }}
                                        </span>
                                    </div>
                                    <p class="text-gray-600 mb-4">{{ Str::limit($actualite->evenement->description, 150) }}</p>
                                    <a href="{{ route('evenement.show', $actualite->evenement) }}" 
                                       class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors duration-300">
                                        En savoir plus
                                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                        </svg>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <div class="bg-white p-6 rounded-2xl shadow text-center">
                                <p class="text-gray-600">Aucune actualité disponible pour le moment.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Events -->
                    <div class="space-y-8">
                        <h3 class="text-2xl font-semibold text-gray-800 flex items-center">
                            <span class="bg-green-600 w-2 h-8 mr-3 rounded-full"></span>
                            Événements à venir
                        </h3>
                        @if(isset($evenement) && $evenement->count() > 0)
                            @foreach ($evenement as $event)
                                <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                    <div class="flex justify-between items-start mb-4">
                                        <h4 class="text-xl font-medium text-gray-900">{{ $event->titre }}</h4>
                                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                                            {{ $event->type }}
                                        </span>
                                    </div>
                                    <div class="flex items-center text-gray-500 text-sm mb-3">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ $event->date->format('d/m/Y H:i') }}
                                    </div>
                                    <div class="flex items-center text-gray-500 text-sm mb-4">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        {{ $event->adresse }}
                                    </div>
                                    <p class="text-gray-600 mb-4">{{ Str::limit($event->description, 150) }}</p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-500">Places restantes : {{ $event->nb_place }}</span>
                                        @if (!$event->isInscrit)
                                            <form action="{{ route('evenement.inscription', $event) }}" method="POST">
                                                @csrf
                                                <button type="submit" 
                                                        class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-full transition-colors duration-300">
                                                    S'inscrire
                                                </button>
                                            </form>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                                Inscrit
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="bg-white p-6 rounded-2xl shadow text-center">
                                <p class="text-gray-600">Aucun événement à venir pour le moment.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </section>

            <!-- Contact Section -->
            <section class="bg-white rounded-3xl shadow-2xl overflow-hidden">
                <div class="p-8 md:p-12">
                    <h2 class="text-4xl font-bold text-gray-900 mb-8">Nous contacter</h2>
                    <div class="grid md:grid-cols-2 gap-12">
                        <div class="space-y-6">
                            <h3 class="text-2xl font-semibold text-gray-800">Coordonnées</h3>
                            <div class="space-y-4">
                                <p class="flex items-center text-gray-600">
                                    <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    1-5 Boulevard de la République, 93440 Dugny
                                </p>
                                <p class="flex items-center text-gray-600">
                                    <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    contact@lycee-robertschuman.com
                                </p>
                                <p class="flex items-center text-gray-600">
                                    <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                    01 48 37 74 26
                                </p>
                            </div>
                        </div>
                        <div class="space-y-6">
                            <h3 class="text-2xl font-semibold text-gray-800">Horaires d'ouverture</h3>
                            <div class="space-y-2 text-gray-600">
                                <p class="flex items-center">
                                    <svg class="w-5 h-5 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Lundi - Vendredi : 8h00 - 18h00
                                </p>
                                <p class="flex items-center">
                                    <svg class="w-5 h-5 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Samedi : 8h00 - 12h00
                                </p>
                                <p class="flex items-center">
                                    <svg class="w-5 h-5 mr-3 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Dimanche : Fermé
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>