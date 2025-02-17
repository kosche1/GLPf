<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            {{ __('Super Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="grid gap-6 p-6">
        <!-- System Overview -->
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
            <div class="p-6 bg-white rounded-lg shadow-md dark:bg-dark-eval-1">
                <h3 class="text-gray-500 dark:text-gray-400">Total Users</h3>
                <p class="text-2xl font-bold">{{ \App\Models\User::count() }}</p>
            </div>
            <div class="p-6 bg-white rounded-lg shadow-md dark:bg-dark-eval-1">
                <h3 class="text-gray-500 dark:text-gray-400">System Health</h3>
                <p class="text-2xl font-bold text-green-500">Good</p>
            </div>
            <div class="p-6 bg-white rounded-lg shadow-md dark:bg-dark-eval-1">
                <h3 class="text-gray-500 dark:text-gray-400">Active Sessions</h3>
                <p class="text-2xl font-bold">{{ \DB::table('sessions')->count() }}</p>
            </div>
            <div class="p-6 bg-white rounded-lg shadow-md dark:bg-dark-eval-1">
                <h3 class="text-gray-500 dark:text-gray-400">Server Load</h3>
                <p class="text-2xl font-bold">23%</p>
            </div>
        </div>

        <!-- Recent User Activity -->
        <div class="p-6 bg-white rounded-lg shadow-md dark:bg-dark-eval-1">
            <h4 class="mb-3 font-medium">Recent User Activity</h4>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-dark-eval-2 dark:text-gray-400">
                        <tr>
                            <th class="px-4 py-2">User</th>
                            <th class="px-4 py-2">Action</th>
                            <th class="px-4 py-2">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentActivity ?? [] as $activity)
                        <tr class="border-b dark:border-gray-700">
                            <td class="px-4 py-2">{{ $activity->user->name }}</td>
                            <td class="px-4 py-2">{{ $activity->description }}</td>
                            <td class="px-4 py-2">{{ $activity->created_at->diffForHumans() }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-4 py-2 text-center text-gray-500">
                                No recent activity
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Level Management Overview -->
        <div class="p-6 bg-white rounded-lg shadow-md dark:bg-dark-eval-1">
            <h3 class="mb-4 text-lg font-medium">Level System Overview</h3>
            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                <div class="p-4 border rounded-lg">
                    <h4 class="font-semibold">Total Levels</h4>
                    <p class="text-2xl">{{ \App\Models\Level::count() }}</p>
                </div>
                <div class="p-4 border rounded-lg">
                    <h4 class="font-semibold">Max Level</h4>
                    <p class="text-2xl">{{ \App\Models\Level::max('level') ?? 0 }}</p>
                </div>
                <div class="p-4 border rounded-lg">
                    <h4 class="font-semibold">Users Leveled Up Today</h4>
                    <p class="text-2xl">{{ \LevelUp\Experience\Models\ExperienceAudit::where('levelled_up', true)->whereDate('created_at', today())->count() }}</p>
                </div>
            </div>
        </div>

        <!-- User Analytics -->
        <div class="grid gap-6 md:grid-cols-2">
            <div class="p-6 bg-white rounded-lg shadow-md dark:bg-dark-eval-1">
                <h3 class="mb-4 text-lg font-medium">User Distribution</h3>
                <div class="space-y-4">
                    <div class="flex justify-between">
                        <span>Students</span>
                        <span class="font-bold">{{ \App\Models\User::where('role', 'student')->count() }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Teachers</span>
                        <span class="font-bold">{{ \App\Models\User::where('role', 'teacher')->count() }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Admins</span>
                        <span class="font-bold">{{ \App\Models\User::where('role', 'admin')->count() }}</span>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-white rounded-lg shadow-md dark:bg-dark-eval-1">
                <h3 class="mb-4 text-lg font-medium">System Logs</h3>
                <div class="space-y-2">
                    <!-- Add system logs here -->
                    <p class="text-gray-500 dark:text-gray-400">No recent logs to display.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 