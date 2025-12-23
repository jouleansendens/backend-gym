<?php

namespace App\Http\Controllers;

use App\Models\Pricing;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => Pricing::all()
        ]);
    }

    public function store(Request $request)
    {
        $pricing = Pricing::create($request->all());
        return response()->json([
            'status' => 'success',
            'data' => $pricing
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $pricing = Pricing::findOrFail($id);
        $pricing->update($request->all());
        return response()->json([
            'status' => 'success',
            'data' => $pricing
        ]);
    }

    public function destroy($id)
    {
        Pricing::findOrFail($id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Pricing deleted'
        ]);
    }
}