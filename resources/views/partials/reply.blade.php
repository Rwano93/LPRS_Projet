<div class="bg-white p-6 rounded-lg shadow-md transition duration-300 ease-in-out hover:shadow-lg animate-fade-in">
    <div class="flex items-start space-x-4">
        <div class="flex-shrink-0">
            <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($reply->user->prenom . ' ' . $reply->user->nom) }}&color=7F9CF5&background=EBF4FF" alt="{{ $reply->user->prenom }} {{ $reply->user->nom }}">
        </div>
        <div class="flex-grow">
            <p class="text-sm font-medium text-gray-900">
                {{ $reply->user->prenom }} {{ $reply->user->nom }}
            </p>
            <p class="text-sm text-gray-500">
                {{ $reply->created_at->format('d M Y à H:i') }}
            </p>
        </div>
    </div>
    <div class="mt-4 prose max-w-none text-gray-700">
        {!! Str::markdown($reply->content) !!}
    </div>
    @if($reply->image)
        <img src="{{ route('replies.image', $reply->id) }}" alt="Image de la réponse" class="mt-4 w-full h-auto rounded-lg shadow-md">
    @endif
</div>

