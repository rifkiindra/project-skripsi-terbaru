@extends('layouts.adminlte')

@section('title', 'Detail Artwork')
@section('page-title', 'Detail Artwork')

@section('content')

@php
    $status = $artwork->status ?? 'sketsa';

    $badgeStyle = match($status) {
        'sketsa' => 'background:#FFD54A;color:#000;',
        'color'  => 'background:#42A5F5;color:#fff;',
        'final'  => 'background:#66BB6A;color:#fff;',
        default  => 'background:#9E9E9E;color:#fff;',
    };
@endphp

<div class="card p-4">

    <h4 class="mb-3">{{ $artwork->judul }}</h4>

    <p><strong>Klien:</strong> {{ $artwork->member->nama ?? '-' }}</p>

    <p>
        <strong>Status:</strong>
        <span class="badge px-2 py-1" style="{{ $badgeStyle }}">
            {{ ucfirst($status) }}
        </span>
    </p>

    <hr>

    <h5 class="mb-4">📌 Riwayat Progress</h5>

    @forelse($artwork->progresses->sortBy('created_at') as $progress)

        @php
            $approvalColor = match($progress->approval_status){
                'approved' => 'success',
                'revisi'   => 'danger',
                default    => 'warning'
            };
        @endphp

        <div class="mb-5">

            <div class="d-flex justify-content-between mb-2">
                <div>
                    <span class="badge bg-primary">
                        {{ strtoupper($progress->stage) }}
                    </span>

                    <span class="badge bg-{{ $approvalColor }}">
                        {{ ucfirst($progress->approval_status ?? 'pending') }}
                    </span>
                </div>

                <small class="text-muted">
                    {{ $progress->created_at->format('d M Y H:i') }}
                </small>
            </div>

            {{-- IMAGE --}}
            @if($progress->image)
                <div class="mb-3 text-center">

                    <img src="{{ asset('uploads/artworks/'.$progress->image) }}"
                         class="img-fluid rounded shadow preview-image"
                         style="max-height:300px; cursor:pointer;"
                         data-bs-toggle="modal"
                         data-bs-target="#imageModal"
                         data-image="{{ asset('uploads/artworks/'.$progress->image) }}">

                    <div class="mt-2">
                        <a href="{{ asset('uploads/artworks/'.$progress->image) }}"
                           download
                           class="btn btn-sm btn-success">
                            ⬇ Download
                        </a>
                    </div>

                </div>
            @endif

            {{-- NOTE --}}
            @if($progress->note)
                <p class="text-muted mt-2">
                    {{ $progress->note }}
                </p>
            @endif

            <hr>
        </div>

    @empty
        <div class="alert alert-warning">
            Belum ada progress
        </div>
    @endforelse

    <a href="{{ route('admin.artworks.index') }}"
       class="btn btn-secondary mt-4">
        Kembali
    </a>

</div>


{{-- =======================
    IMAGE PREVIEW MODAL
======================= --}}
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content bg-dark">

            <div class="modal-header border-0">
                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                </button>
            </div>

            <div class="modal-body text-center">
                <img id="modalImage"
                     src=""
                     class="img-fluid rounded">
            </div>

        </div>
    </div>
</div>


{{-- =======================
    SCRIPT PREVIEW
======================= --}}
<script>
document.addEventListener("DOMContentLoaded", function () {

    const previewImages = document.querySelectorAll('.preview-image');
    const modalImage = document.getElementById('modalImage');

    previewImages.forEach(img => {
        img.addEventListener('click', function () {
            modalImage.src = this.dataset.image;
        });
    });

});
</script>

@endsection
