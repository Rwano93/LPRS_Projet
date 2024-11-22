<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Offres d'emploi") }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <a href="{{ route('job-offers.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Créer une nouvelle offre
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($jobOffers as $offer)
                            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                                <div class="p-4">
                                    <h3 class="font-bold text-xl mb-2">{{ $offer->title }}</h3>
                                    <p class="text-gray-700 text-base mb-2">{{ Str::limit($offer->description, 100) }}</p>
                                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">{{ $offer->type }}</span>
                                </div>
                                <div class="px-4 py-2 bg-gray-100 text-right">
                                    <a href="{{ route('job-offers.show', $offer) }}" class="text-blue-500 hover:underline mr-2">Voir</a>
                                    <a href="{{ route('job-offers.edit', $offer) }}" class="text-green-500 hover:underline mr-2">Modifier</a>
                                    <form action="{{ route('job-offers.destroy', $offer) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette offre ?')">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

