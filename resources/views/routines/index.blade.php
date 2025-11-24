<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Routines') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4">
                        <a href="{{ route('routines.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Add New Routine
                        </a>
                    </div>
                    
                    @if($routines->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full table-auto">
                                <thead>
                                    <tr class="bg-gray-100 dark:bg-gray-700">
                                        <th class="px-4 py-2 text-left">Name</th>
                                        <th class="px-4 py-2 text-left">Exercises</th>
                                        <th class="px-4 py-2 text-left">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($routines as $routine)
                                        <tr class="border-b dark:border-gray-600">
                                            <td class="px-4 py-2">{{ $routine->name }}</td>
                                            <td class="px-4 py-2">
                                                @if($routine->exercises->count() > 0)
                                                    @foreach($routine->exercises as $exercise)
                                                        <div class="mb-1">
                                                            <span class="font-medium">{{ $exercise->name }}</span>
                                                            <span class="text-sm text-gray-500">
                                                                ({{ $exercise->pivot->sets_target }} sets × {{ $exercise->pivot->reps_target }} reps)
                                                            </span>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <span class="text-gray-500">No exercises</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-2">
                                                <a href="{{ route('routines.edit', $routine) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded mr-2">
                                                    Edit
                                                </a>
                                                <form action="{{ route('routines.destroy', $routine) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" 
                                                            onclick="return confirm('Are you sure you want to delete this routine?')">
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
                        <p class="text-gray-500">No routines found. <a href="{{ route('routines.create') }}" class="text-blue-500">Create your first routine</a></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
