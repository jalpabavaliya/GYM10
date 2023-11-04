<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $table = "subscriptions";
    protected $fillable = ['start_date','end_date', 'sub_type', 'amount', 'status'];
}
