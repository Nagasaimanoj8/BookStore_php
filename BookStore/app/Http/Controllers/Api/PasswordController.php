<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
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
}
