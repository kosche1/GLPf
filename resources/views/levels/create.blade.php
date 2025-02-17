<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Create New Level') }}
            </h2>
            <a href="{{ route('levels.index') }}" 
               class="px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg hover:bg-gray-700">
                Back to Levels
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-dark-eval-1 sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('levels.store') }}" method="POST">
                        @csrf
                        
                        <!-- Level Number -->
                        <div class="mb-4">
                            <label for="level" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Level Number
                            </label>
                            <input type="number" 
                                   name="level" 
                                   id="level" 
                                   value="{{ old('level') }}"
                                   class="w-full px-3 py-2 border rounded-lg dark:bg-dark-eval-2 dark:border-gray-700 @error('level') border-red-500 @enderror"
                                   required>
                            @error('level')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- XP Required for Next Level -->
                        <div class="mb-6">
                            <label for="next_level_experience" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                XP Required for Next Level
                            </label>
                            <input type="number" 
                                   name="next_level_experience" 
                                   id="next_level_experience"
                                   value="{{ old('next_level_experience') }}"
                                   class="w-full px-3 py-2 border rounded-lg dark:bg-dark-eval-2 dark:border-gray-700 @error('next_level_experience') border-red-500 @enderror"
                                   required>
                            @error('next_level_experience')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                This is the amount of XP needed to reach the next level
                            </p>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" 
                                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                                Create Level
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 