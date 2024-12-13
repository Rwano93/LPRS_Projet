@if($discussions->isEmpty())
    <div class="text-center bg-yellow-50 border border-yellow-100 text-yellow-800 p-6 rounded-lg shadow-md animate-fade-in">
        <svg class="w-12 h-12 mx-auto mb-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
        </svg>
        <p class="text-lg font-semibold">Aucune discussion trouvée.</p>
        <p class="mt-2">Il n'y a pas encore de discussions dans le forum.</p>
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
                    <img src="{{ route('discussions.image', $discussion->id) }}" alt="Image de la discussion" class="w-full h-32 object-cover rounded-md mb-4">
                @endif
                <div class="flex justify-between items-center text-sm text-gray-500">
                    <span>Par <strong class="text-indigo-600">{{ $discussion->user->prenom }} {{ $discussion->user->nom }}</strong></span>
                    <span>{{ $discussion->created_at->format('d M Y') }}</span>
                </div>
                <div class="mt-2 flex justify-between items-center">
                    <span class="text-sm text-indigo-600">{{ $discussion->category->name }}</span>
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

