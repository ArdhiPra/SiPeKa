document.addEventListener("DOMContentLoaded", function () {
    if (window.location.hash === "#kontak") {
        const target = document.getElementById("kontak");
        const container = document.querySelector(".main-wrapper");

        if (target && container) {
            container.scrollTo({
                top: target.offsetTop - 40,
                behavior: "smooth"
            });
        }
    }
});