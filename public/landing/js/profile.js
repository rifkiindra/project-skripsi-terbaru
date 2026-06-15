document.addEventListener("DOMContentLoaded", () => {
    gsap.from(".profile-header", {
        opacity: 0,
        y: -20,
        duration: 0.8
    });

    gsap.from(".profile-card", {
        opacity: 0,
        y: 20,
        duration: 0.8,
        delay: 0.2,
        stagger: 0.2
    });
});

function openEditModal() {
    document.getElementById("editModal").style.display = "flex";
}

function closeEditModal() {
    document.getElementById("editModal").style.display = "none";
}

document.querySelector(".btn-password").addEventListener("click", () => {
    document.getElementById("passwordModal").style.display = "flex";
});

function closePasswordModal() {
    document.getElementById("passwordModal").style.display = "none";
}

