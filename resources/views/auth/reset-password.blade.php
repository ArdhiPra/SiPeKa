{{-- resources/views/auth/reset-password.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password — Sistem PKL</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/logo_kominforb.png') }}">
    <link rel="stylesheet" href="{{ asset('css/reset-password.css') }}">
</head>
<body>

<div class="page-wrapper">
    <div class="card">

        {{-- Icon Brand --}}
        <div class="brand-icon">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="5" y="11" width="14" height="10" rx="2" stroke="white" stroke-width="2"/>
                <path d="M8 11V7a4 4 0 018 0v4" stroke="white" stroke-width="2" stroke-linecap="round"/>
                <circle cx="12" cy="16" r="1.5" fill="white"/>
            </svg>
        </div>

        {{-- Judul --}}
        <h1 class="card-title">Reset Password</h1>
        <p class="card-subtitle">Masukkan password baru kamu di bawah ini</p>

        {{-- Form --}}
        <form method="POST" action="{{ route('reset.password') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            {{-- Password Baru --}}
            <div class="form-group">
                <label class="form-label" for="password">PASSWORD BARU</label>
                <div class="input-wrapper">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-input @error('password') error @enderror"
                        placeholder="Minimal 6 karakter"
                        required
                        autocomplete="new-password"
                    >
                    <button type="button" class="toggle-password" onclick="togglePassword('password', this)" aria-label="Tampilkan password">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                </div>
                @error('password')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            {{-- Konfirmasi Password --}}
            <div class="form-group">
                <label class="form-label" for="password_confirmation">KONFIRMASI PASSWORD</label>
                <div class="input-wrapper">
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="form-input"
                        placeholder="Ulangi password baru"
                        required
                        autocomplete="new-password"
                    >
                    <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation', this)" aria-label="Tampilkan konfirmasi password">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                </div>
            </div>

            <button type="submit" class="submit-btn">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                </svg>
                Reset Password
            </button>
        </form>

        <div class="card-divider"></div>

        <a href="{{ route('login') }}" class="footer-link">
            Kembali ke <span>Login</span>
        </a>

    </div>
</div>

{{-- SweetAlert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('sweetalert'))
<script>
    window.sweetalertData = {
        icon:  "{{ session('sweetalert.icon') }}",
        title: "{{ session('sweetalert.title') }}",
        text:  "{{ session('sweetalert.text') }}",
    };
</script>
@endif

<script>
    // Sweetalert handler
    if (window.sweetalertData) {
        Swal.fire({
            icon:               window.sweetalertData.icon,
            title:              window.sweetalertData.title,
            text:               window.sweetalertData.text,
            confirmButtonColor: '#185FA5',
            confirmButtonText:  'OK',
        });
    }

    // Toggle show/hide password
    function togglePassword(fieldId, btn) {
        const input = document.getElementById(fieldId);
        const isHidden = input.type === 'password';
        input.type = isHidden ? 'text' : 'password';

        // Ganti ikon
        btn.innerHTML = isHidden
            ? `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94"/>
                <path d="M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19"/>
                <line x1="1" y1="1" x2="23" y2="23"/>
               </svg>`
            : `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                <circle cx="12" cy="12" r="3"/>
               </svg>`;
    }
</script>

</body>
</html>