<x-app-layout>
    <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-bold text-indigo-800 mb-6">
                Envoyer un message à {{ $user->name }}
            </h1>
            <form action="{{ route('messages.store') }}" method="POST">
                @csrf
                <input type="hidden" name="recipient_id" value="{{ $user->id }}">
                <div class="mb-4">
                    <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                    <textarea id="message" name="message" rows="5" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Écrivez votre message..." required></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Envoyer
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
