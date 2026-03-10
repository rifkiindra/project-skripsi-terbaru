<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased relative min-h-screen overflow-hidden">

    {{-- 🔹 Video Background --}}
    <video autoplay muted loop playsinline class="absolute top-0 left-0 w-full h-full object-cover z-0">
        <source src="{{ asset('videos/bg-motion.mp4') }}" type="video/mp4">
        Your browser does not support HTML5 video.
    </video>

    {{-- 🔹 Overlay gelap agar teks tetap jelas --}}
    <div class="absolute inset-0 bg-black bg-opacity-60 z-10"></div>

    {{-- 🔹 Konten Utama --}}
    <div class="relative z-20 flex items-center justify-center min-h-screen">
        <div class="w-full max-w-md px-6 py-8 bg-gray-900 bg-opacity-10 backdrop-blur-md rounded-2xl shadow-lg">
            <div class="text-center mb-6">
                <h1 class="text-3xl font-bold text-white tracking-widest">POLAR ENGINE STUDIO LOGIN</h1>
                <p class="text-gray-300 mt-2">Masuk untuk melanjutkan ke dunia ilustrasi</p>
            </div>

            {{ $slot }}
        </div>
    </div>

</body>
</html>
