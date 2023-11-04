<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramWorkout extends Model
{
    use HasFactory;
    protected $table = "program_workouts";
    protected $fillable = ['program_id','workout_id'];


}
