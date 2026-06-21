<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArtworkChatController extends Controller
{
    /**
     * 🔐 VALIDASI AKSES CHAT
     */
    private function authorizeChat(Artwork $artwork)
    {
        $user = Auth::user();

        // MEMBER → hanya artwork miliknya
        if ($user->role === 'member') {
            if (
                !$user->member ||
                $artwork->member_id !== $user->member->id
            ) {
                abort(403);
            }
            return;
        }

        // TIM → hanya artwork yang ditugaskan
        if ($user->role === 'tim') {
            if ($artwork->team_id !== $user->id) {
                abort(403);
            }
            return;
        }

        abort(403);
    }

    /**
     * 💬 HALAMAN CHAT
     */
    public function index(Artwork $artwork)
    {
        $this->authorizeChat($artwork);

        $messages = Message::where('artwork_id', $artwork->id)
            ->orderBy('created_at')
            ->get();

        return view('chat.artwork', compact('artwork', 'messages'));
    }

    /**
     * 📩 KIRIM PESAN
     */
    public function store(Request $request, Artwork $artwork)
    {
        $this->authorizeChat($artwork);

        if (!$request->filled('message') && !$request->hasFile('file')) {
            return back();
        }

        // 🎯 tentukan penerima
        $receiverId = Auth::user()->role === 'member'
            ? $artwork->team_id
            : $artwork->member->user_id;

        $type = 'text';
        $filePath = null;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $mime = $file->getMimeType();

            $type = str_starts_with($mime, 'image/')
                ? 'image'
                : (str_starts_with($mime, 'video/') ? 'video' : 'document');

            $filePath = $file->store('chat', 'public');
        }

        Message::create([
            'artwork_id' => $artwork->id,
            'from_id'    => Auth::id(),
            'to_id'      => $receiverId,
            'type'       => $type,
            'message'    => $request->message,
            'file_path'  => $filePath,
        ]);

        return back();
    }

    /**
     * 🗑️ HAPUS PESAN
     */
    public function delete(Message $message, $action)
    {
        if ($message->from_id !== Auth::id()) {
            abort(403);
        }

        if ($action === 'me') {
            $message->update(['deleted_by_sender' => true]);
        }

        if ($action === 'all') {
            $message->update(['deleted_for_all' => true]);
        }

        return response()->json(['success' => true]);
    }
}
