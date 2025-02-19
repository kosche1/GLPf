<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            {{ __('Teacher Dashboard') }}
        </h2>
    </x-slot>

    <div class="grid gap-6 p-6">
        <!-- Class Overview -->
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
            <div class="p-6 bg-white rounded-lg shadow-md dark:bg-dark-eval-1">
                <h3 class="text-gray-500 dark:text-gray-400">Total Students</h3>
                <p class="text-2xl font-bold">{{ \App\Models\User::role('student')->count() }}</p>
            </div>
            <div class="p-6 bg-white rounded-lg shadow-md dark:bg-dark-eval-1">
                <h3 class="text-gray-500 dark:text-gray-400">Active Students Today</h3>
                <p class="text-2xl font-bold">{{ \App\Models\User::role('student')->where('updated_at', '>=', \Carbon\Carbon::today())->count() }}</p>
            </div>
            <div class="p-6 bg-white rounded-lg shadow-md dark:bg-dark-eval-1">
                <h3 class="text-gray-500 dark:text-gray-400">Average Level</h3>
                <p class="text-2xl font-bold">{{ number_format(\App\Models\User::role('student')->avg('level'), 1) }}</p>
            </div>
            <div class="p-6 bg-white rounded-lg shadow-md dark:bg-dark-eval-1">
                <h3 class="text-gray-500 dark:text-gray-400">Top Performers</h3>
                <p class="text-2xl font-bold">{{ \App\Models\User::role('student')->where('level', '>=', 5)->count() }}</p>
            </div>
        </div>

        <!-- Student Progress -->
        <div class="p-6 bg-white rounded-lg shadow-md dark:bg-dark-eval-1">
            <h3 class="mb-4 text-lg font-medium">Recent Student Progress</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-dark-eval-2 dark:text-gray-400">
                        <tr>
                            <th class="px-4 py-2">Student</th>
                            <th class="px-4 py-2">Level</th>
                            <th class="px-4 py-2">Experience</th>
                            <th class="px-4 py-2">Last Active</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(\App\Models\User::role('student')->latest('updated_at')->take(5)->get() as $student)
                        <tr class="border-b dark:border-gray-700">
                            <td class="px-4 py-2">{{ $student->name }}</td>
                            <td class="px-4 py-2">{{ $student->level }}</td>
                            <td class="px-4 py-2">{{ $student->experience }} XP</td>
                            <td class="px-4 py-2">{{ $student->updated_at->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid gap-6 md:grid-cols-2">
            <!-- Announcements -->
            <div class="p-6 bg-white rounded-lg shadow-md dark:bg-dark-eval-1">
                <h3 class="mb-4 text-lg font-medium">Announcements</h3>
                <div class="space-y-4">
                    <p class="text-gray-500 dark:text-gray-400">No announcements yet.</p>
                </div>
            </div>

            <!-- Teaching Resources -->
            <div class="p-6 bg-white rounded-lg shadow-md dark:bg-dark-eval-1">
                <h3 class="mb-4 text-lg font-medium">Teaching Resources</h3>
                <div class="space-y-2">
                    <a href="#" class="block p-3 bg-gray-50 dark:bg-dark-eval-2 rounded-lg hover:bg-gray-100 dark:hover:bg-dark-eval-3">
                        📚 Lesson Plans
                    </a>
                    <a href="#" class="block p-3 bg-gray-50 dark:bg-dark-eval-2 rounded-lg hover:bg-gray-100 dark:hover:bg-dark-eval-3">
                        📊 Student Reports
                    </a>
                    <a href="#" class="block p-3 bg-gray-50 dark:bg-dark-eval-2 rounded-lg hover:bg-gray-100 dark:hover:bg-dark-eval-3">
                        🎯 Learning Materials
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 