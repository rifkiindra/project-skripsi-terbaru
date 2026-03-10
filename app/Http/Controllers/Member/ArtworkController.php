<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class ArtworkController extends Controller
{
    /**
     * 📋 LIST ARTWORK MILIK MEMBER LOGIN
     */
    public function index(Request $request)
    {
    $user = Auth::user();

    if (!$user->member) {
        abort(403, 'Akun ini bukan member');
    }

    $query = Artwork::where('member_id', $user->member->id)
        ->where('is_archived', false); // 🔥 TAMBAHKAN INI

    if ($request->filled('search')) {
        $query->where('judul', 'like', '%' . $request->search . '%');
    }

    $artworks = $query->latest()->get();

    return view('member.artworks.index', compact('artworks'));
    }

    /**
     * 🔍 DETAIL ARTWORK (HANYA MILIK MEMBER)
     */
    public function show($id)
    {
        $user = Auth::user();

        if (!$user->member) {
            abort(403, 'Akun ini bukan member');
        }

        $artwork = Artwork::with(['team', 'member', 'progresses' => fn($q) => $q->latest()])
            ->where('id', $id)
            ->where('member_id', $user->member->id)
            ->firstOrFail();

        $status = $artwork->status ?? 'sketsa';

        $badgeStyle = match ($status) {
            'sketsa' => 'background-color:#FFD54A;color:#000;font-weight:600;',
            'color'  => 'background-color:#42A5F5;color:#fff;font-weight:600;',
            'final'  => 'background-color:#66BB6A;color:#fff;font-weight:600;',
            default  => 'background-color:#BDBDBD;color:#000;',
        };

        $imageField = optional($artwork->latestProgress)->image;

        return view('member.artworks.show', compact(
            'artwork',
            'status',
            'badgeStyle',
            'imageField'
        ));
    }

}
