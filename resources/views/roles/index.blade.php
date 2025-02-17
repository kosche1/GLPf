<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-4">
                <a href="{{ route('dashboard') }}" 
                   class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                    {{ __('← Back to Dashboard') }}
                </a>
                <h2 class="text-xl font-semibold leading-tight">
                    {{ __('Role Management') }}
                </h2>
            </div>
            <a href="{{ route('roles.create') }}" 
               class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
                {{ __('Create New Role') }}
            </a>
        </div>
    </x-slot>

    <div class="p-6">
        <div class="bg-white dark:bg-dark-eval-1 rounded-lg shadow-md">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-dark-eval-2 dark:text-gray-400">
                        <tr>
                            <th class="px-6 py-3">Role</th>
                            <th class="px-6 py-3">Permissions</th>
                            <th class="px-6 py-3">Users Count</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($roles as $role)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-6 py-4 font-medium">{{ ucfirst($role->name) }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-1">
                                        @foreach($role->permissions as $permission)
                                            <span class="px-2 py-1 text-xs bg-gray-100 dark:bg-dark-eval-2 rounded">
                                                {{ $permission->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-6 py-4">{{ $role->users->count() }}</td>
                                <td class="px-6 py-4">
                                    @if(!in_array($role->name, ['superadmin', 'admin', 'teacher', 'student']))
                                        <a href="{{ route('roles.edit', $role) }}" 
                                           class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                                        <form action="{{ route('roles.destroy', $role) }}" method="POST" 
                                              class="inline-block"
                                              onsubmit="return confirm('Are you sure you want to delete this role?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                        </form>
                                    @else
                                        <span class="text-gray-500">Default Role</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center">No roles found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout> 