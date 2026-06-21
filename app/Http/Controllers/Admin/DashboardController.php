<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use App\Models\Member;

class DashboardController extends Controller
{
    public function index()
    {
        // Data kosong, dihandle di backend nanti
        $totalArtworks = Artwork::count();
        $totalMembers = Member::count();
        return view('admin.dashboard', compact('totalArtworks', 'totalMembers'));
    }
}
