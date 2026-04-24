<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Sistem PKL')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/logo_kominforb.png') }}">

    <!-- Global CSS -->
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    @stack('styles')
    @if ($errors->any())
    <meta name="alert-error" content="{{ $errors->first() }}">
    @elseif (session('alert-error'))
    <meta name="alert-error" content="{{ session('alert-error') }}">
    @endif
</head>

<body>

   
        {{-- Sidebar akan diisi oleh layout turunan --}}
        @yield('sidebar')

        <main class="flex-grow-1 content">
            @yield('content')
        </main>


    <!-- JS Global -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        window.sweetalertData = @json(session('sweetalert'));
    </script>

    <script src="{{ asset('js/logout.js') }}"></script>
    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script src="{{ asset('js/notifikasi.js') }}"></script>
    <script src="{{ asset('js/edit-notifikasi.js') }}"></script>
    @stack('scripts')

</body>
</html>