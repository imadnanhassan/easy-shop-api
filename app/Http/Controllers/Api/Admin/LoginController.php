<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {

            $admin = Auth::guard('admin')->user();

            $token = $admin->createToken('admins')->plainTextToken;
            return response()->json([
                'token' => $token,
                'admin' => $admin,
                'message' => 'Login Successful',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Email or Password is Invalid',
            ], 401);
        }
    }
}
