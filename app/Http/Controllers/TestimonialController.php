<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        // ✅ Return ALL testimonials for admin panel (termasuk hidden)
        // Frontend yang akan filter mana yang visible
        return response()->json([
            'status' => 'success',
            'data' => Testimonial::orderBy('created_at', 'desc')->get()
        ]);
    }

    public function store(Request $request)
    {
        $testimonial = Testimonial::create($request->all());
        return response()->json([
            'status' => 'success',
            'data' => $testimonial
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        
        // ✅ Ensure is_active is handled properly (convert true/false to 1/0)
        $data = $request->all();
        if (isset($data['is_active'])) {
            $data['is_active'] = $data['is_active'] ? 1 : 0;
        }
        
        $testimonial->update($data);
        
        return response()->json([
            'status' => 'success',
            'data' => $testimonial
        ]);
    }

    public function destroy($id)
    {
        Testimonial::findOrFail($id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Testimonial deleted'
        ]);
    }
}