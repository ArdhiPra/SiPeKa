<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>

<h2>Reset Password</h2>

@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

<form method="POST" action="/reset-password">
    @csrf

    <!-- token dari URL -->
    <input type="hidden" name="token" value="{{ $token }}">

    <label>Password Baru</label><br>
    <input type="password" name="password" required><br><br>

    <label>Konfirmasi Password</label><br>
    <input type="password" name="password_confirmation" required><br><br>

    <button type="submit">Reset Password</button>
</form>

</body>
</html>
