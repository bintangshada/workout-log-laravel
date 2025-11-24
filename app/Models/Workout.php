<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    protected $fillable = ['user_id', 'title', 'date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function workoutDetails()
    {
        return $this->hasMany(WorkoutDetail::class);
    }
}

