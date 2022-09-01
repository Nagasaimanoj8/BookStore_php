<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class UserContoller extends Controller
{
    public $successToken = 200;
    public function register(Request $request)
    {
        $userData=User::where('email',$request->email)->first();
        if($userData){
            Log::channel('custom')->debug("the email has already registered");
        }
        $user=User::create([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'role'=>$request->role,
            'email'=>$request->email,
            'phone_no'=>$request->phone_no,
            'password'=>bcrypt($request->password)
        ]);
        $token=$user->createToken('Token')->plainTextToken;
        return response()->json(['token'=>$token,'user'=>$user]);
    }
    public function login(Request $request){
        $result = Auth::attempt(['email'=> $request->email, 'password' => $request ->password]);
        if($result){
            $user = new User();
            $success['token'] = $user->createToken('Token')->plainTextToken;
            return response()->json(['success'=>$success], $this->successToken);
        }
        else{
            Log::channel('custom')->error("You entered wrong password");
            return response()->json(['error'=>'Unauthorised'], 401);
        }        
    }

}
