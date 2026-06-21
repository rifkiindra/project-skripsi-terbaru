<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        // Ambil ID member yang login
        $memberId = Auth::user()->member->id;

        // HANYA tampilkan artwork yang SUDAH di-archive admin
        $artworks = Artwork::where('member_id', $memberId)
            ->where('is_archived', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('member.history.index', compact('artworks'));
    }

    public function show(Artwork $artwork)
    {
    $memberId = Auth::User()->member->id;

    // Pastikan milik member & sudah archived
    if ($artwork->member_id !== $memberId || !$artwork->is_archived) {
        abort(403);
    }

    $artwork->load(['team','progresses']);

    return view('member.history.show', compact('artwork'));
    }
}
