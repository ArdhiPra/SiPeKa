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
    <a href="{{ route('beranda') }}"
        class="d-flex align-items-center mb-3 text-white text-decoration-none">
        <img src="{{ asset('assets/logo_kominforb.png') }}" 
            alt="Logo" width="30" height="30" class="me-2">
        <h4 class="mb-0">SiPeKa</h4>
    </a>

    <hr class="text-secondary">

    <ul class="nav flex-column">

            <li class="nav-item">
                <a href="{{ route('beranda') }}"
                    class="nav-link text-white {{ request()->routeIs('beranda') ? 'active' : '' }}">
                    <i class="bi bi-info-circle"></i> Beranda
                </a>
            </li> 

            <li class="nav-item">
                <a href="{{ route('kuota.magang') }}"
                    class="nav-link text-white {{ request()->routeIs('kuota.magang') ? 'active' : '' }}">
                    <i class="bi bi-house"></i> Kuota Magang 
                </a>
            </li>
   
            <li class="nav-item">
                <a href="{{ route('login') }}"
                    class="nav-link text-white">
                    <i class="bi bi-box-arrow-in-right"></i> Login
                </a>
            </li>
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


        <li class="nav-item">
                    <a href="{{ route('beranda') }}"
                       class="nav-link text-white">
                       <i class="bi bi-info-circle"></i> Beranda
                    </a>
            </li>

                <li class="nav-item">
                    <a href="{{ route('kuota.magang') }}"
                       class="nav-link text-white">
                       <i class="bi bi-house"></i> Kuota Magang
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('login') }}"
                       class="nav-link text-white">
                       <i class="bi bi-box-arrow-in-right"></i> Login
                    </a>
                </li>
        </ul>
    </div>
</div>