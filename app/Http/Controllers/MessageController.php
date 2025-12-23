<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => Message::latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        $message = Message::create([
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'email' => $request->email,
            'phone' => $request->phone,
            'goal' => $request->goal,
            'message' => $request->message,
            'is_read' => false
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $message
        ], 201);
    }

    public function destroy($id)
    {
        Message::findOrFail($id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Message deleted'
        ]);
    }

    public function markAsRead($id)
    {
        $message = Message::findOrFail($id);
        $message->update(['is_read' => true]);
        return response()->json([
            'status' => 'success',
            'data' => $message
        ]);
    }
}