document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".dashboard-menu").forEach((menu) => {
        const collapseEl = menu.querySelector(".collapse");
        const icon = menu.querySelector(".rotate-icon");

        if (!collapseEl || !icon) return;

        // =========================
        // Set state awal
        // =========================
        if (collapseEl.classList.contains("show")) {
            icon.classList.add("open");
        }

        // =========================
        // Saat dibuka
        // =========================
        collapseEl.addEventListener("shown.bs.collapse", function () {
            icon.classList.add("open");
        });

        // =========================
        // Saat ditutup
        // =========================
        collapseEl.addEventListener("hidden.bs.collapse", function () {
            icon.classList.remove("open");
        });
    });
});
