<!DOCTYPE html>
<html lang="en">
<head>
     <title>@yield('title', 'Artworkly - Artworkstore eCommerce Website Template')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <!-- Custom Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/css/style.css') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('landing/css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/header.css') }}">
    

    <!-- CUSTOM CSS -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #0d0d0d;
            overflow-x: hidden;
        }

        /* HEADER */
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 99;
            padding: 20px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: 0.4s;
        }
        header.scrolled {
            background: rgba(0,0,0,0.75);
            backdrop-filter: blur(10px);
            padding: 12px 50px;
        }
        header a {
            color: #fff;
            font-weight: 700;
            margin-left: 20px;
        }

        /* HERO */
        .hero-container {
            position: relative;
            height: 100vh;
            width: 100%;
            overflow: hidden;
        }
        .scroll-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }
        .scroll-video video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transform: scale(1);
        }

        .hero-title {
            font-family: 'Anton', sans-serif;
            font-size: 6rem;
            color: #fff;
            letter-spacing: 3px;
            text-align: center;
            position: absolute;
            top: 40%;
            width: 100%;
        }

        /* SECTION SPACING */
        section {
            padding: 120px 0;
            color: #fff;
        }
    </style>

    @stack('styles')
</head>

<script src="{{ asset('landing/js/navbar.js') }}"></script>

<body>

    <!-- Symbol SVG -->
    @include('components.landing.symbol-svg')

    <!-- Preloader -->
    @include('components.landing.preloader')

    <!-- Search Popup -->
    @include('components.landing.search-popup')

    <!-- Header -->
    <header>
        @include('components.landing.header')
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        @include('components.landing.footer')
    </footer>


<!-- JS -->
<script src="{{ asset('landing/js/jquery-1.11.0.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="{{ asset('landing/js/script.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('landing/js/header.js') }}" defer></script>

    <script>
       AOS.init();
    </script>
    <!-- GSAP (ADD THIS) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script>

// HEADER SCROLL EFFECT
window.addEventListener("scroll", () => {
    const header = document.getElementById("mainHeader");
    header.classList.toggle("scrolled", window.scrollY > 50);
});

gsap.registerPlugin(ScrollTrigger);

// ZOOM VIDEO
gsap.to(".scroll-video video", {
    scale: 3.3,
    scrollTrigger: {
        trigger: ".hero-container",
        start: "top top",
        end: "bottom top",
        scrub: true
    }
});

// FADE OUT TEXT
gsap.to(".hero-title", {
    opacity: 0,
    y: -150,
    scrollTrigger: {
        trigger: ".hero-container",
        start: "top top",
        end: "bottom top",
        scrub: true
    }
});
</script>

@stack('scripts')

</body>
</html>
