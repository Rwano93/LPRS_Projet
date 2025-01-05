<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-6">Candidatures pour : {{ $offre->titre }}</h2>

                    @if(session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if($candidatures->isEmpty())
                        <p class="text-gray-500">Aucune candidature n'a encore été reçue pour cette offre.</p>
                    @else
                        <div class="grid gap-6">
                            @foreach($candidatures as $candidature)
                                <div class="border rounded-lg p-6 bg-gray-50">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="text-xl font-semibold">{{ $candidature->user->name }}</h3>
                                            <p class="text-gray-600">{{ $candidature->user->email }}</p>
                                            <p class="mt-2">{{ $candidature->motivation }}</p>
                                            
                                            @if($candidature->cv_path)
                                                <a href="{{ Storage::url($candidature->cv_path) }}" 
                                                   class="inline-block mt-2 text-blue-600 hover:text-blue-800"
                                                   target="_blank">
                                                    Voir le CV
                                                </a>
                                            @endif
                                        </div>
                                        <div class="flex space-x-2">
                                            @if($candidature->statut === 'en_attente')
                                                <form action="{{ route('candidatures.accepter', $candidature) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" 
                                                            class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition">
                                                        Accepter
                                                    </button>
                                                </form>
                                                <form action="{{ route('candidatures.refuser', $candidature) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" 
                                                            class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">
                                                        Refuser
                                                    </button>
                                                </form>
                                            @else
                                                <span class="px-4 py-2 rounded {{ $candidature->statut === 'acceptée' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ ucfirst($candidature->statut) }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>