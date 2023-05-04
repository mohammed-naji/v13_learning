<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $token = $request->user()->createToken('login');

            return response()->json([
                'status' => 0,
                'message' => 'User found',
                'data' => [
                    'user' => Auth::user(),
                    'token' => $token->plainTextToken
                ]
            ], 200);

        }else {
            return response()->json([
                'status' => 0,
                'message' => 'User not found',
                'data' => []
            ], 404);
        }
    }
}
