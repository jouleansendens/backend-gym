<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Leaderboard;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getStats()
    {
        return response()->json([
            'stats' => [
                'total_messages' => Message::count(),
                'unread_messages' => Message::where('is_read', false)->count(),
                'total_services' => Service::count(),
                'total_testimonials' => Testimonial::count(),
                'active_members' => Leaderboard::count(), // Menggunakan data leaderboard sebagai representasi member aktif
            ],
            'recent_messages' => Message::latest()->take(5)->get(),
            'top_leaderboard' => Leaderboard::orderBy('steps', 'desc')->take(5)->get()
        ]);
    }
}