<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealPlan extends Model
{
    use HasFactory;
    protected $table = "meal_plans";
    protected $fillable = ['calary','macro_split','meal_perday','days','meal','food_sensitivity'];
}
