<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AssignWorkout;
use App\Models\Exercise;
use App\Models\Food;
use Illuminate\Support\Facades\Auth;

class WorkoutController extends Controller
{
    public function workout_list()
    {
        $user = Auth::user()->id;
        $lists = AssignWorkout::with('Workouts')->where('user_id' , $user)->get();
        return response()->json(['success' => 'true', 'data' => $lists], 200);
    }

    public function exercise_list()
    {
        $lists = Exercise::get();
        return response()->json(['success' => 'true', 'data' => $lists], 200);
    }

    public function food_list()
    {
        $lists = Food::get();
        return response()->json(['success' => 'true', 'data' => $lists], 200);
    }
}
