<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8',
                'confirm_password' => 'required|same:password'
            ]);
    
            $validatedData['password'] = Hash::make($validatedData['password']); // Using Hash instead of bcrypt
    
            $user = User::create($validatedData);
    
            return response()->json([
                'success' => true,
                'message' => 'Registration successful',
                'data' => [
                    'name' => $user->name,
                    'email' => $user->email,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Registration failed',
                'data' => $e->getMessage()
            ], 500);
        }
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email or password',
                'data' => null
            ], 401);
        }
        
        $isAdmin = $user->is_admin ? true : false;
    
        $token = $isAdmin ? $user->createToken('auth_token', ['admin:update'])->plainTextToken :
                            $user->createToken('auth_token', ['server:update'])->plainTextToken;
    
        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'data' => [
                'token' => $token,
                'name' => $user->name,
                'email' => $user->email,
                'isAdmin' => $isAdmin // Include is_admin flag in response
            ]
        ]);
    }
    
    public function logout()
    {
        try {
            auth()->logout();
        } catch (\Throwable $th) {
            // Handle any potential exceptions if logout fails
        }
        
        return response()->json([
            'success'    => true
        ], 200);
    }
    
}
