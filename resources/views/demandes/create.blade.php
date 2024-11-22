<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Demande de changement de statut') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8" x-data="demandeForm()">
                    <form @submit.prevent="submitForm" class="space-y-6">
                        @csrf
                        <div>
                            <label for="type_demande" class="block text-sm font-medium text-gray-700">Type de compte souhaité</label>
                            <div class="mt-1 relative">
                                <select
                                    id="type_demande"
                                    name="type_demande"
                                    x-model="formData.type_demande"
                                    @change="updateAdditionalFields"
                                    class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                    required
                                >
                                    <option value="">Sélectionnez un type</option>
                                    <option value="Etudiant">Etudiant</option>
                                    <option value="Professeur">Professeur</option>
                                    <option value="Alumni">Alumni</option>
                                    <option value="Entreprise">Entreprise</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700">Message de motivation</label>
                            <div class="mt-1">
                                <textarea
                                    id="message"
                                    name="message"
                                    rows="4"
                                    x-model="formData.message"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder="Votre message ici..."
                                    required
                                ></textarea>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 my-4"></div>

                        <div x-show="showAdditionalFields" x-cloak>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Informations supplémentaires</h3>
                            <div class="space-y-4" x-html="additionalFieldsHtml"></div>
                        </div>

                        <div>
                            <button
                                type="submit"
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            >
                                Envoyer la demande
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function demandeForm() {
            return {
                formData: {
                    type_demande: '',
                    message: '',
                    formation_id: '',
                },
                showAdditionalFields: false,
                additionalFieldsHtml: '',
                formations: @json($formations), // Assurez-vous de passer les formations depuis le contrôleur

                updateAdditionalFields() {
                    this.showAdditionalFields = this.formData.type_demande !== '';
                    this.additionalFieldsHtml = this.getAdditionalFieldsHtml();
                },

                getAdditionalFieldsHtml() {
                    switch (this.formData.type_demande) {
                        case 'Etudiant':
                            return `
                                <div>
                                    <label for="cv" class="block text-sm font-medium text-gray-700">CV (PDF)</label>
                                    <input type="file" id="cv" name="cv" accept=".pdf" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100" required>
                                </div>
                                <div>
                                    <label for="niveau_etude" class="block text-sm font-medium text-gray-700">Niveau d'études actuel</label>
                                    <input type="text" id="niveau_etude" name="niveau_etude" x-model="formData.niveau_etude" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                </div>
                            `;
                        case 'Professeur':
                            return `
                                <div>
                                    <label for="cv" class="block text-sm font-medium text-gray-700">CV (PDF)</label>
                                    <input type="file" id="cv" name="cv" accept=".pdf" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100" required>
                                </div>
                                <div>
                                    <label for="formation_id" class="block text-sm font-medium text-gray-700">Formation</label>
                                    <select id="formation_id" name="formation_id" x-model="formData.formation_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" required>
                                        <option value="">Sélectionnez une formation</option>
                                        ${this.formations.map(formation => `<option value="${formation.id}">${formation.nom}</option>`).join('')}
                                    </select>
                                </div>
                            `;
                        case 'Alumni':
                            return `
                                <div>
                                    <label for="cv" class="block text-sm font-medium text-gray-700">CV (PDF)</label>
                                    <input type="file" id="cv" name="cv" accept=".pdf" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100" required>
                                </div>
                                <div>
                                    <label for="annee_diplome" class="block text-sm font-medium text-gray-700">Année d'obtention du diplôme</label>
                                    <input type="number" id="annee_diplome" name="annee_diplome" x-model="formData.annee_diplome" min="1900" max="${new Date().getFullYear()}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                </div>
                            `;
                        case 'Entreprise':
                            return `
                                <div>
                                    <label for="nom_entreprise" class="block text-sm font-medium text-gray-700">Nom de l'entreprise</label>
                                    <input type="text" id="nom_entreprise" name="nom_entreprise" x-model="formData.nom_entreprise" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                </div>
                                <div>
                                    <label for="secteur_activite" class="block text-sm font-medium text-gray-700">Secteur d'activité</label>
                                    <input type="text" id="secteur_activite" name="secteur_activite" x-model="formData.secteur_activite" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                </div>
                            `;
                        default:
                            return '';
                    }
                },

                submitForm() {
                    let formData = new FormData(this.$el);
                    fetch('{{ route("demandes.store") }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Demande envoyée avec succès!');
                            window.location.href = '{{ route("dashboard") }}';
                        } else {
                            alert('Erreur lors de l\'envoi de la demande. Veuillez réessayer.');
                        }
                    })
                    .catch(error => {
                        console.error('Erreur:', error);
                        alert('Une erreur est survenue. Veuillez réessayer.');
                    });
                }
            }
        }
    </script>
    @endpush
</x-app-layout>