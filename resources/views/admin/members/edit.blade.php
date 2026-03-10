@extends('layouts.adminlte')

@section('title', 'Edit Anggota')

@section('page-title', 'Edit Anggota')

@section('content')
<div class="card">
    <div class="card-body">

        {{-- Menampilkan error validasi di atas form --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.members.update', $member->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Input Nama --}}
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama"
                    class="form-control @error('nama') is-invalid @enderror"
                    value="{{ old('nama', $member->nama) }}"
                    placeholder="Masukkan nama anggota" required>
                @error('nama')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- Input Email --}}
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email', $member->email) }}"
                    placeholder="Masukkan email anggota" required>
                @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- Input Telepon --}}
            <div class="form-group">
                <label for="telepon">No Telepon</label>
                <input type="text" name="telepon" id="telepon"
                    class="form-control @error('telepon') is-invalid @enderror"
                    value="{{ old('telepon', $member->telepon) }}"
                    placeholder="Masukkan nomor telepon" required>
                @error('telepon')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- Input Alamat --}}
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="alamat"
                    class="form-control @error('alamat') is-invalid @enderror"
                    placeholder="Masukkan alamat anggota" required>{{ old('alamat', $member->alamat) }}</textarea>
                @error('alamat')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- 🔥 INPUT ROLE USER --}}
            <div class="form-group">
                <label for="role">Role Akun</label>
                <select name="role" id="role"
                    class="form-control @error('role') is-invalid @enderror" required>
                    <option value="direktur"
                        {{ old('role', $member->user->role) === 'direktur' ? 'selected' : '' }}>
                        Direktur
                    </option>
                    <option value="admin"
                        {{ old('role', $member->user->role) === 'admin' ? 'selected' : '' }}>
                        Admin
                    </option>
                    <option value="tim"
                        {{ old('role', $member->user->role) === 'tim' ? 'selected' : '' }}>
                        Tim
                    </option>
                    <option value="member"
                        {{ old('role', $member->user->role) === 'member' ? 'selected' : '' }}>
                        Member
                    </option>
                </select>
                @error('role')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- Tombol --}}
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Simpan
            </button>
            <a href="{{ route('admin.members.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </form>
    </div>
</div>
@endsection
