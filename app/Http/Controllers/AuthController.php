<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Update Admin Profile (Username & Password)
     */
    public function updateProfile(Request $request)
    {
        // Mendapatkan data user yang sedang login
        $user = Auth::user();

        // 1. Validasi input dari Frontend
        $request->validate([
            'currentPassword' => 'required',
            'username' => 'nullable|string|min:3|unique:users,name,' . $user->id,
            'newPassword' => 'nullable|string|min:8',
        ]);

        // 2. Verifikasi: Apakah password lama yang dimasukkan benar?
        if (!Hash::check($request->currentPassword, $user->password)) {
            return response()->json([
                'message' => 'The current password you entered is incorrect.'
            ], 401);
        }

        // 3. Proses Update Username jika diisi
        if ($request->filled('username')) {
            $user->name = $request->username;
        }

        // 4. Proses Update Password jika diisi
        if ($request->filled('newPassword')) {
            $user->password = Hash::make($request->newPassword);
        }

        $user->save();

        return response()->json([
            'message' => 'Profile updated successfully!'
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek kredensial di tabel users
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        // Buat token asli dari Sanctum
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
}