<header id="header" class="site-header sticky-header">
    <nav id="header-nav" class="navbar navbar-expand-lg py-3">
        <div class="container d-flex align-items-center justify-content-between">

    <!-- LEFT LOGO -->
    <a class="navbar-brand me-4" href="{{ route('landing.index') }}">
        <img src="{{ asset('landing/images/main-logo.webp') }}" class="logo img-fluid" style="max-height: 70px;">
    </a>

<!-- NAVIGATION (DESKTOP ONLY) -->
<ul id="navbar"
    class="navbar-nav centered d-none d-lg-flex flex-row gap-5 text-uppercase">

    <li class="nav-item">
        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}"
            href="{{ route('landing.index') }}">Home</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->is('about') ? 'active' : '' }}"
            href="{{ route('landing.about') }}">About</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->is('features') ? 'active' : '' }}"
            href="{{ route('landing.features') }}">Karya Kami</a>
    </li>

</ul>

    <!-- RIGHT AUTH BUTTON -->
    <div class="auth-buttons d-none d-lg-flex align-items-center">
        @auth
            <a href="{{ url('admin/dashboard') }}" class="btn btn-primary px-4 py-2 me-2">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary px-4 py-2 me-2">Log In</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn btn-secondary px-4 py-2">Register</a>
            @endif
        @endauth
    </div>

   <!-- HAMBURGER -->
    <div id="menuToggle" class="menu-toggle d-lg-none">
        <span></span>
        <span></span>
    </div>

</div>
</nav>

<!-- MOBILE MENU -->
<div id="mobileMenu" class="mobile-menu d-lg-none">
    <a href="{{ route('landing.about') }}">About</a>    <a href="{{ route('landing.features') }}">Karya Kami</a>

    <div class="mobile-auth">
        @auth
            <a href="{{ url('admin/dashboard') }}" class="btn-auth primary">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="btn-auth">Login</a>
            <a href="{{ route('register') }}" class="btn-auth primary">Register</a>
        @endauth
    </div>
</div>

<!-- OVERLAY -->
<div id="menuOverlay" class="menu-overlay"></div>

</header>
