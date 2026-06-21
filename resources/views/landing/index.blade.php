@extends('layouts.landing')

@section('title', 'Polar Engine')

@section('content')

<link rel="stylesheet" href="{{ asset('landing/css/home.css') }}">

<!-- ================= HERO ================= -->
<section class="hero-container">
    <img src="{{ asset('images/home.webp') }}" class="hero-bg" alt="Hero">

    <div class="hero-overlay"></div>

    <div class="hero-content reveal">
        <h1>POLAR ENGINE</h1>
        <p>Creative Visual Development Studio</p>
        <a href="#category" class="btn-explore magnetic" id="exploreBtn">Explore</a>    </div>
</section>

<!-- ================= OUR WORLD ================= -->
<section class="section dark text-center reveal">
    <div class="container">
        <h2 class="title">OUR WORLD</h2>
        <p class="subtitle">
            A visual development studio focused on top-tier art production,
            character design, storytelling, and cinematic worldbuilding.
        </p>
    </div>
</section>

<!-- ================= CATEGORY ================= -->
<section class="category-section" id="category">
    <div class="container">

        <h2 class="title text-center reveal">Explore Our Work</h2>

        <div class="category-grid">

            <!-- Concept Art -->
            <div class="category-card reveal" data-category="concept">
    <img src="{{ asset('images/concept.webp') }}">
    <div class="overlay">
        <h3>Concept Art Film</h3>
    </div>
</div>

<div class="category-card reveal" data-category="game">
    <img src="{{ asset('images/game.webp') }}">
    <div class="overlay">
        <h3>Ilustrasi Game</h3>
    </div>
</div>

<div class="category-card reveal" data-category="splash">
    <img src="{{ asset('images/splash.webp') }}">
    <div class="overlay">
        <h3>Splash Art</h3>
    </div>
</div>

        </div>
    </div>
</section>

<section class="gallery-section" id="gallery">
    <div class="container">

        <h2 class="title text-center">Gallery</h2>

        <div class="gallery-grid" id="galleryGrid">
            <!-- isi dari JS -->
        </div>

    </div>
</section>
<!-- ================= CLIENT ================= -->
<section class="section dark text-center">
    <div class="container">
        <h2 class="title reveal">CLIENTS</h2>

        <div class="marquee">
            <div class="marquee-content">
                @for ($i=1; $i<=10; $i++)
                    <img src="{{ asset('images/smith.webp') }}">
                    <img src="{{ asset('images/runeterra.webp') }}">
                    <img src="{{ asset('images/lodc.webp') }}">
                @endfor
            </div>
        </div>
    </div>
</section>

<script src="{{ asset('landing/js/home.js') }}"></script>

@endsection