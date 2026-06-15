const elements = document.querySelectorAll(".about-section, .team-card");

window.addEventListener("scroll", () => {
    elements.forEach((el) => {
        const pos = el.getBoundingClientRect().top;
        if (pos < window.innerHeight - 100) {
            el.classList.add("fade-up", "show");
        }
    });
});
