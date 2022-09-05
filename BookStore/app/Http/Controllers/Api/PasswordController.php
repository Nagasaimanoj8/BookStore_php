<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\sendmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
use Illuminate\Support\Str;

use App\Models\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\support\Facades\Auth;
use app\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PasswordController extends Controller
{
    public function newPassword(Request $request)
    {
        $request->validate([
            
            'email' => 'required',
            'password' =>'required',
            'newPassword' => 'required'
        ]);
        $result = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        if($result){
            User::where('email', $request->email)->update(['password' => $request->newPassword]);
            return response()->json(['message'=>"password updated successfully", 'status'=>200]);
            
        }
        else{
            Log::channel('custom')->error("Check your old password");
            return response()->json(['message'=>"Check your old password", 'status'=>400]);
        }
    }
    public function forgotPassword(Request $request){
        $request->validate([
            'email' => 'required',
        ]);
        $email = $request->email;
        $user = User::where('email', $email)->first();
        if(!$user){
            Log::channel('custom')->debug("Email does not exist");
            return response()->json(['message' => "Email does not exists", 'status' => 404]);
        }
        else{
            
        $token = Str::random(10);
        $reset = new PasswordReset();
    
        $reset->email = $request->input('email');
        $reset->token = $token;
            $reset->save();
        Mail::to($email)->send(new SendMail($token, $email));
        return response()->json(['message'=>"Token sent on mail"]);
        } 
       }

       public function reset(Request $request){
        $request->validate([
            'email' =>'required',
            'password' => 'required',
            'token' => 'required'
        ]);

        $passwordReset = PasswordReset::where('token', $request->token)->first();
        if(!$passwordReset){
            Log::channel('custom')->debug("Token is invalid or expired");
            return response()->json(['message' => "Token is invalid or expired"]);
        }

        $user = DB::table('users')->where('email', $passwordReset->email)->update(['password'=>Hash::make($request->password)]);
        //$user->password = Hash::make($user->password);

        PasswordReset::where('email', $request->email)->delete();
        return "Password changed";
    }
}