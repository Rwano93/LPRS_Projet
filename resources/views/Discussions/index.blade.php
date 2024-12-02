<x-app-layout>
    <div class="container mx-auto mt-10 px-4">
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-6">Forum de Discussions</h1>

        <!-- Bouton de création de discussion -->
        <div class="flex justify-center mb-6">
            <a href="{{ route('discussions.create') }}" class="bg-blue-600 text-black py-2 px-6 rounded-lg hover:bg-blue-700 transition duration-300 shadow-lg">
                Créer une Nouvelle Discussion
            </a>
        </div>

        <!-- Message si aucune discussion -->
        @if($discussions->isEmpty())
            <div class="text-center bg-yellow-100 text-yellow-800 p-4 rounded-lg shadow-md">
                <p>Aucune discussion disponible pour le moment.</p>
            </div>
        @else
            <!-- Liste des discussions -->
            <div class="space-y-4">
                @foreach ($discussions as $discussion)
                    <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-2 hover:text-blue-600 transition duration-300">
                            <a href="{{ route('discussions.show', $discussion->id) }}">{{ $discussion->title }}</a>
                        </h2>
                        <p class="text-gray-700">{{ Str::limit($discussion->content, 150) }}</p>
                        <div class="flex justify-between items-center mt-4 text-sm text-gray-600">
                            <span>Créé par <strong>{{ $discussion->user->name }}</strong> le {{ $discussion->created_at->format('d M Y à H:i') }}</span>
                            <a href="{{ route('discussions.show', $discussion->id) }}" class="text-blue-500 hover:underline">
                                Voir Discussion →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Pagination -->
        <div class="mt-8 flex justify-center">
            {{ $discussions->links('pagination::tailwind') }}
        </div>
    </div>
</x-app-layout>

<!-- Tailwind CSS CDN -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
