<h2>Lupa Password</h2>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

<form method="POST" action="/forgot-password">
    @csrf
    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <button type="submit">Kirim Link Reset</button>
</form>
