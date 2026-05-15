{{-- forgot-password.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <link rel="stylesheet" href="{{ asset('css/forgotpass.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/logo_kominforb.png') }}">
    <style>
    /* Alert boxes */
    .alert {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 14px;
        border-radius: var(--radius-sm);
        font-size: 13px;
        margin-bottom: 16px;
    }

    .alert-success {
        background: rgba(34, 197, 94, 0.1);
        color: #16a34a;
        border: 1px solid rgba(34, 197, 94, 0.25);
    }

    .alert-error {
        background: rgba(224, 92, 92, 0.1);
        color: var(--danger);
        border: 1px solid rgba(224, 92, 92, 0.25);
    }

    @media (prefers-color-scheme: dark) {
        .alert-success {
            background: rgba(34, 197, 94, 0.12);
            color: #4ade80;
        }
    }

    /* Error field text */
    .field-error {
        display: block;
        font-size: 11px;
        color: var(--danger);
        margin-top: 4px;
    }
</style>
    </style>
</head>
<body>

<div class="page-wrapper">
    <div class="card">

        {{-- Icon Brand --}}
        <div class="brand-icon">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2C8.13 2 5 5.13 5 9c0 2.38 1.19 4.47 3 5.74V17c0 .55.45 1 1 1h6c.55 0 1-.45 1-1v-2.26A7 7 0 0 0 12 2zm2 14h-4v-1.5c-1.79-.95-3-2.82-3-4.5a5 5 0 0 1 10 0c0 1.68-1.21 3.55-3 4.5V16zm-3 2h2v1h-2v-1z"
                      fill="white"/>
            </svg>
        </div>

        {{-- Judul --}}
        <h1 class="card-title">Lupa Password</h1>
        <p class="card-subtitle">Masukkan email kamu, kami akan kirimkan link reset</p>

        {{-- Alert Sukses --}}
        @if(session('success'))
            <div class="alert alert-success">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                          stroke="currentColor" stroke-width="2"
                          stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Alert Error --}}
        @if(session('error'))
            <div class="alert alert-error">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                          stroke="currentColor" stroke-width="2"
                          stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                {{ session('error') }}
            </div>
        @endif

        {{-- Form --}}
        <form method="POST" action="{{ route('forgot.send') }}">
            @csrf

            <div class="form-group">
                <label class="form-label" for="email">EMAIL</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-input @error('email') error @enderror"
                    placeholder="contoh@email.com"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email"
                    autofocus
                >
                @error('email')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="submit-btn">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                     style="vertical-align:-2px; margin-right:6px" aria-hidden="true">
                    <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                          stroke="currentColor" stroke-width="2"
                          stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Kirim Link Reset
            </button>
        </form>

        <div class="card-divider"></div>

        {{-- Footer --}}
        <a href="{{ route('login') }}" class="footer-link">
            Ingat password kamu? <span>Login</span>
        </a>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- Sweetalert session handler --}}
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
    if (window.sweetalertData) {
        Swal.fire({
            icon:              window.sweetalertData.icon,
            title:             window.sweetalertData.title,
            text:              window.sweetalertData.text,
            confirmButtonColor: '#185FA5',   // sesuai accent CSS kamu
            confirmButtonText: 'OK',
        });
    }
</script>
</body>
</html>