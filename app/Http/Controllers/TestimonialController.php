<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => Testimonial::where('is_active', true)->get()
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
        $testimonial->update($request->all());
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