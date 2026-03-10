@extends('layouts.landing')
@section('title', 'Contact — POLARENGINE')

@push('styles')
<link rel="stylesheet" href="{{ asset('landing/css/contact.css') }}">
@endpush

@section('content')

<div class="contact-hero">

    <h1 class="contact-title">CONTACT</h1>
    <p class="contact-subtitle">Let’s build something great together.</p>

    <div class="contact-wrapper">

        {{-- LEFT CONTACT INFO --}}
        <div class="contact-info">
            <h3 class="info-title">Contact Information</h3>

            <p class="info-item">
                📧 <strong>Email:</strong> perpustakaan@nurlfki.ac.id
            </p>

            <p class="info-item">
                📞 <strong>Telepon:</strong> +62 (21) 123-4567
            </p>

            <p class="info-item">
                📍 <strong>Alamat:</strong> Perum Paradise, Mlati, Sleman
            </p>
        </div>

        {{-- RIGHT CONTACT FORM --}}
        <form class="contact-form">
            <label>Nama</label>
            <input type="text" placeholder="Nama Anda">

            <label>Email</label>
            <input type="email" placeholder="Email Anda">

            <label>Pesan</label>
            <textarea rows="5" placeholder="Pesan Anda"></textarea>

            <button class="contact-btn">Kirim Pesan</button>
        </form>

    </div>

</div>

@endsection

@push('scripts')
<script src="{{ asset('landing/js/contact.js') }}"></script>
@endpush
