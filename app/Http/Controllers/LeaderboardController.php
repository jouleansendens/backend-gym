<?php

namespace App\Http\Controllers;

use App\Models\Leaderboard;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => Leaderboard::orderBy('steps', 'desc')->get()
        ]);
    }

    public function store(Request $request)
    {
        $entry = Leaderboard::create($request->all());
        return response()->json([
            'status' => 'success',
            'data' => $entry
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $entry = Leaderboard::findOrFail($id);
        $entry->update($request->all());
        return response()->json([
            'status' => 'success',
            'data' => $entry
        ]);
    }

    public function destroy($id)
    {
        Leaderboard::findOrFail($id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Leaderboard entry deleted'
        ]);
    }
}