@extends('layouts.direktur')

@section('title', 'Assign Tim')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Assign Tim ke Artwork</h5>
    </div>

    <div class="card-body">

        <p><strong>Judul Artwork:</strong> {{ $artwork->judul }}</p>
        <p><strong>Klien:</strong> {{ $artwork->member->nama ?? '-' }}</p>

        <form method="POST" action="{{ route('direktur.artworks.assignTim', $artwork->id) }}">
            @csrf

            <div class="form-group">
                <label>Pilih Tim</label>
                <select name="team_id" class="form-control" required>
                    <option value="">-- Pilih Tim --</option>
                    @foreach ($teams as $team)
                        <option value="{{ $team->id }}">
                            {{ $team->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">
                Simpan
            </button>

            <a href="{{ route('direktur.artworks.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </form>
    </div>
</div>
@endsection
