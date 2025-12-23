<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
        $images = Image::all()->pluck('data', 'key');
        return response()->json([
            'status' => 'success',
            'data' => $images
        ]);
    }

    public function update(Request $request)
    {
        $image = Image::updateOrCreate(
            ['key' => $request->id],
            ['data' => $request->data]
        );

        return response()->json([
            'status' => 'success',
            'data' => $image
        ]);
    }

    public function destroy($id)
    {
        Image::where('key', $id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Image deleted'
        ]);
    }
}