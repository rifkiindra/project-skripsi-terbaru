@extends('layouts.direktur')

@section('title', 'Laporan Project')
@section('page-title', 'Arsip Project Selesai')

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Nama Klien</th>
                    <th>Judul Artwork</th>
                    <th>Start</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
            @forelse ($artworks as $artwork)

                {{-- MODAL FINAL --}}
                <div class="modal fade" id="imageModal{{ $artwork->id }}" tabindex="-1">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Hasil Final</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body text-center">
                                @if($artwork->final_image)
                                    <img src="{{ asset('uploads/artworks/'.$artwork->final_image) }}" width="700">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

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
                        <a href="{{ route('direktur.reports.show', $artwork->id) }}"
                           class="btn btn-success btn-sm">
                           <i class="fas fa-eye"></i> Detail
                        </a>
                        <form action="{{ route('direktur.artworks.destroy', $artwork) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Yakin ingin menghapus pesanan artwork ini?')">
                              @csrf
                              @method('DELETE')
                             <button type="submit"
                                     class="btn btn-danger btn-sm"
                                     title="Hapus">
                                    <i class="fas fa-trash"></i>
                             </button>
                        </form>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="8" class="text-center">
                        Belum ada project yang diarsipkan.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
