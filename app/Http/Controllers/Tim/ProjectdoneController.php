<?php

namespace App\Http\Controllers\Tim;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use Illuminate\Support\Facades\Auth;

class ProjectdoneController extends Controller
{
    public function index()
    {
        // Ambil ID user tim yang sedang login
        $timId = Auth::id();

        /*
        |--------------------------------------------------------------------------
        | HANYA TAMPILKAN PROJECT YANG DIKERJAKAN OLEH TIM INI
        |--------------------------------------------------------------------------
        | Ganti 'team_id' jika di tabel artworks nama kolom tim kamu berbeda:
        | kemungkinan lain: tim_id / user_id / assigned_team
        */
        $artworks = Artwork::where('team_id', $timId)
            ->where('is_archived', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('tim.project.index', compact('artworks'));
    }

    public function show(Artwork $artwork)
    {
        $timId = Auth::id();

        /*
        |--------------------------------------------------------------------------
        | CEK KEAMANAN:
        | Hanya tim pemilik project + project archived
        |--------------------------------------------------------------------------
        */
        if ($artwork->team_id != $timId || !$artwork->is_archived) {
            abort(403);
        }

        // Load relasi
        $artwork->load([
            'member',
            'team',
            'progresses'
        ]);

        return view('tim.project.show', compact('artwork'));
    }
}