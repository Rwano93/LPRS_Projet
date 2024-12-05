<x-app-layout>
    <div class="min-h-screen bg-gray-100 flex flex-col">
        <!-- Welcome Section (Replacing Header) -->
        <section class="bg-gradient-to-r bg-black py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
                <h2 class="text-3xl font-extrabold sm:text-4xl">Bienvenue sur notre plateforme</h2>
                <p class="mt-4 text-xl text-indigo-100">Découvrez les opportunités qui vous attendent au Lycée Robert-Schuman.</p>
                <a href="#" 
                   class="mt-8 inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-white hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-indigo-700 focus:ring-white transition-colors duration-300 ease-in-out transform hover:scale-105">
                    Explorez nos programmes
                </a>
            </div>
        </section>
        &nbsp;&nbsp;&nbsp;
        <div class="bg-gradient-to-b from-gray-900 to-transparent h-32"></div>

        <!-- Main Content -->
        <main class="flex-grow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
                &nbsp;&nbsp;&nbsp;
            <!-- Actualités et Événements -->
            <section class="mb-16">
                <div class="flex justify-center items-center mb-8">
                    <h2 class="text-3xl font-semibold text-gray-900">Actualités et Événements</h2>
                </div>
                <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @forelse($evenements as $evenement)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden transition duration-300 ease-in-out transform hover:-translate-y-2 hover:shadow-xl flex flex-col">
                            <div class="flex-grow p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <h3 class="text-2xl font-bold text-indigo-900">{{ $evenement->titre }}</h3>
                                    <span class="text-sm font-medium text-indigo-600 bg-indigo-100 rounded-full px-3 py-1">
                                        {{ $evenement->type }}
                                    </span>
                                </div>
                                <p class="text-gray-600 mb-4">{{ Str::limit($evenement->description, 100) }}</p>
                                <div class="space-y-2 text-sm text-gray-500">
                                    <div class="flex items-center">
                                        <svg class="mr-2 h-5 w-5 text-indigo-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                        </svg>
                                        {{ $evenement->date->format('d/m/Y H:i') }}
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="mr-2 h-5 w-5 text-indigo-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                        </svg>
                                        {{ Str::mask($evenement->adresse, '*', 3) }}
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="mr-2 h-5 w-5 text-indigo-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                        </svg>
                                        Places disponibles : {{ Str::mask($evenement->nb_place, '*', 0, 1) }}
                                    </div>
                                </div>
                            </div>
                            <div class="bg-indigo-50 p-6">
                                <div class="flex justify-between items-center">
                                    @guest
                                        <a href="{{ route('login') }}" class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out transform hover:-translate-y-1 shadow-md hover:shadow-lg">
                                            Se connecter pour en savoir plus
                                        </a>
                                    @elseif(auth()->user()->ref_role == 1)
                                        <a href="/demandes" class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out transform hover:-translate-y-1 shadow-md hover:shadow-lg">
                                            Changer de statut pour accéder
                                        </a>
                                    @else
                                        <a href="/evenements" class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out transform hover:-translate-y-1 shadow-md hover:shadow-lg">
                                            En savoir plus
                                        </a>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600">Aucun événement à afficher pour le moment.</p>
                    @endforelse
                </div>
            </section>
            &nbsp;&nbsp;&nbsp;
            <!-- Offres d'emploi -->
            <section class="mb-16">
                <h2 class="text-3xl font-semibold text-gray-900 mb-8 text-center">Offres d'emploi récentes</h2>
                <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @forelse($offres as $offre)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden transition duration-300 ease-in-out transform hover:-translate-y-2 hover:shadow-xl flex flex-col">
                            <div class="flex-grow p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <h3 class="text-2xl font-bold text-indigo-900">{{ $offre->titre }}</h3>
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
                                        {{ Str::mask($offre->entreprise->ville, '*', 3) }}
                                    </div>
                                </div>
                            </div>
                            <div class="bg-indigo-50 p-6">
                                <div class="flex justify-between items-center">
                                    @guest
                                        <a href="{{ route('login') }}" class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out transform hover:-translate-y-1 shadow-md hover:shadow-lg">
                                            Se connecter pour en savoir plus
                                        </a>
                                    @elseif(auth()->user()->ref_role == 1)
                                        <a href="/demandes" class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out transform hover:-translate-y-1 shadow-md hover:shadow-lg">
                                            Changer de statut pour accéder
                                        </a>
                                    @else
                                        <a href="{{ route('offres.show', $offre->id) }}" class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out transform hover:-translate-y-1 shadow-md hover:shadow-lg">
                                            En savoir plus
                                        </a>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600">Aucune offre d'emploi à afficher pour le moment.</p>
                    @endforelse
                </div>
            </section>
            </div>
        </main>
        &nbsp;&nbsp;&nbsp;
        <!-- Call to Action Section -->
        <section class="bg-gradient-to-r from-indigo-600 to-purple-700 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
                <h2 class="text-3xl font-extrabold sm:text-4xl">Prêt à rejoindre notre communauté ?</h2>
                <p class="mt-4 text-xl text-indigo-100">Découvrez les opportunités qui vous attendent au Lycée Robert-Schuman.</p>
                <a href="/demandes" 
                   class="mt-8 inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-white hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-indigo-700 focus:ring-white transition-colors duration-300 ease-in-out transform hover:scale-105">
                    Explorez nos programmes
                </a>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-800 py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="text-center md:text-left mb-4 md:mb-0">
                        <img src="/placeholder.svg?height=50&width=200" alt="Logo" class="h-8 w-auto inline-block">
                        <p class="text-gray-400 text-sm mt-2">&copy; 2024 Lycée Robert-Schuman. Tous droits réservés.</p>
                    </div>
                    <div class="flex space-x-6">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                            <span class="sr-only">Instagram</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                            <span class="sr-only">Twitter</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</x-app-layout>

