<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use App\Models\Exercise;
use App\Models\Routine;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    public function index()
    {
        $workouts = Workout::where('user_id', auth()->id())->orderBy('date', 'desc')->get();
        return view('workouts.index', compact('workouts'));
    }

    public function create()
    {
        $routines = Routine::where('user_id', auth()->id())->with('exercises')->get();
        $exercises = Exercise::all();
        return view('workouts.create', compact('routines', 'exercises'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'routine_id' => 'nullable|exists:routines,id',
            'exercises' => 'nullable|array',
            'exercises.*' => 'exists:exercises,id',
        ]);

        $workout = Workout::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'date' => $request->date,
        ]);

        if ($request->routine_id) {
            $routine = Routine::with('exercises')->find($request->routine_id);
            foreach ($routine->exercises as $exercise) {
                for ($i = 1; $i <= $exercise->pivot->sets_target; $i++) {
                    $workout->workoutDetails()->create([
                        'exercise_id' => $exercise->id,
                        'set_number' => $i,
                        'weight_kg' => null,
                        'reps' => $exercise->pivot->reps_target,
                    ]);
                }
            }
        }

        if ($request->exercises) {
            foreach ($request->exercises as $exerciseId) {
                $existingExercise = $workout->workoutDetails()->where('exercise_id', $exerciseId)->exists();
                if (!$existingExercise) {
                    $workout->workoutDetails()->create([
                        'exercise_id' => $exerciseId,
                        'set_number' => 1,
                        'weight_kg' => null,
                        'reps' => 10,
                    ]);
                }
            }
        }

        return redirect()->route('workouts.show', $workout)->with('success', 'Workout created successfully!');
    }

    public function show(Workout $workout)
    {
        $workoutDetails = $workout->workoutDetails()->with('exercise')->orderBy('exercise_id', 'asc')->orderBy('set_number', 'asc')->get();
        $exercises = Exercise::all();
        return view('workouts.show', compact('workout', 'workoutDetails', 'exercises'));
    }

    public function destroy(Workout $workout)
    {
        $workout->delete();
        return redirect()->route('workouts.index')->with('success', 'Workout deleted successfully!');
    }
}
