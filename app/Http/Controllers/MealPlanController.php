<?php

namespace App\Http\Controllers;

use App\Models\MealPlan;
use Illuminate\Http\Request;

class MealPlanController extends Controller
{
    public function index()
    {
        $mealplans = MealPlan::get();
        return view('mealPlan.index', compact('mealplans'));
    }

    public function create()
    {
        return view('mealPlan.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'calary' => 'required|numeric',
        ]);
        $data = $request->input();
        $ins = array(
            'calary' => $data['calary'] ? $data['calary'] : '0',
            'macro_split' => $data['macro_split'] ? $data['macro_split'] : null,
            'meal_perday' => $data['meal_perday'] ? $data['meal_perday'] : null,
            'days' => $data['days'] ? $data['days'] : null,
            'meal' => $data['days'] ? $data['days'] : null,
            'food_sensitivity' => $data['sensitivity'] ? implode(",", $data['sensitivity']) : '0',
        );
        MealPlan::create($ins);
        return redirect()->route('mealPlan.index')
            ->with('success', 'Meal Plan created successfully');
    }

    public function edit()
    {
        dd("fdk");
    }
}
