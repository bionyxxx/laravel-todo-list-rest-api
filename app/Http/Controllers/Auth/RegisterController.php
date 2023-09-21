<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'username' => ['required', 'string', 'min:3', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 400,
                'message' => 'Bad Request',
                'errors' => $validator->errors()
            ], 400);
        }

        try {
            \DB::beginTransaction();

            $user = User::create(array_merge(
                $validator->validated(),
                ['password' => bcrypt($request->password)]
            ));

            \DB::commit();

            return response()->json([
                'status_code' => 201,
                'message' => 'User created successfully',
                'data' => [
                    'user' => $user
                ]
            ], 201);
        } catch (\Exception $e) {
            \DB::rollBack();

            return response()->json([
                'status_code' => 500,
                'message' => 'Internal Server Error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }
}
