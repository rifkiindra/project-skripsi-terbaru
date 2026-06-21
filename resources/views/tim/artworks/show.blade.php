@extends('layouts.adminlte')

@section('title','Detail Proyek')

@section('content')

@php
    // 🔥 AMBIL PROGRESS TERBARU (ANTI BUG)
    $lastProgress = $artwork->progresses->sortByDesc('created_at')->first();

    $statusColor = [
        'sketsa' => 'warning',
        'color'  => 'info',
        'final'  => 'success',
    ];
@endphp


<div class="card shadow">

    <div class="card-header bg-primary text-white">
        <strong>{{ $artwork->judul ?? 'Artwork' }}</strong>
    </div>

    <div class="card-body">

        {{-- INFO --}}
        <div class="mb-4">
            <p><strong>Klien:</strong> {{ $artwork->member?->nama ?? '-' }}</p>

            <p>
                <strong>Status Saat Ini:</strong>

                <span class="badge bg-{{ $statusColor[$artwork->status] ?? 'secondary' }}">
                    {{ strtoupper($artwork->status) }}
                </span>
            </p>

            <a href="{{ route('artworks.chat', $artwork->id) }}"
               class="btn btn-secondary btn-sm">
                💬 Chat Revisi
            </a>
        </div>


        {{-- 🔥 ALERT REVISI --}}
        <form action="{{ route('tim.artworks.progress', $artwork->id) }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf
    @method('PATCH')

    @if($lastProgress && $lastProgress->approval_status == 'revisi')

        {{-- 🔒 STAGE DIKUNCI KE STAGE SEBELUMNYA --}}
        <input type="hidden" 
               name="type" 
               value="{{ $lastProgress->stage }}">

        <div class="alert alert-danger">
            ⚠️ Artwork sedang direvisi.<br>
            Upload ulang tahap <b>{{ strtoupper($lastProgress->stage) }}</b>
        </div>

    @else

        <div class="form-group">
            <label>Jenis Progress</label>
            <select name="type" class="form-control" required>
                <option value="">-- Pilih --</option>
                <option value="sketsa">Sketsa</option>
                <option value="color">Color</option>
                <option value="final">Final</option>
            </select>
        </div>

    @endif


    <div class="form-group mt-2">
        <label>Upload Gambar</label>
        <input type="file"
               name="file"
               class="form-control"
               accept="image/*"
               required>
    </div>

    <div class="form-group mt-2">
        <label>Catatan</label>
        <textarea name="note"
                  class="form-control"
                  rows="3"></textarea>
    </div>

    <button class="btn btn-success mt-3 w-100">
        ⬆️ Upload Progress
    </button>

</form>




        {{-- =========================
            TIMELINE
        ==========================--}}
        <div class="card shadow">
            <div class="card-body">

                <h4 class="mb-4">🚀 Timeline Progress Artwork</h4>

                @forelse($artwork->progresses->sortByDesc('created_at') as $progress)

                    @php
                        $approvalColor = match($progress->approval_status){
                            'approved' => 'success',
                            'revisi'   => 'danger',
                            default    => 'warning'
                        };
                    @endphp

                    <div class="mb-5">

                        {{-- HEADER --}}
                        <div class="d-flex justify-content-between">

                            <div>
                                <span class="badge bg-{{ $statusColor[$progress->stage] ?? 'secondary' }}">
                                    {{ strtoupper($progress->stage) }}
                                </span>

                                <span class="badge bg-{{ $approvalColor }}">
                                    {{ ucfirst($progress->approval_status ?? 'pending') }}
                                </span>
                            </div>

                            <small class="text-muted text-right">
                                {{ $progress->created_at->diffForHumans() }} <br>
                                {{ $progress->created_at->format('d M Y H:i') }}
                            </small>
                        </div>


                        {{-- NOTE --}}
                        @if($progress->note)
                            <p class="text-muted mt-2">
                                {{ $progress->note }}
                            </p>
                        @endif


                        {{-- DELETE --}}
                        @if($progress->approval_status !== 'approved')
                        <form action="{{ route('tim.progress.destroy', $progress->id) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus progress ini?')"
                              class="mb-2">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm">
                                🗑 Hapus Progress
                            </button>
                        </form>
                        @endif



                        {{-- IMAGE --}}
                        @if($progress->image)

                            <img src="{{ asset('uploads/artworks/'.$progress->image) }}"
                                 class="img-fluid rounded shadow-sm"
                                 style="max-height:450px">

                        @else
                            <div class="text-muted">
                                ⚠️ Gambar tidak ditemukan
                            </div>
                        @endif

                        <hr>

                    </div>

                @empty

                    <p class="text-muted text-center">
                        Belum ada progress
                    </p>

                @endforelse

            </div>
        </div>

    </div>
</div>

@endsection
