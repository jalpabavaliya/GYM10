<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;
    protected $table = "meals";
    protected $fillable = ['meal_name','meal_categories_id','prep_time','cook_time','tag','contain','image'];

    public function mealCat()
    {
        return $this->hasOne(MealCategories::class, 'id', 'meal_categories_id');
    }

    public function mealfoods()
    {
        return $this->hasMany(mealFood::class, 'meal_id', 'id')->join('foods', 'foods.id', '=', 'meal_foods.food_id');
    }
}
