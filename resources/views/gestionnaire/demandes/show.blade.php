<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails de la demande') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Informations de la demande</h3>
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Utilisateur</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $demande->user->name }}</dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Statut demandé</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $demande->role->libelle }}</dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Date de demande</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $demande->created_at->format('d/m/Y H:i') }}</dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Statut actuel</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ ucfirst($demande->statut) }}</dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">Message de motivation</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $demande->message }}</dd>
                        </div>
                        @if($demande->cv)
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500">CV</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    <a href="{{ Storage::url($demande->cv) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">Voir le CV</a>
                                </dd>
                            </div>
                        @endif
                    </dl>

                    @if($demande->statut == 'en_attente')
                        <div class="mt-8 flex space-x-4">
                            <form action="{{ route('gestionnaire.demandes.approuver', $demande) }}" method="POST">
                                @csrf
                                <x-button class="bg-green-500 hover:bg-green-700">
                                    {{ __('Approuver') }}
                                </x-button>
                            </form>
                            <form action="{{ route('gestionnaire.demandes.rejeter', $demande) }}" method="POST">
                                @csrf
                                <x-button class="bg-red-500 hover:bg-red-700">
                                    {{ __('Rejeter') }}
                                </x-button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>