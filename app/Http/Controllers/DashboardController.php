<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use App\Models\Exercise;
use App\Models\Routine;
use App\Models\WorkoutDetail;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $totalWorkouts = Workout::where('user_id', $user->id)->count();
        $totalExercises = Exercise::count();
        $totalRoutines = Routine::where('user_id', $user->id)->count();
        
        $recentWorkouts = Workout::where('user_id', $user->id)
            ->where('date', '>=', Carbon::now()->subDays(7))
            ->count();
        
        $workoutFrequency = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $count = Workout::where('user_id', $user->id)
                ->whereDate('date', $date)
                ->count();
            $workoutFrequency[] = [
                'date' => $date->format('M j'),
                'count' => $count
            ];
        }
        
        $popularExercises = WorkoutDetail::join('workouts', 'workout_details.workout_id', '=', 'workouts.id')
            ->join('exercises', 'workout_details.exercise_id', '=', 'exercises.id')
            ->where('workouts.user_id', $user->id)
            ->selectRaw('exercises.name, COUNT(*) as usage_count')
            ->groupBy('exercises.id', 'exercises.name')
            ->orderBy('usage_count', 'desc')
            ->limit(5)
            ->get();
        
        $recentWorkoutsList = Workout::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->limit(5)
            ->get();
        
        $thisMonth = Carbon::now()->startOfMonth();
        $monthlyStats = WorkoutDetail::join('workouts', 'workout_details.workout_id', '=', 'workouts.id')
            ->where('workouts.user_id', $user->id)
            ->where('workouts.date', '>=', $thisMonth)
            ->selectRaw('COUNT(*) as total_sets, SUM(reps) as total_reps')
            ->first();
        
        $thisWeekWorkouts = Workout::where('user_id', $user->id)
            ->where('date', '>=', Carbon::now()->startOfWeek())
            ->count();
        
        $lastWeekWorkouts = Workout::where('user_id', $user->id)
            ->whereBetween('date', [
                Carbon::now()->subWeek()->startOfWeek(),
                Carbon::now()->subWeek()->endOfWeek()
            ])
            ->count();
        
        return view('dashboard', compact(
            'totalWorkouts',
            'totalExercises', 
            'totalRoutines',
            'recentWorkouts',
            'workoutFrequency',
            'popularExercises',
            'recentWorkoutsList',
            'monthlyStats',
            'thisWeekWorkouts',
            'lastWeekWorkouts'
        ));
    }
}