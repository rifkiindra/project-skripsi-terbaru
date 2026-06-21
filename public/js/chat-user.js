/**
 * CHAT USER SCRIPT – FINAL
 * Semua tombol aktif:
 * Emoji | Image | Video | Coret | Preview | Modal
 */

document.addEventListener("DOMContentLoaded", () => {
    const chatBody = document.getElementById("chatBody");
    if (chatBody) chatBody.scrollTop = chatBody.scrollHeight;
});

/* ===== ELEMENT ===== */
const emojiBox = document.getElementById("emojiBox");
const fileInput = document.getElementById("fileInput");
const previewBox = document.getElementById("previewBox");
const imgPreview = document.getElementById("imgPreview");
const videoPreview = document.getElementById("videoPreview");
const messageInput = document.getElementById("messageInput");
const chatType = document.getElementById("chatType");

/* ===== EMOJI ===== */
function toggleEmoji() {
    emojiBox.style.display =
        emojiBox.style.display === "block" ? "none" : "block";
}

function addEmoji(emoji) {
    messageInput.value += emoji;
    messageInput.focus();
}

/* ===== IMAGE ===== */
function pickImage() {
    chatType.value = "image";
    fileInput.accept = "image/*";
    fileInput.click();
}

/* ===== VIDEO ===== */
function pickVideo() {
    chatType.value = "video";
    fileInput.accept = "video/*";
    fileInput.click();
}

/* ===== FILE PREVIEW ===== */
fileInput.addEventListener("change", () => {
    const file = fileInput.files[0];
    if (!file) return;

    previewBox.classList.add("show");
    imgPreview.style.display = "none";
    videoPreview.style.display = "none";

    const url = URL.createObjectURL(file);

    if (file.type.startsWith("image")) {
        imgPreview.src = url;
        imgPreview.style.display = "block";
    }

    if (file.type.startsWith("video")) {
        videoPreview.src = url;
        videoPreview.style.display = "block";
    }
});

/* ===== CLEAR PREVIEW ===== */
function clearPreview() {
    previewBox.classList.remove("show");
    fileInput.value = "";
}

/* ===== IMAGE MODAL ===== */
function openImage(src) {
    const modal = document.getElementById("imageModal");
    const img = document.getElementById("modalImage");
    img.src = src;
    modal.style.display = "flex";
}

function closeImage() {
    document.getElementById("imageModal").style.display = "none";
}
