document.addEventListener("DOMContentLoaded", function () {
    const alertData = window.sweetalertData;
    if (!alertData) return;

    Swal.fire({
        icon: alertData.icon,
        title: alertData.title,
        text: alertData.text,
        confirmButtonText: "OK",
        width: 450,
    }).then((result) => {
        if (result.isConfirmed && window.dashboardRedirect) { // ✅ cek null dulu
            window.location.href = window.dashboardRedirect;
        }
    });
});