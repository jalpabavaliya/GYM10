<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQuestion extends Model
{
    use HasFactory;
    public $table = 'user_questions';
    protected $fillable = ['user_id','gender','date_of_birth','weight','height','goal', 'medical_condition', 'activity'];
}
