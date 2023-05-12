<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            # code...
            return response()->json($validator->errors(), 401);
        }

        if (!$token = auth()->attempt($validator->validate())) {
            return response()->json([
                'code_status' => '401',
                'msg_status' => 'Unauthorized user'
            ], 401);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        auth()->user()->update([
            'status' => '1'
        ]);
        return response()->json([
            'code_status' => 200,
            'msg_status' => "Login was successfully",
            'data' => [
                'token' => $token,
                'user' => auth()->user()
            ]
        ]);
    }
}
