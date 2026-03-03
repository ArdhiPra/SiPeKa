document.addEventListener("DOMContentLoaded", function () {
    // Ambil semua menu sidebar
    document.querySelectorAll(".dashboard-menu").forEach(menu => {
        const collapseEl = menu.querySelector(".collapse");
        const icon = menu.querySelector(".rotate-icon");

        if (collapseEl && icon) {
            // Saat collapse terbuka
            collapseEl.addEventListener("shown.bs.collapse", () => {
                icon.classList.add("open");
            });

            // Saat collapse tertutup
            collapseEl.addEventListener("hidden.bs.collapse", () => {
                icon.classList.remove("open");
            });
        }
    });
});
