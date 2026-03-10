@extends('layouts.direktur')

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

<div class="card shadow-sm border-0 p-4">

    {{-- ================= HEADER ================= --}}
    <div class="mb-4">
        <h4 class="fw-bold">{{ $artwork->judul }}</h4>
        <p class="mb-1"><strong>Klien:</strong> {{ $artwork->member->nama ?? '-' }}</p>

        <span class="badge px-3 py-2" style="{{ $badgeStyle }}">
            Status Artwork: {{ ucfirst($status) }}
        </span>
    </div>

    <hr>

    {{-- ================= HASIL TERBARU ================= --}}
    <h5 class="mb-3 fw-semibold">Hasil Terbaru</h5>

    @if ($artwork->latestProgress)
        <div class="text-center mb-4">

            <img
                src="{{ asset('uploads/artworks/'.$artwork->latestProgress->image) }}"
                class="img-fluid rounded shadow-lg preview-image"
                style="max-height:420px; cursor:pointer; transition:0.3s"
                data-image="{{ asset('uploads/artworks/'.$artwork->latestProgress->image) }}"
            >

            <div class="mt-3 text-muted small">
                Upload:
                {{ $artwork->latestProgress->created_at->format('d M Y - H:i') }} WIB
                |
                Tahap: <strong>{{ strtoupper($artwork->latestProgress->stage) }}</strong>
            </div>

        </div>
    @else
        <div class="alert alert-warning">
            Belum ada progress terbaru.
        </div>
    @endif

    <hr>

    {{-- ================= RIWAYAT PROGRESS ================= --}}
    <h5 class="mb-4 fw-semibold">Riwayat Progress</h5>

    <div class="row">

    @foreach($artwork->progresses->sortByDesc('created_at') as $progress)

        @php
            $progressStatus = $progress->status ?? 'pending';

            $badgeStatus = match($progressStatus) {
                'approved' => 'background:#66BB6A;color:#fff;',
                'pending'  => 'background:#FFA726;color:#fff;',
                'revisi'   => 'background:#EF5350;color:#fff;',
                default    => 'background:#9E9E9E;color:#fff;',
            };
        @endphp

        <div class="col-lg-3 col-md-4 col-6 mb-4">

            <div class="card shadow-sm border-0 h-100">

                <div class="position-relative">

                    <img
                        src="{{ asset('uploads/artworks/'.$progress->image) }}"
                        class="img-fluid rounded-top preview-image"
                        style="height:180px; object-fit:cover; cursor:pointer;"
                        data-image="{{ asset('uploads/artworks/'.$progress->image) }}"
                    >
                </div>

                <div class="card-body p-3">

                    <small class="text-muted d-block mb-1">
                        📅 {{ $progress->created_at->format('d M Y') }}
                    </small>

                    <small class="text-muted d-block mb-2">
                        ⏰ {{ $progress->created_at->format('H:i') }} WIB
                    </small>

                    @if($artwork->team)
                      <small class="text-muted d-block mb-2">
                          👤 Ilustrator : {{ $artwork->team->name }}
                      </small>
                    @else
                        <small class="text-danger d-block mb-2">
                            ⚠ Tim belum ditentukan
                        </small>
                    @endif

                    @php
                        $stageColor = match($progress->stage){
                            'sketsa' => 'background:#FFD54A;color:#000;',
                            'color'  => 'background:#42A5F5;color:#fff;',
                            'final'  => 'background:#66BB6A;color:#fff;',
                            default  => 'background:#9E9E9E;color:#fff;',
                        };
                       $approvalColor = match($progress->approval_status ?? 'pending'){
                           'approved' => 'success',
                           'revisi'   => 'danger',
                           default    => 'warning'
                       };
                    @endphp

                    <span class="badge px-2 py-1 me-2" style="{{ $stageColor }}">
                        {{ strtoupper($progress->stage) }}
                    </span>

                    <span class="badge bg-{{ $approvalColor }}">
                        {{ ucfirst($progress->approval_status ?? 'pending') }}
                    </span>


                    @if($progress->note)
                        <div class="mt-2 small text-muted">
                            💬 {{ $progress->note }}
                        </div>
                    @endif

                </div>

            </div>

        </div>

    @endforeach

    </div>

    <a href="{{ route('direktur.artworks.index') }}"
       class="btn btn-secondary mt-3">
        Kembali
    </a>

</div>



{{-- ================= MODAL PREVIEW ================= --}}
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content bg-dark border-0">

            <div class="modal-header border-0">
                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                </button>
            </div>

            <div class="modal-body text-center">
                <img id="modalImage"
                     src=""
                     class="img-fluid rounded shadow-lg">
            </div>

        </div>
    </div>
</div>



{{-- ================= SCRIPT PREVIEW ================= --}}
<script>
document.addEventListener("DOMContentLoaded", function () {

    const previewImages = document.querySelectorAll('.preview-image');
    const modalImage = document.getElementById('modalImage');
    const modal = new bootstrap.Modal(document.getElementById('imageModal'));

    previewImages.forEach(img => {

        img.addEventListener('click', function () {

            const imageUrl = this.dataset.image;

            modalImage.src = imageUrl;
            modal.show();
        });

        img.addEventListener('mouseover', function(){
            this.style.transform = "scale(1.05)";
        });

        img.addEventListener('mouseout', function(){
            this.style.transform = "scale(1)";
        });

    });

});
</script>

@endsection
