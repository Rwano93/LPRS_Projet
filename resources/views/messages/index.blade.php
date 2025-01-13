<x-app-layout>
    <div class="max-w-4xl mx-auto py-12">
        <h1 class="text-2xl font-bold">Vos conversations</h1>
        <div class="mt-6">
            @foreach ($conversations as $conversation)
                @php
                    $otherUser = $conversation->user_one_id === auth()->id()
                        ? $conversation->userTwo
                        : $conversation->userOne;
                @endphp
                <a href="{{ route('messages.show', $conversation) }}" class="block p-4 bg-white shadow rounded-lg mt-2">
                    <p>{{ $otherUser->name }}</p>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>
