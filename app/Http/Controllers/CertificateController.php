<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => Certificate::all()
        ]);
    }

    public function store(Request $request)
    {
        $certificate = Certificate::create($request->all());
        return response()->json([
            'status' => 'success',
            'data' => $certificate
        ], 201);
    }

    public function destroy($id)
    {
        Certificate::findOrFail($id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Certificate deleted'
        ]);
    }
}