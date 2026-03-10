<?php

namespace App\Http\Controllers\Direktur;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    return view('direktur.dashboard', [
        'totalProjects' => Artwork::count(),
        'activeProjects' => Artwork::whereNotIn('status', ['selesai', 'completed', 'final'])->count(),
        'completedProjects' => Artwork::whereIn('status', ['selesai', 'completed', 'final'])->count(),
    ]);
}

}
