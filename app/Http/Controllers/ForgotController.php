<?php

namespace App\Http\Controllers;

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
use Illuminate\Support\Facades\Hash;

class ForgotController extends Controller
{
    public function password()
    {
        return view('forgotpassword.index');
    }

    public function forgot(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users,email'
        ]);

        $code = mt_rand(100000, 999999);
        $title = 'Mail from FitWip';
        $body = 'Forgot Password OTP';
        $otp = $code;

        $email = $request->email;
        $UpdateDetails = User::where('email', '=',  $request->email)->first();
        $UpdateDetails->otp = $code;
        $UpdateDetails->save();

        $sendmail = Mail::to($request->email)->send(new SendMail($title, $body, $otp));
        $errors = '';
        return view('forgotpassword.otp', compact('email','errors'));
    }

    public function create() {
        return view('forgotpassword.password');
    }

    public function otpsend(Request $request)
    {
        $this->validate($request, [
            'otp' => 'required',
        ]);
        $email = $request->email;
        $users = User::where('email', $request->email)->first();
        if ($users->otp == $request->otp) {
            return view('forgotpassword.password',compact('email'));
        }else{
            $errors = "OTP in Invalid.";
            return view('forgotpassword.otp', compact('email','errors'));
        }
    }

    public function storepassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($request->password == $request->c_password) {
            $users = User::where('email', $request->email)->first();
            $users->password = bcrypt($request->password);
            $users->save();
            return view('auth.login');
        }
        else {
            $errors = "Password and Confirm Password does not match.";
            return view('forgotpassword.password', compact('errors'));
            // return redirect()->back()->with('errors', 'The Message');
        }
    }
}
