<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
            <!-- Profile Photo File Input -->
            <input type="file" class="hidden"
                        wire:model="photo"
                        x-ref="photo"
                        x-on:change="
                                photoName = $refs.photo.files[0].name;
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    photoPreview = e.target.result;
                                };
                                reader.readAsDataURL($refs.photo.files[0]);
                        " />

            <x-label for="photo" value="{{ __('Photo') }}" />

            <!-- Current Profile Photo -->
            <div class="mt-2" x-show="! photoPreview">
                <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
            </div>

            <!-- New Profile Photo Preview -->
            <div class="mt-2" x-show="photoPreview" style="display: none;">
                <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                      x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                </span>
            </div>

            <x-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                {{ __('Select A New Photo') }}
            </x-button>

            @if ($this->user->profile_photo_path)
                <x-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                    {{ __('Remove Photo') }}
                </x-button>
            @endif

            <x-input-error for="photo" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="nom" value="{{ __('Nom') }}" />
            <x-input id="nom" type="text" class="mt-1 block w-full" wire:model.defer="state.nom" autocomplete="nom" />
            <x-input-error for="state.nom" class="mt-2" />
        </div>

        <!-- Prenom -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="prenom" value="{{ __('Prénom') }}" />
            <x-input id="prenom" type="text" class="mt-1 block w-full" wire:model.defer="state.prenom" autocomplete="prenom" />
            <x-input-error for="state.prenom" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
            <x-input-error for="state.email" class="mt-2" />
        </div>

      <!-- CV -->
        <div x-data="{ cvName: null }" class="col-span-6 sm:col-span-4">
            <x-label for="cv" value="{{ __('CV') }}" />
            <div class="mt-1 flex items-center">
                <x-button type="button" x-on:click.prevent="$refs.cvInput.click()">
                    {{ __('Choisir un fichier') }}
                </x-button>
                <span x-text="cvName" class="ml-3 text-sm text-gray-600"></span>
            </div>
            <input type="file" id="cv" x-ref="cvInput" wire:model="cv" class="hidden" x-on:change="cvName = $event.target.files[0].name" accept=".pdf" />
            <x-input-error for="cv" class="mt-2" />
            @if($this->user->cv)
                <div class="mt-2">
                    <a href="{{ Storage::url($this->user->cv) }}" target="_blank" class="text-sm text-blue-500 hover:underline">
                        {{ __('Voir le CV actuel') }}
                    </a>
                    <x-button type="button" wire:click="deleteCV" class="ml-2 text-sm text-red-500">
                        {{ __('Supprimer le CV') }}
                    </x-button>
                </div>
            @endif
        </div>


    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo, cv">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>

