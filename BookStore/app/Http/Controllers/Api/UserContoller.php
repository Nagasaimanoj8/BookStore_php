<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


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
        return response()->json(['user'=>$user]);
    }
    /**
 * @OA\Post(
 * path="/login",
 * summary="Sign in",
 * description="Login by email, password",
 * operationId="authLogin",
 * tags={"auth"},
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *       required={"email","password"},
 *       @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
 *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
 *       @OA\Property(property="persistent", type="boolean", example="true"),
 *    ),
 * ),
 * @OA\Response(
 *    response=422,
 *    description="Wrong credentials response",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
 *        )
 *     )
 * )
 */
    public function login(Request $request)
    {
        $data = $request-> validate([
            
            'email' => 'required|email|max:100|',
            'password' => 'required|string',
        ]);

        $user = User::where('email',$data['email'])->first();

        if(!$user || !Hash::check($data['password'], $user->password))
        {
            Log::channel('custom')->debug(" login invalid");
            return response(['message' => 'Invalid Credentials'], 401);
        }
        else
        {
            $token = $user->createToken('Login')->plainTextToken;
            $response = [
                'user' => $user,
                'token' => $token,
            ];
            
            return response($response, 200);
        }
    }
}
