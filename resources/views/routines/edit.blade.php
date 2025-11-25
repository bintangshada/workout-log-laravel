<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Routine') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-2xl border border-gray-100 dark:border-gray-700">
                <div class="p-8">
                    <header class="mb-8">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Edit: {{ $routine->name }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Modify the routine name or selected exercises.</p>
                    </header>

                    <form action="{{ route('routines.update', $routine) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div>
                            <label for="name" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Routine Name</label>
                            <input type="text" 
                                   class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors py-3 px-4" 
                                   id="name" name="name" value="{{ old('name', $routine->name) }}" required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="exercises" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Selected Exercises</label>
                            <div class="relative">
                                <select multiple 
                                        class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 h-64 p-2" 
                                        id="exercises" name="exercises[]">
                                    @foreach ($exercises as $exercise)
                                        <option value="{{ $exercise->id }}" 
                                                class="p-2 mb-1 rounded hover:bg-blue-50 dark:hover:bg-blue-900/30 cursor-pointer checked:bg-blue-100 dark:checked:bg-blue-800 checked:text-blue-800 dark:checked:text-white"
                                                {{ in_array($exercise->id, $routine->exercises->pluck('id')->toArray()) ? 'selected' : '' }}>
                                            {{ $exercise->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute right-3 top-3 pointer-events-none text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path></svg>
                                </div>
                            </div>
                            <div class="mt-2 flex items-start p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg text-sm text-blue-700 dark:text-blue-300">
                                <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <p>To select multiple items, hold down <span class="font-bold">Ctrl</span> (Windows) or <span class="font-bold">Cmd</span> (Mac) while clicking.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-end pt-4 border-t border-gray-100 dark:border-gray-700 gap-3">
                            <a href="{{ route('routines.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-medium text-gray-600 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                Cancel
                            </a>
                            <button type="submit" class="px-5 py-2.5 rounded-xl text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 shadow-lg shadow-blue-500/30 transition-all transform hover:-translate-y-0.5">
                                Update Routine
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>