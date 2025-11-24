<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Workout: ') . $workout->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Workout Info -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4">
                        <h3 class="text-lg font-medium">Workout Details</h3>
                        <p><strong>Date:</strong> {{ $workout->date }}</p>
                        <p><strong>Title:</strong> {{ $workout->title }}</p>
                    </div>
                    
                    <div class="mb-4">
                        <a href="{{ route('workouts.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Back to Workouts
                        </a>
                    </div>
                </div>
            </div>

            <!-- Workout Sets -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Workout Sets</h3>
                    
                    @if($workoutDetails->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full table-auto">
                                <thead>
                                    <tr class="bg-gray-100 dark:bg-gray-700">
                                        <th class="px-4 py-2 text-left">Exercise</th>
                                        <th class="px-4 py-2 text-left">Set #</th>
                                        <th class="px-4 py-2 text-left">Weight (kg)</th>
                                        <th class="px-4 py-2 text-left">Reps</th>
                                        <th class="px-4 py-2 text-left">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($workoutDetails as $detail)
                                        <tr class="border-b dark:border-gray-600">
                                            <td class="px-4 py-2">{{ $detail->exercise->name }}</td>
                                            <td class="px-4 py-2">{{ $detail->set_number }}</td>
                                            <td class="px-4 py-2">{{ $detail->weight_kg ?? 'N/A' }}</td>
                                            <td class="px-4 py-2">{{ $detail->reps }}</td>
                                            <td class="px-4 py-2">
                                                <form action="{{ route('workout_details.destroy', $detail) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" 
                                                            onclick="return confirm('Are you sure you want to delete this set?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500">No sets recorded for this workout yet.</p>
                    @endif
                </div>
            </div>

            <!-- Add New Set -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Add New Set</h3>
                    
                    <form action="{{ route('workout_details.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="workout_id" value="{{ $workout->id }}">
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div>
                                <label for="exercise_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Exercise</label>
                                <select class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700" name="exercise_id" required>
                                    <option value="">Select Exercise</option>
                                    @foreach ($exercises as $exercise)
                                        <option value="{{ $exercise->id }}">{{ $exercise->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div>
                                <label for="set_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Set Number</label>
                                <input type="number" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700" name="set_number" min="1" required>
                            </div>
                            
                            <div>
                                <label for="weight_kg" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Weight (kg)</label>
                                <input type="number" step="0.5" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700" name="weight_kg">
                            </div>
                            
                            <div>
                                <label for="reps" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Reps</label>
                                <input type="number" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700" name="reps" min="1" required>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Add Set
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
