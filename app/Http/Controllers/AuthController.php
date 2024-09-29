<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\UserCreateRequest;
use App\Models\User;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(UserCreateRequest $request)
    {
   
        // Create user 
        $userData = $request->only(['name', 'bio', 'email', 'phone']);
        
       
        // $otp = rand(100000, 999999);
        
       
        // Redis::setex('otp:' . $request->phone, 300, $otp);
        
       
        // Log::info('OTP for ' . $request->phone . ' is: ' . $otp);

         User::create($userData);
        return response()->json(['message' => 'OTP sent to your phone number.'], 200);
    }


    public function login(LoginRequest $request)
    {
        // $request->validate([
        //     'phone' => 'required|string',
        //     'otp' => 'required|numeric',
        // ]);

        // Retrieve OTP from Redis
        // $storedOtp = Redis::get('otp:' . $request->phone);

        // if (!$storedOtp || $storedOtp != $request->otp) {
        //     return response()->json(['message' => 'Invalid OTP.'], 401);
        // }

        // Find or create the user
        $user = User::where('phone', $request->phone)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }
    
        $token = $user->createToken('AccessToken')->accessToken;

        return response()->json(['access_token' => $token], 200);
    }
}
