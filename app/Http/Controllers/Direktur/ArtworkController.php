<?php

namespace App\Http\Controllers\Direktur;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtworkController extends Controller
{
    public function index()
    {
        $artworks = Artwork::with(['member','team','latestProgress'])
           ->where('is_archived', false)
           ->latest()
           ->get();

        return view('direktur.artworks.index', compact('artworks'));
    }

    public function create()
    {
        return view('direktur.artworks.create', [
            'artwork' => new Artwork(),
            'members' => Member::orderBy('nama')->get(),
            'teams' => User::where('role', 'tim')
                            ->orderBy('name')
                            ->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'member_id' => 'required|exists:members,id',
            'team_id'   => 'required|exists:members,id',
            'judul'     => 'required|string|max:255',
            'kategori'  => 'required|string|max:100',
            'start'     => 'required|date',
            'deadline'  => 'nullable|date|after_or_equal:start',
        ]);

        $data['status'] = 'sketsa';
        $data['is_archived'] = false;

         Artwork::create($data);

        return redirect()
            ->route('direktur.artworks.index')
            ->with('success','Artwork berhasil dibuat 🚀');
    }

    public function show(Artwork $artwork)
    {
        $artwork->load(['member', 'team', 'progresses','latestProgress']);
        return view('direktur.artworks.show', compact('artwork'));
    }

    public function edit(Artwork $artwork)
    {
        return view('direktur.artworks.edit', [
            'artwork' => $artwork,
            'members' => Member::orderBy('nama')->get(),
        ]);
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'member_id' => 'required',
        'kategori' => 'required',
        'start' => 'required|date',
        'deadline' => 'nullable|date',
        'status' => 'required',
    ]);

    $artwork = Artwork::findOrFail($id);

    $artwork->update([
        'judul' => $request->judul,
        'member_id' => $request->member_id,
        'kategori' => $request->kategori,
        'start' => $request->start,
        'deadline' => $request->deadline,
        'status' => $request->status,
    ]);

    return redirect()
        ->route('direktur.artworks.index')
        ->with('success', 'Artwork berhasil diperbarui.');
}

    public function archive(Artwork $artwork)
    {
        if ($artwork->status !== 'final') {
            return back()->with('error', 'Artwork belum final');
        }

        $artwork->update(['is_archived' => true]);

        return back()->with('success', 'Artwork berhasil diarsipkan 🚀');
    }

    public function report()
    {
        $artworks = Artwork::with(['member', 'team'])
            ->where('is_archived', true)
            ->latest()
            ->get();

        return view('direktur.reports.index', compact('artworks'));
    }

    public function destroy(Artwork $artwork)
    {
        if ($artwork->hasil && Storage::disk('public')->exists($artwork->hasil)) {
            Storage::disk('public')->delete($artwork->hasil);
        }

        $artwork->delete();

        return back()->with('success', 'Artwork dihapus');
    }
}
