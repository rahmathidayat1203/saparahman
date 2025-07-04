<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

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

    public function profile(Request $request)
    {
        try {
            $user = $request->user();

            return response()->json([
                'success' => true,
                'message' => "profile get success",
                'data' => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $user = $request->user();
            $user->currentAccessToken()->delete();

            return response()->json([
                'success' => true,
                'message' => 'success logout',
                'data' => null
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

     public function update_foto_profile_base64(Request $request)
    {
        try {
           Log::info('request : '.json_encode($request->all()));
            $validator = Validator::make($request->all(), [
                'foto' => 'required|string', // Expect base64 string
            ]);

            if ($validator->fails()) {
                Log::info('Validation errors: ' . json_encode($validator->errors()));
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors(),
                    'data' => null
                ], 422);
            }

            $user = $request->user();

            // Decode base64 string
            $base64Image = $request->input('foto');
            // Remove data URI prefix if present (e.g., "data:image/jpeg;base64,")
            $base64Image = preg_replace('/^data:image\/\w+;base64,/', '', $base64Image);
            $imageData = base64_decode($base64Image);

            if ($imageData === false) {
                Log::info('Invalid base64 image data');
                return response()->json([
                    'success' => false,
                    'message' => 'Data gambar base64 tidak valid',
                    'data' => null
                ], 422);
            }

            // Hapus foto lama jika ada
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }

            // Generate filename
            $filename = 'profile_' . $user->id . '_' . time() . '.jpg';
            $path = 'profile_photos/' . $filename;

            // Simpan gambar ke storage
            Storage::disk('public')->put($path, $imageData);

            // Update database
            $user->update([
                'foto' => $path
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Foto profil berhasil diupdate',
                'data' => [
                    'foto_url' => asset('storage/' . $path),
                    'foto_path' => $path,
                    'user' => $user->fresh()
                ]
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error uploading base64 photo: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengupload foto',
                'error' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

   

    public function get_profile_photo_url($user)
    {
        if ($user->foto && Storage::disk('public')->exists($user->foto)) {
            return asset('storage/' . $user->foto);
        }
        return asset('images/default-avatar.png');
    }

}
