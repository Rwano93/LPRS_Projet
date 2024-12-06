<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails de la demande') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Bouton de retour en haut à gauche -->
            <div class="flex items-center mb-6">
                <a href="{{ route('gestionnaire.demandes.index') }}" class="text-indigo-600 hover:text-indigo-900 font-semibold flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>{{ __('Retour aux demandes') }}
                </a>
            </div>
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4 text-blue-600">Informations de la demande :</h3>
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Utilisateur :</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                <span class="font-semibold text-indigo-600">
                                    {{ $demande->user->prenom }} {{ $demande->user->nom }}
                                </span>
                            </dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Statut demandé :</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                <span class="font-semibold text-green-500">{{ $demande->role->libelle }}</span>
                            </dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Date de demande :</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $demande->created_at->format('d/m/Y H:i') }}</dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Statut actuel :</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                <span class="font-semibold text-yellow-500">{{ ucfirst($demande->statut) }}</span>
                            </dd>
                        </div>
                        
                        @if($demande->type_demande === 'etudiant')
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Niveau d'étude :</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $demande->niveau_etude }}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Filière :</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $demande->filiere }}</dd>
                            </div>
                        @elseif($demande->type_demande === 'alumni')
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Année d'obtention du diplôme :</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $demande->annee_diplome }}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Emploi actuel :</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $demande->emploi_actuel }}</dd>
                            </div>
                        @elseif($demande->type_demande === 'partenaire')
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Nom de l'entreprise :</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $demande->entreprise }}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Secteur d'activité :</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $demande->secteur_activite }}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Téléphone :</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $demande->telephone }}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Site web :</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    <a href="{{ $demande->site_web }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">{{ $demande->site_web }}</a>
                                </dd>
                            </div>
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500">Adresse :</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ $demande->adresse }}, {{ $demande->code_postal }} {{ $demande->ville }}
                                </dd>
                            </div>
                        @elseif($demande->type_demande === 'professeur')
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Formation :</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $demande->formation->nom }}</dd>
                            </div>
                        @endif
                        
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">Message de motivation :</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $demande->message }}</dd>
                        </div>
                        @if($demande->cv)
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500">CV</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    <a href="{{ Storage::url($demande->cv) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 underline">Voir le CV</a>
                                </dd>
                            </div>
                        @endif
                    </dl>

                    <div class="mt-8">
                        @if($demande->statut == 'en_attente')
                            <div class="flex justify-between space-x-4">
                                <!-- Formulaire d'approbation -->
                                <form action="{{ route('gestionnaire.demandes.approuver', $demande) }}" method="POST">
                                    @csrf
                                    <x-button class="bg-green-500 hover:bg-green-700 transition duration-300 ease-in-out shadow-md">
                                        <i class="fas fa-check-circle mr-2"></i>{{ __('Approuver') }}
                                    </x-button>
                                </form>
                                <!-- Formulaire de rejet -->
                                <form action="{{ route('gestionnaire.demandes.rejeter', $demande) }}" method="POST">
                                    @csrf
                                    <x-button class="bg-red-500 hover:bg-red-700 transition duration-300 ease-in-out shadow-md">
                                        <i class="fas fa-times-circle mr-2"></i>{{ __('Rejeter') }}
                                    </x-button>
                                </form>
                            </div>
                        @else
                            <div class="mt-4 p-4 rounded-lg bg-gray-100 text-center">
                                <p class="text-sm font-semibold text-gray-700">
                                    <span class="text-green-500">{{ ucfirst($demande->statut) }}</span> — Cette demande a été traitée. 
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notifications -->
    @if(session('success'))
        <div class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-md shadow-lg">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-md shadow-lg">
            {{ session('error') }}
        </div>
    @endif
</x-app-layout>

