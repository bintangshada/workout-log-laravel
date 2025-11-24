<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = ['name', 'description'];

    public function routines()
    {
        return $this->belongsToMany(Routine::class, 'routine_exercises');
    }

    public function workoutDetails()
    {
        return $this->hasMany(WorkoutDetail::class);
    }
}