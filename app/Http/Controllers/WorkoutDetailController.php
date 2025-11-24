<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use App\Models\WorkoutDetail;
use App\Models\Exercise;
use Illuminate\Http\Request;

class WorkoutDetailController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'workout_id' => 'required|exists:workouts,id',
            'exercise_id' => 'required|exists:exercises,id',
            'set_number' => 'required|integer|min:1',
            'weight_kg' => 'nullable|numeric|min:0',
            'reps' => 'required|integer|min:1',
        ]);

        WorkoutDetail::create([
            'workout_id' => $request->workout_id,
            'exercise_id' => $request->exercise_id,
            'set_number' => $request->set_number,
            'weight_kg' => $request->weight_kg,
            'reps' => $request->reps,
        ]);

        return redirect()->route('workouts.show', $request->workout_id)
                        ->with('success', 'Set added successfully!');
    }

    public function destroy(WorkoutDetail $workoutDetail)
    {
        $workoutId = $workoutDetail->workout_id;
        $workoutDetail->delete();
        
        return redirect()->route('workouts.show', $workoutId)
                        ->with('success', 'Set deleted successfully!');
    }
}


