@foreach ($discussions as $discussion)
    <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300 transform hover:scale-105">
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
