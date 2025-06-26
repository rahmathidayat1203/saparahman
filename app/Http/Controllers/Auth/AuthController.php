<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'no_wa' => 'required|string',
            'password' => 'required|string',
        ]);

        // Coba login
        if (Auth::attempt(['no_wa' => $credentials['no_wa'], 'password' => $credentials['password']])) {
            $user = Auth::user();

            // Buat token
            $token = $user->createToken('api_token')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Login berhasil',
                'data' => $token,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No WA atau password salah'
            ], 401);
        }
    }

    public function profile(Request $request){
        try {
            $user = $request->user();

            return response()->json([
                'success' => true,
                'message' => "profile get success",
                'data' => $user
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ],500);
        }
    }
    
    public function logout(Request $request){
        try {
            $user = $request->user();
            $user->currentAccessToken()->delete();

            return response()->json([
                'success' => true,
                'message' => 'success logout',
                'data' => null
            ],200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ],500);
        }
    }
}
