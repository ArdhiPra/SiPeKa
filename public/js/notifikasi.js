document.addEventListener("DOMContentLoaded", function () {
    const alertData = window.sweetalertData;
    if (!alertData) return;

    Swal.fire({
        icon: alertData.icon,
        title: alertData.title,
        text: alertData.text,
        confirmButtonText: "OK",
        width: 450, // responsive di mobile
    }).then((result) => {
        if (result.isConfirmed && alertData.icon === "success") {
            window.location.href = window.dashboardRedirect;
        }
    });
});
