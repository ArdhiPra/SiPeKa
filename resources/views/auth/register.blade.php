<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

    <h2>Register</h2>

    @if($errors->any())
        <ul style="color:red">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="/register">
        @csrf

        <label>Nama</label><br>
        <input type="text" name="nama" required><br><br>

        <label>Email</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password</label><br>
        <input type="password" name="password" required><br><br>

        <label>Konfirmasi Password</label><br>
        <input type="password" name="password_confirmation" required><br><br>

        <button type="submit">Register</button>
    </form>

    <br>
    <a href="/login">Sudah punya akun? Login</a>

</body>
</html>
