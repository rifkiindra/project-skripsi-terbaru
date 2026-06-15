@extends('layouts.landing')

@section('title', 'Flashandblood Project')

@section('content')

<link rel="stylesheet" href="{{ asset('landing/css/fab.css') }}">

<section class="works-hero">
    <div class="works-hero-inner">
        <h1 class="works-title">CAPCOM</h1>
        <p class="works-subtitle">
            Every man is the builder of a temple, called his body, to the god he worships, after a style purely his own, nor can he get off by hammering marble instead. We are all sculptors and painters, and our material is our own flesh and blood and bones. Any nobleness begins at once to refine a man's features, any meanness or sensuality to imbrute them.
        </p>
    </div>
</section>


<section class="works-grid">

    <div class="work-card" data-title="BARETTA">
        <img src="{{ asset('landing/images/Baretta.webp') }}" alt="">
        <div class="work-overlay"></div>
        <div class="work-title">BARETTA</div>
    </div>

    <div class="work-card" data-title="BISON">
        <img src="{{ asset('landing/images/Bison.webp') }}" alt="">
        <div class="work-overlay"></div>
        <div class="work-title">BISON</div>
    </div>

    <div class="work-card" data-title="KEN">
        <img src="{{ asset('landing/images/Ken.webp') }}" alt="">
        <div class="work-overlay"></div>
        <div class="work-title">KEN</div>
    </div>

</section>
<div id="lightbox" class="lightbox">
    <div class="lightbox-ui top-left">
        <span class="lightbox-meta">
            ART DIRECTION: MARKO DJURDJEVIC & JELENA KEVIC DJURDJEVIC<br>
            ARTIST: RICARDO PADIERNE SILVERA
        </span>
    </div>

    <div class="lightbox-counter" id="lightboxCounter">01 / 03</div>

    <img id="lightboxImage" src="">

    <div class="lightbox-controls">
        <button id="prevBtn">←</button>
        <button id="nextBtn">→</button>
    </div>

    <div class="lightbox-close" id="closeLightbox">✕</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>                   
<script src="{{ asset('landing/js/fab.js') }}"></script>
@endsection
