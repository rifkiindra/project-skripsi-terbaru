@extends('layouts.adminlte')

@section('title', 'Detail Artwork')
@section('page-title', 'Detail Artwork')

@section('content')

<div class="card shadow-lg border-0">
    <div class="card-body p-4">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">{{ $artwork->judul }}</h4>
                <small class="text-muted">
                    Kategori: {{ $artwork->kategori ?? '-' }}
                </small>
            </div>

            <span class="badge bg-dark px-3 py-2">
                {{ ucfirst($artwork->status) }}
            </span>
        </div>

        {{-- INFO --}}
        <p><strong>Klien:</strong> {{ $artwork->member->nama ?? '-' }}</p>

        @if($artwork->team)
            <div class="alert alert-info border-0 shadow-sm">
                👨‍🎨 <strong>Tim Pengerja:</strong> {{ $artwork->team->name }}
            </div>
        @else
            <div class="alert alert-warning border-0 shadow-sm">
                ⚠ Tim belum ditentukan
            </div>
        @endif

        <hr class="my-4">

        <h5 class="fw-bold mb-4">📌 Riwayat Progress</h5>

        @php
            $progresses = $artwork->progresses->sortByDesc('created_at');
        @endphp

        @if($progresses->count())

            @foreach($progresses as $index => $progress)

                @php
                    // ===== BADGE stage =====
                    if(strtolower($progress->stage) == 'sketsa'){
                        $stageColor = 'warning';
                        $stageLabel = 'Sketsa';
                    } elseif(strtolower($progress->stage) == 'color'){
                        $stageColor = 'primary';
                        $stageLabel = 'Color';
                    } elseif(strtolower($progress->stage) == 'final'){
                        $stageColor = 'success';
                        $stageLabel = 'Final';
                    } else {
                        $stageColor = 'secondary';
                        $stageLabel = ucfirst($progress->stage);
                    }

                    // ===== BADGE STATUS =====
                    if($progress->approval_status == 'approved'){
                        $statusColor = 'success';
                        $statusLabel = 'Approved';
                    } elseif($progress->approval_status == 'revisi'){
                        $statusColor = 'danger';
                        $statusLabel = 'Revisi';
                    } else {
                        $statusColor = 'secondary';
                        $statusLabel = 'Pending';
                    }
                @endphp

                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-body">

                        <div class="row align-items-center">

                            {{-- GAMBAR --}}
                            <div class="col-md-4 text-center">
                                <img
                                    src="{{ asset('uploads/artworks/'.$progress->image) }}"
                                    class="img-fluid rounded shadow-sm"
                                    style="max-height:230px; object-fit:cover; cursor:pointer;"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modal{{ $progress->id }}"
                                >
                            </div>

                            {{-- DETAIL --}}
                            <div class="col-md-8">

                                <h6 class="fw-bold mb-3">
                                    Progress {{ $stageLabel }}
                                </h6>

                                <p class="mb-1">
                                    👤 <strong>Upload oleh:</strong>
                                    {{ $progress->team->name ?? $artwork->team->name ?? 'Tim Tidak Diketahui' }}
                                </p>

                                <p class="mb-1">
                                    🕒 <strong>Tanggal Upload:</strong>
                                    {{ $progress->created_at->format('d M Y') }}
                                    | {{ $progress->created_at->format('H:i') }}
                                </p>

                                <p class="mb-2">
                                    🎨 <strong>stage:</strong>
                                    <span class="badge bg-{{ $stageColor }}">
                                        {{ $stageLabel }}
                                    </span>
                                </p>

                                <p class="mb-3">
                                    🔎 <strong>Status:</strong>
                                    <span class="badge bg-{{ $statusColor }}">
                                        {{ $statusLabel }}
                                    </span>
                                </p>

                                {{-- ACTION HANYA PROGRESS TERBARU --}}
                                @if($index == 0 && $progress->approval_status == 'pending')

                                    <div class="d-flex gap-2">

                                        {{-- REVISI --}}
                                        <form action="{{ route('member.progress.revisi', $progress->id) }}"
                                              method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <input type="hidden"
                                                   name="note"
                                                   value="Klien meminta revisi melalui chat">

                                            <button class="btn btn-danger btn-sm">
                                                💬 Minta Revisi
                                            </button>
                                        </form>

                                        {{-- APPROVE --}}
                                        <form method="POST"
                                              action="{{ route('member.progress.approve', $progress->id) }}">
                                            @csrf
                                            @method('PATCH')

                                            <button class="btn btn-success btn-sm">
                                                ✅ Approve
                                            </button>
                                        </form>

                                    </div>

                                @endif

                            </div>

                        </div>

                    </div>
                </div>


                {{-- MODAL PREVIEW + DOWNLOAD --}}
                <div class="modal fade"
                     id="modal{{ $progress->id }}"
                     tabindex="-1">

                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content bg-dark border-0">
                            <div class="modal-body text-center">

                                <img
                                    src="{{ asset('uploads/artworks/'.$progress->image) }}"
                                    class="img-fluid rounded"
                                >

                                <div class="mt-4">

                                    <a href="{{ asset('uploads/artworks/'.$progress->image) }}"
                                       download
                                       class="btn btn-success me-2">
                                       ⬇ Download
                                    </a>

                                    <button class="btn btn-light"
                                            data-bs-dismiss="modal">
                                        Tutup
                                    </button>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            @endforeach

        @else

            <div class="alert alert-warning shadow-sm">
                Belum ada progress yang diupload oleh tim.
            </div>

        @endif


        <hr class="my-4">

        <div class="d-flex gap-2">

            <a href="{{ route('member.history.index') }}"
               class="btn btn-secondary btn-sm">
                ← Kembali
            </a>
        </div>

    </div>
</div>

@endsection