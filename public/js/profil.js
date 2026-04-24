document.addEventListener("DOMContentLoaded", function () {

    const tabs     = document.querySelectorAll(".settings-tabs a[data-tab]");
    const sections = document.querySelectorAll('[id^="tab-"]');

    // ========================
    // MARK AS READ
    // ========================
    function markAsRead() {
        fetch(window.markAsReadUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': window.csrfToken,
                'Content-Type': 'application/json',
            },
        })
        .then(res => {
            if (!res.ok) return;

            const notifTab = document.querySelector('[data-tab="notifikasi"]');
            const tabBadge = notifTab?.querySelector('.tab-badge');
            if (tabBadge) tabBadge.remove();

            const navbarBadge = document.querySelector('.bi-envelope-fill')
                ?.closest('a')
                ?.querySelector('.badge');
            if (navbarBadge) navbarBadge.remove();
        })
        .catch(err => console.error('markAsRead error:', err));
    }

    // ========================
    // TAB SWITCHING
    // ========================
    tabs.forEach((tab) => {
        tab.addEventListener("click", function (e) {
            e.preventDefault();

            tabs.forEach(t => t.classList.remove("active"));
            this.classList.add("active");

            const target = this.dataset.tab;
            sections.forEach(sec => sec.style.display = "none");

            const targetEl = document.getElementById("tab-" + target);
            if (targetEl) targetEl.style.display = "block";

            if (target === 'notifikasi') markAsRead();
        });
    });

    // Buka tab dari query string ?tab=
    const urlParams  = new URLSearchParams(window.location.search);
    const tabFromUrl = urlParams.get('tab');
    if (tabFromUrl) {
        const tabLink = document.querySelector(`[data-tab="${tabFromUrl}"]`);
        if (tabLink) tabLink.click();
    }

    // Buka tab sandi jika ada error validasi
    if (window.openSandiTab) {
        const sandiTab = document.querySelector('[data-tab="sandi"]');
        if (sandiTab) sandiTab.click();
    }

    // ========================
    // PREVIEW FOTO (upload)
    // ========================
    const fotoInput = document.getElementById('foto_input');

    if (fotoInput) {
        fotoInput.addEventListener('change', function () {
            const file = this.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function (e) {
                const container = document.querySelector('.photo-avatar');
                container.innerHTML = `
                    <img id="preview-foto"
                        src="${e.target.result}"
                        alt="Foto Profil"
                        class="avatar-img">
                `;
            };
            reader.readAsDataURL(file);
        });
    }

    // ========================
    // HAPUS FOTO
    // ========================
    const btnHapus = document.querySelector('.btn-delete-foto');

    if (btnHapus) {
        btnHapus.addEventListener('click', function () {
            if (!confirm('Yakin ingin menghapus foto profil?')) return;

            const formData = new FormData();
            formData.append('_token', window.csrfToken); // cukup token saja

            fetch(window.deleteFotoUrl, {
                method: 'POST',
                body: formData,
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    const container = document.querySelector('.photo-avatar');
                    const inisial   = window.userInisial || '?';

                    // Balik ke avatar inisial
                    container.innerHTML = `
                        <div id="preview-foto" class="avatar-initials">
                            ${inisial}
                        </div>
                    `;
                    btnHapus.remove();
                } else {
                    alert('Gagal menghapus foto.');
                }
            })
            .catch(() => alert('Terjadi kesalahan.'));
        });
    }

});