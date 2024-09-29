<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return response()->json(['user' => $user]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $user->update($request->only(['name', 'bio', 'email']));
        
        return response()->json(['user' => $user]);
    }
}
