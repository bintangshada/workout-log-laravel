<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Workouts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4">
                        <a href="{{ route('workouts.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Add New Workout
                        </a>
                    </div>
                    
                    @if($workouts->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full table-auto">
                                <thead>
                                    <tr class="bg-gray-100 dark:bg-gray-700">
                                        <th class="px-4 py-2 text-left">Title</th>
                                        <th class="px-4 py-2 text-left">Date</th>
                                        <th class="px-4 py-2 text-left">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($workouts as $workout)
                                        <tr class="border-b dark:border-gray-600">
                                            <td class="px-4 py-2">{{ $workout->title }}</td>
                                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($workout->date)->format('M d, Y') }}</td>
                                            <td class="px-4 py-2">
                                                <a href="{{ route('workouts.show', $workout) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded mr-2">
                                                    View
                                                </a>
                                                <form action="{{ route('workouts.destroy', $workout) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" 
                                                            onclick="return confirm('Are you sure you want to delete this workout?')">
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
                        <p class="text-gray-500">No workouts found. <a href="{{ route('workouts.create') }}" class="text-blue-500">Create your first workout</a></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>