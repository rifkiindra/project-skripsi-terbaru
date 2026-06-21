@extends('layouts.direktur')

@section('title', 'Manajemen Artwork')
@section('page-title', 'Daftar Artwork')

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('direktur.artworks.create') }}" class="btn btn-primary float-right">
            Tambah Pesanan Artwork
        </a>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>JUDUL ARTWORK</th>
                    <th>KLIEN</th>
                    <th>KATEGORI</th>
                    <th>START</th>
                    <th>DEADLINE</th>
                    <th>STATUS</th>
                    <th>ILUSTRATOR</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>

                @forelse ($artworks as $artwork)

                {{-- MODAL PREVIEW HASIL --}}
                <div class="modal fade" id="imageModal{{ $artwork->id }}" tabindex="-1">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Hasil {{ ucfirst($artwork->status) }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body text-center">
                                @if($artwork->status === 'sketsa' && $artwork->sketsa_image)
                                    <img src="{{ asset('uploads/artworks/'.$artwork->sketsa_image) }}" width="700">
                                @elseif($artwork->status === 'color' && $artwork->color_image)
                                    <img src="{{ asset('uploads/artworks/'.$artwork->color_image) }}" width="700">
                                @elseif($artwork->status === 'final' && $artwork->final_image)
                                    <img src="{{ asset('uploads/artworks/'.$artwork->final_image) }}" width="700">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $artwork->judul }}</td>
                        <td>{{ $artwork->member->nama }}</td>
                        <td>{{ $artwork->kategori }}</td>
                        <td>{{ \Carbon\Carbon::parse($artwork->start)->format('d M Y') }}</td>
                        <td>
                            {{ $artwork->deadline
                                ? \Carbon\Carbon::parse($artwork->deadline)->format('d M Y')
                                : '-' }}
                        </td>
                        <td>
                            @if($artwork->status === 'sketsa')
                                <span class="badge badge-warning">Sketsa</span>
                            @elseif($artwork->status === 'color')
                                <span class="badge badge-primary">Color</span>
                            @elseif($artwork->status === 'final')
                                <span class="badge bg-success">Final</span>
                            @endif
                        </td>
                        <td>{{ $artwork->team->name ?? '-' }}</td>

                        <td>
    {{-- Assign Tim (selama belum final) --}}
    @if($artwork->status !== 'final')
        <a href="{{ route('direktur.artworks.edit', $artwork->id) }}"
           class="btn btn-warning btn-sm">
            <i class="fas fa-edit"></i>
        </a>
    @endif
    <form action="{{ route('direktur.artworks.destroy', $artwork->id) }}" method="POST"
        class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" title="Hapus"
        onclick="return confirm('Yakin ingin menghapus pesanan artwork ini?')">
        <i class="fas fa-trash"></i>
    </button>
    </form>
    {{-- Arsip HANYA jika status final --}}
    @if ($artwork->status === 'final' && !$artwork->is_archived)
    <form action="{{ route('direktur.artworks.archive', $artwork->id) }}"
      method="POST"
      onsubmit="return confirm('Arsipkan artwork ini?')">

    @csrf
    @method('PATCH')

    <button class="btn btn-warning btn-sm">
        Arsipkan
    </button>

</form>

@endif


    {{-- Lihat --}}
    <a href="{{ route('direktur.artworks.show', $artwork) }}"
       class="btn btn-success btn-sm">
        <i class="fas fa-eye"></i>
    </a>
</td>

                </tr>

            @empty
                <tr>
                    <td colspan="8" class="text-center">
                        Tidak ada pemesanan artwork.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection