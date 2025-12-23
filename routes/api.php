<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\Admin\DashboardController;

// Content Management
Route::get('/content', [ContentController::class, 'index']);
Route::put('/content', [ContentController::class, 'update']);
Route::post('/content', [ContentController::class, 'store']); // Backward compatibility
Route::get('/content/{key}', [ContentController::class, 'show']); // Backward compatibility
Route::post('/reset', [ContentController::class, 'reset']);

// Resource Controllers
Route::apiResource('services', ServiceController::class);
Route::apiResource('pricing', PricingController::class);
Route::apiResource('faqs', FaqController::class);
Route::apiResource('testimonials', TestimonialController::class);
Route::apiResource('leaderboard', LeaderboardController::class);
Route::apiResource('messages', MessageController::class);
Route::apiResource('certificates', CertificateController::class);

// Message specific routes
Route::put('/messages/{id}/read', [MessageController::class, 'markAsRead']);

// Image routes
Route::get('/images', [ImageController::class, 'index']);
Route::put('/images', [ImageController::class, 'update']);
Route::delete('/images/{id}', [ImageController::class, 'destroy']);

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = User::where('email', $credentials['email'])->first();

    if (!$user || !Hash::check($credentials['password'], $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    return response()->json([
        'status' => 'success',
        'user' => $user
    ]);
});

Route::put('/admin/update-profile', function (Request $request) {
    $validated = $request->validate([
        'name' => 'sometimes|string|max:255',
        'email' => 'sometimes|email|unique:users,email,' . ($request->user_id ?? 1),
        'current_password' => 'required_with:new_password|string',
        'new_password' => 'sometimes|string|min:8|confirmed',
    ]);

    // Ambil user (sesuaikan dengan auth system Anda)
    $user = User::find($request->user_id ?? 1);

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    // Verify current password jika ada new_password
    if ($request->filled('new_password')) {
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'message' => 'Current password is incorrect'
            ], 422);
        }
        $user->password = Hash::make($request->new_password);
    }

    // Update name dan email jika ada
    if ($request->filled('name')) {
        $user->name = $request->name;
    }
    if ($request->filled('email')) {
        $user->email = $request->email;
    }

    $user->save();

    return response()->json([
        'status' => 'success',
        'message' => 'Profile updated successfully',
        'user' => $user
    ]);
});

Route::post('/login', [AdminController::class, 'login']);
Route::put('/admin/update-profile', [AdminController::class, 'updateProfile']);
Route::middleware('auth:sanctum')->get('/admin/dashboard-stats', [DashboardController::class, 'getStats']);