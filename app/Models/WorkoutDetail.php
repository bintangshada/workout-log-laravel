<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutDetail extends Model
{
    protected $fillable = ['workout_id', 'exercise_id', 'set_number', 'weight_kg', 'reps'];

    public function workout()
    {
        return $this->belongsTo(Workout::class);
    }

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }
}

