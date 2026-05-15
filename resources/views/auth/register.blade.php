<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/png" href="{{ asset('assets/logo_kominforb.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>

    {{-- SweetAlert Data --}}
    @if(session('sweetalert'))
    <script>
        window.sweetalertData = {
            icon:  "{{ session('sweetalert.icon') }}",
            title: "{{ session('sweetalert.title') }}",
            text:  "{{ session('sweetalert.text') }}",
        };
        window.dashboardRedirect = "{{ session('sweetalert.redirect', route('user.dashboard')) }}";
    </script>
    @endif

    @if(session('alert-success'))
    <script>
        window.sweetalertData = {
            icon:  "success",
            title: "Berhasil!",
            text:  "{{ session('alert-success') }}",
        };
        window.dashboardRedirect = null;
    </script>
    @endif

    @if($errors->any() || session('alert-error'))
    <script>
        window.sweetalertData = {
            icon:  "error",
            title: "Gagal!",
            text:  "{{ $errors->any() ? $errors->first() : session('alert-error') }}",
        };
        window.dashboardRedirect = null;
    </script>
    @endif

    <div class="page-wrapper">
        <div class="card">

            {{-- Icon --}}
            <div class="brand-icon">
                <img src="{{ asset('assets/logo_kominforb.png') }}" alt="Logo" style="width:40px;height:40px;">
            </div>

            <h1 class="card-title">Sistem PKL</h1>
            <p class="card-subtitle">Buat akun baru untuk melanjutkan</p>

            {{-- Form --}}
            <form method="POST" action="/register" id="register-form" novalidate>
                @csrf
                <input type="hidden" name="role" id="role-input" value="peserta">

                <div class="form-group">
                    <label class="form-label" for="nama">NAMA LENGKAP</label>
                    <input
                        class="form-input"
                        type="text"
                        name="nama"
                        id="nama"
                        placeholder="Masukkan nama lengkap"
                        value="{{ old('nama') }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">EMAIL</label>
                    <input
                        class="form-input"
                        type="email"
                        name="email"
                        id="email"
                        placeholder="contoh@email.com"
                        value="{{ old('email') }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">PASSWORD</label>
                    <div class="input-wrapper">
                        <input
                            class="form-input has-toggle"
                            type="password"
                            name="password"
                            id="password"
                            placeholder="••••••••"
                            required
                        >
                        <button type="button" class="toggle-password" data-target="password" aria-label="Tampilkan password">
                            <svg class="eye-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password_confirmation">KONFIRMASI PASSWORD</label>
                    <div class="input-wrapper">
                        <input
                            class="form-input has-toggle"
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            placeholder="••••••••"
                            required
                        >
                        <button type="button" class="toggle-password" data-target="password_confirmation" aria-label="Tampilkan konfirmasi password">
                            <svg class="eye-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="submit-btn" id="submit-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                    <span id="submit-text">Daftar sebagai Peserta</span>
                </button>
            </form>

            <div class="card-divider"></div>

            <div class="card-footer">
                <a href="/login" class="footer-link">Sudah punya akun? <span>Login</span></a>
            </div>

        </div>
    </div>

    <script src="{{ asset('js/register.js') }}"></script>
</body>
</html>