<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ChMessage;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function subscriptionlist()
    {
        $lists = Subscription::get();
        return response()->json(['success' => 'true', 'data' => $lists], 200);
    }
}
