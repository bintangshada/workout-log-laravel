<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="relative bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl shadow-lg overflow-hidden mb-8">
        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-40 h-40 bg-white opacity-10 rounded-full blur-2xl"></div>
        <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-40 h-40 bg-white opacity-10 rounded-full blur-2xl"></div>
        
        <div class="relative p-8 md:p-10 flex flex-col md:flex-row items-start md:items-center justify-between z-10">
            <div>
                <h3 class="text-3xl font-bold text-white mb-2">Welcome back, {{ auth()->user()->name }}! 👋</h3>
                <p class="text-blue-100 text-lg opacity-90">Your fitness journey continues. Ready to crush it today?</p>
            </div>
            <div class="mt-6 md:mt-0">
                <span class="inline-flex items-center px-4 py-2 rounded-lg bg-white/20 backdrop-blur-sm text-white text-sm font-medium border border-white/10">
                    {{ \Carbon\Carbon::now()->format('l, M jS') }}
                </span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Total Workouts</p>
                    <h4 class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $totalWorkouts }}</h4>
                </div>
                <div class="p-3 bg-blue-50 dark:bg-blue-900/30 rounded-xl text-blue-600 dark:text-blue-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">This Week</p>
                    <h4 class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $thisWeekWorkouts }}</h4>
                    @if($lastWeekWorkouts > 0)
                        <p class="text-xs mt-2 font-medium flex items-center">
                            @if($thisWeekWorkouts > $lastWeekWorkouts)
                                <span class="text-green-500 flex items-center"><svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg> +{{ $thisWeekWorkouts - $lastWeekWorkouts }}</span>
                            @elseif($thisWeekWorkouts < $lastWeekWorkouts)
                                <span class="text-red-500 flex items-center"><svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path></svg> -{{ $lastWeekWorkouts - $thisWeekWorkouts }}</span>
                            @else
                                <span class="text-gray-500">Same as last week</span>
                            @endif
                        </p>
                    @endif
                </div>
                <div class="p-3 bg-green-50 dark:bg-green-900/30 rounded-xl text-green-600 dark:text-green-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Sets This Month</p>
                    <h4 class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $monthlyStats->total_sets ?? 0 }}</h4>
                </div>
                <div class="p-3 bg-purple-50 dark:bg-purple-900/30 rounded-xl text-purple-600 dark:text-purple-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Total Routines</p>
                    <h4 class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $totalRoutines }}</h4>
                </div>
                <div class="p-3 bg-yellow-50 dark:bg-yellow-900/30 rounded-xl text-yellow-600 dark:text-yellow-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        <div class="lg:col-span-2 bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-6 flex items-center">
                <span class="bg-blue-500 w-1 h-6 mr-3 rounded-full"></span>
                Workout Frequency
            </h3>
            <div class="h-72 w-full">
                <canvas id="workoutChart"></canvas>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-6">Top Exercises</h3>
            @if($popularExercises->count() > 0)
                <div class="space-y-4">
                    @foreach($popularExercises as $index => $exercise)
                        <div class="flex items-center justify-between p-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 rounded-xl transition-colors">
                            <div class="flex items-center">
                                <div class="w-10 h-10 {{ $index < 3 ? 'bg-gradient-to-br from-blue-500 to-purple-600 text-white shadow-lg shadow-blue-500/30' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300' }} rounded-xl flex items-center justify-center text-sm font-bold">
                                    {{ $index + 1 }}
                                </div>
                                <div class="ml-4">
                                    <span class="block text-sm font-bold text-gray-900 dark:text-gray-100">{{ $exercise->name }}</span>
                                    <div class="w-full bg-gray-200 rounded-full h-1.5 mt-1.5 dark:bg-gray-700">
                                        <div class="bg-blue-500 h-1.5 rounded-full" style="width: {{ min(($exercise->usage_count / 20) * 100, 100) }}%"></div>
                                    </div>
                                </div>
                            </div>
                            <span class="text-xs font-semibold text-gray-500">{{ $exercise->usage_count }}x</span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center py-4">No data yet.</p>
            @endif
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Recent History</h3>
            <a href="{{ route('workouts.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700">View All</a>
        </div>
        
        @if($recentWorkoutsList->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50 dark:bg-gray-700/50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Workout</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Date</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase">Volume</th>
                            <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @foreach($recentWorkoutsList as $workout)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $workout->title }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ \Carbon\Carbon::parse($workout->date)->format('M j, Y') }}</td>
                                <td class="px-6 py-4 text-center text-sm text-gray-500">{{ $workout->workoutDetails()->count() }} Sets</td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('workouts.show', $workout) }}" class="text-blue-600 hover:underline text-sm font-medium">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="p-8 text-center text-gray-500">No workouts yet.</div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('workoutChart').getContext('2d');
        const workoutData = @json($workoutFrequency);
        
        let gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(59, 130, 246, 0.5)'); 
        gradient.addColorStop(1, 'rgba(59, 130, 246, 0.0)'); 

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: workoutData.map(item => item.date),
                datasets: [{
                    label: 'Workouts',
                    data: workoutData.map(item => item.count),
                    borderColor: '#3b82f6',
                    backgroundColor: gradient,
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1 } },
                    x: { ticks: { maxTicksLimit: 7 } }
                }
            }
        });
    </script>
</x-app-layout>