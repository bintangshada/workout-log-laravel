<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Routine') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-2xl border border-gray-100 dark:border-gray-700">
                <div class="p-8">
                    <header class="mb-8 border-b border-gray-100 dark:border-gray-700 pb-4">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Design Your Routine</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Name your routine and add exercises with target sets/reps.</p>
                    </header>

                    <form action="{{ route('routines.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-8">
                            <label for="name" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Routine Name</label>
                            <input type="text" 
                                   class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-lg" 
                                   id="name" name="name" placeholder="e.g. Chest & Triceps A" required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-8">
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-4">Exercises Flow</label>
                            
                            <div id="exercises-container" class="space-y-4">
                                <div class="exercise-item bg-gray-50 dark:bg-gray-700/30 p-5 rounded-xl border border-gray-200 dark:border-gray-600 relative group transition-all duration-200 hover:border-blue-300 dark:hover:border-blue-500">
                                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                                        <div class="md:col-span-6">
                                            <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1 uppercase tracking-wider">Exercise</label>
                                            <select name="exercises[]" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                                <option value="">Select Exercise...</option>
                                                @foreach ($exercises as $exercise)
                                                    <option value="{{ $exercise->id }}">{{ $exercise->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        <div class="md:col-span-2">
                                            <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1 uppercase tracking-wider">Sets</label>
                                            <input type="number" name="sets_target[]" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 text-center" min="1" placeholder="3" required>
                                        </div>
                                        
                                        <div class="md:col-span-2">
                                            <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1 uppercase tracking-wider">Reps</label>
                                            <input type="number" name="reps_target[]" class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 text-center" min="1" placeholder="10" required>
                                        </div>

                                        <div class="md:col-span-2 flex justify-end">
                                            <button type="button" class="remove-exercise w-full md:w-auto inline-flex justify-center items-center px-3 py-2 border border-red-200 dark:border-red-900/30 text-sm leading-4 font-medium rounded-lg text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/10 hover:bg-red-100 dark:hover:bg-red-900/30 focus:outline-none transition-colors" style="display: none;">
                                                <svg class="w-4 h-4 mr-1 md:mr-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                <span class="md:hidden">Remove</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <button type="button" id="add-exercise" class="mt-4 w-full py-3 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl text-gray-500 dark:text-gray-400 font-semibold hover:border-blue-500 hover:text-blue-600 dark:hover:border-blue-400 dark:hover:text-blue-400 transition-all flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                Add Next Exercise
                            </button>
                        </div>
                        
                        <div class="flex items-center justify-end pt-6 border-t border-gray-100 dark:border-gray-700 gap-3">
                            <a href="{{ route('routines.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-medium text-gray-600 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                Cancel
                            </a>
                            <button type="submit" class="px-6 py-2.5 rounded-xl text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 shadow-lg shadow-blue-500/30 transition-all transform hover:-translate-y-0.5">
                                Create Routine
                            </button>
                        </div>
                    </form>

                    <script>
                        document.getElementById('add-exercise').addEventListener('click', function() {
                            const container = document.getElementById('exercises-container');
                            const exerciseItem = container.querySelector('.exercise-item').cloneNode(true);
                            
                            // Clear values
                            exerciseItem.querySelectorAll('input, select').forEach(input => input.value = '');
                            
                            // Pastikan tombol remove muncul di item baru
                            const removeBtn = exerciseItem.querySelector('.remove-exercise');
                            if(removeBtn) removeBtn.style.display = 'inline-flex'; // styling fix for flex button
                            
                            container.appendChild(exerciseItem);
                            updateRemoveButtons();
                        });

                        document.addEventListener('click', function(e) {
                            // Mencari tombol remove dengan closest agar klik icon juga terbaca
                            const btn = e.target.closest('.remove-exercise');
                            if (btn) {
                                btn.closest('.exercise-item').remove();
                                updateRemoveButtons();
                            }
                        });

                        function updateRemoveButtons() {
                            const items = document.querySelectorAll('.exercise-item');
                            items.forEach((item, index) => {
                                const removeBtn = item.querySelector('.remove-exercise');
                                if (items.length > 1) {
                                    // Style flex untuk alignment yang benar dengan icon
                                    removeBtn.style.display = 'inline-flex';
                                } else {
                                    removeBtn.style.display = 'none';
                                }
                            });
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>