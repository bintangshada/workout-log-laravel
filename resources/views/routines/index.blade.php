<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('My Routines') }}
            </h2>
            <a href="{{ route('routines.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring ring-blue-300 transition ease-in-out duration-150 shadow-md shadow-blue-500/30">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                New Routine
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if($routines->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($routines as $routine)
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md transition-shadow duration-200 flex flex-col h-full">
                            <div class="p-6 border-b border-gray-50 dark:border-gray-700">
                                <div class="flex justify-between items-start">
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white truncate" title="{{ $routine->name }}">
                                        {{ $routine->name }}
                                    </h3>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('routines.edit', $routine) }}" class="text-gray-400 hover:text-yellow-500 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        </a>
                                        <form action="{{ route('routines.destroy', $routine) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors" onclick="return confirm('Are you sure you want to delete this routine?')">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">{{ $routine->exercises->count() }} Exercises</p>
                            </div>

                            <div class="p-6 flex-1 bg-gray-50 dark:bg-gray-800/50 rounded-b-2xl">
                                @if($routine->exercises->count() > 0)
                                    <ul class="space-y-3">
                                        @foreach($routine->exercises->take(5) as $exercise)
                                            <li class="flex justify-between items-center text-sm">
                                                <span class="text-gray-700 dark:text-gray-300 font-medium truncate w-2/3">{{ $exercise->name }}</span>
                                                <span class="bg-white dark:bg-gray-700 px-2 py-1 rounded text-xs text-gray-500 border border-gray-100 dark:border-gray-600 whitespace-nowrap">
                                                    {{ $exercise->pivot->sets_target }} x {{ $exercise->pivot->reps_target }}
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                    @if($routine->exercises->count() > 5)
                                        <div class="mt-3 text-center">
                                            <span class="text-xs text-blue-500 font-medium">+ {{ $routine->exercises->count() - 5 }} more exercises</span>
                                        </div>
                                    @endif
                                @else
                                    <div class="text-center py-4 text-gray-400 italic text-sm">
                                        No exercises added yet.
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16 px-4 bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                    <div class="w-20 h-20 bg-blue-50 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-blue-500 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1">No Routines Yet</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-6 max-w-sm mx-auto">Create a routine to bundle your exercises together (e.g., "Leg Day", "Morning Cardio").</p>
                    <a href="{{ route('routines.create') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow-lg shadow-blue-500/30 transition-all transform hover:-translate-y-0.5">
                        Start Your First Routine
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>