function showTab(tab) {
    const misi = document.getElementById("misi");
    const visi = document.getElementById("visi");

    const btnMisi = document.getElementById("btn-misi");
    const btnVisi = document.getElementById("btn-visi");

    // reset content
    misi.classList.remove("active");
    visi.classList.remove("active");

    // reset buttons
    btnMisi.classList.remove("btn-warning", "text-white");
    btnMisi.classList.add("btn-light");

    btnVisi.classList.remove("btn-warning", "text-white");
    btnVisi.classList.add("btn-light");

    // activate selected
    if (tab === "misi") {
        misi.classList.add("active");
        btnMisi.classList.remove("btn-light");
        btnMisi.classList.add("btn-warning", "text-white");
    } else {
        visi.classList.add("active");
        btnVisi.classList.remove("btn-light");
        btnVisi.classList.add("btn-warning", "text-white");
    }
}
