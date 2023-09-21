<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 400,
                'message' => 'Bad Request',
                'errors' => $validator->errors()
            ], 400);
        }

        if (!\Auth::attempt($validator->validated())) {
            return response()->json([
                'status_code' => 401,
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = \Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status_code' => 200,
            'message' => 'Login successfully',
            'data' => [
                'user' => $user,
                'token' => $token
            ]
        ]);
    }
}
