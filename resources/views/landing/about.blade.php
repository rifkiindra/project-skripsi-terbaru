@extends('layouts.landing')

@section('title', 'About Us')

@section('content')

<link rel="stylesheet" href="{{ asset('landing/css/about.css') }}">

<!-- HEADER -->
<section class="about-banner"> 
    <div class="container text-center">
        <h1 class="about-title">Tentang Kami</h1> 
        <p class="about-subtitle">Selamat datang di Polar Engine Studio</p>
    </div> 
</section>

<!-- VISI MISI -->
<section class="about-section">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-md-6" data-aos="fade-right">
                <img src="{{ asset('landing/images/studio.webp') }}" 
                     class="about-img"
                     alt="Visi Misi">
            </div>

            <div class="col-md-6" data-aos="fade-left">
                <h2 class="section-title">Visi & Misi</h2>

                <h4 class="accent">Visi</h4>
                <p>
                    Menjadi studio kreatif digital yang menghasilkan karya visual
                    berstandar internasional dengan pendekatan artistik sinematik.
                </p>

                <h4 class="accent mt-4">Misi</h4>
                <ul class="about-list">
                    <li>Mengembangkan ilustrasi dan desain visual berkualitas tinggi</li>
                    <li>Menggabungkan teknologi modern dengan kreativitas</li>
                    <li>Memberikan solusi visual profesional</li>
                    <li>Membangun studio yang inovatif & kolaboratif</li>
                </ul>
            </div>

        </div>
    </div>
</section>

<!-- STORY -->
<section class="about-section dark">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-md-6" data-aos="fade-right">
                <h2 class="section-title">Perjalanan Kami</h2>
                <p>
                    Polar Engine Studio adalah ruang kreatif yang menggabungkan seni digital dan teknologi.
                    Kami terinspirasi oleh visual storytelling sinematik untuk menciptakan karya yang kuat dan berkarakter.
                </p>
                <p>
                    Berawal dari lingkungan kampus, kami berkembang menjadi tim kreatif yang terus berinovasi
                    dalam dunia ilustrasi dan digital experience.
                </p>
            </div>

            <div class="col-md-6" data-aos="fade-left">
                <img src="{{ asset('landing/images/studio.webp') }}" 
                     class="about-img" 
                     alt="Studio">
            </div>

        </div>
    </div>
</section>

<!-- TEAM -->
<section class="team-section">
    <div class="container text-center">
        <h2 class="section-title">Tim Kami</h2>

        @php
            $tim = [
                ['name' => 'Fajar Eka Setiawan', 'role' => 'Direktur Polar Engine Jogja', 'img' => 'man1.webp'],
                ['name' => 'Rizky Amelia Putri', 'role' => 'Finance Direktur', 'img' => 'wom.webp'],
                ['name' => 'Ilyas Abdul Aziz', 'role' => 'Ilustrator', 'img' => 'man3.webp'],
                ['name' => 'Afif Naufal', 'role' => 'Ilustrator', 'img' => 'man4.webp'],
                ['name' => 'Deden Rafi Akbar', 'role' => 'Ilustrator', 'img' => 'man5.webp'],
                ['name' => 'Fajar Nurzaman', 'role' => 'Ilustrator', 'img' => 'man6.webp'],
            ];
        @endphp

        <div class="row g-4 justify-content-center mt-4">

            @foreach ($tim as $member)
                <div class="col-md-4 col-lg-3 team-card" data-aos="zoom-in">
                    <div class="team-img">
                        <img src="{{ asset('landing/images/' . $member['img']) }}" alt="{{ $member['name'] }}">
                    </div>
                    <h5>{{ $member['name'] }}</h5>
                    <p>{{ $member['role'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<script src="{{ asset('landing/js/about.js') }}"></script>

@endsection