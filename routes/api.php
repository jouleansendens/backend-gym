<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

Route::get('/fix-sanctum-table', function () {
    if (!Schema::hasTable('personal_access_tokens')) {
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();
            $table->morphs('tokenable');
            $table->string('name');
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
        return "Tabel personal_access_tokens berhasil dibuat!";
    }
    return "Tabel sudah ada.";
});

/*
|--------------------------------------------------------------------------
| API Routes - FITCOACH Backend
|--------------------------------------------------------------------------
*/

// --- 1. PUBLIC ROUTES (Dapat diakses Frontend tanpa Login) ---

// Authentication
Route::post('/login', [AuthController::class, 'login']);

// Landing Page Content
Route::get('/content', [ContentController::class, 'index']);
Route::get('/content/{key}', [ContentController::class, 'show']);

// Public Data (Untuk ditampilkan di Website)
Route::get('/services', [ServiceController::class, 'index']);
Route::get('/pricing', [PricingController::class, 'index']);
Route::get('/faqs', [FaqController::class, 'index']);
Route::get('/testimonials', [TestimonialController::class, 'index']);
Route::get('/leaderboard', [LeaderboardController::class, 'index']);
Route::get('/certificates', [CertificateController::class, 'index']);

// Submit Contact Form
Route::post('/messages', [MessageController::class, 'store']);


// --- 2. PROTECTED ROUTES (Hanya Admin - Memerlukan Token) ---

Route::middleware('auth:sanctum')->group(function () {
    
    // Auth Check (Digunakan oleh AuthContext.tsx di React)
    Route::get('/check-auth', function (Request $request) {
        return response()->json(['authenticated' => true, 'user' => $request->user()]);
    });

    // Dashboard Statistics
    Route::get('/admin/dashboard-stats', [DashboardController::class, 'getStats']);

    // Admin Profile Management
    Route::put('/admin/update-profile', [AuthController::class, 'updateProfile']);

    // Site Content Management (Edit Landing Page)
    Route::put('/content', [ContentController::class, 'update']);
    Route::post('/content', [ContentController::class, 'store']);
    Route::post('/reset', [ContentController::class, 'reset']);

    // Admin Resource CRUD (Create, Update, Delete)
    Route::apiResource('services', ServiceController::class)->except(['index']);
    Route::apiResource('pricing', PricingController::class)->except(['index']);
    Route::apiResource('faqs', FaqController::class)->except(['index']);
    Route::apiResource('testimonials', TestimonialController::class)->except(['index']);
    Route::apiResource('leaderboard', LeaderboardController::class)->except(['index']);
    Route::apiResource('messages', MessageController::class)->except(['index', 'store']);
    Route::apiResource('certificates', CertificateController::class)->except(['index']);

    // Inbox Management
    Route::get('/messages', [MessageController::class, 'index']);
    Route::put('/messages/{id}/read', [MessageController::class, 'markAsRead']);

    // Image & Gallery Management
    Route::get('/images', [ImageController::class, 'index']);
    Route::put('/images', [ImageController::class, 'update']);
    Route::delete('/images/{id}', [ImageController::class, 'destroy']);
});