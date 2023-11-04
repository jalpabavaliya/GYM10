<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostureImage extends Model
{
    use HasFactory;
    protected $table = "posture_images";
    protected $fillable = ['user_id','image', 'date'];
}
