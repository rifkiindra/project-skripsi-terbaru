<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Dashboard')</title>

  <!-- Fonts & Core CSS -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/chat-user.css') }}">


  {{-- CSS KHUSUS HALAMAN --}}
  @stack('member-css')
</head>

<body class="hold-transition sidebar-mini @yield('body-class')">
<div class="wrapper">

  {{-- Navbar & Sidebar --}}
  @include('components.member.navbar')
  @include('components.adminlte.sidebar')

  {{-- Content --}}
  <div class="content-wrapper">
   {{-- @include('partials.content-header') --}}


    <section class="content">
      <div class="container-fluid mt-3">
        @yield('content')
      </div>
    </section>
  </div>

</div>

<!-- Core JS -->
<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('js/chat-user.js') }}"></script>

{{-- ⚠️ Bootstrap CDN optional (boleh dihapus jika tidak perlu) --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

{{-- ✅ JS KHUSUS ADMIN CHAT --}}
@stack('member-js')

</body>
</html>
