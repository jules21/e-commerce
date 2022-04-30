<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' =>'required|email|unique:users',
            'password' =>'required|confirmed|min:6'
        ]);
     //create user
        $user = User::create([
           'name' => $request->name,
           'email' => $request->email,
           'password' => Hash::make($request->password),
        ]);
//        create default account for new user
        Account::create([
            'user_id'=>$user->id,
            'account_number'=>'21212-262212-' . rand(1,5000),
        ]);

        auth()->login($user);

        $token = $user->createToken('appToken')->plainTextToken;

        return response()->json([
            'user' =>$user,
            'token' =>$token
        ], Response::HTTP_OK);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' =>'required|email',
            'password' =>'required'
        ]);

//        check if user exists
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password))
        {
            return response()->json([
                'error' => 'Credentials does not match our records!',
            ], Response::HTTP_UNAUTHORIZED);
        }

        auth()->login($user);

        $token = $user->createToken('appToken')->plainTextToken;

        return response()->json([
            'user' =>$user,
            'token' =>$token
        ], Response::HTTP_OK);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return \response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
