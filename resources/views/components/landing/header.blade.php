<header id="header" class="site-header sticky-header">
    <nav id="header-nav" class="navbar navbar-expand-lg py-3">
        <div class="container d-flex align-items-center justify-content-between">

    <!-- LEFT LOGO -->
    <a class="navbar-brand me-4" href="{{ route('landing.index') }}">
        <img src="{{ asset('landing/images/main-logo.png') }}" class="logo img-fluid" style="max-height: 70px;">
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
        <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}"
            href="{{ route('landing.contact') }}">Contact</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->is('features') ? 'active' : '' }}"
            href="{{ route('landing.features') }}">Karya Kami</a>
    </li>

</ul>


    <!-- RIGHT AUTH BUTTON -->
    <div class="d-none d-lg-flex align-items-center">
        @auth
            <a href="{{ url('admin/dashboard') }}" class="btn btn-primary px-4 py-2 me-2">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary px-4 py-2 me-2">Log In</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn btn-secondary px-4 py-2">Register</a>
            @endif
        @endauth
    </div>

    <!-- MOBILE TOGGLE -->
    <button class="navbar-toggler d-flex d-lg-none order-3 p-2" type="button"
        data-bs-toggle="offcanvas" data-bs-target="#bdNavbar">
        <svg class="navbar-icon"><use xlink:href="#navbar-icon"></use></svg>
    </button>

</div>

    </nav>
</header>
