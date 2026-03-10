@extends('layouts.landing')

@section('title', 'About Us')

@section('content')

<section class="about-banner"> 
    <div class="container py-5"> 
        <h1 class="text-center">Tentang Kami</h1> 
        <p class="text-center" data-aos="flip-left"> Selamat datang di Polar Engine Studio </p>
    </div> 
</section>
<style>

    /* --- Section Cinematic --- */
    .section-cinematic {
        padding: 100px 0;
        color: #fff;
        background: #ffffff;
    }

    .section-cinematic h2 {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 20px;
        text-transform: uppercase;
    }

    .section-cinematic p {
        font-size: 1.2rem;
        opacity: 0.9;
    }

    .team-section img {
        transition: 0.3s;
        border: 3px solid #fff;
    }

    .team-section img:hover {
        transform: scale(1.1);
    }

    .team-card h5 {
        color: #fff;
        margin-top: 10px;
        font-size: 1.2rem;
        text-transform: uppercase;
    }

    .team-card p {
        color: #aaa;
        margin: 0;
    }

    .team-section {
        background: #ffffff;
        padding: 100px 0;
    }

    .contact-section {
        background: #ffffff;
        color: #fff;
        padding: 100px 0;
    }
</style>

<!-- STORY SECTION -->
<section class="section-cinematic">
    <div class="container">
        <div class="row align-items-center">

            <!-- Gambar di kiri -->
            <div class="col-md-6 mb-4 mb-md-0" data-aos="fade-right">
                <img src="{{ asset('landing/images/studio.jpg') }}" 
                     class="img-fluid rounded-4 shadow-lg"
                     alt="Visi Misi">
            </div>

            <!-- Tulisan di kanan -->
            <div class="col-md-6 text-black" data-aos="fade-left">
                <h2 style="font-size: 3rem; font-weight: 700; text-transform: uppercase;">
                    Visi & Misi Kami
                </h2>

                <h4 class="mt-4" style="font-weight: 600; color: #ff6a00;">
                    Visi
                </h4>
                <p style="opacity: 0.9; font-size: 1.1rem;">
                    Menjadi studio kreatif digital yang menghasilkan karya visual
                    berstandar internasional dengan pendekatan artistik sinematik.
                </p>

                <h4 class="mt-4" style="font-weight: 600; color: #ff6a00;">
                    Misi
                </h4>

                <ul style="opacity: 0.9; font-size: 1.1rem; line-height: 1.7;">
                    <li>Mengembangkan ilustrasi, konsep karakter, dan desain visual berkualitas tinggi.</li>
                    <li>Menggabungkan teknologi modern dengan kreativitas artistik.</li>
                    <li>Memberikan solusi visual bagi industri akademik, kreatif, dan komersial.</li>
                    <li>Membangun ekosistem studio yang inovatif, kolaboratif, dan progresif.</li>
                </ul>
            </div>

        </div>
    </div>
</section>

<!-- STORY SECTION -->
<section class="section-cinematic">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6" data-aos="fade-right">
                <h2>Perjalanan Kami</h2>
                <p>
                    Polar Engine Studio adalah ruang kreatif yang berfokus pada perpaduan seni digital dan teknologi. Studio kami terinspirasi oleh dunia artis seperti SixMoreVodka—dengan fokus pada karakter, visual storytelling, dan desain yang sinematik.
                </p>
                <p>
                    Berawal dari lingkungan kampus, kami berkembang menjadi tim yang terus bereksperimen menciptakan konten visual, digital engine, serta platform kreatif yang dapat mendukung kebutuhan akademik dan komersial.
                </p>
            </div>
            <div class="col-md-6" data-aos="fade-left">
                <img src="{{ asset('landing/images/studio.jpg') }}" class="img-fluid rounded-4 shadow-lg" alt="Studio">
            </div>
        </div>
    </div>
</section>

<!-- TEAM SECTION (SIXMOREVODKA STYLE GRID) -->
<section class="team-section">
    <div class="container text-center mb-5">
        <h2 class="text-white" style="font-size: 3rem; text-transform: uppercase;">Tim Kami</h2>
    </div>

    <div class="container">
        <div class="row g-4 justify-content-center">

            @php
                $team = [
                    ['name' => 'Eko Haryono', 'role' => 'Kepala Perpustakaan', 'img' => 'man1.png'],
                    ['name' => 'Rehan Nurmishuari', 'role' => 'Staf Administrasi', 'img' => 'man2.png'],
                    ['name' => 'Ilyas Abdul Aziz', 'role' => 'Staf Layanan', 'img' => 'man3.png'],
                    ['name' => 'Afif Naufal', 'role' => 'Staf Layanan', 'img' => 'man4.png'],
                    ['name' => 'Deden Rafi Akbar', 'role' => 'Staf Copywriting', 'img' => 'man5.png'],
                    ['name' => 'Fajar Nurzaman', 'role' => 'Staf Copywriting', 'img' => 'man6.png'],
                ];
            @endphp

            @foreach ($team as $member)
                <div class="col-md-4 col-lg-3 text-center team-card" data-aos="zoom-in">
                    <img src="{{ asset('landing/images/' . $member['img']) }}" class="img-fluid rounded-circle mb-3" style="width: 150px; height:150px; object-fit:cover;" />
                    <h5>{{ $member['name'] }}</h5>
                    <p>{{ $member['role'] }}</p>
                </div>
            @endforeach

        </div>
    </div>
</section>

<!-- CONTACT -->
<section class="contact-section text-center">
    <div class="container">
        <h2 style="font-size: 2.5rem; text-transform: uppercase;">Hubungi Kami</h2>
        <p class="mt-3">Ada pertanyaan atau butuh bantuan? Tim kami siap membantu Anda.</p>
        {{-- <a href="{{ route('contact') }}" class="btn btn-light mt-3 px-4 py-2">Hubungi Kami</a> --}}
    </div>
</section>

@endsection
