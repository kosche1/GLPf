<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('All Challenges') }}
            </h2>
            <a href="{{ route('challenges.create') }}"
                class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Create New Challenge
            </a>
        </div>
    </x-slot>

    <div class="p-4 sm:p-8">
        <div class="overflow-x-auto bg-white rounded-lg shadow-md dark:bg-gray-800">
            @if($challenges->isEmpty())
                <div class="p-4 text-center text-gray-500 dark:text-gray-400">
                    No challenges created yet. Click the "Create New Challenge" button to get started.
                </div>
            @else
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Title</th>
                            <th scope="col" class="px-6 py-3">Difficulty</th>
                            <th scope="col" class="px-6 py-3">Points</th>
                            <th scope="col" class="px-6 py-3">Due Date</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($challenges as $challenge)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    {{ $challenge->title }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                        {{ $challenge->difficulty === 'easy' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $challenge->difficulty === 'medium' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $challenge->difficulty === 'hard' ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ ucfirst($challenge->difficulty) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">{{ $challenge->points }} pts</td>
                                <td class="px-6 py-4">{{ $challenge->due_date->format('M d, Y H:i') }}</td>
                                <td class="px-6 py-4">
                                    @if($challenge->due_date->isPast())
                                        <span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full">
                                            Expired
                                        </span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                                            Active
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-3">
                                        <a href="{{ route('challenges.show', $challenge) }}" 
                                           class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                            View
                                        </a>
                                        <a href="{{ route('challenges.edit', $challenge) }}"
                                           class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300">
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('challenges.destroy', $challenge) }}" 
                                              class="inline"
                                              onsubmit="return confirm('Are you sure you want to delete this challenge?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="p-4">
                    {{ $challenges->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout> 