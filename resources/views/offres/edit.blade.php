<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                <div class="p-8">
                    <h2 class="text-3xl font-semibold text-gray-800 mb-6">
                        Modifier l'offre d'emploi
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

                    <form action="{{ route('offres.update', $offre) }}" method="POST" id="offreForm"
                        class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div class="sm:col-span-2">
                                <label for="titre" class="block text-sm font-medium text-gray-700">Titre de l'offre</label>
                                <input type="text" name="titre" id="titre" required
                                    value="{{ old('titre', $offre->titre) }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    placeholder="Titre de l'offre">
                            </div>

                            <div class="sm:col-span-2">
                                <label for="description"
                                    class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea name="description" id="description" rows="4" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    placeholder="Décrivez l'offre en détail">{{ old('description', $offre->description) }}</textarea>
                            </div>

                            <div class="sm:col-span-2">
                                <label for="missions"
                                    class="block text-sm font-medium text-gray-700">Missions</label>
                                <textarea name="missions" id="missions" rows="4" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    placeholder="Détaillez les missions du poste">{{ old('missions', $offre->missions) }}</textarea>
                            </div>

                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Type de contrat</label>
                                <select name="type" id="type" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="stage" {{ old('type', $offre->type) == 'stage' ? 'selected' : '' }}>Stage</option>
                                    <option value="alternance" {{ old('type', $offre->type) == 'alternance' ? 'selected' : '' }}>Alternance</option>
                                    <option value="CDD" {{ old('type', $offre->type) == 'CDD' ? 'selected' : '' }}>CDD</option>
                                    <option value="CDI" {{ old('type', $offre->type) == 'CDI' ? 'selected' : '' }}>CDI</option>
                                </select>
                            </div>

                            <div>
                                <label for="salaire" class="block text-sm font-medium text-gray-700">Salaire</label>
                                <input type="number" name="salaire" id="salaire" step="0.01"
                                    value="{{ old('salaire', $offre->salaire) }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    placeholder="Salaire annuel brut">
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-6">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Mettre à jour l'offre
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
</x-app-layout>
