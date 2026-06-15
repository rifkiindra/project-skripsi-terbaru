document.addEventListener("DOMContentLoaded", () => {
    const toggle = document.getElementById("menuToggle");
    const menu = document.getElementById("mobileMenu");
    const overlay = document.getElementById("menuOverlay");
    const header = document.querySelector(".site-header");

    if (!toggle || !menu || !overlay) return;

    // TOGGLE MENU
    toggle.addEventListener("click", () => {
        toggle.classList.toggle("active");
        menu.classList.toggle("active");
        overlay.classList.toggle("active");
    });

    // CLOSE SAAT KLIK LUAR
    overlay.addEventListener("click", () => {
        toggle.classList.remove("active");
        menu.classList.remove("active");
        overlay.classList.remove("active");
    });

    // SCROLL EFFECT
    window.addEventListener("scroll", () => {
        header.classList.toggle("scrolled", window.scrollY > 50);
    });
});
