<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ChatController extends Controller
{
    // Untuk User: Ambil pesan
    public function getMessages() {
        $sessionId = Session::getId();
        $messages = DB::table('messages')
            ->where('session_id', $sessionId)
            ->orderBy('created_at', 'asc')
            ->get();
        return response()->json($messages);
    }

    // Untuk User: Kirim pesan
    public function sendMessage(Request $request) {
        DB::table('messages')->insert([
            'session_id' => Session::getId(),
            'sender_type' => 'user',
            'message' => $request->message,
            'created_at' => now()
        ]);
        return response()->json(['status' => 'success']);
    }

    public function adminIndex() {
    $chats = DB::table('messages')
        ->select('session_id', DB::raw('max(created_at) as last_chat'))
        ->groupBy('session_id')
        ->orderBy('last_chat', 'desc')
        ->get();

    // Menggunakan titik (.) untuk masuk ke folder admin
    return view('admin.messages-index', compact('chats'));
}

    // Untuk Admin: Balas Pesan
    public function adminReply(Request $request) {
        DB::table('messages')->insert([
            'session_id' => $request->session_id,
            'sender_type' => 'admin',
            'message' => $request->message,
            'created_at' => now()
        ]);
        return back();
    }
}
