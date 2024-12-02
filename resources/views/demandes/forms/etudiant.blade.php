<x-app-layout>
    <div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                <div class="p-8">
                    <h2 class="text-3xl font-semibold text-gray-800 mb-6">
                        Demande de changement de statut - Étudiant
                    </h2>

                    <form action="{{ route('demandes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="etudiantForm">
                        @csrf
                        <input type="hidden" name="role_id" value="{{ $role->id ?? '' }}">

                        <div>
                            <label for="niveau_etude" class="block text-sm font-medium text-gray-700">Niveau d'étude</label>
                            <select name="niveau_etude" id="niveau_etude" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="">Sélectionnez un niveau d'étude</option>
                                @foreach($niveauxEtude as $niveau)
                                    <option value="{{ $niveau->id }}">{{ $niveau->libelle }}</option>
                                @endforeach
                                
                            </select>
                        </div>

                        <div id="autre_niveau_etude_container" style="display: none;">
                            <label for="autre_niveau_etude" class="block text-sm font-medium text-gray-700">Précisez votre niveau d'étude</label>
                            <input type="text" name="autre_niveau_etude" id="autre_niveau_etude"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="filiere" class="block text-sm font-medium text-gray-700">Filière</label>
                            <input type="text" name="filiere" id="filiere" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="cv" class="block text-sm font-medium text-gray-700">CV (PDF)</label>
                            <input type="file" name="cv" id="cv" accept=".pdf" required
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

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const niveauEtudeSelect = document.getElementById('niveau_etude');
            const autreNiveauEtudeContainer = document.getElementById('autre_niveau_etude_container');
            const autreNiveauEtudeInput = document.getElementById('autre_niveau_etude');
            const form = document.getElementById('etudiantForm');

            niveauEtudeSelect.addEventListener('change', function() {
                if (this.value === 'autre') {
                    autreNiveauEtudeContainer.style.display = 'block';
                    autreNiveauEtudeInput.required = true;
                } else {
                    autreNiveauEtudeContainer.style.display = 'none';
                    autreNiveauEtudeInput.required = false;
                }
            });

            form.addEventListener('submit', function(e) {
                if (niveauEtudeSelect.value === '') {
                    e.preventDefault();
                    alert('Veuillez sélectionner un niveau d\'étude ou choisir "Autre".');
                }
            });
        });
    </script>
    @endpush
</x-app-layout>