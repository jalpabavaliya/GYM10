<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PostureImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator; 
use App\CPU\ImageManager;

class PostureController extends Controller
{
    public function postureImage(Request $request) {

        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'date' => 'required',
        ]);
        
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $data = $request->input();
        $auth = Auth::user()->id;
        $ins = array(
            'user_id' =>  $auth,
            'date' => $data['date'] ? $data['date'] : null, 
        );
        $ins['image'] = ImageManager::upload('modal/', 'png', $request->file('image'));
        PostureImage::create($ins);
        return response()->json(['success' => 'true', 'data' => $ins, 'message' => 'Posture Image Create Successfully...'], 200);
    }
}
