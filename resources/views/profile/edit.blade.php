@extends('layouts.app') {{-- ganti sesuai layout Anda --}}
@section('title', 'Profile')

@push('styles')
<link rel="stylesheet" href="{{ asset('landing/css/profile.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
@endpush

@section('content')

<div class="profile-container">

    {{-- PROFIL HEADER --}}
    <div class="profile-header">
        <img src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.Auth::user()->name }}"
             class="profile-avatar">

        <div class="profile-basic">
            <h2>{{ Auth::user()->name }}</h2>
            <p class="email">{{ Auth::user()->email }}</p>
            <span class="role">{{ Auth::user()->role ?? 'User' }}</span>
        </div>
    </div>

    {{-- KONTEN UTAMA --}}
    <div class="profile-content">

        {{-- Left Card - Personal Info --}}
        <div class="profile-card">
            <h3>Personal Information</h3>

            <div class="info-row">
                <label>Nama Lengkap</label>
                <p>{{ Auth::user()->name }}</p>
            </div>

            <div class="info-row">
                <label>Email</label>
                <p>{{ Auth::user()->email }}</p>
            </div>

            <div class="info-row">
                <label>Member Sejak</label>
                <p>{{ Auth::user()->created_at->format('d M Y') }}</p>
            </div>

            <button class="btn-edit" onclick="openEditModal()">Edit Profile</button>
        </div>

        

        {{-- Right Card - Security --}}
        <div class="profile-card">
            <h3>Security Settings</h3>

            <div class="info-row">
                <label>Password</label>
                <p>********</p>
            </div>

            <button class="btn-password">Ubah Password</button>
        </div>

    </div>

</div>

@endsection
{{-- MODAL EDIT PROFILE --}}
<div id="editModal" class="modal">
    <div class="modal-content">
        <h3>Edit Profile</h3>
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Upload Foto --}}
            <label>Foto Profile</label>
            <input type="file" name="profile_photo" class="input">

            {{-- Nama --}}
            <label>Nama Lengkap</label>
            <input type="text" name="name" class="input"
                value="{{ Auth::user()->name }}" required>

            {{-- Email --}}
            <label>Email</label>
            <input type="email" name="email" class="input"
                value="{{ Auth::user()->email }}" required>

            <button type="submit" class="btn-submit">Simpan Perubahan</button>
            <button type="button" class="btn-close" onclick="closeEditModal()">Batal</button>
        </form>
    </div>
</div>

{{-- MODAL UBAH PASSWORD --}}
<div id="passwordModal" class="modal">
    <div class="modal-content">
        <h3>Ubah Password</h3>
        <form action="{{ route('profile.password.update') }}" method="POST">
            @csrf
            @method('PUT')

            <label>Password Lama</label>
            <input type="password" name="current_password" class="input" required>

            <label>Password Baru</label>
            <input type="password" name="password" class="input" required>

            <label>Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" class="input" required>

            <button type="submit" class="btn-submit">Update Password</button>
            <button type="button" class="btn-close" onclick="closePasswordModal()">Batal</button>
        </form>
    </div>
</div>

@push('scripts')
<script src="{{ asset('landing/js/profile.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
@endpush
