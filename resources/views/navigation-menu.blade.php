<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0 mr-1.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span class="sr-only">Dashboard</span>
                    </a>
                </div>
 
                @if (Route::has('login'))
                    <nav class="-mx-3 flex flex-1 justify-end">
                        @auth
                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                                {{ __('Accueil') }}
                            </x-nav-link>

                            @if(Auth::user()->ref_role == 1)
                                <x-nav-link href="{{ route('contact.show') }}" :active="request()->routeIs('contact.show')">
                                    {{ __('Contact Us') }}
                                </x-nav-link>
                            @endif

                            @if(Auth::user()->ref_role == 2)
                                <x-nav-link href="{{ route('offres.index') }}" :active="request()->routeIs('offres.index')">
                                    {{ __('Offres d\'emploi') }}
                                </x-nav-link>
                                <x-nav-link href="{{ route('forum.index') }}" :active="request()->routeIs('forum.index')">
                                    {{ __('Forum') }}
                                </x-nav-link>
                                <x-nav-link href="{{ route('evenement.index') }}" :active="request()->routeIs('evenement.index')">
                                    {{ __('Événements') }}
                                </x-nav-link>
                                <x-nav-link href="{{ route('contact.show') }}" :active="request()->routeIs('contact.show')">
                                    {{ __('Contact Us') }}
                                </x-nav-link>
                            @endif

                            @if(Auth::user()->ref_role == 3)
                                <x-nav-link href="{{ route('offres.index') }}" :active="request()->routeIs('offres.index')">
                                    {{ __('Offres d\'emploi') }}
                                </x-nav-link>
                                <x-nav-link href="{{ route('forum.index') }}" :active="request()->routeIs('forum.index')">
                                    {{ __('Forum') }}
                                </x-nav-link>
                                <x-nav-link href="{{ route('evenement.index') }}" :active="request()->routeIs('evenement.index')">
                                    {{ __('Événements') }}
                                </x-nav-link>
                                <x-nav-link href="{{ route('contact.show') }}" :active="request()->routeIs('contact.show')">
                                    {{ __('Contact Us') }}
                                </x-nav-link>
                            @endif

                            @if(Auth::user()->ref_role == 4)
                                <x-nav-link href="{{ route('offres.index') }}" :active="request()->routeIs('offres.index')">
                                    {{ __('Offres d\'emploi') }}
                                </x-nav-link>
                                <x-nav-link href="{{ route('forum.index') }}" :active="request()->routeIs('forum.index')">
                                    {{ __('Forum') }}
                                </x-nav-link>
                                <x-nav-link href="{{ route('evenement.index') }}" :active="request()->routeIs('evenement.index')">
                                    {{ __('Événements') }}
                                </x-nav-link>
                                <x-nav-link href="{{ route('contact.show') }}" :active="request()->routeIs('contact.show')">
                                    {{ __('Contact Us') }}
                                </x-nav-link>
                            @endif

                            @if(Auth::user()->ref_role == 5)
                                <x-nav-link href="{{ route('offres.index') }}" :active="request()->routeIs('offres.index')">
                                    {{ __('Offres d\'emploi') }}
                                </x-nav-link>
                                <x-nav-link href="{{ route('forum.index') }}" :active="request()->routeIs('forum.index')">
                                    {{ __('Forum') }}
                                </x-nav-link>
                                <x-nav-link href="{{ route('evenement.index') }}" :active="request()->routeIs('evenement.index')">
                                    {{ __('Événements') }}
                                </x-nav-link>
                                <x-nav-link href="{{ route('contact.show') }}" :active="request()->routeIs('contact.show')">
                                    {{ __('Contact Us') }}
                                </x-nav-link>
                            @endif

                            @if(Auth::user()->ref_role == 6)
                                <x-nav-link href="{{ route('offres.index') }}" :active="request()->routeIs('offres.index')">
                                    {{ __('Offres d\'emploi') }}
                                </x-nav-link>
                                <x-nav-link href="{{ route('forum.index') }}" :active="request()->routeIs('forum.index')">
                                    {{ __('Forum') }}
                                </x-nav-link>
                                <x-nav-link href="{{ route('evenement.index') }}" :active="request()->routeIs('evenement.index')">
                                    {{ __('Événements') }}
                                </x-nav-link>
                                <x-nav-link href="{{ route('contact.show') }}" :active="request()->routeIs('contact.show')">
                                    {{ __('Contact Us') }}
                                </x-nav-link>
                            @endif
                            </div>
                        @endauth
                    </nav>
                @endif
            </div>
 
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="ms-3 relative">
                        <x-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->currentTeam->name }}
 
                                        <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>
 
                            <x-slot name="content">
                                <div class="w-60">
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>
 
                                    <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-dropdown-link>
 
                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-dropdown-link>
                                    @endcan
 
                                    @if (Auth::user()->allTeams()->count() > 1)
                                        <div class="border-t border-gray-200"></div>
 
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Switch Teams') }}
                                        </div>
 
                                        @foreach (Auth::user()->allTeams() as $team)
                                            <x-switchable-team :team="$team" />
                                        @endforeach
                                    @endif
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endif
 
                @auth
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->nom }} {{ Auth::user()->prenom }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->nom }} {{ Auth::user()->prenom }}

                                        <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>
                            <x-slot name="content">
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Account') }}
                                </div>
 
                                <x-dropdown-link href="{{ route('profile.show') }}">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                        {{ __('API Tokens') }}
                                    </x-dropdown-link>
                                @endif
                                @if(Auth::user()->ref_role == 6)
                                <x-dropdown-link href="{{ route('gestionnaire.dashboard') }}">
                                    <div class="flex items-center">
                                        {{ __('Gestion des demandes') }}
                                        @if(isset($newRequestsCount) && $newRequestsCount > 0)
                                            <span class="ml-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">
                                                {{ $newRequestsCount }}
                                            </span>
                                        @endif
                                    </div>
                                </x-dropdown-link>
                                @else
                                    <x-dropdown-link href="{{ route('demandes.index') }}">
                                        {{ __('Demande de changement de statut') }}
                                    </x-dropdown-link>
                                @endif
                                @if(Auth::user()->ref_role == 4)
                                    @php
                                        $pendingRequestsCount = app(App\Http\Controllers\EvenementController::class)->getPendingEventRequestsCount();
                                    @endphp
                                    <x-nav-link href="{{ route('approbation.demandes') }}" :active="request()->routeIs('approbation.demandes')">
                                        <div class="flex items-center">
                                            {{ __('Approbation des demandes evenements') }}
                                            @if($pendingRequestsCount > 0)
                                                <span class="ml-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">
                                                    {{ $pendingRequestsCount }}
                                                </span>
                                            @endif
                                        </div>
                                    </x-nav-link>
                                @endif
                                @if(Auth::user()->ref_role == 6)
                                <x-dropdown-link href="{{ route('users.index') }}" :active="request()->routeIs('users.index')">
                                    {{ __('Panel Utilisateurs') }}
                                </x-dropdown-link>
                                @endif   
                
                                @if(Auth::user()->ref_role == 3 || Auth::user()->ref_role == 5 || Auth::user()->ref_role == 6)
                                <x-dropdown-link href="{{ route('entreprises.index') }}" :active="request()->routeIs('entreprises.index')">
                                    {{ __('Panel Entreprises') }}
                                </x-dropdown-link>
                                @endif
                                <div class="border-t border-gray-200"></div>
 
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
 
                                    <x-dropdown-link href="{{ route('logout') }}"
                                                     @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @else
                    <x-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                        Log in
                    </x-nav-link>
    
                    @if (Route::has('register'))
                        <x-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                            Register
                        </x-nav-link>
                    @endif
                @endauth
            </div>
 
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Accueil') }}
                </x-responsive-nav-link>
                @if(Auth::user()->ref_role == 3 || Auth::user()->ref_role == 2 || Auth::user()->ref_role == 4 || Auth::user()->ref_role == 6)
                <x-responsive-nav-link href="{{ route('offres.index') }}" :active="request()->routeIs('offres.index')">
                    {{ __('Offres d\'emploi') }}
                </x-responsive-nav-link>
                @endif
                <x-responsive-nav-link href="{{ route('forum.index') }}" :active="request()->routeIs('forum.index')">
                    {{ __('Forum') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('evenement.index') }}" :active="request()->routeIs('evenement.index')">
                    {{ __('Événements') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('contact.show') }}" :active="request()->routeIs('contact.show')">
                    {{ __('Contact Us') }}
                </x-responsive-nav-link>
            
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="flex items-center px-4">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <div class="shrink-0 me-3">
                                <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->nom }} {{ Auth::user()->prenom }}" />
                            </div>
                        @endif

                        <div>
                            <div class="font-medium text-base text-gray-800">{{ Auth::user()->nom . " " . Auth::user()->prenom }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                            {{ __('Profile') }}
                        </x-responsive-nav-link>

                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                                {{ __('API Tokens') }}
                            </x-responsive-nav-link>
                        @endif
                        @if(Auth::user()->ref_role == 4)
                            <x-responsive-nav-link href="{{ route('approbation.demandes') }}" :active="request()->routeIs('approbation.demandes')">
                                {{ __('Demandes approbation') }}
                            </x-responsive-nav-link>
                        @endif
                        @if(Auth::user()->ref_role == 6)
                            <x-responsive-nav-link href="{{ route('gestionnaire.dashboard') }}">
                                {{ __('Gestion des demandes') }}
                            </x-responsive-nav-link>
                        @else
                            <x-responsive-nav-link href="{{ route('demandes.index') }}">
                                {{ __('Demande de changement de statut') }}
                            </x-responsive-nav-link>
                        @endif
                        

                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf

                            <x-responsive-nav-link href="{{ route('logout') }}"
                                                   @click.prevent="$root.submit();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </form>

                        @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                            <div class="border-t border-gray-200"></div>

                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Team') }}
                            </div>

                            <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                                {{ __('Team Settings') }}
                            </x-responsive-nav-link>

                            @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                                    {{ __('Create New Team') }}
                                </x-responsive-nav-link>
                            @endcan

                            @if (Auth::user()->allTeams()->count() > 1)
                                <div class="border-t border-gray-200"></div>

                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Switch Teams') }}
                                </div>

                                @foreach (Auth::user()->allTeams() as $team)
                                    <x-switchable-team :team="$team" component="responsive-nav-link" />
                                @endforeach
                            @endif
                        @endif
                    </div>
                </div>
            @else
                <x-responsive-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                    Log in
                </x-responsive-nav-link>

                @if (Route::has('register'))
                    <x-responsive-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                        Register
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>
    </div>
</nav>