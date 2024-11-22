<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Créer une nouvelle offre d'emploi") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('offres.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="titre" class="block text-gray-700 text-sm font-bold mb-2">Titre</label>
                            <input type="text" name="titre" id="titre" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required maxlength="255">
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                            <textarea name="description" id="description" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="missions" class="block text-gray-700 text-sm font-bold mb-2">Missions</label>
                            <textarea name="missions" id="missions" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="type" class="block text-gray-700 text-sm font-bold mb-2">Type</label>
                            <select name="type" id="type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="stage">Stage</option>
                                <option value="alternance">Alternance</option>
                                <option value="CDD">CDD</option>
                                <option value="CDI">CDI</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="salaire" class="block text-gray-700 text-sm font-bold mb-2">Salaire</label>
                            <input type="number" name="salaire" id="salaire" min="0" step="0.01" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <h3 class="text-lg font-semibold mb-4">Informations de l'entreprise</h3>

                        <div class="mb-4">
                            <label for="entreprise_nom" class="block text-gray-700 text-sm font-bold mb-2">Nom de l'entreprise</label>
                            <input type="text" name="entreprise_nom" id="entreprise_nom" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required maxlength="255">
                        </div>

                        <div class="mb-4">
                            <label for="entreprise_adresse" class="block text-gray-700 text-sm font-bold mb-2">Adresse</label>
                            <input type="text" name="entreprise_adresse" id="entreprise_adresse" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required maxlength="255">
                        </div>

                        <div class="mb-4">
                            <label for="entreprise_code_postal" class="block text-gray-700 text-sm font-bold mb-2">Code Postal</label>
                            <input type="text" name="entreprise_code_postal" id="entreprise_code_postal" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required pattern="[0-9]{5}" title="Le code postal doit contenir 5 chiffres">
                        </div>

                        <div class="mb-4">
                            <label for="entreprise_ville" class="block text-gray-700 text-sm font-bold mb-2">Ville</label>
                            <input type="text" name="entreprise_ville" id="entreprise_ville" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required maxlength="255">
                        </div>

                        <div class="mb-4">
                            <label for="entreprise_telephone" class="block text-gray-700 text-sm font-bold mb-2">Téléphone</label>
                            <input type="tel" name="entreprise_telephone" id="entreprise_telephone" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required pattern="[0-9]{10}" title="Le numéro de téléphone doit contenir 10 chiffres">
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Créer l'offre
                            </button>
                            <a href="{{ route('offres.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                                Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>