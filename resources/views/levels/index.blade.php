<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Level Management') }}
            </h2>
            <button onclick="window.location.href='{{ route('levels.create') }}'"
                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                Add New Level
            </button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-dark-eval-1 sm:rounded-lg">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-dark-eval-2 dark:text-gray-400">
                                <tr>
                                    <th class="px-6 py-3">Level</th>
                                    <th class="px-6 py-3">XP Required for Next Level</th>
                                    <th class="px-6 py-3">Users at Level</th>
                                    <th class="px-6 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($levels as $level)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-6 py-4">{{ $level->level }}</td>
                                    <td class="px-6 py-4">{{ $level->next_level_experience ?? 'Max Level' }}</td>
                                    <td class="px-6 py-4">{{ $level->users_count }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-3">
                                            <a href="{{ route('levels.edit', $level) }}" 
                                               class="text-blue-600 hover:text-blue-900">Edit</a>
                                            <form action="{{ route('levels.destroy', $level) }}" method="POST" 
                                                  onsubmit="return confirm('Are you sure you want to delete this level?');">
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 