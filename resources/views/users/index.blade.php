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
                    <div class="mt-8 text-2xl flex justify-between">
                        <div>
                            Manage Users
                        </div>
                        <div>
                            <x-button-link href="{{ route('users.create') }}" class="bg-blue-500 hover:bg-blue-700">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                Add New User
                            </x-button-link>
                        </div>
                    </div>

                    <div class="mt-6 text-gray-500">
                        <div class="flex flex-col sm:flex-row justify-between items-center mb-4">
                            <form action="{{ route('users.index') }}" method="GET" class="w-full sm:w-auto mb-4 sm:mb-0">
                                <div class="flex items-center">
                                    <x-input type="text" name="search" placeholder="Search users..." value="{{ request('search') }}" class="block w-full sm:w-64"/>
                                    <x-button type="submit" class="ml-2">Search</x-button>
                                </div>
                            </form>
                            <div class="flex items-center">
                                <span class="mr-2">Filter by role:</span>
                                <select name="role" onchange="this.form.submit()" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">All Roles</option>
                                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="manager" {{ request('role') == 'manager' ? 'selected' : '' }}>Manager</option>
                                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                                </select>
                            </div>
                        </div>

                        <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
                            <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                                <thead>
                                    <tr class="text-left">
                                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">Name</th>
                                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">Email</th>
                                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">Role</th>
                                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td class="border-b border-gray-200 px-6 py-4">{{ $user->name }}</td>
                                            <td class="border-b border-gray-200 px-6 py-4">{{ $user->email }}</td>
                                            <td class="border-b border-gray-200 px-6 py-4">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->role == 'admin' ? 'bg-red-100 text-red-800' : ($user->role == 'manager' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                                    {{ ucfirst($user->role) }}
                                                </span>
                                            </td>
                                            <td class="border-b border-gray-200 px-6 py-4">
                                                <div class="flex items-center space-x-2">
                                                    <a href="{{ route('users.show', $user) }}" class="text-blue-600 hover:text-blue-900">View</a>
                                                    <a href="{{ route('users.edit', $user) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                    <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                                    </form>
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

    @push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('userManagement', () => ({
                showDeleteModal: false,
                userToDelete: null,
                confirmDelete(userId) {
                    this.userToDelete = userId;
                    this.showDeleteModal = true;
                },
                deleteUser() {
                    if (this.userToDelete) {
                        document.getElementById('delete-form-' + this.userToDelete).submit();
                    }
                }
            }));
        });
    </script>
    @endpush
</x-app-layout>