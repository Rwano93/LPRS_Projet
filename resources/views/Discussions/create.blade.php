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

            <div id="discussions-container">
                @include('discussions._list', ['discussions' => $discussions])
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

