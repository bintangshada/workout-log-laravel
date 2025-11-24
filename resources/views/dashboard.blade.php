<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-white">
                    <h3 class="text-2xl font-bold mb-2">Welcome back, {{ auth()->user()->name }}! 💪</h3>
                    <p class="text-blue-100">Ready for another great workout day?</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Workouts</p>
                                <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $totalWorkouts }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">This Week</p>
                                <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $thisWeekWorkouts }}</p>
                                @if($lastWeekWorkouts > 0)
                                    <p class="text-xs text-gray-500">
                                        @if($thisWeekWorkouts > $lastWeekWorkouts)
                                            <span class="text-green-500">↗ +{{ $thisWeekWorkouts - $lastWeekWorkouts }}</span>
                                        @elseif($thisWeekWorkouts < $lastWeekWorkouts)
                                            <span class="text-red-500">↘ -{{ $lastWeekWorkouts - $thisWeekWorkouts }}</span>
                                        @else
                                            <span class="text-gray-500">→ Same as last week</span>
                                        @endif
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Sets This Month</p>
                                <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $monthlyStats->total_sets ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Routines</p>
                                <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $totalRoutines }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Workout Frequency (Last 30 Days)</h3>
                        <div class="h-64">
                            <canvas id="workoutChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Most Popular Exercises</h3>
                        @if($popularExercises->count() > 0)
                            <div class="space-y-3">
                                @foreach($popularExercises as $index => $exercise)
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full flex items-center justify-center text-white text-sm font-bold">
                                                {{ $index + 1 }}
                                            </div>
                                            <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $exercise->name }}</span>
                                        </div>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $exercise->usage_count }} times</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 dark:text-gray-400">No exercises recorded yet. <a href="{{ route('workouts.create') }}" class="text-blue-500">Start your first workout!</a></p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Recent Workouts</h3>
                        <a href="{{ route('workouts.index') }}" class="text-sm text-blue-500 hover:text-blue-700">View all</a>
                    </div>
                    
                    @if($recentWorkoutsList->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <thead>
                                    <tr class="border-b border-gray-200 dark:border-gray-700">
                                        <th class="text-left py-2 text-sm font-medium text-gray-500 dark:text-gray-400">Title</th>
                                        <th class="text-left py-2 text-sm font-medium text-gray-500 dark:text-gray-400">Date</th>
                                        <th class="text-left py-2 text-sm font-medium text-gray-500 dark:text-gray-400">Sets</th>
                                        <th class="text-right py-2 text-sm font-medium text-gray-500 dark:text-gray-400">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentWorkoutsList as $workout)
                                        <tr class="border-b border-gray-100 dark:border-gray-600">
                                            <td class="py-3 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $workout->title }}</td>
                                            <td class="py-3 text-sm text-gray-500 dark:text-gray-400">{{ \Carbon\Carbon::parse($workout->date)->format('M j, Y') }}</td>
                                            <td class="py-3 text-sm text-gray-500 dark:text-gray-400">{{ $workout->workoutDetails()->count() }} sets</td>
                                            <td class="py-3 text-right">
                                                <a href="{{ route('workouts.show', $workout) }}" class="text-sm bg-blue-500 hover:bg-blue-700 text-white px-3 py-1 rounded">View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">No workouts yet</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Get started by creating your first workout.</p>
                            <div class="mt-6">
                                <a href="{{ route('workouts.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    New Workout
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('workoutChart').getContext('2d');
        const workoutData = @json($workoutFrequency);
        
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: workoutData.map(item => item.date),
                datasets: [{
                    label: 'Workouts',
                    data: workoutData.map(item => item.count),
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    },
                    x: {
                        ticks: {
                            maxTicksLimit: 10
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
