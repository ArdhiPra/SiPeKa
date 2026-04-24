<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

    <h2>Login</h2>

    @if(session('alert-error'))
        <p style="color:red">{{ session('alert-error') }}</p>
    @endif

    @if(session('alert-success'))
        <p style="color:green">{{ session('alert-success') }}</p>
    @endif

    <form method="POST" action="/login">
        @csrf

        <label>Email</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password</label><br>
        <input type="password" name="password" required><br><br>
        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
        <button type="submit">Login</button>
    </form>

    <br>
    <a href="/forgot-password">Lupa password?</a>
    <a href="/register">Belum punya akun? Register</a>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>
