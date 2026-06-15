<?php

namespace App\Http\Controllers\Tim;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use Illuminate\Support\Facades\Auth;

class TimDashboardController extends Controller
{
    public function index()
    {
        // ID user tim yang sedang login
        $timId = Auth::id();

        /*
        |--------------------------------------------------------------------------
        | Jika kolom di tabel artworks adalah:
        | team_id  -> pakai team_id
        | tim_id   -> ganti jadi tim_id
        | user_id  -> ganti jadi user_id
        |--------------------------------------------------------------------------
        */

        // Project aktif / sedang dikerjakan
        $activeProjects = Artwork::where('team_id', $timId)
            ->where(function ($query) {
                $query->where('is_archived', false)
                      ->orWhereNull('is_archived');
            })
            ->count();

        // Project selesai / history tim ini saja
        $completedProjects = Artwork::where('team_id', $timId)
            ->where('is_archived', true)
            ->count();

        return view('tim.dashboard', [
            'activeProjects' => $activeProjects,
            'completedProjects' => $completedProjects,
        ]);
    }
}