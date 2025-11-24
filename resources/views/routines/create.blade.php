<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Routine') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('routines.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Routine Name</label>
                            <input type="text" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                                   id="name" name="name" required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Exercises</label>
                            <div id="exercises-container">
                                <div class="exercise-item border p-4 mb-4 rounded">
                                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium">Exercise</label>
                                            <select name="exercises[]" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700" required>
                                                <option value="">Select Exercise</option>
                                                @foreach ($exercises as $exercise)
                                                    <option value="{{ $exercise->id }}">{{ $exercise->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium">Sets Target</label>
                                            <input type="number" name="sets_target[]" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700" min="1" required>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium">Reps Target</label>
                                            <input type="number" name="reps_target[]" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700" min="1" required>
                                        </div>
                                        <div class="flex items-end">
                                            <button type="button" class="remove-exercise bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" style="display: none;">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <button type="button" id="add-exercise" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Add Exercise
                            </button>
                        </div>
                        
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('routines.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                                Cancel
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
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
                            exerciseItem.querySelector('.remove-exercise').style.display = 'block';
                            
                            container.appendChild(exerciseItem);
                            updateRemoveButtons();
                        });

                        document.addEventListener('click', function(e) {
                            if (e.target.classList.contains('remove-exercise')) {
                                e.target.closest('.exercise-item').remove();
                                updateRemoveButtons();
                            }
                        });

                        function updateRemoveButtons() {
                            const items = document.querySelectorAll('.exercise-item');
                            items.forEach((item, index) => {
                                const removeBtn = item.querySelector('.remove-exercise');
                                if (items.length > 1) {
                                    removeBtn.style.display = 'block';
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
