<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-4">
                <a href="{{ route('dashboard') }}" 
                   class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                    {{ __('← Back to Dashboard') }}
                </a>
                <h2 class="text-xl font-semibold leading-tight">
                    {{ __('User Management') }}
                </h2>
            </div>
            <a href="{{ route('users.create') }}" 
               class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
                {{ __('Add New User') }}
            </a>
        </div>
    </x-slot>

    <div class="p-6">
        <div class="bg-white dark:bg-dark-eval-1 rounded-lg shadow-md">
            <!-- Search and Filter Section -->
            <div class="p-4 border-b dark:border-gray-700">
                <form action="{{ route('users.index') }}" method="GET" class="flex gap-4">
                    <input type="text" name="search" placeholder="Search users..." 
                           class="flex-1 rounded-lg dark:bg-dark-eval-2 border-gray-300 dark:border-gray-700">
                    <select name="role" class="rounded-lg dark:bg-dark-eval-2 border-gray-300 dark:border-gray-700">
                        <option value="">All Roles</option>
                        <option value="student">Student</option>
                        <option value="teacher">Teacher</option>
                        <option value="admin">Admin</option>
                        <option value="superadmin">Super Admin</option>
                    </select>
                    <button type="submit" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                        Search
                    </button>
                </form>
            </div>

            <!-- Users Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-dark-eval-2 dark:text-gray-400">
                        <tr>
                            <th class="px-6 py-3">Name</th>
                            <th class="px-6 py-3">Email</th>
                            <th class="px-6 py-3">Role</th>
                            <th class="px-6 py-3">School ID</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-6 py-4">{{ $user->name }}</td>
                                <td class="px-6 py-4">{{ $user->email }}</td>
                                <td class="px-6 py-4">{{ ucfirst($user->role) }}</td>
                                <td class="px-6 py-4">{{ $user->school_id ?? 'N/A' }}</td>
                                <td class="px-6 py-4 flex gap-2">
                                    <a href="{{ route('users.edit', $user) }}" 
                                       class="text-blue-600 hover:text-blue-900">Edit</a>
                                    @if(!$user->isSuperAdmin())
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" 
                                              onsubmit="return confirm('Are you sure you want to delete this user?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center">No users found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout> 