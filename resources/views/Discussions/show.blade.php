<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-indigo-50 to-white py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white shadow-xl rounded-lg overflow-hidden mb-8 animate-fade-in-down">
                <div class="p-6 sm:p-10">
                    <h1 class="text-3xl sm:text-4xl font-bold text-indigo-800 mb-2 transition duration-300 ease-in-out hover:text-indigo-600">
                        {{ $discussion->title }}
                    </h1>
                    <p class="text-gray-600 mb-6">
                        Créé par <span class="font-semibold text-indigo-600">{{ $discussion->user->prenom }} {{ $discussion->user->nom }}</span> 
                        le {{ $discussion->created_at->format('d M Y à H:i') }}
                    </p>
                    
                    <div class="prose max-w-none text-gray-800">
                        {!! Str::markdown($discussion->content) !!}
                    </div>
                    
                    @if($discussion->image)
                        <div class="mt-6">
                            <img src="{{ route('discussions.image', $discussion->id) }}" alt="Image de la discussion" class="w-full h-auto rounded-lg shadow-md">
                        </div>
                    @endif
                </div>
            </div>

            <h2 class="text-2xl font-bold text-center text-indigo-800 mt-12 mb-6">Réponses</h2>
            
            <div id="replies-container" class="space-y-6">
                @foreach ($discussion->replies as $reply)
                    @include('partials.reply', ['reply' => $reply])
                @endforeach
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6 mt-8 transition duration-300 ease-in-out hover:shadow-xl animate-fade-in">
                <h3 class="text-xl font-bold text-indigo-800 mb-4">Laisser une Réponse</h3>
                <form id="reply-form" action="{{ route('replies.store', $discussion->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="discussion_id" value="{{ $discussion->id }}">
                    <div class="mb-4">
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Votre réponse</label>
                        <textarea id="content" name="content" rows="4" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Écrivez votre réponse ici..." required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Image (optionnel)</label>
                        <input type="file" id="image" name="image" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    </div>
                    <div class="flex items-center justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 ease-in-out transform hover:scale-105">
                            Répondre
                        </button>
                    </div>
                </form>
            </div>

            <div class="mt-8 text-center">
                <a href="{{ route('forum.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 ease-in-out transform hover:scale-105">
                    <svg class="mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Retour au Forum
                </a>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('reply-form');
            const repliesContainer = document.getElementById('replies-container');

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(form);

                axios.post(form.action, formData)
                    .then(function(response) {
                        if (response.data.success) {
                            const newReply = createReplyElement(response.data.reply);
                            repliesContainer.insertAdjacentHTML('beforeend', newReply);
                            form.reset();
                        }
                    })
                    .catch(function(error) {
                        console.error('Error:', error);
                    });
            });

            function createReplyElement(reply) {
                return `
                    <div class="bg-white p-6 rounded-lg shadow-md transition duration-300 ease-in-out hover:shadow-lg animate-fade-in">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=${encodeURIComponent(reply.user.prenom + ' ' + reply.user.nom)}&color=7F9CF5&background=EBF4FF" alt="${reply.user.prenom} ${reply.user.nom}">
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm font-medium text-gray-900">
                                    ${reply.user.prenom} ${reply.user.nom}
                                </p>
                                <p class="text-sm text-gray-500">
                                    ${reply.created_at}
                                </p>
                            </div>
                        </div>
                        <div class="mt-4 prose max-w-none text-gray-700">
                            ${reply.content}
                        </div>
                        ${reply.image ? `<img src="${reply.image}" alt="Image de la réponse" class="mt-4 w-full h-auto rounded-lg shadow-md">` : ''}
                    </div>
                `;
            }
        });
    </script>
    @endpush

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

