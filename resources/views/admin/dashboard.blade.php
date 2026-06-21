@extends('layouts.adminlte')

@section('title', 'Dashboard Admin')

@section('page-title', 'Dashboard Admin')

<link rel="stylesheet" href="{{ asset('admin/css/dashboardadmin.css') }}">
@section('content')
<div class="container-fluid">

    {{-- STAT CARDS --}}
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="stat-card stat-blue">
                <div class="stat-icon">
                    <i class="fas fa-paint-brush"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $totalArtworks }}</h3>
                    <span>Total Pemesanan Artwork</span>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="stat-card stat-green">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $totalMembers }}</h3>
                    <span>Total User</span>
                </div>
            </div>
        </div>
    </div>

    {{-- CHART + QUICK ACTION --}}
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Statistik Pemesanan</h5>
                </div>
                <div class="card-body">
                    <canvas id="orderChart" height="120"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Quick Action</h5>
                </div>
                <div class="card-body d-grid gap-2">
                    <a href="{{ route('admin.artworks.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-image"></i> Kelola Artwork
                    </a>
                    <a href="{{ route('admin.members.index') }}" class="btn btn-outline-dark">
                        <i class="fas fa-users"></i> Manajemen User
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script>
const ctx = document.getElementById('orderChart');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
        datasets: [{
            label: 'Pemesanan Artwork',
            data: [1, 3, 2, 5, 4, {{ $totalArtworks }}],
            borderColor: '#1d9bf0',
            backgroundColor: 'rgba(29,155,240,.15)',
            fill: true,
            tension: .4
        }]
    },
    options: {
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: { beginAtZero: true }
        }
    }
});
</script>
@endpush

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection

