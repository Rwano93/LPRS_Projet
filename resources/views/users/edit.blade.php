<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <form action="{{ route('users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-label for="nom" value="{{ __('Nom') }}" />
                            <x-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom', $user->nom)" required autofocus />
                        </div>

                        <div class="mb-4">
                            <x-label for="prenom" value="{{ __('Prénom') }}" />
                            <x-input id="prenom" class="block mt-1 w-full" type="text" name="prenom" :value="old('prenom', $user->prenom)" required />
                        </div>

                        <div class="mb-4">
                            <x-label for="email" value="{{ __('Email') }}" />
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" required />
                        </div>

                        <div class="mb-4">
                            <x-label for="password" value="{{ __('New Password (leave blank to keep current)') }}" />
                            <x-input id="password" class="block mt-1 w-full" type="password"
                                     name="password"
                                     autocomplete="new-password" />
                        </div>

                        <div class="mb-4">
                            <x-label for="password_confirmation" value="{{ __('Confirm New Password') }}" />
                            <x-input id="password_confirmation" class="block mt-1 w-full"
                                     type="password"
                                     name="password_confirmation" />
                        </div>

                        <div class="mb-4">
                            <x-label for="ref_role" value="{{ __('Role') }}" />
                            <select id="ref_role" name="ref_role" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ $user->ref_role == $role->id ? 'selected' : '' }}>
                                        {{ ucfirst($role->libelle) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Update User') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>