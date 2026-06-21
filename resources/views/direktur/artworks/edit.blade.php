@extends('layouts.direktur')

@section('title', 'Edit Buku')

@section('page-title', 'Edit Buku')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('direktur.artworks.update', $artwork->id) }}" 
                method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Form Input Judul Buku -->
                <div class="form-group">
                    <label for="judul">Judul Pesanan Artworks</label>
                    <input type="text" name="judul" id="judul" class="form-control" placeholder="Masukkan judul buku"
                        value="{{ old('judul', $artwork->judul) }}">
                    @error('judul')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Form Input Klien -->
                <div class="form-group">
                    <label for="member_id">Nama Klien</label>
                    <select name="member_id" id="member_id"
                    class="form-control @error('member_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Klien --</option>
                    @foreach ($members as $member)
                        <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                            {{ $member->nama }}
                        </option>
                    @endforeach
                    </select>
                    @error('member_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Form Input Kategori -->
                <div class="form-group">
    <label for="kategori">KATEGORI</label>
    <select name="kategori" id="kategori" 
        class="form-control @error('kategori') is-invalid @enderror" required>
        
        <option value="">-- Pilih Kategori --</option>

        <option value="Concept Art Film" 
            {{ old('kategori') == 'Concept Art Film' ? 'selected' : '' }}>
            Concept Art Film
        </option>

        <option value="Ilustrasi Game" 
            {{ old('kategori') == 'Ilustrasi Game' ? 'selected' : '' }}>
            Ilustrasi Game
        </option>

        <option value="Splash Art" 
            {{ old('kategori') == 'Splash Art' ? 'selected' : '' }}>
            Splash Art
        </option>

    </select>

    @error('kategori')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

            {{-- START --}}
            <div class="form-group mt-3">
                <label for="start">Start</label>
                <input type="date"
                       name="start"
                       id="start"
                       class="form-control @error('start') is-invalid @enderror"
                       value="{{ old('start', $artwork->start) }}"
                       required>
                @error('start')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- DEADLINE --}}
            <div class="form-group mt-3">
                <label for="deadline">Deadline</label>
                <input type="date"
                       name="deadline"
                       id="deadline"
                       class="form-control @error('deadline') is-invalid @enderror"
                       value="{{ old('deadline', $artwork->deadline) }}">
                @error('deadline')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- STATUS --}}
<div class="form-group mt-3">
    <label for="status">Status</label>
    <select name="status"
            id="status"
            class="form-control @error('status') is-invalid @enderror"
            required>
        <option value="sketsa" @selected(old('status', $artwork->status) === 'sketsa')>
            Sketsa
        </option>
        <option value="color" @selected(old('status', $artwork->status) === 'color')>
            Color
        </option>
        <option value="final" @selected(old('status', $artwork->status) === 'final')>
            Final
        </option>
    </select>
    @error('status')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>


                <!-- Tombol Submit -->
                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                <a href="{{ route('direktur.artworks.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection
