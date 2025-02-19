<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            {{ __('Create New Challenge') }}
        </h2>
    </x-slot>

    <div class="p-4 sm:p-8">
        <div class="max-w-xl">
            <form method="POST" action="{{ route('challenges.store') }}" class="space-y-6">
                @csrf

                <div>
                    <x-input-label for="title" value="Challenge Title" />
                    <x-text-input id="title" name="title" type="text" class="block w-full mt-1"
                        :value="old('title')" required autofocus />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="description" value="Description" />
                    <textarea id="description" name="description" rows="4"
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                        required>{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="points" value="Points" />
                        <x-text-input id="points" name="points" type="number" class="block w-full mt-1"
                            :value="old('points')" required min="1" />
                        <x-input-error :messages="$errors->get('points')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="difficulty" value="Difficulty" />
                        <select id="difficulty" name="difficulty"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                            <option value="easy" {{ old('difficulty') == 'easy' ? 'selected' : '' }}>Easy</option>
                            <option value="medium" {{ old('difficulty') == 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="hard" {{ old('difficulty') == 'hard' ? 'selected' : '' }}>Hard</option>
                        </select>
                        <x-input-error :messages="$errors->get('difficulty')" class="mt-2" />
                    </div>
                </div>

                <div>
                    <x-input-label for="due_date" value="Due Date" />
                    <x-text-input id="due_date" name="due_date" type="datetime-local" class="block w-full mt-1"
                        :value="old('due_date')" required />
                    <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
                </div>

                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('Create Challenge') }}</x-primary-button>
                    <a href="{{ route('challenges.index') }}" class="text-gray-600 dark:text-gray-400">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout> 