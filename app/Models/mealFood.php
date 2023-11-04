<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mealFood extends Model
{
    use HasFactory;

    protected $table = "meal_foods";
    protected $fillable = ['meal_id','food_id', 'calary', 'serving_type'];

}
