<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserChatController extends Controller
{
    private function adminId()
    {
        return User::where('role', 'admin')->value('id');
    }

    public function index()
    {
        $userId  = Auth::id();
        $adminId = $this->adminId();

        $messages = Message::where(function ($q) use ($userId, $adminId) {
                $q->where('from_id', $userId)
                  ->where('to_id', $adminId);
            })
            ->orWhere(function ($q) use ($userId, $adminId) {
                $q->where('from_id', $adminId)
                  ->where('to_id', $userId);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        // tandai pesan admin → user sebagai read
        Message::where('from_id', $adminId)
            ->where('to_id', $userId)
            ->update([
                'is_delivered' => 1,
                'is_read'      => 1
            ]);

        return view('member.chat', compact('messages'));
    }

    public function fetch()
    {
        $userId  = Auth::id();
        $adminId = $this->adminId();

        $messages = Message::where(function ($q) use ($userId, $adminId) {
                $q->where('from_id', $userId)
                  ->where('to_id', $adminId);
            })
            ->orWhere(function ($q) use ($userId, $adminId) {
                $q->where('from_id', $adminId)
                  ->where('to_id', $userId);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        // update read status
        Message::where('from_id', $adminId)
            ->where('to_id', $userId)
            ->update([
                'is_delivered' => 1,
                'is_read'      => 1
            ]);

        return response()->json($messages);
    }

    public function send(Request $request)
{
    $request->validate([
        'message' => 'nullable|string',
        'file'    => 'nullable|file|max:20480',
    ]);

    $adminId = $this->adminId();

    $data = [
        'from_id'      => Auth::id(),
        'to_id'        => $adminId,
        'message'      => $request->message,
        'type'         => 'text',
        'is_read'      => 0,
        'is_delivered' => 0,
    ];

    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $path = $file->store('chat', 'public');
        $mime = $file->getMimeType();

        $data['file_path'] = $path;
        $data['type'] = str_starts_with($mime, 'image/')
            ? 'image'
            : (str_starts_with($mime, 'video/') ? 'video' : 'document');

        if (empty($data['message'])) {
            $data['message'] = null;
        }
    }

    $message = Message::create($data);

    // ✅ AJAX → return JSON
    if ($request->expectsJson()) {
        return response()->json($message);
    }

    // ✅ Submit biasa → redirect (TIDAK tampil JSON)
    return redirect()->route('member.chat');
}
}
