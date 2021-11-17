<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function sign_up(Request $request)
    {

        $request->validate([
            'email' => 'required|unique:users',
            'name' => 'required',
            'password' => 'required',
        ]);
        
        $user = User::create($request->all());

        $user->createToken('auth_token')->plainTextToken;
        $device = $request->header('User-Agent');
        $token = $user->createToken($device);
        
        return response()->json(['token' => $token->plainTextToken]);
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $device = $request->header('User-Agent');
            $token = $user->createToken($device);

        } else {
            return response()->json([
                'message' => 'Incorrect credentials'
            ], 401);
        }
        
        return response()->json(['token' => $token->plainTextToken]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();    
    }
}
