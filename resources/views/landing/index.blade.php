@extends('layouts.landing')

@section('title', 'Polar Engine')

@section('content')

<link rel="stylesheet" href="{{ asset('landing/css/home.css') }}">

<!-- ================= HERO VIDEO ================= -->
<div class="hero-container">
    <div class="scroll-video">
        <video autoplay muted loop playsinline>
            <source src="{{ asset('videos/huhuhu.mp4') }}" type="video/mp4">
        </video>
    </div>

    <div class="hero-title">
        POLAR ENGINE
    </div>
</div>

<!-- ================= OUR WORLD ================= -->
<section class="py-5" data-aos="fade-up">
    <div class="container text-center">
        <h2 class="display-3 fw-bold" style="font-family: 'Anton'">OUR WORLD</h2>
        <p class="lead mt-4 text-white-50 w-75 mx-auto">
            A visual development studio focused on top-tier art production, character design, 
            storytelling, and cinematic worldbuilding.  
        </p>
    </div>
</section>

<!-- ================= STUDIO ================= -->
<section class="py-5" data-aos="fade-up">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-md-6">
                <h2 class="display-4 fw-bold" style="font-family: 'Anton'">OUR STUDIO</h2>
                <p class="mt-3 text-white-50">
                    We build worlds, characters, and cinematic universes through high-end illustration, 
                    concept design, and narrative creativity.  
                    <br><br>
                    Our team collaborates across disciplines to create cohesive visual language and 
                    storytelling identity for studios, games, and entertainment brands.
                </p>
            </div>

            <div class="col-md-6">
                <img src="https://picsum.photos/900/600" class="w-100 rounded shadow">
            </div>

        </div>
    </div>
</section>

<!-- ================= PRODUCTION PIPELINE ================= -->
<section class="py-5" data-aos="fade-up">
    <div class="container">
        <h2 class="display-4 fw-bold text-center mb-5" style="font-family: 'Anton'">PRODUCTION PIPELINE</h2>

        @php
            $pipeline = [
                "Concept & Moodboarding",
                "Character Exploration",
                "Environment & Props",
                "Key Illustration Frames",
                "Final Rendering",
                "Post-Production Polish",
            ];
        @endphp

        <div class="row g-4">
            @foreach ($pipeline as $step)
                <div class="col-md-4">
                    <div class="p-4 border rounded-3 text-center h-100"
                         style="background:#111; border-color:#333;">
                        <h4 class="fw-bold mb-3" style="font-family: 'Anton'">{{ $step }}</h4>
                        <p class="text-white-50">
                            High-level production workflow ensuring quality, consistency and visual direction clarity.
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ================= CLIENT STRIP ================= -->
<section class="py-5">
    <div class="container text-center">
        <h2 class="fw-bold mb-4" style="font-family: 'Anton'">CLIENTS</h2>

        <div class="d-flex flex-wrap justify-content-center gap-4 opacity-75">
            @for ($i=1; $i<=8; $i++)
            <img src="https://dummyimage.com/150x70/777/fff&text=LOGO+{{ $i }}"
                 style="height: 70px;">
            @endfor
        </div>
    </div>
</section>

<!-- ================= TEAM FOOTER BANNER ================= -->
<section style="position:relative; height:60vh; overflow:hidden; margin-top:80px;">
    <img src="https://picsum.photos/1900/900" 
         class="w-100 h-100" 
         style="object-fit:cover; filter:brightness(0.5);">

    <div class="position-absolute top-50 start-50 translate-middle text-center">
        <h1 class="display-2 fw-bold" style="font-family:'Anton'; letter-spacing:3px;">
            JOIN THE TEAM
        </h1>
        <p class="text-white-50 mt-3">
            We are always looking for passionate artists and creators.
        </p>
    </div>
</section>

@endsection
