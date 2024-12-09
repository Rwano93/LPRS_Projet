<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer une Entreprise') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('entreprises.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-label for="nom" value="{{ __('Nom') }}" />
                                <x-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')" required autofocus />
                            </div>

                            <div>
                                <x-label for="adresse" value="{{ __('Adresse') }}" />
                                <x-input id="adresse" class="block mt-1 w-full" type="text" name="adresse" :value="old('adresse')" required />
                            </div>

                            <div>
                                <x-label for="code_postal" value="{{ __('Code Postal') }}" />
                                <x-input id="code_postal" class="block mt-1 w-full" type="text" name="code_postal" :value="old('code_postal')" required />
                            </div>

                            <div>
                                <x-label for="ville" value="{{ __('Ville') }}" />
                                <x-input id="ville" class="block mt-1 w-full" type="text" name="ville" :value="old('ville')" required />
                            </div>

                            <div>
                                <x-label for="telephone" value="{{ __('Téléphone') }}" />
                                <x-input id="telephone" class="block mt-1 w-full" type="text" name="telephone" :value="old('telephone')" required />
                            </div>

                            <div>
                                <x-label for="site_web" value="{{ __('Site Web') }}" />
                                <x-input id="site_web" class="block mt-1 w-full" type="url" name="site_web" :value="old('site_web')" required />
                            </div>

                            <div>
                                <x-label for="poste" value="{{ __('Votre Poste') }}" />
                                <x-input id="poste" class="block mt-1 w-full" type="text" name="poste" :value="old('poste')" required />
                            </div>

                            @if(Auth::user()->role->libelle === 'Alumni')
                                <div class="col-span-2">
                                    <x-label for="motif_inscription" value="{{ __('Motif d\'inscription') }}" />
                                    <textarea id="motif_inscription" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="motif_inscription" rows="3" required>{{ old('motif_inscription') }}</textarea>
                                </div>
                            @endif

                            <div class="col-span-2">
                                <label for="is_partner" class="inline-flex items-center">
                                    <input id="is_partner" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="is_partner" value="1" {{ old('is_partner') ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-600">{{ __('Demander le statut de partenaire') }}</span>
                                </label>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Créer') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

