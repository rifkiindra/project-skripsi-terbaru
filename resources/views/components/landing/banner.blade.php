@extends('landing.layout')

@section('content')

<link rel="stylesheet" href="{{ asset('landing/css/home.css') }}">
<script defer src="{{ asset('landing/js/home.js') }}"></script>

<div class="home-container">

    {{-- BACKGROUND VIDEO / IMAGE --}}
    <div class="home-bg">
        <video src="{{ asset('landing/videos/bg.mp4') }}" autoplay muted loop playsinline></video>
        {{-- kalau mau pakai gambar tinggal ganti img --}}
        {{-- <img src="{{ asset('landing/images/bg.jpg') }}"> --}}
    </div>

    {{-- MAIN TITLE --}}
    <h1 class="home-title">POLARENGINE</h1>

    {{-- SUBTITLE --}}
    <h2 class="home-sub">ILLUSTRATION AND CONCEPT ARTIST</h2>

    {{-- SLIDER / SHOWCASE --}}
    <div class="home-slider">
        <div class="slide-track">

            <div class="slide">
                <img src="{{ asset('landing/images/sample1.jpg') }}">
            </div>

            <div class="slide">
                <img src="{{ asset('landing/images/sample2.jpg') }}">
            </div>

            <div class="slide">
                <img src="{{ asset('landing/images/sample3.jpg') }}">
            </div>

            <div class="slide">
                <img src="{{ asset('landing/images/sample4.jpg') }}">
            </div>

        </div>
    </div>

</div>

@endsection
