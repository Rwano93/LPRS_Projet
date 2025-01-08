<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-indigo-50 to-white py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-4xl font-bold text-center text-indigo-800 mb-8 animate-fade-in-down">Forum de Discussions</h1>

            <div class="flex justify-center mb-8 animate-fade-in">
                <a href="{{ route('discussions.create') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 ease-in-out transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Créer une Nouvelle Discussion
                </a>
            </div>

            @if($discussions->isEmpty())
                <div class="text-center bg-yellow-50 border border-yellow-100 text-yellow-800 p-6 rounded-lg shadow-md animate-fade-in">
                    <svg class="w-12 h-12 mx-auto mb-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <p class="text-lg font-semibold">Aucune discussion disponible pour le moment.</p>
                    <p class="mt-2">Soyez le premier à créer une discussion !</p>
                </div>
            @else
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($discussions as $discussion)
                        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300 transform hover:scale-105 animate-fade-in">
                            <h2 class="text-xl font-semibold text-indigo-800 mb-2 hover:text-indigo-600 transition duration-300">
                                <a href="{{ route('discussions.show', $discussion->id) }}">{{ $discussion->title }}</a>
                            </h2>
                            <p class="text-gray-600 mb-4">{{ Str::limit($discussion->content, 100) }}</p>
                            @if($discussion->image)
                                <img src="{{ Storage::url('discussion_images/' . $discussion->image) }}" alt="Image de la discussion" class="w-full h-32 object-cover rounded-md mb-4">
                            @endif

                            <div class="flex justify-between items-center text-sm text-gray-500">
                                <span>Par <strong class="text-indigo-600">{{ $discussion->user->prenom }} {{ $discussion->user->nom }}</strong></span>
                                <span>{{ $discussion->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="mt-4 text-right">
                                <a href="{{ route('discussions.show', $discussion->id) }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 transition duration-300 ease-in-out">
                                    Voir Discussion
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="mt-8 flex justify-center animate-fade-in">
                {{ $discussions->links() }}
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translate3d(0, -20px, 0);
            }
            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        .animate-fade-in-down {
            animation: fadeInDown 0.5s ease-out;
        }
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }
    </style>
    @endpush
</x-app-layout>
