<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Workout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('workouts.store') }}" method="POST" id="workoutForm">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Workout Title</label>
                            <input type="text" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                                   id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date</label>
                            <input type="date" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                                   id="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required>
                            @error('date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Choose from Existing Routine (Optional)</label>
                            
                            @if($routines->count() > 0)
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach($routines as $routine)
                                        <div class="border border-gray-300 dark:border-gray-600 rounded-lg p-4 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer routine-card" 
                                             data-routine-id="{{ $routine->id }}">
                                            <div class="flex items-start">
                                                <input type="radio" name="routine_id" value="{{ $routine->id }}" 
                                                       class="mt-1 text-indigo-600 border-gray-300 focus:ring-indigo-500" 
                                                       id="routine_{{ $routine->id }}">
                                                <div class="ml-3 flex-1">
                                                    <label for="routine_{{ $routine->id }}" class="block text-sm font-medium cursor-pointer">
                                                        {{ $routine->name }}
                                                    </label>
                                                    <div class="mt-1 text-xs text-gray-600 dark:text-gray-400">
                                                        @foreach($routine->exercises as $exercise)
                                                            <span class="inline-block bg-gray-200 dark:bg-gray-600 rounded px-2 py-1 mr-1 mb-1">
                                                                {{ $exercise->name }} ({{ $exercise->pivot->sets_target }}×{{ $exercise->pivot->reps_target }})
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                
                                <div class="mt-3">
                                    <label class="flex items-center">
                                        <input type="radio" name="routine_id" value="" class="text-indigo-600 border-gray-300 focus:ring-indigo-500" checked>
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Don't use any routine (create from scratch)</span>
                                    </label>
                                </div>
                            @else
                                <p class="text-gray-500 text-sm">No routines available. <a href="{{ route('routines.create') }}" class="text-blue-500">Create your first routine</a></p>
                            @endif
                        </div>

                        <div class="mb-6" id="additionalExercises">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Add Additional Exercises (Optional)</label>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">You can add more exercises beyond what's included in the routine.</p>
                            
                            <div class="border border-gray-300 dark:border-gray-600 rounded-lg p-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Select Exercises</label>
                                <div class="max-h-40 overflow-y-auto">
                                    @foreach($exercises as $exercise)
                                        <label class="flex items-center py-2">
                                            <input type="checkbox" name="exercises[]" value="{{ $exercise->id }}" 
                                                   class="text-indigo-600 border-gray-300 focus:ring-indigo-500 rounded">
                                            <span class="ml-2 text-sm">{{ $exercise->name }}</span>
                                            @if($exercise->description)
                                                <span class="ml-2 text-xs text-gray-500">({{ $exercise->description }})</span>
                                            @endif
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('workouts.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                                Cancel
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Create Workout
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const routineCards = document.querySelectorAll('.routine-card');
            routineCards.forEach(card => {
                card.addEventListener('click', function() {
                    const radio = this.querySelector('input[type="radio"]');
                    radio.checked = true;
                    
                    routineCards.forEach(c => c.classList.remove('bg-indigo-50', 'dark:bg-indigo-900', 'border-indigo-300', 'dark:border-indigo-600'));
                    
                    this.classList.add('bg-indigo-50', 'dark:bg-indigo-900', 'border-indigo-300', 'dark:border-indigo-600');
                });
            });

            const noRoutineRadio = document.querySelector('input[name="routine_id"][value=""]');
            if (noRoutineRadio) {
                noRoutineRadio.addEventListener('change', function() {
                    if (this.checked) {
                        routineCards.forEach(c => c.classList.remove('bg-indigo-50', 'dark:bg-indigo-900', 'border-indigo-300', 'dark:border-indigo-600'));
                    }
                });
            }

            const routineRadios = document.querySelectorAll('input[name="routine_id"]:not([value=""])');
            const titleInput = document.getElementById('title');
            
            routineRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.checked && !titleInput.value) {
                        const routineName = this.closest('.routine-card').querySelector('label').textContent.trim();
                        const today = new Date().toLocaleDateString('en-US', { 
                            year: 'numeric', 
                            month: 'short', 
                            day: 'numeric' 
                        });
                        titleInput.value = `${routineName} - ${today}`;
                    }
                });
            });
        });
    </script>
</x-app-layout>
