@extends('layouts.adminlte')

@section('title', 'Cari Artwork')
@section('page-title', 'Daftar Artwork')

@section('content')
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Judul Artwork</th>
                    <th>Klien</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
@if($artworks->count())
    @foreach ($artworks as $artwork)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $artwork->judul }}</td>
            <td>{{ $artwork->member->nama ?? '-' }}</td>
            <td>
                <a href="{{ route('member.artworks.show', $artwork->id) }}"
                   class="btn btn-sm btn-primary">
                   Detail
                </a>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="4" class="text-center text-muted">
            Anda belum memiliki pesanan artwork.
        </td>
    </tr>
@endif
</tbody>

        </table>
    </div>
</div>
@endsection
