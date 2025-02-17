<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}" 
               class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                {{ __('← Back to Dashboard') }}
            </a>
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Create New User') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6">
        <div class="max-w-xl mx-auto bg-white dark:bg-dark-eval-1 rounded-lg shadow-md p-6">
            <!-- Form actions -->
            <div class="flex justify-between mb-6">
                <a href="{{ route('users.index') }}" 
                   class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                    {{ __('← Back to Users') }}
                </a>
            </div>
            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Name
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                           class="mt-1 block w-full rounded-lg dark:bg-dark-eval-2 border-gray-300 dark:border-gray-700">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Email
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                           class="mt-1 block w-full rounded-lg dark:bg-dark-eval-2 border-gray-300 dark:border-gray-700">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Password
                    </label>
                    <input type="password" name="password" id="password" required
                           class="mt-1 block w-full rounded-lg dark:bg-dark-eval-2 border-gray-300 dark:border-gray-700">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Confirm Password
                    </label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                           class="mt-1 block w-full rounded-lg dark:bg-dark-eval-2 border-gray-300 dark:border-gray-700">
                </div>

                <!-- Role -->
                <div class="mb-4">
                    <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Role
                    </label>
                    <select name="role" id="role" required
                            class="mt-1 block w-full rounded-lg dark:bg-dark-eval-2 border-gray-300 dark:border-gray-700">
                        <option value="">Select Role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
                    @error('role')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- School ID -->
                <div class="mb-6">
                    <label for="school_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        School ID (Optional)
                    </label>
                    <input type="text" name="school_id" id="school_id" value="{{ old('school_id') }}"
                           class="mt-1 block w-full rounded-lg dark:bg-dark-eval-2 border-gray-300 dark:border-gray-700">
                    @error('school_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" 
                            class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
                        Create User
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout> 