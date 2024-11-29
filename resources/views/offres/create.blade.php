<x-app-layout>
    <div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                <div class="p-8">
                    <h2 class="text-3xl font-semibold text-gray-800 mb-6">
                        Créer une nouvelle offre d'emploi
                    </h2>

                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                            <p class="font-medium">Veuillez corriger les erreurs suivantes :</p>
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('offres.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <!-- Titre -->
                            <div>
                                <label for="titre" class="block text-sm font-medium text-gray-700">Titre de l'offre</label>
                                <input type="text" name="titre" id="titre" required value="{{ old('titre') }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    placeholder="Titre accrocheur">
                            </div>

                            <!-- Description -->
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea name="description" id="description" rows="4" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    placeholder="Décrivez l'offre de manière concise">{{ old('description') }}</textarea>
                            </div>

                            <!-- Missions -->
                            <div class="sm:col-span-2">
                                <label for="missions" class="block text-sm font-medium text-gray-700">Missions</label>
                                <textarea name="missions" id="missions" rows="4" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    placeholder="Détaillez les missions à accomplir">{{ old('missions') }}</textarea>
                            </div>

                            <!-- Type -->
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Type de contrat</label>
                                <select name="type" id="type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                    <option value="stage">Stage</option>
                                    <option value="alternance">Alternance</option>
                                    <option value="CDD">CDD</option>
                                    <option value="CDI">CDI</option>
                                </select>
                            </div>

                            <!-- Salaire -->
                            <div>
                                <label for="salaire" class="block text-sm font-medium text-gray-700">Salaire</label>
                                <input type="number" name="salaire" id="salaire" value="{{ old('salaire') }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    placeholder="Salaire (optionnel)">
                            </div>

                            <h3 class="sm:col-span-2 text-lg font-semibold mb-4">Informations sur l'entreprise</h3>

                            <!-- Nom de l'entreprise -->
                            <div>
                                <label for="entreprise_nom" class="block text-sm font-medium text-gray-700">Nom de l'entreprise</label>
                                <input type="text" name="entreprise_nom" id="entreprise_nom" required value="{{ old('entreprise_nom') }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    placeholder="Nom de l'entreprise">
                            </div>

                            <!-- Adresse -->
                            <div>
                                <label for="entreprise_adresse" class="block text-sm font-medium text-gray-700">Adresse de l'entreprise</label>
                                <input type="text" name="entreprise_adresse" id="entreprise_adresse" required value="{{ old('entreprise_adresse') }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    placeholder="Adresse de l'entreprise">
                            </div>

                            <!-- Code Postal -->
                            <div>
                                <label for="entreprise_code_postal" class="block text-sm font-medium text-gray-700">Code Postal</label>
                                <input type="text" name="entreprise_code_postal" id="entreprise_code_postal" required 
                                    value="{{ old('entreprise_code_postal') }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    placeholder="Code Postal" maxlength="5" oninput="validatePostalCode(this)">
                            </div>

                            <!-- Ville -->
                            <div>
                                <label for="entreprise_ville" class="block text-sm font-medium text-gray-700">Ville</label>
                                <input type="text" name="entreprise_ville" id="entreprise_ville" required value="{{ old('entreprise_ville') }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    placeholder="Ville de l'entreprise">
                            </div>

                            <!-- Téléphone -->
                            <div>
                                <label for="entreprise_telephone" class="block text-sm font-medium text-gray-700">Téléphone de l'entreprise</label>
                                <input type="tel" name="entreprise_telephone" id="entreprise_telephone" required 
                                    value="{{ old('entreprise_telephone') }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    placeholder="Numéro de téléphone de l'entreprise" maxlength="10" oninput="validatePhoneNumber(this)">
                            </div>

                            <!-- Site Web de l'entreprise (optionnel) -->
                            <div>
                                <label for="entreprise_site_web" class="block text-sm font-medium text-gray-700">Site Web de l'entreprise (optionnel)</label>
                                <input type="url" name="entreprise_site_web" id="entreprise_site_web" value="{{ old('entreprise_site_web') }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    placeholder="URL du site web de l'entreprise">
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-6">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Créer l'offre
                            </button>
                            <a href="{{ route('offres.index') }}"
                                class="text-sm font-medium text-gray-600 hover:text-gray-500">
                                Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script pour validation des champs -->
    <script>
        // Validation et formatage du numéro de téléphone
        function validatePhoneNumber(input) {
            input.value = input.value.replace(/[^0-9]/g, '').slice(0, 10);
        }

        // Validation et formatage du code postal
        function validatePostalCode(input) {
            input.value = input.value.replace(/[^0-9]/g, '').slice(0, 5);
        }
    </script>
</x-app-layout>
