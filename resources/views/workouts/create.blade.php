<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Start New Workout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-2xl border border-gray-100 dark:border-gray-700">
                <div class="p-8">
                    <form action="{{ route('workouts.store') }}" method="POST" id="workoutForm">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div>
                                <label for="title" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Workout Title</label>
                                <input type="text" class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3" 
                                       id="title" name="title" value="{{ old('title') }}" placeholder="e.g. Monday Chest Day" required>
                                @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="date" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Date</label>
                                <input type="date" class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3" 
                                       id="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required>
                                @error('date') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="mb-8">
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-4">Choose a Routine (Optional)</label>
                            
                            @if($routines->count() > 0)
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="routine-card relative border-2 border-gray-200 dark:border-gray-700 rounded-xl p-5 cursor-pointer hover:border-blue-400 transition-all group bg-gray-50 dark:bg-gray-700/30" data-id="">
                                        <input type="radio" name="routine_id" value="" class="absolute top-4 right-4 text-blue-600 focus:ring-blue-500" checked>
                                        <div class="flex items-center mb-2">
                                            <div class="w-10 h-10 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center text-gray-500 dark:text-gray-300 group-hover:bg-blue-100 group-hover:text-blue-600 transition-colors">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                            </div>
                                            <h4 class="ml-3 font-bold text-gray-900 dark:text-white">Empty Workout</h4>
                                        </div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Start from scratch without a template.</p>
                                    </div>

                                    @foreach($routines as $routine)
                                        <div class="routine-card relative border-2 border-gray-200 dark:border-gray-700 rounded-xl p-5 cursor-pointer hover:border-blue-400 transition-all" data-id="{{ $routine->id }}" data-name="{{ $routine->name }}">
                                            <input type="radio" name="routine_id" value="{{ $routine->id }}" class="absolute top-4 right-4 text-blue-600 focus:ring-blue-500">
                                            <h4 class="font-bold text-gray-900 dark:text-white mb-2 pr-8">{{ $routine->name }}</h4>
                                            <div class="text-xs text-gray-500 dark:text-gray-400 flex flex-wrap gap-1">
                                                @foreach($routine->exercises->take(3) as $exercise)
                                                    <span class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded px-2 py-1">
                                                        {{ $exercise->name }}
                                                    </span>
                                                @endforeach
                                                @if($routine->exercises->count() > 3)
                                                    <span class="bg-gray-100 dark:bg-gray-700 rounded px-2 py-1 text-gray-500">+{{ $routine->exercises->count() - 3 }} more</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center p-6 border-2 border-dashed border-gray-300 dark:border-gray-700 rounded-xl">
                                    <p class="text-gray-500">No routines found.</p>
                                    <a href="{{ route('routines.create') }}" class="text-blue-500 font-semibold hover:underline">Create a routine</a> to speed up this process.
                                </div>
                            @endif
                        </div>

                        <div class="mb-8 p-5 bg-gray-50 dark:bg-gray-700/20 rounded-xl border border-gray-100 dark:border-gray-700">
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-3">Include Extra Exercises?</label>
                            <div class="h-48 overflow-y-auto pr-2 custom-scrollbar">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                    @foreach($exercises as $exercise)
                                        <label class="flex items-center p-3 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-600 cursor-pointer hover:border-blue-400 transition-colors">
                                            <input type="checkbox" name="exercises[]" value="{{ $exercise->id }}" class="rounded text-blue-600 focus:ring-blue-500 h-5 w-5 border-gray-300">
                                            <div class="ml-3">
                                                <span class="block text-sm font-medium text-gray-900 dark:text-white">{{ $exercise->name }}</span>
                                                @if($exercise->description)
                                                    <span class="block text-xs text-gray-500 truncate max-w-[200px]">{{ $exercise->description }}</span>
                                                @endif
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-700">
                            <a href="{{ route('workouts.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-medium text-gray-600 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                Cancel
                            </a>
                            <button type="submit" class="px-8 py-2.5 rounded-xl text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 shadow-lg shadow-blue-500/30 transition-all transform hover:-translate-y-0.5">
                                Start Workout
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.routine-card');
            const titleInput = document.getElementById('title');

            // Handle Card Clicks
            cards.forEach(card => {
                card.addEventListener('click', function() {
                    // Update Radio
                    const radio = this.querySelector('input[type="radio"]');
                    radio.checked = true;

                    // Update Visuals
                    cards.forEach(c => {
                        c.classList.remove('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900/20', 'ring-2', 'ring-blue-500', 'ring-opacity-50');
                        c.classList.add('border-gray-200', 'dark:border-gray-700');
                    });
                    
                    this.classList.remove('border-gray-200', 'dark:border-gray-700');
                    this.classList.add('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900/20', 'ring-2', 'ring-blue-500', 'ring-opacity-50');

                    // Auto-fill Title
                    const routineName = this.dataset.name;
                    if (routineName) {
                        const today = new Date().toLocaleDateString('en-US', { weekday: 'short', month: 'short', day: 'numeric' });
                        titleInput.value = `${routineName} - ${today}`;
                    } else if (this.dataset.id === "") {
                        // Reset if empty selected (optional)
                    }
                });
            });
        });
    </script>
</x-app-layout>