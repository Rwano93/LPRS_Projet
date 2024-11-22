<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl flex justify-between items-center">
                        <div class="font-bold text-gray-900">
                            Manage Users
                        </div>
                        <div>
                            <a href="{{ route('users.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                Add New User
                            </a>
                        </div>
                    </div>

                    <div class="mt-8 text-gray-500">
                        <form action="{{ route('users.index') }}" method="GET" class="mb-8">
                            <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0 sm:space-x-4">
                                <div class="w-full sm:w-1/2">
                                    <input type="text" name="search" placeholder="Search by ID, name, or email..." value="{{ request('search') }}" class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-100 focus:border-gray-300">
                                </div>
                                <div class="w-full sm:w-1/4">
                                    <select name="role" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-100 focus:border-gray-300">
                                        <option value="">All Roles</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{ request('role') == $role->id ? 'selected' : '' }}>
                                                {{ ucfirst($role->libelle) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="w-full sm:w-1/4">
                                    <button type="submit" class="w-full px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                        Search
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
                            <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                                <thead>
                                    <tr class="text-left">
                                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">ID</th>
                                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">Name</th>
                                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">Email</th>
                                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">Role</th>
                                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td class="border-b border-gray-200 px-6 py-4">{{ $user->id }}</td>
                                            <td class="border-b border-gray-200 px-6 py-4">{{ $user->nom }} {{ $user->prenom }}</td>
                                            <td class="border-b border-gray-200 px-6 py-4">{{ $user->email }}</td>
                                            <td class="border-b border-gray-200 px-6 py-4">
                                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    {{ $user->ref_role == 6 ? 'bg-red-100 text-red-800' : 
                                                       ($user->ref_role == 5 ? 'bg-yellow-100 text-yellow-800' : 
                                                       'bg-green-100 text-green-800') }}">
                                                    {{ $roles->firstWhere('id', $user->ref_role)->libelle ?? 'No Role' }}
                                                </span>
                                            </td>
                                            <td class="border-b border-gray-200 px-6 py-4">
                                                <div class="flex items-center justify-between w-24">
                                                    <a href="{{ route('users.show', $user) }}" class="text-blue-500 hover:text-blue-700" title="View">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                                        </svg>
                                                    </a>
                                                    @if(auth()->user()->ref_role == 6)
                                                        <a href="{{ route('users.edit', $user) }}" class="text-yellow-500 hover:text-yellow-700" title="Edit">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                            </svg>
                                                        </a>
                                                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-500 hover:text-red-700" title="Delete" onclick="return confirm('Are you sure you want to delete this user?');">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>