<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOut extends Model
{
    use HasFactory;
    protected $fillable = ['name','workout_type','total_exercise','est_time'];
}
