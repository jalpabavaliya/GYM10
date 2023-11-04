<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use App\Models\UserQuestion;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use Illuminate\Support\Facades\DB;
use App\Rules\MatchOldPassword;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseController
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users|email',
            'mobile_no' => 'required|unique:users,mobile_no',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $title = 'Mail from FitWip';
        $body = 'Registration OTP';

        $code = mt_rand(100000, 999999);
        $otp = $code;
        $input = $request->all();
        $input['otp']  = $code;
        $input['password'] = bcrypt($input['password']);

        $sendmail = Mail::to($request->email)->send(new SendMail($title, $body, $otp));
        $user = User::create($input);

        $success['token'] =  $user->createToken('authToken')->plainTextToken;
        $success['name'] =  $user->name;
        return $this->sendResponse($success, 'Registration successfully.');
    }

    public function verifyRegistrationEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'email' => 'required|email|exists:users,email'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $UpdateDetails = User::where('email', '=',  $request->email)->first();
        if ($UpdateDetails->otp == $request->code) {
            return $this->sendResponse(200, 'Verification successfully..');
        } else {
            return $this->sendError('error', "Your Verification code is wrong.");
        }
    }


    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gender' => 'required',
            'date_of_birth' => 'required|date_format:Y-m-d',
            'weight' => 'required',
            'height' => 'required',
            'goal' => 'required',
            'medical_condition' => 'required',
            'activity' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $auth = Auth::user();
        if ($auth) {

            $user = UserQuestion::create([
                'user_id' => $auth->id,
                'gender' => $request->input('gender'),
                'date_of_birth' => $request->input('date_of_birth'),
                'weight' => $request->input('weight'),
                'height' => $request->input('height'),
                'goal' => $request->input('goal'),
                'medical_condition' => $request->input('medical_condition'),
                'activity' => $request->input('activity'),
            ]);

            $users = User::where('id', $auth->id)->first();
            $users->gender = $request->gender;
            $users->date_of_birth = $request->date_of_birth;
            $users->weight = $request->weight;
            $users->height = $request->height;
            $users->goal = $request->goal;
            $users->medical_condition = $request->medical_condition;
            $users->activity = $request->activity;
            $users->save();
            return $this->sendResponse($user, 'Profile successfully.');
        } else {
            return $this->sendError(false, ['error' => 'User credentials does not match']);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('authToken')->plainTextToken;
            $success['name'] =  $user->name;

            $profile = UserQuestion::where('user_id', $user->id)->first();
            if ($profile) {
                $success['profile_status'] = 1;
            } else {
                $success['profile_status'] = 0;
            }
            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError(false, ['error' => 'User credentials does not match']);
        }
    }

    public function resendotp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $title = 'Mail from FitWip';
        $body = 'Registration Resend OTP';
        $code = mt_rand(100000, 999999);
        $otp = $code;
        $input = $request->all();
        $input['otp']  = $code;
        $sendmail = Mail::to($request->email)->send(new SendMail($title, $body, $otp));
        $user = User::where('email', $request->email)->update(array('otp' => $code));
        return $this->sendResponse('success', 'Resend OTP Send successfully.');
    }

    public function forgotpwd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $code = mt_rand(100000, 999999);

        $title = 'Mail from FitWip';
        $body = 'Forgot Password OTP';
        $otp = $code;
        $UpdateDetails = User::where('email', '=',  $request->email)->first();
        $UpdateDetails->verification_code = $code;
        $UpdateDetails->save();

        $sendmail = Mail::to($request->email)->send(new SendMail($title, $body, $otp));

        if (empty($sendmail)) {
            return response()->json(['message' => 'Mail Sent fail'], 400);
        } else {
            return response()->json(['message' => 'Mail Sent Sucssfully'], 200);
        }
    }

    public function resetPwd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'c_password' => 'required|same:password',
            'email' => 'required|email|exists:users,email'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $password = bcrypt($request->password);
        $UpdateDetails = User::where('email', '=',  $request->email)->first();
        $UpdateDetails->password = $password;
        $UpdateDetails->save();
        return $this->sendResponse(200, 'Password Reset Successfully..');
    }



    public function changePwd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
        return $this->sendResponse(200, 'Password Change Successfully..');
    }

    public function verificationEmailCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'email' => 'required|email|exists:users,email'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $UpdateDetails = User::where('email', '=',  $request->email)->first();
        if ($UpdateDetails->verification_code == $request->code) {
            return $this->sendResponse(200, 'Your Code Verification Successfully..');
        } else {
            return $this->sendError('error', "Your Verification code is wrong.");
        }
    }
    public function unAuthorized()
    {
        return $this->sendError('UnAuthorized.');
    }

    public function logout()
    {
        $user = request()->user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
        return $this->sendResponse(200, 'User Logged Out.');
    }

    public function heartRate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'heart_rate' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $list = DB::table('users')
            ->where('id', Auth::user()->id)
            ->update(['heart_rate' => $request->heart_rate]);

        // $list = User::where('id', '=', Auth::user()->id)->update(['heart_rate', $request->heart_rate]);
        return $this->sendResponse(200, 'Heart Rate Successfully.....');
    }

    public function signinWithGoogle(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'token' => ['required'],
        ]);

        if ($validator->fails()) {
            $response = array();
            $response['status'] = 0;
            $response['msg'] = "The request could not be understood by the server due to malformed syntax";
            $response['statuscode'] = 400;
            $response['data'] = $validator->errors();
        } else {
            $command = 'https://oauth2.googleapis.com/tokeninfo?id_token=' . $request->token;
            $ch = curl_init($command);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $content = curl_exec($ch);
            curl_close($ch);
            $content = json_decode($content, true);
            if (isset($content['error']) && $content['error'] != "") {
                $response = array();
                $response['status'] = 0;
                $response['msg'] = "Invalid oauth2 from Google";
                $response['statuscode'] = 401;
                return response()->json($response)->header('Content-Type', 'application/json');
            } else {
                $social_id = $content['sub'];
                $email = $content['email'];
                $full_name = explode(' ', $content['name']);
                $name = $full_name[0];
                $surname = $full_name[1];
                if (count($full_name) > 2) {
                    $name = $full_name[0];
                    $surname = $full_name[2];
                }
                $user = User::where('social_id', $social_id)->first();
                if ($user) {
                    Auth::loginUsingId($user->id);
                    $user = $request->user();
                    $tokenResult = $user->createToken('authToken')->plainTextToken;
                    $access_token = $tokenResult;
                    $response = array();
                    $response['status'] = 1;
                    $response['statuscode'] = 201;
                    $response['msg'] = "Successfully login with social";
                    $response['user'] = $user;
                    $response['token_type'] = 'Bearer';
                    $response['access_token'] = $access_token;
                    $profile = UserQuestion::where('user_id', $user->id)->first();
                    if ($profile) {
                        $response['profile_status'] = 1;
                    } else {
                        $response['profile_status'] = 0;
                    }
                } else {
                    $user = User::where('email', $email)->first();
                    if ($user) {
                        $response = array();
                        $response['status'] = 0;
                        $response['msg'] = "This email is already in use";
                        $response['statuscode'] = 401;
                        return response()->json($response)->header('Content-Type', 'application/json');
                    }
                    $user = new User();
                    // $user->social_type = 1;
                    $user->social_id = $social_id;
                    $user->name = $name;
                    $user->last_name = $surname;
                    $user->email = $email;
                    $user->save();
                    Auth::loginUsingId($user->id);
                    $user = $request->user();
                    $tokenResult = $user->createToken('authToken')->plainTextToken;
                    $access_token = $tokenResult;
                    $response = array();
                    $response['status'] = 1;
                    $response['statuscode'] = 201;
                    $response['msg'] = "Successfully login with social";
                    $response['user'] = $user;
                    $response['token_type'] = 'Bearer';
                    $response['access_token'] = $access_token;
                    $profile = UserQuestion::where('user_id', $user->id)->first();
                    if ($profile) {
                        $response['profile_status'] = 1;
                    } else {
                        $response['profile_status'] = 0;
                    }
                }
            }
        }
        return response()->json($response)->header('Content-Type', 'application/json');
    }

    public function showProfile()
    {
        $user = User::where('id', Auth::id())->first();
        if ($user->date_of_birth != null) {
            $user->age = Carbon::parse($user->date_of_birth)->age;
        }
        return $this->sendResponse(200, $user);
    }

    public function update_Profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile_no' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $user = User::where('id', Auth::id())->first();
        $user->name = isset($request->first_name) ? $request->first_name : $user->name;
        $user->last_name = isset($request->last_name) ? $request->last_name : $user->last_name;
        $user->mobile_no = isset($request->mobile_no) ? $request->mobile_no : $user->mobile_no;
        $user->save();
        return $this->sendResponse(200, 'Profile Updated Successfully. ');
    }

    public function profile_delete($id)
    {
        DB::table("users")->where('id', $id)->delete();
        return $this->sendResponse(200, 'Account Deleted Successfully.........');
    }

    public function dashboard()
    {
        $user = Auth::user();
        $user->heart_rate = null;
        $user->fat = null;
        $user->foot_step = null;
        return $this->sendResponse($user, 'Dashboard list .........');
    }
}
