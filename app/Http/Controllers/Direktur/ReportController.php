<?php

namespace App\Http\Controllers\Direktur;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\RevisionRequested;

class ReportController extends Controller
{
    /**
     * =========================
     * LAPORAN ARTWORK
     * =========================
     */
    public function index(Request $request)
{
    $query = Artwork::where('is_archived', 1)
        ->where('status', 'final');

    if ($request->filled('start_date')) {
        $query->whereDate('updated_at', '>=', $request->start_date);
    }

    if ($request->filled('end_date')) {
        $query->whereDate('updated_at', '<=', $request->end_date);
    }

    $artworks = $query->orderBy('updated_at', 'desc')->get();

    return view('direktur.reports.index', compact('artworks'));
}


    /**
     * =========================
     * REQUEST REVISI
     * =========================
     */
    public function requestRevision(Request $request)
    {
        $request->validate([
            'artwork_id' => 'required|exists:artworks,id',
            'message'    => 'required|string',
        ]);

        $artwork = Artwork::findOrFail($request->artwork_id);

        // 🔔 kirim notifikasi email (direktur)
        //Notification::route('mail', 'rifkyindra150@gmail.com')
        //    ->notify(new RevisionRequested($artwork, $request->message));

        return back()->with('success', 'Permintaan revisi berhasil dikirim.');
    }

    public function show(Artwork $artwork)
    {
        $artwork->load(['member','team','progresses']);

        return view('direktur.reports.show', compact('artwork'));
    }
}
