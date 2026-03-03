document.addEventListener("DOMContentLoaded", function () {
    const successMessage = document.querySelector(
        'meta[name="alert-success"]'
    )?.content;
    const errorMessage = document.querySelector(
        'meta[name="alert-error"]'
    )?.content;

    if (successMessage) {
        Swal.fire({
            icon: "success",
            title: "Berhasil!",
            text: successMessage,
            width: 450, // <<< UBAH DI SINI
            showConfirmButton: false,
            timer: 1500,
        });
    }

    if (errorMessage) {
        Swal.fire({
            icon: "error",
            title: "Gagal!",
            text: errorMessage,
            width: 450,
            timer: 2000, // <<< UBAH DI SINI
            showConfirmButton: true,
        });
    }
});

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
