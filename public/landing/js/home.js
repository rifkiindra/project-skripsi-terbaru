// SCROLL REVEAL (ringan)
const reveals = document.querySelectorAll(".reveal");

function revealOnScroll() {
    let windowHeight = window.innerHeight;

    reveals.forEach((el) => {
        if (el.getBoundingClientRect().top < windowHeight - 80) {
            el.classList.add("active");
        }
    });
}

window.addEventListener("scroll", revealOnScroll);

/* EXPLORE BUTTON */
document.getElementById("exploreBtn").addEventListener("click", function (e) {
    e.preventDefault();
    document.getElementById("category").scrollIntoView({ behavior: "smooth" });
});

/* GALLERY SYSTEM */
const cards = document.querySelectorAll(".category-card");
const gallery = document.getElementById("gallery");
const galleryGrid = document.getElementById("galleryGrid");

// BASE URL dari Laravel
const BASE = window.location.origin + "/";

const data = {
    concept: [
        "images/concept1.webp",
        "images/concept2.webp",
        "images/concept3.webp",
    ],
    game: ["images/game1.webp", "images/game2.webp", "images/game3.webp"],
    splash: [
        "images/splash1.webp",
        "images/splash2.webp",
        "images/splash3.webp",
    ],
};

cards.forEach((card) => {
    card.addEventListener("click", () => {
        let category = card.dataset.category;
        galleryGrid.innerHTML = "";

        data[category].forEach((img) => {
            let image = document.createElement("img");
            image.src = BASE + img;
            galleryGrid.appendChild(image);
        });

        gallery.classList.add("active");
        gallery.scrollIntoView({ behavior: "smooth" });
    });
});
