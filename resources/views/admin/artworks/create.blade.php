@extends('layouts.adminlte')

@section('title', 'Tambah Buku')

@section('page-title', 'Tambah Buku Baru')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.artworks.store') }}" 
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                <!-- Form Input Judul Buku -->
                <div class="form-group">
                    <label for="judul">JUDUL ARTWORKS</label>
                    <input type="text" name="judul" id="judul" class="form-control" placeholder="Masukkan judul artwork"
                        value="{{ old('judul') }}">
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

                {{-- Start --}}
            <div class="form-group">
                <label for="start">Start</label>
                <input type="date"
                       name="start"
                       id="start"
                       class="form-control @error('start') is-invalid @enderror"
                       value="{{ old('start') }}"
                       required>
                @error('start')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- Deadline --}}
            <div class="form-group">
                <label for="deadline">Deadline</label>
                <input type="date"
                       name="deadline"
                       id="deadline"
                       class="form-control @error('deadline') is-invalid @enderror"
                       value="{{ old('deadline') }}">
                @error('deadline')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- Status --}}
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status"
                        id="status"
                        class="form-control @error('status') is-invalid @enderror"
                        required>
                    <option value="sketsa" {{ old('status') == 'sketsa' ? 'selected' : '' }}>
                        Sketsa
                    </option>
                    <option value="color" {{ old('status') == 'color' ? 'selected' : '' }}>
                        Color
                    </option>
                    <option value="final" {{ old('status') == 'final' ? 'selected' : '' }}>
                        Final
                    </option>
                </select>
                @error('status')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- Upload hasil --}}
            <div class="form-group">
                <label for="hasil">Upload Hasil Artwork (Opsional)</label>
                <input type="file"
                       name="hasil"
                       id="hasil"
                       class="form-control @error('hasil') is-invalid @enderror"
                       accept="image/*">
                <small class="text-muted">
                    Kosongkan jika belum ada hasil. JPG, JPEG, PNG. Maks 2MB.
                </small>
                @error('hasil')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

                <!-- Tombol Submit -->
            <button type="submit" class="btn btn-primary">
                Simpan
            </button>
                <a href="{{ route('admin.artworks.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection
