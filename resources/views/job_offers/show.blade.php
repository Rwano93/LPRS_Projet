<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $jobOffer->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <a href="{{ route('job-offers.index') }}" class="text-blue-500 hover:underline">
                            &larr; Retour aux offres
                        </a>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Description</h3>
                        <p class="text-gray-700">{{ $jobOffer->description }}</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Missions</h3>
                        <p class="text-gray-700">{{ $jobOffer->missions }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <h3 class="text-lg font-semibold mb-2">Type</h3>
                            <p class="text-gray-700">{{ $jobOffer->type }}</p>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold mb-2">Salaire</h3>
                            <p class="text-gray-700">{{ $jobOffer->salary ?? 'Non spécifié' }}</p>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('job-offers.edit', $jobOffer) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Modifier
                        </a>
                        <a href="{{ route('job-offers.delete', $jobOffer) }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Supprimer
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

