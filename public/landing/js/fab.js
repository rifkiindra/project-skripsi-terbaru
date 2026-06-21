document.addEventListener("mousemove", (e) => {
    const hero = document.querySelector(".works-hero");
    if (!hero) return;

    const x = (e.clientX / window.innerWidth - 0.5) * 15;
    const y = (e.clientY / window.innerHeight - 0.5) * 15;

    hero.style.backgroundPosition = `${50 + x}% ${50 + y}%`;
});
window.addEventListener("load", () => {
    // Hero animation
    gsap.from(".works-title", {
        y: 60,
        opacity: 0,
        duration: 1.2,
        ease: "power3.out",
    });

    gsap.from(".works-subtitle", {
        y: 40,
        opacity: 0,
        duration: 1,
        delay: 0.3,
        ease: "power3.out",
    });

    // Gallery cards stagger
    gsap.from(".work-card", {
        y: 80,
        opacity: 0,
        duration: 1,
        stagger: 0.2,
        delay: 0.6,
        ease: "power3.out",
    });
});

const cards = document.querySelectorAll(".work-card");
const lightbox = document.getElementById("lightbox");
const lightboxImage = document.getElementById("lightboxImage");
const counter = document.getElementById("lightboxCounter");

let currentIndex = 0;
const images = [];

cards.forEach((card, index) => {
    images.push(card.querySelector("img").src);

    card.addEventListener("click", () => {
        currentIndex = index;
        openLightbox();
    });
});

function openLightbox() {
    lightbox.classList.add("active");
    updateLightbox();
}

function closeLightbox() {
    lightbox.classList.remove("active");
}

function updateLightbox() {
    lightboxImage.src = images[currentIndex];
    counter.textContent = `${String(currentIndex + 1).padStart(2, "0")} / ${images.length}`;
}

document.getElementById("closeLightbox").onclick = closeLightbox;
document.getElementById("nextBtn").onclick = () => {
    currentIndex = (currentIndex + 1) % images.length;
    updateLightbox();
};
document.getElementById("prevBtn").onclick = () => {
    currentIndex = (currentIndex - 1 + images.length) % images.length;
    updateLightbox();
};

document.addEventListener("keydown", (e) => {
    if (!lightbox.classList.contains("active")) return;
    if (e.key === "Escape") closeLightbox();
    if (e.key === "ArrowRight") document.getElementById("nextBtn").click();
    if (e.key === "ArrowLeft") document.getElementById("prevBtn").click();
});
