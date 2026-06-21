<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminChatController extends Controller
{
    /**
     * LIST USER YANG PERNAH CHAT DENGAN ADMIN
     */
   public function index()
{
    $adminId = Auth::id();

    $users = User::where('id', '!=', $adminId)
        ->where(function ($q) use ($adminId) {
            $q->whereHas('sentMessages', fn ($qq) => $qq->where('to_id', $adminId))
              ->orWhereHas('receivedMessages', fn ($qq) => $qq->where('from_id', $adminId));
        })
        ->withCount([
            'sentMessages as unread_count' => function ($q) use ($adminId) {
                $q->where('to_id', $adminId)
                  ->where('is_read', false);
            }
        ])
        ->get();

    return view('admin.chat.index', compact('users'));
}


    /**
     * DETAIL CHAT ADMIN DENGAN 1 USER
     */
    public function show(User $user)
{
    $adminId = Auth::id();

    $messages = Message::with('sender')
        ->where(function ($q) use ($user, $adminId) {
            $q->where('from_id', $adminId)
              ->where('to_id', $user->id);
        })
        ->orWhere(function ($q) use ($user, $adminId) {
            $q->where('from_id', $user->id)
              ->where('to_id', $adminId);
        })
        ->orderBy('created_at')
        ->get();

    // 🔔 Tandai pesan user sebagai dibaca
    Message::where('from_id', $user->id)
        ->where('to_id', $adminId)
        ->where('is_read', false)
        ->update(['is_read' => true]);

    return view('admin.chat.show', compact('user', 'messages'));
}

    /**
     * ADMIN KIRIM PESAN
     */
    public function send(Request $request, User $user)
    {
        $request->validate([
            'message' => 'nullable|string',
            'file'    => 'nullable|file|max:20480'
        ]);

        $data = [
            'from_id' => Auth::id(),
            'to_id'   => $user->id,
            'type'    => 'text',
            'is_read' => false
        ];

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('chat', 'public');

            $data['file_path'] = $path;
            $data['type'] = $this->getFileType($request->file('file'));
        } else {
            $data['message'] = $request->message;
        }

        Message::create($data);

        return back();
    }

    /**
     * DETEKSI JENIS FILE
     */
    private function getFileType($file)
    {
        $mime = $file->getMimeType();

        return match (true) {
            str_starts_with($mime, 'image/') => 'image',
            str_starts_with($mime, 'video/') => 'video',
            default => 'document'
        };
    }

}
