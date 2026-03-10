<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Tampilkan chat user ↔ admin
     */
    public function index()
    {
        $userId = Auth::id();
        abort_if(!$userId, 403);

        $admin = User::where('role', 'admin')->firstOrFail();

        $messages = Message::where(function ($q) use ($userId, $admin) {
                $q->where('from_id', $userId)
                  ->where('to_id', $admin->id);
            })
            ->orWhere(function ($q) use ($userId, $admin) {
                $q->where('from_id', $admin->id)
                  ->where('to_id', $userId);
            })
            ->orderBy('created_at')
            ->get();

        return view('chat.user', compact('messages', 'admin'));
    }

    /**
     * Kirim pesan (text / image / video / order)
     */
    public function send(Request $request)
{
    $userId = Auth::id();
    $admin = User::where('role', 'admin')->firstOrFail();

    $filePath = null;

    if ($request->hasFile('file')) {
        $filePath = $request->file('file')->store('chat', 'public');
    }

    Message::create([
        'from_id'      => $userId,
        'to_id'        => $admin->id,
        'message'      => $request->message ?? '',
        'file_path'    => $filePath,
        'type'         => $request->type,
        'is_read'      => false,
        'is_delivered' => true,
    ]);

    return back();
}

}
