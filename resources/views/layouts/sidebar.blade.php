@php
    $isAdmin = auth()->check() && auth()->user()->role === 'admin';
@endphp

{{-- ================= NAVBAR MOBILE ================= --}}
<nav class="navbar navbar-dark bg-dark d-md-none">
    <div class="container-fluid d-flex align-items-center">

        {{-- Toggle Button --}}
        <button class="btn btn-outline-light me-2" 
                type="button" 
                data-bs-toggle="offcanvas" 
                data-bs-target="#offcanvasSidebar">
            <i class="bi bi-list"></i>
        </button>

        {{-- Brand --}}
        @if($isAdmin)
            <a class="navbar-brand d-flex align-items-center mb-0 h1" 
               href="{{ route('admin.dashboard') }}">
        @else
            <a class="navbar-brand d-flex align-items-center mb-0 h1" 
               href="{{ route('user.dashboard') }}">
        @endif

            <img src="{{ asset('assets/logo_kominforb.png') }}" 
                 alt="Logo" width="30" height="30" class="me-2">
            <span>SiPeKa</span>
        </a>

    </div>
</nav>


{{-- ================= SIDEBAR DESKTOP ================= --}}
<div class="sidebar d-none d-md-block bg-dark text-white p-3" 
     style="width: 250px; min-height: 100vh;">

    {{-- Logo --}}
    <a href="{{ $isAdmin ? route('admin.dashboard') : route('user.dashboard') }}"
       class="d-flex align-items-center mb-3 text-white text-decoration-none">
        <img src="{{ asset('assets/logo_kominforb.png') }}" 
             alt="Logo" width="30" height="30" class="me-2">
        <h4 class="mb-0">SiPeKa</h4>
    </a>

    <hr class="text-secondary">

    <ul class="nav flex-column">

        {{-- ================= USER / GUEST ================= --}}
        @if(!$isAdmin)

            <li class="nav-item">
                <a href="{{ route('user.dashboard') }}"
                   class="nav-link text-white {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                   <i class="bi bi-house"></i> Beranda
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('tentang') }}"
                   class="nav-link text-white {{ request()->routeIs('tentang') ? 'active' : '' }}">
                   <i class="bi bi-info-circle"></i> Tentang
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ url('/tentang#kontak') }}"
                   class="nav-link text-white">
                   <i class="bi bi-telephone"></i> Kontak
                </a>
            </li>

            @guest
            <li class="nav-item">
                <a href="{{ route('logout') }}"
                   class="nav-link text-white">
                   <i class="bi bi-box-arrow-in-right"></i> Logout
                </a>
            </li>
            @endguest

        @endif


        {{-- ================= ADMIN ================= --}}
        @if($isAdmin)

        <li class="nav-item">

            {{-- Parent --}}
            <a href="{{ route('admin.dashboard') }}"
               class="nav-link text-white d-flex justify-content-between align-items-center
               {{ request()->routeIs('admin.*') ? 'active' : '' }}">

                <span>
                    <i class="bi bi-house"></i> Dashboard
                </span>

                <span data-bs-toggle="collapse"
                      data-bs-target="#dashboardCollapseDesktop"
                      onclick="event.preventDefault();">
                    <i class="bi bi-chevron-right"></i>
                </span>

            </a>

            {{-- Submenu --}}
            <div class="collapse {{ request()->routeIs('admin.*') ? 'show' : '' }}" 
                 id="dashboardCollapseDesktop">
                <ul class="nav flex-column ms-4">

                    <li class="nav-item">
                        <a href="{{ route('admin.magang.create') }}"
                           class="nav-link text-white {{ request()->routeIs('admin.magang.create') ? 'active' : '' }}">
                           <i class="bi bi-plus-circle"></i> Tambah Data
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.edit.index') }}"
                           class="nav-link text-white {{ request()->routeIs('admin.edit.index') ? 'active' : '' }}">
                           <i class="bi bi-pencil-square"></i> Edit Data
                        </a>
                    </li>

                </ul>
            </div>

        </li>

        <li class="nav-item">
            <a href="#" class="nav-link text-white logout-trigger">
                <i class="bi bi-box-arrow-in-left"></i> Logout
            </a>

            <form action="{{ route('logout') }}" method="POST" class="logout-form d-none">
                @csrf
            </form>
        </li>

        @endif

    </ul>
</div>


{{-- ================= SIDEBAR MOBILE (OFFCANVAS) ================= --}}
<div class="offcanvas offcanvas-start bg-dark text-white d-md-none"
     tabindex="-1"
     id="offcanvasSidebar">

    <div class="offcanvas-header">
        <div class="d-flex align-items-center">
            <img src="{{ asset('assets/logo_kominforb.png') }}"
                 alt="Logo" width="30" height="30" class="me-2">
            <h5 class="offcanvas-title">SiPeKa</h5>
        </div>
        <button type="button" 
                class="btn-close btn-close-white"
                data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body">
        <ul class="nav flex-column">

            {{-- USER / GUEST --}}
            @if(!$isAdmin)

                <li class="nav-item">
                    <a href="{{ route('user.dashboard') }}"
                       class="nav-link text-white">
                       <i class="bi bi-house"></i> Beranda
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('tentang') }}"
                       class="nav-link text-white">
                       <i class="bi bi-info-circle"></i> Tentang
                    </a>
                </li>

                @guest
                <li class="nav-item">
                    <a href="{{ route('logout') }}"
                       class="nav-link text-white">
                       <i class="bi bi-box-arrow-in-right"></i> Logout
                    </a>
                </li>
                @endguest

            @endif


            {{-- ADMIN --}}
            @if($isAdmin)

            <li class="nav-item">

                <a href="{{ route('admin.dashboard') }}"
                   class="nav-link text-white d-flex justify-content-between align-items-center"
                   data-bs-toggle="collapse"
                   data-bs-target="#dashboardCollapseMobile">

                    <span>
                        <i class="bi bi-house"></i> Dashboard
                    </span>

                    <i class="bi bi-chevron-right"></i>
                </a>

                <div class="collapse" id="dashboardCollapseMobile">
                    <ul class="nav flex-column ms-4">

                        <li class="nav-item">
                            <a href="{{ route('admin.magang.create') }}"
                               class="nav-link text-white">
                               <i class="bi bi-plus-circle"></i> Tambah Data
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.edit.index') }}"
                               class="nav-link text-white">
                               <i class="bi bi-pencil-square"></i> Edit Data
                            </a>
                        </li>

                    </ul>
                </div>

            </li>

            <li class="nav-item">
                <a href="#" class="nav-link text-white logout-trigger">
                    <i class="bi bi-box-arrow-in-left"></i> Logout
                </a>

                <form action="{{ route('logout') }}" method="POST" class="logout-form d-none">
                    @csrf
                </form>
            </li>

            @endif

        </ul>
    </div>
</div>