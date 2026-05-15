document.addEventListener('DOMContentLoaded', function () {

    /* ── SweetAlert Adaptive ── */
    if (window.sweetalertData) {
        const isDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

        Swal.fire({
            icon: window.sweetalertData.icon,
            title: window.sweetalertData.title,
            text: window.sweetalertData.text,
            background: isDark ? '#161B22' : '#FFFFFF',
            color: isDark ? '#E6EDF3' : '#0D1117',
            confirmButtonColor: '#185FA5',
        }).then(() => {
            if (window.dashboardRedirect) {
                window.location.href = window.dashboardRedirect;
            }
        });
    }

    /* ── Toggle Password ── */
    document.querySelectorAll('.toggle-password').forEach(btn => {
        btn.addEventListener('click', function () {
            const input = document.getElementById(btn.dataset.target);

            if (input.type === 'password') {
                input.type = 'text';
            } else {
                input.type = 'password';
            }
        });
    });

    /* ── Validation ── */
    const form = document.getElementById('register-form');
    const submitBtn = document.getElementById('submit-btn');
    const submitText = document.getElementById('submit-text');

    form.addEventListener('submit', function (e) {
        const nama = document.getElementById('nama');
        const email = document.getElementById('email');
        const password = document.getElementById('password');
        const confirm = document.getElementById('password_confirmation');

        let valid = true;

        [nama, email, password, confirm].forEach(el => el.classList.remove('error'));

        if (!nama.value.trim()) {
            nama.classList.add('error');
            valid = false;
        }

        if (!email.value.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
            email.classList.add('error');
            valid = false;
        }

        if (password.value.length < 8) {
            password.classList.add('error');
            valid = false;
        }

        if (confirm.value !== password.value) {
            confirm.classList.add('error');
            valid = false;
        }

        if (!valid) {
        e.preventDefault();

        let errorMessage = '';

        if (!nama.value.trim()) {
            errorMessage = 'Nama lengkap wajib diisi.';
        } else if (!email.value.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
            errorMessage = 'Format email tidak valid.';
        } else if (password.value.length < 8) {
            errorMessage = 'Password minimal 8 karakter.';
        } else if (confirm.value !== password.value) {
            errorMessage = 'Konfirmasi password tidak cocok.';
        }

        Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan',
            text: errorMessage,
            confirmButtonColor: '#185FA5'
        });

        return;
    }

        submitBtn.disabled = true;
        submitText.textContent = 'Memproses...';
    });

});