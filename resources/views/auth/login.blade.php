<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

    <h2>Login</h2>

    @if(session('error'))
        <p style="color:red">{{ session('error') }}</p>
    @endif

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <form method="POST" action="/">
        @csrf

        <label>Email</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password</label><br>
        <input type="password" name="password" required><br><br>
        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
        <button type="submit">Login</button>
    </form>

    <br>
    <a href="/register">Belum punya akun? Register</a>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>
