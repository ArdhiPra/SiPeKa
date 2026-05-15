<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body style="margin:0; padding:0; background-color:#F0F4F8; font-family:'Segoe UI', Arial, sans-serif;">

    {{-- Wrapper --}}
    <table width="100%" cellpadding="0" cellspacing="0" border="0"
           style="background-color:#F0F4F8; padding:40px 16px;">
        <tr>
            <td align="center">

                {{-- Card --}}
                <table width="100%" cellpadding="0" cellspacing="0" border="0"
                       style="max-width:520px; background:#ffffff; border-radius:20px;
                              box-shadow:0 4px 24px rgba(0,0,0,0.08); overflow:hidden;">

                    {{-- ===== HEADER ===== --}}
                    <tr>
                        <td align="center"
                            style="background:linear-gradient(135deg, #185FA5 0%, #0e4a82 100%);
                                   padding:36px 32px 28px;">

                            {{-- Logo --}}
                            <img src="{{ url('/assets/logo_kominforb.png') }}"
                                 alt="Logo Sistem PKL"
                                 width="64" height="64"
                                 style="border-radius:14px; display:block;
                                        margin:0 auto 16px;
                                        border:3px solid rgba(255,255,255,0.25);">

                            <h1 style="margin:0; color:#ffffff; font-size:22px;
                                       font-weight:700; letter-spacing:-0.3px;">
                                Sistem PKL
                            </h1>
                            <p style="margin:4px 0 0; color:rgba(255,255,255,0.75);
                                      font-size:13px;">
                                Sistem Informasi Praktik Kerja Lapangan
                            </p>
                        </td>
                    </tr>

                    {{-- ===== BODY ===== --}}
                    <tr>
                        <td style="padding:36px 32px 28px;">

                            {{-- Ikon gembok --}}
                            <table width="100%" cellpadding="0" cellspacing="0" border="0"
                                   style="margin-bottom:24px;">
                                <tr>
                                    <td align="center">
                                        <div style="width:56px; height:56px; background:#EFF6FF;
                                                    border-radius:14px; display:inline-flex;
                                                    align-items:center; justify-content:center;
                                                    font-size:28px; line-height:56px;">
                                            🔐
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            {{-- Judul --}}
                            <h2 style="margin:0 0 8px; color:#0D1117; font-size:20px;
                                       font-weight:700; text-align:center;">
                                Reset Password
                            </h2>
                            <p style="margin:0 0 24px; color:#6B7280; font-size:14px;
                                      text-align:center; line-height:1.6;">
                                Kami menerima permintaan reset password untuk akun kamu.
                                Klik tombol di bawah untuk membuat password baru.
                            </p>

                            {{-- Tombol CTA --}}
                            <table width="100%" cellpadding="0" cellspacing="0" border="0"
                                   style="margin-bottom:24px;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ url('/reset-password/' . $token) }}"
                                           style="display:inline-block;
                                                  background:linear-gradient(135deg, #185FA5, #0e4a82);
                                                  color:#ffffff; text-decoration:none;
                                                  font-size:15px; font-weight:600;
                                                  padding:14px 40px; border-radius:10px;
                                                  box-shadow:0 4px 14px rgba(24,95,165,0.35);">
                                            🔑 &nbsp; Reset Password Sekarang
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            {{-- Divider --}}
                            <table width="100%" cellpadding="0" cellspacing="0" border="0"
                                   style="margin-bottom:20px;">
                                <tr>
                                    <td style="border-top:1px solid #E5E7EB; font-size:0;">&nbsp;</td>
                                </tr>
                            </table>

                            {{-- Info expired --}}
                            <table width="100%" cellpadding="0" cellspacing="0" border="0"
                                   style="background:#FFF7ED; border-radius:10px;
                                          border:1px solid #FED7AA; margin-bottom:20px;">
                                <tr>
                                    <td style="padding:14px 16px;">
                                        <p style="margin:0; color:#92400E; font-size:13px;
                                                  line-height:1.6;">
                                            ⏰ &nbsp;<strong>Link ini hanya berlaku selama 30 menit.</strong>
                                            Setelah itu kamu perlu meminta link baru.
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            {{-- Info jika tidak request --}}
                            <table width="100%" cellpadding="0" cellspacing="0" border="0"
                                   style="background:#F0F9FF; border-radius:10px;
                                          border:1px solid #BAE6FD; margin-bottom:8px;">
                                <tr>
                                    <td style="padding:14px 16px;">
                                        <p style="margin:0; color:#0C4A6E; font-size:13px;
                                                  line-height:1.6;">
                                            🛡️ &nbsp;Jika kamu tidak merasa meminta reset password,
                                            abaikan email ini. Akun kamu tetap aman.
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            {{-- Fallback link --}}
                            <p style="margin:20px 0 0; color:#9CA3AF; font-size:11px;
                                      text-align:center; line-height:1.6;">
                                Tombol tidak berfungsi? Salin link berikut ke browser kamu:<br>
                                <span style="color:#185FA5; word-break:break-all;">
                                    {{ url('/reset-password/' . $token) }}
                                </span>
                            </p>

                        </td>
                    </tr>

                    {{-- ===== FOOTER ===== --}}
                    <tr>
                        <td align="center"
                            style="background:#F9FAFB; border-top:1px solid #E5E7EB;
                                   padding:20px 32px;">
                            <p style="margin:0; color:#9CA3AF; font-size:12px; line-height:1.6;">
                                Email ini dikirim otomatis oleh <strong>Sistem PKL</strong>.<br>
                                Mohon jangan membalas email ini.
                            </p>
                        </td>
                    </tr>

                </table>
                {{-- End Card --}}

            </td>
        </tr>
    </table>

</body>
</html>