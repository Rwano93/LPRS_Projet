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
        
        <div class="bg-gradient-to-b from-gray-900 to-transparent h-32"></div>

        <!-- Main Content -->
        <main class="flex-grow">
            <!-- Présentation de l'école -->
            <section class="bg-white shadow-lg rounded-lg mx-4 sm:mx-6 lg:mx-8 my-12 overflow-hidden">
                <div class="md:flex">
                    <div class="md:flex-shrink-0">
                        <img class="h-48 w-full object-cover md:w-48" src="/placeholder.svg?height=300&width=400" alt="Lycée Robert-Schuman">
                    </div>
                    <div class="p-8">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Notre Mission</h2>
                        <p class="mt-2 text-gray-600 mb-6">
                            Le Lycée Robert-Schuman s'engage à fournir une éducation de qualité, à préparer les étudiants pour l'avenir et à cultiver un environnement d'apprentissage innovant et inclusif.
                        </p>
                        <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            En savoir plus
                            <svg class="ml-2 -mr-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </section>
            <!--Ajout d'espace-->
            &nbsp;&nbsp;&nbsp;

            <!-- Actualités et Événements -->
            <section class="mt-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-semibold text-gray-900 mb-8">Actualités et Événements</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @foreach(range(1, 3) as $index)
                        <div class="bg-white rounded-lg shadow-lg border border-gray-200 hover:shadow-xl transition-all duration-300 ease-in-out transform hover:scale-105">
                            <img class="w-full h-48 object-cover rounded-t-lg" src="/placeholder.svg?height=200&width=400" alt="Événement {{ $index }}">
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-900 mb-3">Événement {{ $index }}</h3>
                                <p class="text-gray-600 mb-6">Description brève de l'événement ou de l'actualité...</p>
                                <a href="/evenements" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    En savoir plus
                                    <svg class="ml-2 -mr-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- Offres d'emploi -->
            <section class="mt-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">
                <!--Ajout d'espace-->
                &nbsp;&nbsp;&nbsp;
                <h2 class="text-3xl font-semibold text-gray-900 mb-8">Offres d'emploi récentes</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @foreach(range(1, 3) as $index)
                        <div class="bg-white rounded-lg shadow-lg border border-gray-200 hover:shadow-xl transition-all duration-300 ease-in-out transform hover:scale-105">
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-900 mb-3">Poste {{ $index }}</h3>
                                <p class="text-gray-600 mb-6">Description brève du poste...</p>
                                <a href="/offres.index" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    En savoir plus
                                    <svg class="ml-2 -mr-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!--Ajout d'espace-->
                &nbsp;&nbsp;&nbsp;
            </section>
        </main>
        
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

