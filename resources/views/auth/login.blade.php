{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Login</title>

    {{-- Tabler Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.8.0/tabler-icons.min.css">

    {{-- Google reCAPTCHA --}}
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Login CSS (letakkan di public/css/login.css) --}}
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/logo_kominforb.png') }}">

</head>

<body>
    <main class="login-page">
        <div class="login-card">

            {{-- ── Brand / Logo ── --}}
            <div class="brand">
                <div class="brand-icon">
                    <img src="{{ asset('assets/logo_kominforb.png') }}" alt="Logo" style="width:40px;height:40px;">
                </div>
                <h1>Sistem PKL</h1>
                <p>Masuk ke akun kamu untuk melanjutkan</p>
            </div>

            {{-- ── SweetAlert Data (dari session) ── --}}
            @if(session('sweetalert'))
            <script>
                window.sweetalertData = {
                    icon:  "{{ session('sweetalert.icon') }}",
                    title: "{{ session('sweetalert.title') }}",
                    text:  "{{ session('sweetalert.text') }}",
                };
                window.dashboardRedirect = "{{ session('sweetalert.redirect') }}";
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

            {{-- ── Role Toggle ── --}}
            <div class="toggle-wrap" role="tablist" aria-label="Pilih peran login">
                <div class="toggle-slider" id="slider" aria-hidden="true"></div>
                <button
                    class="toggle-btn active"
                    id="btn-user"
                    role="tab"
                    aria-selected="true"
                    onclick="switchRole('user')"
                    type="button">
                    <i class="ti ti-user" aria-hidden="true" style="font-size:15px"></i>
                    Peserta
                </button>
                <button
                    class="toggle-btn"
                    id="btn-admin"
                    role="tab"
                    aria-selected="false"
                    onclick="switchRole('admin')"
                    type="button">
                    <i class="ti ti-shield" aria-hidden="true" style="font-size:15px"></i>
                    Admin
                </button>
            </div>

            {{-- ── Role Badge ── --}}
            <div class="role-badge-wrap">
                <span class="role-badge user" id="role-badge">
                    <i class="ti ti-user" id="badge-icon" style="font-size:11px" aria-hidden="true"></i>
                    <span id="role-badge-name">Login sebagai Peserta PKL</span>
                </span>
            </div>

            {{-- ── Login Form ── --}}
            <form method="POST" action="{{ url('/login') }}" id="login-form">
                @csrf

                {{-- Hidden field untuk kirim role ke controller --}}
                <input type="hidden" name="role" id="role-input" value="peserta">

                {{-- Email --}}
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-wrap">
                        <i class="ti ti-mail icon-left" aria-hidden="true"></i>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="contoh@email.com"
                            autocomplete="email"
                            value="{{ old('email') }}"
                            required>
                    </div>
                    @error('email')
                        <span style="font-size:11.5px; color:#993C1D; margin-top:4px; display:block;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label for="password-input">Password</label>
                    <div class="input-wrap">
                        <i class="ti ti-lock icon-left" aria-hidden="true"></i>
                        <input
                            type="password"
                            id="password-input"
                            name="password"
                            placeholder="••••••••"
                            autocomplete="current-password"
                            required>
                        <i class="ti ti-eye icon-right" id="toggle-password" aria-label="Tampilkan password"></i>
                    </div>
                    @error('password')
                        <span style="font-size:11.5px; color:#993C1D; margin-top:4px; display:block;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- reCAPTCHA --}}
                <div class="captcha-box">
                    <div
                        class="g-recaptcha"
                        data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"
                        data-theme="light">
                    </div>
                </div>

                @error('g-recaptcha-response')
                    <span style="font-size:11.5px; color:#993C1D; margin-bottom:0.75rem; display:block;">
                        {{ $message }}
                    </span>
                @enderror

                {{-- Submit --}}
                <button class="btn-login" type="submit" id="btn-submit">
                    <i class="ti ti-login" aria-hidden="true"></i>
                    <span id="btn-label">Masuk sebagai Peserta</span>
                </button>
            </form>

            <div class="divider"></div>

            {{-- Footer Links --}}
            <div class="footer-links">
                <a href="{{ url('/forgot-password') }}">Lupa password?</a>
                <a href="{{ url('/register') }}">Belum punya akun?</a>
            </div>

        </div>{{-- .login-card --}}
    </main>

    {{-- Login JS (letakkan di public/js/login.js) --}}
    <script src="{{ asset('js/login.js') }}"></script>

    {{-- Trigger SweetAlert jika ada data --}}
    <script>
        if (window.sweetalertData) {
            Swal.fire({
                icon:              window.sweetalertData.icon,
                title:             window.sweetalertData.title,
                text:              window.sweetalertData.text,
                confirmButtonColor: '#185FA5',
                confirmButtonText: 'OK',
            }).then(function () {
                if (window.dashboardRedirect) {
                    window.location.href = window.dashboardRedirect;
                }
            });
        }
    </script>
</body>

</html>