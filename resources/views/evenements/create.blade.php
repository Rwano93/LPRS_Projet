<x-app-layout>
    <div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                <div class="p-8">
                    <h2 class="text-3xl font-semibold text-gray-800 mb-6">
                        Créer un nouvel événement
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

                    <form action="{{ route('evenement.store') }}" method="POST" id="eventForm" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Type
                                    d'événement</label>
                                <input type="text" name="type" id="type" required value="{{ old('type') }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    placeholder="Ex: Conférence, Atelier, etc.">
                            </div>

                            <div>
                                <label for="titre" class="block text-sm font-medium text-gray-700">Titre de
                                    l'événement</label>
                                <input type="text" name="titre" id="titre" required value="{{ old('titre') }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    placeholder="Titre accrocheur">
                            </div>

                            <div class="sm:col-span-2">
                                <label for="description"
                                    class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea name="description" id="description" rows="4" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    placeholder="Décrivez votre événement en détail">{{ old('description') }}</textarea>
                            </div>

                            <div>
                                <label for="adresse" class="block text-sm font-medium text-gray-700">Adresse</label>
                                <input type="text" name="adresse" id="adresse" required value="{{ old('adresse') }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    placeholder="Lieu de l'événement">
                            </div>

                            <div>
                                <label for="elementrequis" class="block text-sm font-medium text-gray-700">Éléments
                                    requis</label>
                                <input type="text" name="elementrequis" id="elementrequis"
                                    value="{{ old('elementrequis') }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    placeholder="Ce que les participants doivent apporter">
                            </div>

                            <div>
                                <label for="nb_place" class="block text-sm font-medium text-gray-700">Nombre de
                                    places</label>
                                <input type="number" name="nb_place" id="nb_place" min="1" required
                                    value="{{ old('nb_place') }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    placeholder="Capacité maximale">
                            </div>

                            <div>
                                <label for="date" class="block text-sm font-medium text-gray-700">Date et heure</label>
                                <input type="datetime-local" name="date" id="date" required value="{{ old('date') }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <p id="dateError" class="mt-2 text-sm text-red-600 hidden">La date ne peut pas être
                                    antérieure à aujourd'hui.</p>
                            </div>

                            @if(Auth::user()->ref_role == \App\Models\User::ROLE_STUDENT)
                                <div class="sm:col-span-2">
                                    <label for="ref_professeur" class="block text-sm font-medium text-gray-700">
                                        Professeur responsable
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <select name="ref_professeur" id="ref_professeur" required
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option value="">Sélectionnez un professeur</option>
                                        @foreach($professeurs as $professeur)
                                            <option value="{{ $professeur->id }}" {{ old('ref_professeur') == $professeur->id ? 'selected' : '' }}>
                                                {{ $professeur->nom }} {{ $professeur->prenom }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            <div class="sm:col-span-2">
                                <label for="collaborateurs" class="block text-sm font-medium text-gray-700">
                                    Collaborateurs (optionnel)
                                </label>
                                <select name="collaborateurs[]" id="collaborateurs" multiple
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    @foreach($collaborateurs as $collaborateur)
                                        <option value="{{ $collaborateur->id }}" {{ (collect(old('collaborateurs'))->contains($collaborateur->id)) ? 'selected' : '' }}>
                                            {{ $collaborateur->nom }} {{ $collaborateur->prenom }} 
                                            ({{ $collaborateur->ref_role == \App\Models\User::ROLE_PROFESSOR ? 'Professeur' : 'Collaborateur' }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-6">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                @if(Auth::user()->ref_role == \App\Models\User::ROLE_STUDENT)
                                    Demander la création de l'événement
                                @else
                                    Créer l'événement
                                @endif
                            </button>
                            <a href="{{ route('evenement.index') }}"
                                class="text-sm font-medium text-gray-600 hover:text-gray-500">
                                Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Add jQuery and Select2 JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dateInput = document.getElementById('date');
            const dateError = document.getElementById('dateError');
            const form = document.getElementById('eventForm');

            dateInput.addEventListener('change', validateDate);
            form.addEventListener('submit', validateForm);

            function validateDate() {
                const selectedDate = new Date(dateInput.value);
                const today = new Date();
                today.setHours(0, 0, 0, 0);

                if (selectedDate < today) {
                    dateError.classList.remove('hidden');
                    dateInput.classList.add('border-red-500');
                } else {
                    dateError.classList.add('hidden');
                    dateInput.classList.remove('border-red-500');
                }
            }

            function validateForm(e) {
                validateDate();
                if (!dateError.classList.contains('hidden')) {
                    e.preventDefault();
                }
            }

            // Initialize Select2 for collaborateurs
            $('#collaborateurs').select2({
                placeholder: 'Sélectionnez des collaborateurs',
                allowClear: true,
                multiple: true,
                width: '100%'
            });
        });
    </script>
</x-app-layout>