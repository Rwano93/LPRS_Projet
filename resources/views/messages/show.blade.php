<x-app-layout>
    <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-indigo-800 mb-6">
            Conversation avec {{ $conversation->user_one_id === auth()->id() ? $conversation->userTwo->name : $conversation->userOne->name }}
        </h1>
        <div class="bg-white shadow-md rounded-lg p-6 space-y-4">
            @foreach ($messages as $message)
                <div class="{{ $message->sender_id === auth()->id() ? 'text-right' : '' }}">
                    <p class="inline-block p-3 rounded-lg {{ $message->sender_id === auth()->id() ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-black' }}">
                        {{ $message->content }}
                    </p>
                </div>
            @endforeach
        </div>
        <form action="{{ route('messages.store') }}" method="POST" class="mt-6">
            @csrf
            <input type="hidden" name="recipient_id" value="{{ $conversation->user_one_id === auth()->id() ? $conversation->user_two_id : $conversation->user_one_id }}">
            <textarea name="message" rows="4" class="w-full border-gray-300 rounded-lg" placeholder="Écrivez votre message..."></textarea>
            <button type="submit" class="mt-2 px-4 py-2 bg-indigo-600 text-white rounded-lg">Envoyer</button>
        </form>
    </div>
</x-app-layout>
