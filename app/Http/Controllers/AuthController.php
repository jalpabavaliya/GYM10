<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;


class AuthController extends Controller
{

    public function social_login(Request $request) {
        $idToken = $request->input('idToken');

        $user = Socialite::driver('google')->userFromToken($idToken);

        $accessToken = $user->createToken('MyApp')->accessToken;

        return response()->json(['access_token' => $accessToken]);
    }

   /*  public function social_login(Request $request)
    {
        $isEmail = User::where(['email' => $request->email])->first();

        if ($isEmail) {

            $checkEmailSocialid = User::where(['email' => $request->email, 'social_id' => $request->social_id])->first();

            if ($checkEmailSocialid) {
                $user = Auth::loginUsingId($checkEmailSocialid->id);
                $success['token'] =  $user->createToken('MyApp')->accessToken;
                // return $this->sendResponse($success, 'User login successfully.');
                return response()->json(['success' => 'true', 'data' => $success, 'message' => 'User login successfully.'], 200);
            }
            return response()->json(['error' => 'Email is already exits'], 400);
            // return $this->sendError('Unauthorised.', ['error' => 'Email is already exits']);
        } else {

            $social_id = $request->social_id;
            $isUser = User::where(['social_id' => $social_id])->first();

            if ($isUser) {

                $user = Auth::loginUsingId($isUser->id);
                $success['token'] =  $user->createToken('MyApp')->accessToken;
                return response()->json(['success' => 'true', 'data' => $success, 'message' => 'User login successfully.'], 200);

                // return $this->sendResponse($success, 'User login successfully.');
            } else {

                $createUser = User::create([
                    'email' => $request->email,
                    'password' => Hash::make('password'),
                    'social_id' => $request->social_id,
                    'provider' => $request->provider
                ]);

                $loginUsingId = User::where(['id' => $createUser->id])->first();
                $user = Auth::loginUsingId($loginUsingId->id);
                $success['token'] =  $user->createToken('MyApp')->accessToken;
                return response()->json(['success' => 'true', 'data' => $success, 'message' => 'User login successfully.'], 200);
            }
        }
    } */
}
