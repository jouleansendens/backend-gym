<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => FAQ::all()
        ]);
    }

    public function store(Request $request)
    {
        $faq = FAQ::create($request->all());
        return response()->json([
            'status' => 'success',
            'data' => $faq
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $faq = FAQ::findOrFail($id);
        $faq->update($request->all());
        return response()->json([
            'status' => 'success',
            'data' => $faq
        ]);
    }

    public function destroy($id)
    {
        FAQ::findOrFail($id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'FAQ deleted'
        ]);
    }
}