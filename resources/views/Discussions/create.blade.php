@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6" role="alert">
        <strong>Erreur !</strong>
        <ul class="mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-indigo-50 to-white py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl font-bold text-center text-indigo-800 mb-8 animate-fade-in-down">Créer une Nouvelle Discussion</h1>

            <form action="{{ route('discussions.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md animate-fade-in">
                @csrf

                <div class="mb-4">
                    <label for="title" class="block text-lg font-medium text-gray-700">Titre de la Discussion</label>
                    <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                </div>

                <div class="mb-4">
                    <label for="content" class="block text-lg font-medium text-gray-700">Contenu de la Discussion</label>
                    <textarea name="content" id="contenu" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required></textarea>
                </div>

                <div class="mb-4">
                    <label for="category_id" class="block text-lg font-medium text-gray-700">Catégorie</label>
                    <select name="category_id" id="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                        <option value="">Sélectionnez une catégorie</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="text-center">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Créer la Discussion
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ route('forum.index') }}" class="text-indigo-600 hover:underline">Retour au Forum</a>
            </div>

            <div id="pagination" class="mt-8 flex justify-center animate-fade-in">
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
