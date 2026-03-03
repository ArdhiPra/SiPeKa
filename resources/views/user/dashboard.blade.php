<!DOCTYPE html>
<html>
<head>
    <title>Dashboard User</title>
</head>
<body>
@include('layouts.sidebar')
    <h2>Dashboard User</h2>
    <p>Selamat datang, {{ session('nama') }}</p>

    <a href="/logout">Logout</a>

</body>
</html>
