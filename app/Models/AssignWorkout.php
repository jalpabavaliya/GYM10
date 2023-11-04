<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignWorkout extends Model
{
    use HasFactory;
    protected $table = "assign_workouts";
    protected $fillable = ['workout_id','user_id'];

    public function Workouts()
    {
        return $this->hasOne(WorkOut::class, 'id', 'workout_id');
    }
}
