@extends('layouts.landing')

@section('title', 'Karya Kami')

@section('content')

<link rel="stylesheet" href="{{ asset('landing/css/karyakami.css') }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

<section class="works-section">

    <!-- BACKGROUND PREVIEW (FULLSCREEN BEHIND TEXT) -->
    <div class="work-preview">
        <img id="preview-image" src="{{ asset('landing/images/Call for Backup.webp') }}" alt="preview">
    </div>

    <!-- TEXT CENTERED -->
    <div class="work-list">

        <div class="work-item" data-image="{{ asset('landing/images/Call for Backup.webp') }}"
        onclick="window.location.href='{{ url('karya/flashandblood') }}'">
        <span class="text-base">FLASH AND BLOOD</span>
        <span class="text-ghost">FLASH AND BLOOD</span>
        </div>

        <div class="work-item" data-image="{{ asset('landing/images/Hun Batz.webp') }}"
        onclick="window.location.href='{{ url('karya/smite') }}'">
        <span class="text-base">SMITE</span>
        <span class="text-ghost">SMITE</span>
        </div>

        <div class="work-item" data-image="{{ asset('landing/images/mobilelegend.webp') }}"
        onclick="window.location.href='{{ url('karya/capcom') }}'">
        <span class="text-base">CAPCOM</span>
        <span class="text-ghost">CAPCOM</span>
        </div>

        <div class="work-item" data-image="{{ asset('landing/images/royalclass.webp') }}"
        onclick="window.location.href='{{ url('karya/fablecraft') }}'">
        <span class="text-base">FABLECRAFT</span>
        <span class="text-ghost">FABLECRAFT</span>
        </div>
    </div>


</section>


{{-- Load khusus --}}
<link rel="stylesheet" href="{{ asset('landing/css/karyakami.css') }}">
<script src="{{ asset('landing/js/karyakami.js') }}"></script>
@endsection
