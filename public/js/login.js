/* =========================================
   LOGIN PAGE JS — Sistem PKL
   File: public/js/login.js
   ========================================= */

(function () {
    'use strict';

    /* --------------------------------------------------
       Role Toggle (Peserta / Admin)
    -------------------------------------------------- */
    const slider   = document.getElementById('slider');
    const btnUser  = document.getElementById('btn-user');
    const btnAdmin = document.getElementById('btn-admin');
    const badge    = document.getElementById('role-badge');
    const roleName = document.getElementById('role-badge-name');
    const btnLabel = document.getElementById('btn-label');
    const roleInput= document.getElementById('role-input');

    function switchRole(role) {
        if (role === 'admin') {
            slider.classList.add('right');
            btnUser.classList.remove('active');
            btnAdmin.classList.add('active');

            badge.className    = 'role-badge admin';
            roleName.textContent = 'Login sebagai Admin';
            btnLabel.textContent = 'Masuk sebagai Admin';
            if (roleInput) roleInput.value = 'admin';

            // Swap badge icon
            document.getElementById('badge-icon').className = 'ti ti-shield';
        } else {
            slider.classList.remove('right');
            btnAdmin.classList.remove('active');
            btnUser.classList.add('active');

            badge.className    = 'role-badge user';
            roleName.textContent = 'Login sebagai Peserta PKL';
            btnLabel.textContent = 'Masuk sebagai Peserta';
            if (roleInput) roleInput.value = 'peserta';

            document.getElementById('badge-icon').className = 'ti ti-user';
        }
    }

    // Attach to global scope so onclick="" attributes work
    window.switchRole = switchRole;

    // Keyboard accessibility for toggle buttons
    [btnUser, btnAdmin].forEach(btn => {
        btn && btn.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                const role = this.id === 'btn-admin' ? 'admin' : 'user';
                switchRole(role);
            }
        });
    });


    /* --------------------------------------------------
       Password Visibility Toggle
    -------------------------------------------------- */
    const togglePwd = document.getElementById('toggle-password');
    const pwdInput  = document.getElementById('password-input');

    if (togglePwd && pwdInput) {
        togglePwd.addEventListener('click', function () {
            const isHidden = pwdInput.type === 'password';
            pwdInput.type = isHidden ? 'text' : 'password';
            this.className = isHidden ? 'ti ti-eye-off icon-right' : 'ti ti-eye icon-right';
        });
    }


    /* --------------------------------------------------
       Alert auto-dismiss after 5 seconds
    -------------------------------------------------- */
    document.querySelectorAll('.alert').forEach(function (el) {
        setTimeout(function () {
            el.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
            el.style.opacity    = '0';
            el.style.transform  = 'translateY(-6px)';
            setTimeout(function () { el.remove(); }, 420);
        }, 5000);
    });


    /* --------------------------------------------------
       Form submission guard — disable button while submitting
    -------------------------------------------------- */
    const form      = document.getElementById('login-form');
    const submitBtn = document.getElementById('btn-submit');

    if (form && submitBtn) {
        form.addEventListener('submit', function () {
            submitBtn.disabled = true;
            submitBtn.style.opacity = '0.7';
            submitBtn.querySelector('#btn-label').textContent = 'Memproses…';
        });
    }

})();
