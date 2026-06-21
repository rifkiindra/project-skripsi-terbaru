@extends('layouts.member')

@section('title', 'Dashboard Member')
@section('page-title', 'Dashboard Member')

@section('content')
<div class="container-fluid">

    {{-- Welcome --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-gradient-primary text-white shadow">
                <div class="card-body d-flex align-items-center">
                    <div>
                        <h4 class="mb-1">👋 Selamat Datang, {{ auth()->user()->name }}</h4>
                        <p class="mb-0">Kelola pesanan artwork & pembayaran Anda di sini</p>
                    </div>
                    <div class="ml-auto d-none d-md-block">
                        <i class="fas fa-palette fa-4x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Statistik --}}
    <div class="row">
        <div class="col-md-3 col-6">
            <div class="small-box bg-info shadow-sm">
                <div class="inner">
                    <h3>{{ $totalOrders ?? 0 }}</h3>
                    <p>Total Order</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="small-box bg-warning shadow-sm">
                <div class="inner">
                    <h3>{{ $activeOrders ?? 0 }}</h3>
                    <p>Order Aktif</p>
                </div>
                <div class="icon">
                    <i class="fas fa-spinner"></i>
                </div>
            </div>
        </div>

    {{-- Order Terakhir --}}
    <div class="row mt-4">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">🧾 Order Terakhir</h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Judul</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestOrders ?? [] as $order)
                                <tr>
                                    <td>{{ $order->title }}</td>
                                    <td>
                                        <span class="badge badge-{{ $order->status == 'selesai' ? 'success' : 'warning' }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">
                                        Belum ada order
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Aksi Cepat --}}
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">⚡ Aksi Cepat</h5>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
