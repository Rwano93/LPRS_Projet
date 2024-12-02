<x-app-layout>
    <div class="container mx-auto mt-10 px-4">
        <!-- En-tête de la discussion -->
        <div class="text-center mb-8">
            <!-- Titre en majuscules -->
            <h1 class="text-4xl font-bold text-indigo-600 transition duration-500 ease-in-out hover:text-indigo-800 text-uppercase">
                {{ strtoupper($discussion->title) }}
            </h1>
            <p class="text-gray-500 mt-2 text-lg">Créé par <strong>{{ $discussion->user->prenom }} {{ $discussion->user->nom }}</strong> le {{ $discussion->created_at->format('d M Y à H:i') }}</p>
        </div>

        <!-- Contenu de la discussion -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8 transition duration-300 ease-in-out hover:shadow-2xl transform hover:scale-105">
            <h2 class="text-2xl font-medium text-gray-800 mb-4">Contenu de la Discussion</h2>
            <p class="text-lg text-gray-600">{{ $discussion->content }}</p>
        </div>

        <!-- Section des réponses -->
        <h2 class="text-2xl font-semibold text-center text-purple-600 mt-10 mb-4 transition duration-300 ease-in-out hover:text-purple-800">Réponses</h2>
        @if ($discussion->replies->isEmpty())
            <div class="bg-yellow-100 text-yellow-700 p-4 rounded-lg shadow-md mb-6">
                Aucune réponse pour cette discussion.
            </div>
        @else
            <div class="space-y-6 mt-6">
                @foreach ($discussion->replies as $reply)
                    <div class="bg-gray-50 p-4 rounded-lg shadow-md transition duration-300 ease-in-out hover:shadow-2xl transform hover:scale-105">
                        <p class="text-lg text-indigo-700 font-semibold">{{ strtoupper($reply->user->prenom) }} {{ strtoupper($reply->user->nom) }} a dit :</p>
                        <p class="text-gray-600 mt-2">{{ $reply->content }}</p>
                        <p class="text-sm text-gray-400 text-right mt-4">Répondu le {{ $reply->created_at->format('d M Y à H:i') }}</p>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Formulaire de réponse -->
        <div class="bg-white rounded-lg shadow-lg p-6 mt-8 transition duration-300 ease-in-out hover:shadow-2xl transform hover:scale-105">
            <h3 class="text-xl font-medium text-gray-800 mb-4 text-center">Laisser une Réponse</h3>
            <form action="{{ route('replies.store', $discussion->id) }}" method="POST">
                @csrf
                <input type="hidden" name="discussion_id" value="{{ $discussion->id }}">
                <div class="mb-6">
                    <label for="content" class="block text-lg font-medium text-gray-700">Contenu de la Réponse</label>
                    <textarea id="content" name="contenu" rows="4" class="mt-2 block w-full rounded-lg border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 p-4 transition duration-300 ease-in-out hover:border-indigo-500" required></textarea>
                </div>
                <button type="submit" class="bg-indigo-600 text-white py-2 px-6 rounded-lg w-full text-lg hover:bg-indigo-700 transition duration-300 ease-in-out transform hover:scale-105">Répondre</button>
            </form>
        </div>

        <!-- Bouton retour -->
        <div class="mt-8 text-center">
            <a href="{{ route('forum.index') }}" class="text-indigo-600 hover:underline text-lg">← Retour au Forum</a>
        </div>
    </div>
</x-app-layout>

<!-- Tailwind CSS CDN -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
