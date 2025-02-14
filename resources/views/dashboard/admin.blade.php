<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="grid gap-6 p-6">
        <!-- User Statistics -->
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
            <div class="p-6 bg-white rounded-lg shadow-md dark:bg-dark-eval-1">
                <h3 class="text-gray-500 dark:text-gray-400">Total Users</h3>
                <p class="text-2xl font-bold">{{ \App\Models\User::count() }}</p>
            </div>
            <div class="p-6 bg-white rounded-lg shadow-md dark:bg-dark-eval-1">
                <h3 class="text-gray-500 dark:text-gray-400">Active Today</h3>
                <p class="text-2xl font-bold">{{ \App\Models\User::where('updated_at', '>=', \Carbon\Carbon::today())->count() }}</p>
            </div>
            <div class="p-6 bg-white rounded-lg shadow-md dark:bg-dark-eval-1">
                <h3 class="text-gray-500 dark:text-gray-400">New This Week</h3>
                <p class="text-2xl font-bold">{{ \App\Models\User::where('created_at', '>=', \Carbon\Carbon::now()->subWeek())->count() }}</p>
            </div>
            <div class="p-6 bg-white rounded-lg shadow-md dark:bg-dark-eval-1">
                <h3 class="text-gray-500 dark:text-gray-400">Average Level</h3>
                <p class="text-2xl font-bold">{{ number_format(\App\Models\User::avg('level'), 1) }}</p>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="p-6 bg-white rounded-lg shadow-md dark:bg-dark-eval-1">
            <h3 class="mb-4 text-lg font-medium">Recent Activity</h3>
            <div class="space-y-4">
                <!-- Add activity items here -->
                <p class="text-gray-500 dark:text-gray-400">No recent activity to display.</p>
            </div>
        </div>
    </div>
</x-app-layout> 