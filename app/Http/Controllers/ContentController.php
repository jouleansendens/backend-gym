<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteSetting;
use App\Models\Service;
use App\Models\Pricing;
use App\Models\FAQ;
use App\Models\Testimonial;
use App\Models\Leaderboard;
use App\Models\Message;
use App\Models\Certificate;
use App\Models\Image;

class ContentController extends Controller
{
    /**
     * GET /api/content - Mengambil semua site content (hero, about, coach, dll)
     */
    public function index()
    {
        // Ambil semua site settings dan format jadi key-value pairs
        $settings = SiteSetting::all()->pluck('value', 'key');
        
        // Decode JSON values
        $content = [];
        foreach ($settings as $key => $value) {
            $decoded = json_decode($value, true);
            $content[$key] = is_array($decoded) ? $decoded : $value;
        }
        
        return response()->json([
            'status' => 'success',
            'data' => $content
        ]);
    }

    public function update(Request $request)
    {
        $key = $request->input('key');
        $value = $request->input('value');
        
        // Handle null/empty values - convert to empty string to prevent NULL constraint error
        if ($value === null || $value === '') {
            $finalValue = '';
        } else {
            // Force value to be string if not array
            $finalValue = is_array($value) ? json_encode($value) : (string)$value;
        }

        try {
            // Explicitly check for existence to debug persistence issues
            $setting = SiteSetting::where('key', $key)->first();
            
            if ($setting) {
                $setting->value = $finalValue;
                $setting->save();
            } else {
                SiteSetting::create([
                    'key' => $key,
                    'value' => $finalValue
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Content updated successfully',
                'saved_key' => $key,
                'saved_value' => $finalValue
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to save content: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * POST /api/reset - Reset semua content ke default
     */
    public function reset()
    {
        // Hapus semua data
        SiteSetting::truncate();
        Service::truncate();
        Pricing::truncate();
        FAQ::truncate();
        Testimonial::truncate();
        Leaderboard::truncate();
        Message::truncate();
        Certificate::truncate();
        Image::truncate();

        return response()->json([
            'status' => 'success',
            'message' => 'All content has been reset'
        ]);
    }

    /**
     * GET /api/content/{key} - Untuk backward compatibility dengan Redis version
     */
    public function show($key)
    {
        switch ($key) {
            case 'site_content':
                $data = SiteSetting::where('key', 'site_content')->first();
                return response()->json($data ? json_decode($data->value) : null);
            case 'site_services':
                return response()->json(Service::all());
            case 'site_pricing':
                return response()->json(Pricing::all());
            case 'site_testimonials':
                return response()->json(Testimonial::all());
            case 'site_faqs':
                return response()->json(FAQ::all());
            case 'site_leaderboard':
                return response()->json(Leaderboard::orderBy('steps', 'desc')->get());
            case 'site_messages':
                return response()->json(Message::latest()->get());
            case 'site_certificates':
                return response()->json(Certificate::all());
            case 'site_images':
                $images = Image::all()->pluck('data', 'key');
                return response()->json($images);
            default:
                return response()->json(null);
        }
    }

    /**
     * POST /api/content - Untuk backward compatibility
     */
    public function store(Request $request)
    {
        $key = $request->key;
        $value = $request->value;

        if ($key === 'site_content') {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => json_encode($value)]);
        }

        return response()->json(['status' => 'success', 'driver' => 'mysql']);
    }
}