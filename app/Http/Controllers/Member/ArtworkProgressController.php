<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\ArtworkProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ArtworkProgressController extends Controller
{
    public function approve(ArtworkProgress $progress)
    {
        $progress->update([
            'approval_status' => 'approved'
        ]);

        $progress->artwork->update([
            'status' => $progress->stage
        ]);

        return back()->with('success','Progress disetujui 👍');
    }

    public function revisi(Request $request, ArtworkProgress $progress)
{
    $request->validate([
        'note' => 'required|string|max:1000'
    ]);

    // SECURITY — pastikan progress milik member ini
    if ($progress->artwork->member_id !== Auth::user()->member->id) {
        abort(403);
    }

    $progress->update([
        'approval_status' => 'revisi',
        'note' => $request->note
    ]);

    return redirect()
    ->route('artworks.chat', $progress->artwork->id)
    ->with('success','Revisi berhasil dikirim ke tim ✏️');

}

}
