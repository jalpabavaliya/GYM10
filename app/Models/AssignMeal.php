<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignMeal extends Model
{
    use HasFactory;
    protected $table = "assign_meals";
    protected $fillable = ['meal_id', 'user_id'];

    public function Meals()
    {
        return $this->hasOne(Meal::class, 'id', 'meal_id');
    }

    public function Users()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
