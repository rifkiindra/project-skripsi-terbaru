@extends('layouts.adminlte')

@section('title', 'Riwayat Pemesanan')

@section('page-title', 'Riwayat Pemesanan')

@section('content')

<div class="card">
    <div class="card-body">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>NO</th>
                    <th>NAMA KLIEN</th>
                    <th>JUDUL ARTWORK</th>
                    <th>START</th>
                    <th>DEADLINE</th>
                    <th>STATUS</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($artworks as $artwork)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $artwork->member->nama }}</td>
                        <td>{{ $artwork->judul }}</td>
                        <td>{{ \Carbon\Carbon::parse($artwork->start)->format('d M Y') }}</td>
                        <td>
                            {{ $artwork->deadline 
                                ? \Carbon\Carbon::parse($artwork->deadline)->format('d M Y') 
                                : '-' }}
                        </td>

                        <td>
                            <span class="badge bg-success">Final</span>
                        </td>
                        <td>
                        <a href="{{ route('member.history.show', $artwork->id) }}"
                           class="btn btn-success btn-sm">
                           <i class="fas fa-eye"></i> Detail
                        </a>
                    </td>
                    </tr>

                    {{-- MODAL GAMBAR --}}
                    <div class="modal fade" id="imageModal{{ $artwork->id }}" tabindex="-1">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Hasil Final Artwork</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="{{ Storage::url($artwork->hasil) }}"
                                         class="img-fluid rounded shadow">
                                </div>
                            </div>
                        </div>
                    </div>

                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            Belum ada riwayat pemesanan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
