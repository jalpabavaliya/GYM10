<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AssignMeal;
use App\Models\Meal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MealController extends Controller
{
    public function meallist()
    {
        $lists = Meal::with('mealCat')->with('mealfoods')->get();
        return response()->json(['success' => 'true', 'data' => $lists], 200);
    }

    public function mealdetail($id)
    {
        $meal = Meal::with('mealCat')->with('mealfoods')->where('id', $id)->first();
        return response()->json(['success' => 'true', 'data' => $meal], 200);
    }

    public function mealschedule()
    {

        $auth = Auth::user()->id;
        $list = AssignMeal::with('Meals.mealfoods')->with('Users')->where('user_id', $auth)->get();
        // $list = Meal::with('mealCat')->with(['AssignMeals' => function ($query) use ($auth) {
        //     $query->where('user_id', $auth);
        //  }])->get();
        return response()->json(['success' => 'true', 'data' => $list], 200);
    }

    public function dailymeal()
    {
        $auth = Auth::user()->id;
        $assignmeals = AssignMeal::with('Meals.mealfoods')->with('Users')->where('user_id', $auth)->whereDate('created_at', '=', now()->format('Y-m-d'))->get();
        return response()->json(['success' => 'true', 'data' => $assignmeals], 200);
    }
}
