
document.addEventListener("DOMContentLoaded", function () {
    // DELETE CONFIRMATION
    document.querySelectorAll(".form-delete").forEach((form) => {
        form.addEventListener("submit", function (e) {
            e.preventDefault(); // hentikan submit biasa

            Swal.fire({
                title: "Yakin ingin menghapus?",
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: "warning",
                width: 450,
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "Ya, hapus",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // submit manual
                }
            });
        });
    });
});
