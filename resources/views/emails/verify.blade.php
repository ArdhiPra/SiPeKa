<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif; padding: 20px;">
    <h2>Halo, {{ $user->nama }}!</h2>
    <p>Klik tombol di bawah untuk verifikasi email kamu:</p>
    <a href="{{ $url }}" 
       style="background:#4CAF50; color:white; padding:10px 20px; text-decoration:none; border-radius:5px;">
        Verifikasi Email
    </a>
    <p style="margin-top:20px; color:#999;">
        Jika kamu tidak merasa mendaftar, abaikan email ini.
    </p>
</body>
</html>