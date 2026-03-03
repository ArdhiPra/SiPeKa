document.addEventListener("DOMContentLoaded", function () {

    document.querySelectorAll(".logout-trigger").forEach(function (logoutLink) {

        logoutLink.addEventListener("click", function (e) {
            e.preventDefault();

            const logoutForm = this.closest("li").querySelector(".logout-form");
            if (!logoutForm) return;

            Swal.fire({
                title: "Yakin ingin logout?",
                text: "Sesi kamu akan berakhir",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Logout",
                cancelButtonText: "Batal",
                focusCancel: true
            }).then((result) => {
                if (result.isConfirmed) {
                    logoutForm.submit();
                }
            });
        });

    });

});
