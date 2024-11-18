<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Contactez-nous') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8">
                    <h1 class="text-2xl font-medium text-gray-900 dark:text-gray-100">
                        Nous sommes à votre écoute
                    </h1>
                    <p class="mt-6 text-gray-500 dark:text-gray-400 leading-relaxed">
                        N'hésitez pas à nous contacter pour toute question ou demande. Nous vous répondrons dans les plus brefs délais.
                    </p>

                    <form method="POST" action="{{ route('contact.submit') }}" class="mt-8 space-y-6">
                        @csrf
                        <div>
                            <x-label for="nom" value="{{ __('Nom') }}" />
                            <x-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-label for="email" value="{{ __('Email') }}" />
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                        </div>

                        <div class="mt-4">
                            <x-label for="sujet" value="{{ __('Sujet') }}" />
                            <x-input id="sujet" class="block mt-1 w-full" type="text" name="sujet" :value="old('sujet')" required />
                        </div>

                        <div class="mt-4">
                            <x-label for="message" value="{{ __('Message') }}" />
                            <textarea id="message" name="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Votre message ici..." required>{{ old('message') }}</textarea>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Envoyer') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>