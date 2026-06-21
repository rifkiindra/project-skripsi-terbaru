@extends('layouts.tim')

@section('title','Dashboard Tim')

@section('content')
<div class="card">
    <div class="card-header bg-info text-white">
        <strong>Proyek Saya</strong>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Judul Artwork</th>
                    <th>Klien</th>
                    <th>Status</th>
                    <th>Uploaded</th>
                    <th width="120">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($artworks as $artwork)
                <tr>
                    <td>{{ $artwork->judul ?? '-' }}</td>
                    <td>{{ $artwork->member->nama ?? '-' }}</td>
                    <td>
                        <span class="badge badge-info">
                            {{ strtoupper($artwork->status) }}
                        </span>
                    </td>
                   <td>
@if($artwork->progresses->first())

    {{ $artwork->progresses->first()->created_at->diffForHumans() }}
    <br>
    <small class="text-muted">
        {{ $artwork->progresses->first()->created_at->format('d M Y H:i') }}
    </small>

@else
    <span class="text-muted">Belum ada progress</span>
@endif
</td>

                    <td>
                        <a href="{{ route('tim.artworks.show', $artwork->id) }}"
                           class="btn btn-sm btn-primary">
                           Kerjakan
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">
                        Belum ada proyek
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
