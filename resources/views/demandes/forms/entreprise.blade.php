<x-app-layout>
    <div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                <div class="p-8">
                    <h2 class="text-3xl font-semibold text-gray-800 mb-6">
                        Demande de changement de statut - Partenaire
                    </h2>

                    <form action="{{ route('demandes.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="role_id" value="{{ $role->id ?? '' }}">

                        <div>
                            <label for="nom_entreprise" class="block text-sm font-medium text-gray-700">Nom de l'entreprise</label>
                            <input type="text" name="nom_entreprise" id="nom_entreprise" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="adresse" class="block text-sm font-medium text-gray-700">Adresse</label>
                            <input type="text" name="adresse" id="adresse" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="code_postal" class="block text-sm font-medium text-gray-700">Code postal</label>
                            <input type="text" name="code_postal" id="code_postal" required pattern="[0-9]{5}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="ville" class="block text-sm font-medium text-gray-700">Ville</label>
                            <input type="text" name="ville" id="ville" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="secteur_activite" class="block text-sm font-medium text-gray-700">Secteur d'activité</label>
                            <input type="text" name="secteur_activite" id="secteur_activite" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="site_web" class="block text-sm font-medium text-gray-700">Site web</label>
                            <input type="url" name="site_web" id="site_web" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                            <input type="tel" name="telephone" id="telephone" required pattern="[0-9]{10}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="poste" class="block text-sm font-medium text-gray-700">Votre poste dans l'entreprise</label>
                            <input type="text" name="poste" id="poste" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700">Message de motivation</label>
                            <textarea name="message" id="message" rows="4" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                        </div>

                        <div class="flex items-center justify-between pt-6">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Envoyer la demande
                            </button>
                            <a href="{{ route('demandes.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-500">
                                Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

