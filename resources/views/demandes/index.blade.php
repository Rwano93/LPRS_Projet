<x-app-layout> 
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-white"> 
        <!-- Header -->
        <header class="bg-white shadow-sm sticky top-0 z-10">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold text-gray-900">Demandes de changement de statut</h1> 
                <p class="mt-2 text-sm text-gray-600">Choisissez votre nouveau parcours</p> 
            </div> 
        </header>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto py-12 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
                @foreach($roles as $role)
                    <div class="bg-white overflow-hidden shadow-xl rounded-lg border border-gray-200 transition-all duration-300 hover:shadow-2xl hover:border-blue-300 flex flex-col">
                        <div class="p-6 flex flex-col flex-grow">
                            <h2 class="text-xl font-semibold text-gray-900 mb-4">{{ $role->libelle }}</h2>
                            <p class="text-gray-600 mb-6 flex-grow">
                                @switch($role->libelle)
                                    @case('Etudiant')
                                        Accédez à nos formations et développez vos compétences pour l'avenir.
                                        @break
                                    @case('Professeur')
                                        Partagez votre expertise et façonnez la prochaine génération de professionnels.
                                        @break
                                    @case('Alumni')
                                        Restez connecté, accédez à des opportunités exclusives et élargissez votre réseau.
                                        @break
                                    @case('Entreprise')
                                        Collaborez avec nous pour recruter des talents et stimuler l'innovation.
                                        @break
                                @endswitch
                            </p>
                        </div>
                        <div class="p-4 bg-gray-50">
                            <a href="{{ route('demandes.create.' . strtolower($role->libelle)) }}" 
                               class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-300">
                                Faire une demande
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 -mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </main>

        <!-- Call to Action Section -->
        <section class="bg-gradient-to-r from-blue-600 to-indigo-700 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-extrabold text-white sm:text-4xl">Prêt à franchir le pas ?</h2>
                <p class="mt-4 text-xl text-blue-100">
                    Rejoignez notre communauté et découvrez de nouvelles opportunités.
                </p>
                <a href="#" 
                   class="mt-8 inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-blue-700 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-blue-700 focus:ring-white transition-colors duration-300">
                    En savoir plus
                </a>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <p class="text-center text-gray-400 text-sm">
                    © 2024 Votre Organisation. Tous droits réservés.
                </p>
            </div>
        </footer>
    </div>
</x-app-layout>
