<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title', 'Polar Engine Studio')</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">    

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('landing/css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/footer.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('landing/images/logo.png') }}">
    

    <!-- CUSTOM CSS -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #0d0d0d;
            overflow-x: hidden;
        }

        /* FIX TITIK-TITIK */
        ul, ol {
            list-style: none;
            padding-left: 0;
            margin: 0;
        }

        header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 99;
            padding: 20px 50px;
            transition: 0.3s;
        }

        header.scrolled {
            background: rgba(0,0,0,0.7);
            backdrop-filter: blur(10px);
        }
    </style>

    @stack('styles')
</head>

<body>

@include('components.landing.symbol-svg')

<header id="mainHeader">
    @include('components.landing.header')
</header>

<main>
    @yield('content')
</main>

@include('components.landing.footer')

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('landing/js/header.js') }}"></script>
<script src="{{ asset('landing/js/navbar.js') }}" defer></script>

<script>
window.addEventListener("scroll", () => {
    document.getElementById("mainHeader")
        .classList.toggle("scrolled", window.scrollY > 50);
});
</script>

@stack('scripts')

</body>
</html>