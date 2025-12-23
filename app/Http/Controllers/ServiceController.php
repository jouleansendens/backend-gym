<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => Service::all()
        ]);
    }

    public function store(Request $request)
    {
        $service = Service::create($request->all());
        return response()->json([
            'status' => 'success',
            'data' => $service
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->update($request->all());
        return response()->json([
            'status' => 'success',
            'data' => $service
        ]);
    }

    public function destroy($id)
    {
        Service::findOrFail($id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Service deleted'
        ]);
    }
}