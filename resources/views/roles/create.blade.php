<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}" 
               class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                {{ __('← Back to Dashboard') }}
            </a>
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Create New Role') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6">
        <div class="max-w-xl mx-auto bg-white dark:bg-dark-eval-1 rounded-lg shadow-md p-6">
            <!-- Form actions -->
            <div class="flex justify-between mb-6">
                <a href="{{ route('roles.index') }}" 
                   class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                    {{ __('← Back to Roles') }}
                </a>
            </div>

            <form action="{{ route('roles.store') }}" method="POST">
                @csrf

                <!-- Role Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Role Name
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                           class="mt-1 block w-full rounded-lg dark:bg-dark-eval-2 border-gray-300 dark:border-gray-700">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Permissions -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Permissions
                    </label>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($permissions as $permission)
                            <div class="flex items-center">
                                <input type="checkbox" 
                                       name="permissions[]" 
                                       value="{{ $permission->id }}"
                                       id="permission_{{ $permission->id }}"
                                       class="rounded border-gray-300 dark:border-gray-700 text-purple-600 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50"
                                       {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }}>
                                <label for="permission_{{ $permission->id }}" 
                                       class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                                    {{ $permission->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @error('permissions')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" 
                            class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
                        Create Role
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout> 