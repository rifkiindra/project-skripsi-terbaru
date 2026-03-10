<?php

namespace App\Http\Controllers\Tim;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use App\Models\ArtworkProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ArtworkController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Dashboard Tim
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $artworks = Artwork::with([
            'member',
            'progresses' => fn($q) => $q->latest()->limit(1)
        ])
        ->where('team_id', Auth::id())
        ->where('is_archived', false)
        ->latest()
        ->get();

        return view('tim.artworks.index', compact('artworks'));
    }

    /*
    |--------------------------------------------------------------------------
    | Detail Artwork
    |--------------------------------------------------------------------------
    */
    public function show(Artwork $artwork)
    {
        $this->authorizeArtwork($artwork);

        $artwork->load([
            'member',
            'team',
            'progresses' => fn($q) => $q->latest()
        ]);

        return view('tim.artworks.show', compact('artwork'));
    }

    /*
    |--------------------------------------------------------------------------
    | Upload Progress
    |--------------------------------------------------------------------------
    */
    public function upload(Request $request, Artwork $artwork)
    {
        $this->authorizeArtwork($artwork);

        $lastProgress = $artwork->progresses()->latest()->first();

        /*
        |--------------------------------------------------------------------------
        | LOCK kalau revisi
        |--------------------------------------------------------------------------
        */
        if ($lastProgress && $lastProgress->approval_status === 'revisi' && $request->type !== $lastProgress->stage
        ) {
            return back()->with('error','Revisi harus dikerjakan pada tahap yang sama!');
        }

        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */
        $data = $request->validate([
            'type' => 'required|in:sketsa,color,final',
            'file' => 'required|image|mimes:jpg,jpeg,png,webp|max:10240',
            'note' => 'nullable|string|max:1000'
        ]);

        /*
        |--------------------------------------------------------------------------
        | FLOW VALIDATION (ANTI LONCAT)
        |--------------------------------------------------------------------------
        */
        $currentStage = $lastProgress?->stage;

$flow = [
    'sketsa' => [null, 'sketsa'],
    'color'  => ['sketsa', 'color'],   // tambahkan self-stage untuk revisi
    'final'  => ['color', 'final'],    // tambahkan self-stage untuk revisi
];

if (!in_array($currentStage, $flow[$data['type']], true)) {
    return back()->with('error', 'Urutan pengerjaan tidak valid!');
}


        /*
        |--------------------------------------------------------------------------
        | AUTO CREATE FOLDER (ini sering bikin gambar tidak tampil!)
        |--------------------------------------------------------------------------
        */
        $destination = public_path('uploads/artworks');

        if (!File::exists($destination)) {
            File::makeDirectory($destination, 0755, true);
        }

        /*
        |--------------------------------------------------------------------------
        | UPLOAD FILE (PAKAI EXTENSION ASLI)
        |--------------------------------------------------------------------------
        */
        $file = $request->file('file');
        $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();

        $file->move($destination, $filename);

        /*
        |--------------------------------------------------------------------------
        | CREATE PROGRESS
        |--------------------------------------------------------------------------
        */
        ArtworkProgress::create([
            'artwork_id' => $artwork->id,
            'stage' => $data['type'],
            'image' => $filename,
            'note' => $data['note'],
            'approval_status' => 'pending'
        ]);

        /*
        |--------------------------------------------------------------------------
        | UPDATE STATUS ARTWORK
        |--------------------------------------------------------------------------
        */
        $artwork->update([
            'status' => $data['type']
        ]);

        return back()->with('success', 'Progress berhasil diupload 👍');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE PROGRESS
    |--------------------------------------------------------------------------
    */
    public function destroy(ArtworkProgress $progress)
    {
        $artwork = $progress->artwork;

        $this->authorizeArtwork($artwork);

        /*
        |--------------------------------------------------------------------------
        | JANGAN HAPUS YANG SUDAH APPROVED
        |--------------------------------------------------------------------------
        */
        if ($progress->approval_status === 'approved') {
            return back()->with('error','Progress yang sudah disetujui tidak bisa dihapus!');
        }

        /*
        |--------------------------------------------------------------------------
        | HAPUS FILE
        |--------------------------------------------------------------------------
        */
        $filePath = public_path('uploads/artworks/'.$progress->image);

        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        /*
        |--------------------------------------------------------------------------
        | DELETE DATABASE
        |--------------------------------------------------------------------------
        */
        $progress->delete();

        /*
        |--------------------------------------------------------------------------
        | UPDATE STATUS KE PROGRESS TERAKHIR
        |--------------------------------------------------------------------------
        */
        $lastProgress = $artwork->progresses()->latest()->first();

        $artwork->update([
            'status' => $lastProgress?->stage ?? 'sketsa'
        ]);

        if ($lastProgress) {
            $lastProgress->update([
               'approval_status' => 'pending'
            ]);
        }

        return back()->with('success','Progress berhasil dihapus 👍');
    }

    /*
    |--------------------------------------------------------------------------
    | AUTHORIZATION HELPER (FIX TYPO!)
    |--------------------------------------------------------------------------
    */
    private function authorizeArtwork(Artwork $artwork)
    {
        if ($artwork->team_id !== Auth::id()) {
            abort(403, 'Akses ditolak');
        }

        if ($artwork->is_archived) {
            abort(403, 'Proyek sudah diarsipkan');
        }
    }
}
