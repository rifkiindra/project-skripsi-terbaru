<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Dashboard')</title>

    <!-- FAVICON -->
  <link rel="icon" type="image/png" href="{{ asset('landing/images/logo.png') }}?v=99">
  <link rel="shortcut icon" href="{{ asset('landing/images/logo.png') }}?v=99">

  <!-- Fonts & Core CSS -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <!-- CHAT ADMIN -->
  <link rel="stylesheet" href="{{ asset('admin/css/chat.css') }}">

  <!-- GLOBAL CHAT (HAPUS PESAN, DROPDOWN) -->
  <link rel="stylesheet" href="{{ asset('css/chat.css') }}">


  {{-- CSS KHUSUS HALAMAN --}}
  @stack('admin-css')
</head>

<body class="hold-transition sidebar-mini @yield('body-class')">
<div class="wrapper">

  {{-- Navbar & Sidebar --}}
  @include('components.adminlte.navbar')
  @include('components.adminlte.sidebar')

  {{-- Content --}}
  <div class="content-wrapper">
    @include('partials.content-header')

    <section class="content">
      <div class="container-fluid mt-3">
        @yield('content')
      </div>
    </section>
  </div>

  {{-- Footer --}}
  @include('components.adminlte.footer')

</div>

<!-- Core JS -->
<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>

{{-- ⚠️ Bootstrap CDN optional (boleh dihapus jika tidak perlu) --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


{{-- ✅ JS KHUSUS ADMIN CHAT --}}
@stack('admin-js')

</body>
</html>
