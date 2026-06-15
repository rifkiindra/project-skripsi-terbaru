@extends('layouts.adminlte')

@section('title', 'Manajemen Artwork')
@section('page-title', 'Production Control Center')

@section('content')

@php
    use Carbon\Carbon;

    $totalActive = $artworks->count();
    $deadlineSoon = $artworks->filter(function($a){
        if(!$a->deadline) return false;
        return Carbon::today()->diffInDays(Carbon::parse($a->deadline), false) <= 7
            && Carbon::today()->diffInDays(Carbon::parse($a->deadline), false) >= 0;
    })->count();

    $lateProjects = $artworks->filter(function($a){
        if(!$a->deadline) return false;
        return Carbon::today()->diffInDays(Carbon::parse($a->deadline), false) < 0;
    })->count();

    $completed = $artworks->where('status', 'final')->count();
@endphp

<style>
    .tracking-card {
        border: none;
        border-radius: 18px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .stats-box {
        border-radius: 18px;
        color: white;
        padding: 20px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    }

    .stats-box h3 {
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
    }

    .stats-box p {
        margin: 0;
        font-size: 0.95rem;
        opacity: 0.9;
    }

    .bg-premium-1 { background: linear-gradient(135deg, #1d2671, #c33764); }
    .bg-premium-2 { background: linear-gradient(135deg, #f7971e, #ffd200); }
    .bg-premium-3 { background: linear-gradient(135deg, #93291e, #ed213a); }
    .bg-premium-4 { background: linear-gradient(135deg, #11998e, #38ef7d); }

    .table thead th {
        background: linear-gradient(90deg, #1d2671, #c33764);
        color: white;
        border: none;
        text-align: center;
        vertical-align: middle;
        font-size: 0.85rem;
    }

    .table tbody td {
        vertical-align: middle;
    }

    .project-title {
        font-weight: 700;
        color: #2c3e50;
    }

    .project-category {
        font-size: 0.8rem;
        color: #6c757d;
    }

    .progress {
        height: 10px;
        border-radius: 20px;
    }

    .badge-priority {
        padding: 8px 12px;
        border-radius: 30px;
        font-size: 0.75rem;
    }

    .deadline-box {
        font-size: 0.85rem;
        font-weight: 600;
    }

    .filter-bar {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .filter-bar .btn {
        border-radius: 30px;
    }

    .table-responsive {
        border-radius: 15px;
        overflow: hidden;
    }
</style>

{{-- ================= KPI CARDS ================= --}}
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="stats-box bg-premium-1">
            <h3>{{ $totalActive }}</h3>
            <p>Total Project Aktif</p>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="stats-box bg-premium-2">
            <h3>{{ $deadlineSoon }}</h3>
            <p>Deadline ≤ 7 Hari</p>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="stats-box bg-premium-3">
            <h3>{{ $lateProjects }}</h3>
            <p>Terlambat</p>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="stats-box bg-premium-4">
            <h3>{{ $completed }}</h3>
            <p>Selesai / Final</p>
        </div>
    </div>
</div>

{{-- ================= MAIN TABLE ================= --}}
<div class="card tracking-card">
    <div class="card-header bg-white border-0">
        <h4 class="mb-3 font-weight-bold">Tracking Progres Produksi Artwork</h4>

        <div class="filter-bar">
            <button class="btn btn-outline-dark btn-sm">Semua</button>
            <button class="btn btn-outline-warning btn-sm">Sketsa</button>
            <button class="btn btn-outline-primary btn-sm">Color</button>
            <button class="btn btn-outline-success btn-sm">Final</button>
            <button class="btn btn-outline-danger btn-sm">Urgent</button>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>PROJECT</th>
                        <th>KLIEN</th>
                        <th>PROGRESS</th>
                        <th>START</th>
                        <th>DEADLINE</th>
                        <th>SISA</th>
                        <th>PRIORITAS</th>
                        <th>AKSI</th>
                    </tr>
                </thead>

                <tbody>
                @forelse ($artworks as $artwork)

                    @php
                        if($artwork->status === 'sketsa'){
                            $progress = 25;
                        } elseif($artwork->status === 'color'){
                            $progress = 70;
                        } else {
                            $progress = 100;
                        }

                        $remaining = $artwork->deadline
                            ? Carbon::today()->diffInDays(Carbon::parse($artwork->deadline), false)
                            : null;
                    @endphp

                    {{-- MODAL PREVIEW --}}
                    <div class="modal fade" id="imageModal{{ $artwork->id }}" tabindex="-1">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Preview Artwork</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center">
                                    @if($artwork->sketsa_image)
                                        <img src="{{ asset('uploads/artworks/'.$artwork->sketsa_image) }}" class="img-fluid rounded">
                                    @elseif($artwork->color_image)
                                        <img src="{{ asset('uploads/artworks/'.$artwork->color_image) }}" class="img-fluid rounded">
                                    @elseif($artwork->final_image)
                                        <img src="{{ asset('uploads/artworks/'.$artwork->final_image) }}" class="img-fluid rounded">
                                    @else
                                        <span class="text-muted">Belum ada hasil</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>

                        {{-- PROJECT --}}
                        <td>
                            <div class="project-title">{{ $artwork->judul }}</div>
                            <div class="project-category">{{ ucfirst($artwork->kategori) }}</div>
                        </td>

                        {{-- KLIEN --}}
                        <td>{{ $artwork->member->nama }}</td>

                        {{-- PROGRESS --}}
                        <td style="min-width:180px;">
                            <div class="progress mb-2">
                                <div class="progress-bar
                                    @if($progress < 50) bg-warning
                                    @elseif($progress < 100) bg-primary
                                    @else bg-success
                                    @endif"
                                    style="width: {{ $progress }}%">
                                </div>
                            </div>
                            <small><strong>{{ $progress }}%</strong> - {{ ucfirst($artwork->status) }}</small>
                        </td>

                        {{-- START --}}
                        <td>{{ Carbon::parse($artwork->start)->format('d M Y') }}</td>

                        {{-- DEADLINE --}}
                        <td>
                            {{ $artwork->deadline ? Carbon::parse($artwork->deadline)->format('d M Y') : '-' }}
                        </td>

                        {{-- SISA --}}
                        <td class="text-center">
                            @if(!$artwork->deadline)
                                <span class="badge badge-secondary">-</span>
                            @elseif($remaining < 0)
                                <span class="badge badge-danger">
                                    Terlambat {{ abs($remaining) }} Hari
                                </span>
                            @elseif($remaining <= 3)
                                <span class="badge badge-warning">
                                    {{ $remaining }} Hari
                                </span>
                            @else
                                <span class="badge badge-success">
                                    {{ $remaining }} Hari
                                </span>
                            @endif
                        </td>

                        {{-- PRIORITAS --}}
                        <td class="text-center">
                            @if($artwork->status === 'final')
                                <span class="badge badge-success badge-priority">SELESAI</span>
                            @elseif($remaining !== null && $remaining < 0)
                                <span class="badge badge-danger badge-priority">URGENT</span>
                            @elseif($remaining !== null && $remaining <= 3)
                                <span class="badge badge-warning badge-priority">HIGH</span>
                            @else
                                <span class="badge badge-primary badge-priority">NORMAL</span>
                            @endif
                        </td>

                        {{-- AKSI --}}
                        <td class="text-center">
                            

                            @if ($artwork->status === 'final' && !$artwork->is_archived)
                                <form action="{{ route('admin.artworks.archive', $artwork->id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    <button class="btn btn-secondary btn-sm mb-1"
                                            onclick="return confirm('Arsipkan artwork ini?')">
                                        Arsip
                                    </button>
                                </form>
                            @endif

                            <a href="{{ route('admin.artworks.show', $artwork) }}"
                               class="btn btn-success btn-sm mb-1">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="10" class="text-center py-4">
                            Tidak ada project artwork aktif.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection