<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artwork;



class ArtworkController extends Controller
{
    /**
     * =========================
     * LIST PEKERJAAN AKTIF
     * =========================
     */
    public function index()
    {
        $artworks = Artwork::with(['member','team','latestProgress'])
            ->where('is_archived', false)
            ->latest()
            ->get();
        return view('admin.artworks.index', compact('artworks'));
    }

    public function show(Artwork $artwork)
    {
        $artwork->load(['member', 'team', 'progresses', 'latestProgress']);
        return view('admin.artworks.show', compact('artwork'));
    }

    public function archive(Artwork $artwork)
    {
        if ($artwork->status !== 'final') {
            return back()->with('error', 'Artwork belum final');
        }

        $artwork->update(['is_archived' => true]);

        return back()->with('success', 'Artwork berhasil diarsipkan 🚀');
    }

    /**
     * =========================
     * LAPORAN
     * =========================
     */
    public function report()
    {
        $artworks = Artwork::with(['member', 'team'])
            ->where('is_archived', true)
            ->latest()
            ->get();

        return view('admin.reports.index', compact('artworks'));
    }

}
