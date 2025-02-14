<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            {{ __('Student Dashboard') }}
        </h2>
    </x-slot>

    <div class="grid gap-6 p-6">
        <!-- XP and Level Card -->
        <div class="p-6 bg-white rounded-lg shadow-md dark:bg-dark-eval-1">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium">Progress</h3>
                <span class="text-2xl font-bold">Level {{ Auth::user()->level }}</span>
            </div>
            <div class="w-full h-4 bg-gray-200 rounded-full dark:bg-dark-eval-2">
                <div class="h-4 bg-purple-500 rounded-full" style="width: {{ (Auth::user()->experience % 100) }}%"></div>
            </div>
            <div class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                {{ Auth::user()->experience }} XP Total
            </div>
        </div>

        <!-- Achievements Card -->
        <div class="p-6 bg-white rounded-lg shadow-md dark:bg-dark-eval-1">
            <h3 class="mb-4 text-lg font-medium">Recent Achievements</h3>
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4">
                @foreach(Auth::user()->achievements()->latest()->take(4)->get() as $achievement)
                <div class="flex flex-col items-center p-3 text-center bg-gray-50 rounded-lg dark:bg-dark-eval-2">
                    <div class="w-12 h-12 mb-2 bg-purple-100 rounded-full dark:bg-purple-900"></div>
                    <span class="text-sm font-medium">{{ $achievement->name }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Daily Quests Card -->
        <div class="p-6 bg-white rounded-lg shadow-md dark:bg-dark-eval-1">
            <h3 class="mb-4 text-lg font-medium">Daily Quests</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg dark:bg-dark-eval-2">
                    <div>
                        <h4 class="font-medium">Complete 3 Exercises</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">0/3 completed</p>
                    </div>
                    <span class="px-3 py-1 text-sm text-purple-700 bg-purple-100 rounded-full dark:bg-purple-900 dark:text-purple-300">
                        +50 XP
                    </span>
                </div>
                <!-- Add more daily quests as needed -->
            </div>
        </div>
    </div>
</x-app-layout> 