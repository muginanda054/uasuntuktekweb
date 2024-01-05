<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{    
    /**
     * index
     *
     * @param  mixed $request
     * @return void
     */
    public function index(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['These credentials do not match our records.'],
            ])->status(404);
        }
        
            // Check if the user is an admin
            $isAdmin = $user->is_admin ? true : false;

            // Generate token manually or use Sanctum/Passport for token generation
            $token = $isAdmin ? $user->createToken('auth_token', ['admin:update'])->plainTextToken :
                                $user->createToken('auth_token', ['server:update'])->plainTextToken;
    
        
        $response = [
            'success'   => true,
            'user'      => $user,
            'token'     => $token,
            'is_admin'  => $isAdmin
        ];
        
        return response()->json($response, 200);
    }
    
    /**
     * logout
     *
     * @return void
     */
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
