<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


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

    /**
     * =========================
     * FORM TAMBAH ARTWORK
     * =========================
     */
    public function create()
    {
        return view('admin.artworks.create', [
            'artwork' => new Artwork(),
            'members' => Member::orderBy('nama')->get(),
        ]);
    }

    /**
     * =========================
     * SIMPAN ARTWORK
     * =========================
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'member_id' => 'required|exists:members,id',
            'judul'     => 'required|string|max:255',
            'kategori'  => 'required|string|max:100',
            'start'     => 'required|date',
            'deadline'  => 'nullable|date|after_or_equal:start',
            'status'    => 'required|in:sketsa,color,final',
            'hasil'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('hasil')) {
            $data['hasil'] = $request->file('hasil')
                ->store('artworks/hasil', 'public');
        }

        $data['status'] = 'sketsa';
        $data['is_archived'] = false;

        return redirect()
            ->route('admin.artworks.index')
            ->with('success', 'Artwork berhasil dibuat & DP 50% otomatis dibuat');
    }

    /**
     * =========================
     * DETAIL ARTWORK
     * =========================
     */
    public function show(Artwork $artwork)
    {
        $artwork->load(['member', 'team', 'progresses', 'latestProgress']);
        return view('admin.artworks.show', compact('artwork'));
    }

    /**
     * =========================
     * FORM EDIT
     * =========================
     */
    public function edit(Artwork $artwork)
    {
        return view('admin.artworks.edit', [
            'artwork' => $artwork,
            'members' => Member::orderBy('nama')->get(),
        ]);
    }

    /**
     * =========================
     * UPDATE ARTWORK
     * =========================
     */
    public function update(Request $request, Artwork $artwork)
{
    $rules = [
        'judul'    => 'required|string|max:255',
        'kategori' => 'required|string|max:100',
        'status'   => 'required|in:sketsa,color,final',
        'start'    => 'required|date',
        'deadline' => 'nullable|date|after_or_equal:start',
        'hasil'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ];

    // 🔥 FINAL WAJIB ADA GAMBAR
    if (
        $request->status === 'final' &&
        !$request->hasFile('hasil') &&
        !$artwork->hasil
    ) {
    
        return back()
            ->withErrors([
                'hasil' => 'Wajib upload gambar sebelum status Final'
            ])
            ->withInput();
    }

    $data = $request->validate($rules);

    // 🔁 JIKA ADA FILE → GANTI HASIL LAMA
    if ($request->hasFile('hasil')) {

        if ($artwork->hasil && Storage::disk('public')->exists($artwork->hasil)) {
            Storage::disk('public')->delete($artwork->hasil);
        }

        $data['hasil'] = $request->file('hasil')
            ->store('artworks/hasil', 'public');
    }

    $artwork->update($data);

    return redirect()
        ->route('admin.artworks.index')
        ->with('success', 'Artwork berhasil diperbarui');
}

    /**
     * =========================
     * ARSIP (MASUK LAPORAN)
     * =========================
     */
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

    /**
     * =========================
     * DELETE
     * =========================
     */
    public function destroy(Artwork $artwork)
    {
        if ($artwork->hasil && Storage::disk('public')->exists($artwork->hasil)) {
            Storage::disk('public')->delete($artwork->hasil);
        }

        $artwork->delete();

        return back()->with('success', 'Artwork dihapus');
    }
}
