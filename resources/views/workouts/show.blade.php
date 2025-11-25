<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 dark:text-white leading-tight">
                    {{ $workout->title }}
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    {{ \Carbon\Carbon::parse($workout->date)->format('l, F j, Y') }}
                </p>
            </div>
            <a href="{{ route('workouts.index') }}" class="mt-4 md:mt-0 text-sm text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to History
            </a>
        </div>
    </x-slot>

    <div class="py-6 md:py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-1 order-1 lg:order-1">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 sticky top-6">
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                                <span class="w-2 h-6 bg-blue-600 rounded-full mr-3"></span>
                                Log Set
                            </h3>

                            <form action="{{ route('workout_details.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="workout_id" value="{{ $workout->id }}">
                                
                                <div class="mb-6">
                                    <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Select Exercise</label>
                                    <select name="exercise_id" id="exerciseSelect" class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white text-lg py-3 focus:ring-blue-500 focus:border-blue-500" required>
                                        <option value="">-- Choose Exercise --</option>
                                        @foreach ($exercises as $exercise)
                                            <option value="{{ $exercise->id }}">{{ $exercise->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-6">
                                    <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Set Number</label>
                                    <input type="number" id="setNumberInput" name="set_number" class="w-full bg-gray-100 dark:bg-gray-700 border-transparent rounded-xl text-center font-bold text-gray-600 dark:text-gray-200" readonly value="1">
                                </div>

                                <div class="grid grid-cols-2 gap-4 mb-8">
                                    <div>
                                        <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2 text-center">Weight (kg)</label>
                                        <div class="flex items-center">
                                            <button type="button" onclick="adjustValue('weightInput', -2.5)" class="w-12 h-12 bg-gray-200 dark:bg-gray-700 rounded-l-xl text-gray-600 dark:text-white hover:bg-gray-300 dark:hover:bg-gray-600 active:bg-gray-400 transition-colors flex items-center justify-center">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                            </button>
                                            
                                            <input type="number" step="0.5" name="weight_kg" id="weightInput" class="w-full border-t-0 border-b-0 border-r-0 border-l-0 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white text-center text-xl font-bold py-3 focus:ring-0 placeholder-gray-400 dark:placeholder-gray-600" placeholder="0">
                                            
                                            <button type="button" onclick="adjustValue('weightInput', 2.5)" class="w-12 h-12 bg-gray-200 dark:bg-gray-700 rounded-r-xl text-gray-600 dark:text-white hover:bg-gray-300 dark:hover:bg-gray-600 active:bg-gray-400 transition-colors flex items-center justify-center">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                            </button>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2 text-center">Reps</label>
                                        <div class="flex items-center">
                                            <button type="button" onclick="adjustValue('repsInput', -1)" class="w-12 h-12 bg-gray-200 dark:bg-gray-700 rounded-l-xl text-gray-600 dark:text-white hover:bg-gray-300 dark:hover:bg-gray-600 active:bg-gray-400 transition-colors flex items-center justify-center">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                            </button>
                                            
                                            <input type="number" name="reps" id="repsInput" class="w-full border-t-0 border-b-0 border-r-0 border-l-0 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white text-center text-xl font-bold py-3 focus:ring-0 placeholder-gray-400 dark:placeholder-gray-600" placeholder="0" required>
                                            
                                            <button type="button" onclick="adjustValue('repsInput', 1)" class="w-12 h-12 bg-gray-200 dark:bg-gray-700 rounded-r-xl text-gray-600 dark:text-white hover:bg-gray-300 dark:hover:bg-gray-600 active:bg-gray-400 transition-colors flex items-center justify-center">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-blue-500/30 active:transform active:scale-95 transition-all text-lg">
                                    Save Set
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-2 order-2 lg:order-2">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Current Session</h3>
                            <span class="text-sm font-medium text-gray-500">{{ $workoutDetails->count() }} sets total</span>
                        </div>

                        @if($workoutDetails->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="w-full text-left" id="historyTable">
                                    <thead class="bg-gray-50 dark:bg-gray-700/50 text-gray-500 dark:text-gray-400 text-xs uppercase font-semibold">
                                        <tr>
                                            <th class="px-6 py-4 rounded-tl-lg">Exercise</th>
                                            <th class="px-4 py-4 text-center">Set</th>
                                            <th class="px-4 py-4 text-center">kg</th>
                                            <th class="px-4 py-4 text-center">Reps</th>
                                            <th class="px-4 py-4 text-right rounded-tr-lg">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                        @foreach ($workoutDetails->sortByDesc('created_at') as $detail)
                                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors group" 
                                                data-exercise-id="{{ $detail->exercise_id }}"
                                                data-weight="{{ $detail->weight_kg }}"
                                                data-reps="{{ $detail->reps }}"
                                                data-set-num="{{ $detail->set_number }}">
                                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $detail->exercise->name }}</td>
                                                <td class="px-4 py-4 text-center text-gray-500 bg-gray-50/50 dark:bg-gray-800 mx-2 rounded-lg font-mono">{{ $detail->set_number }}</td>
                                                <td class="px-4 py-4 text-center font-bold text-gray-800 dark:text-gray-200">{{ $detail->weight_kg ?? '-' }}</td>
                                                <td class="px-4 py-4 text-center font-bold text-blue-600 dark:text-blue-400">{{ $detail->reps }}</td>
                                                <td class="px-4 py-4 text-right">
                                                    <form action="{{ route('workout_details.destroy', $detail) }}" method="POST" class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-gray-300 hover:text-red-500 transition-colors p-2" onclick="return confirm('Delete this set?')">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="p-12 text-center">
                                <div class="w-16 h-16 bg-blue-50 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse">
                                    <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                </div>
                                <h3 class="text-gray-900 dark:text-white font-bold mb-1">Session Started</h3>
                                <p class="text-gray-500 text-sm">Select an exercise on the left to log your first set.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // 1. Helper for +/- Buttons
        function adjustValue(inputId, step) {
            const input = document.getElementById(inputId);
            let val = parseFloat(input.value) || 0;
            val += step;
            if(val < 0) val = 0;
            // Jika step desimal, fix precision
            if (!Number.isInteger(step)) {
                val = parseFloat(val.toFixed(1));
            }
            input.value = val;
        }

        // 2. Smart Auto-fill Logic
        document.addEventListener('DOMContentLoaded', function() {
            const exerciseSelect = document.getElementById('exerciseSelect');
            const weightInput = document.getElementById('weightInput');
            const repsInput = document.getElementById('repsInput');
            const setNumberInput = document.getElementById('setNumberInput');
            const historyRows = document.querySelectorAll('#historyTable tbody tr');

            exerciseSelect.addEventListener('change', function() {
                const selectedId = this.value;
                if (!selectedId) return;

                // Cari history terakhir untuk exercise ini
                let lastSetWeight = '';
                let lastSetReps = '';
                let maxSetNum = 0;

                // Loop history row
                historyRows.forEach(row => {
                    if (row.dataset.exerciseId === selectedId) {
                        const rowSetNum = parseInt(row.dataset.setNum);
                        
                        // Set number logic
                        if (rowSetNum > maxSetNum) {
                            maxSetNum = rowSetNum;
                            lastSetWeight = row.dataset.weight;
                            lastSetReps = row.dataset.reps;
                        }
                    }
                });

                // Update UI
                setNumberInput.value = maxSetNum + 1;
                
                if (lastSetWeight) weightInput.value = lastSetWeight;
                if (lastSetReps) repsInput.value = lastSetReps;
            });
        });
    </script>
</x-app-layout>