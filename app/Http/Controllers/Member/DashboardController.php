<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
   public function index()
{
    /** @var User $user */
    $user = Auth::user();

    $artworks = $user->artworks();

    return view('member.dashboard', [
        'totalOrders'    => $artworks->count(),
        'activeOrders'   => $artworks->whereIn('status', ['proses', 'revisi'])->count(),
        'latestOrders'   => $artworks->latest()->limit(5)->get(),
    ]);
}



}
