<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('direktur.dashboard') }}" class="brand-link">
        <img src="{{ asset('admin/dist/img/artifact.jpg') }}" 
             class="brand-image img-circle elevation-3" alt="Logo">
        <span class="brand-text font-weight-light">POLARENGINE</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" role="menu">

                @auth
                @if(auth()->user()->role === 'direktur')
                    <li class="nav-header">DIREKTUR PANEL</li>

                    <li class="nav-item">
                        <a href="{{ route('direktur.dashboard') }}"
                           class="nav-link {{ request()->routeIs('direktur.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('direktur.artworks.index') }}"
                           class="nav-link {{ request()->routeIs('direktur.artworks.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-paint-brush"></i>
                            <p>Manajemen Artworks</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('direktur.reports.index') }}"
                           class="nav-link {{ request()->routeIs('direktur.reports.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-chart-line"></i>
                            <p>Laporan</p>
                        </a>
                    </li>
                @endif
                @endauth

                <li class="nav-header">AKUN</li>

                <li class="nav-item">
                    <a href="{{ route('profile.edit') }}"
                       class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Profil</p>
                    </a>
                </li>

                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link text-left">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Logout</p>
                        </button>
                    </form>
                </li>

            </ul>
        </nav>
    </div>
</aside>
