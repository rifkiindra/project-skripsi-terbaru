/**
 * OPEN CHAT USER (WHATSAPP DESKTOP STYLE)
 */
function openChat(userId, el) {
    // ===== ACTIVE STATE USER =====
    document
        .querySelectorAll(".chat-item")
        .forEach((i) => i.classList.remove("active"));

    el.classList.add("active");

    // ===== LOAD CHAT =====
    fetch(`/admin/chat/${userId}`)
        .then((res) => res.text())
        .then((html) => {
            const wrapper = document.getElementById("chatWrapper");
            wrapper.innerHTML = html;

            initChatFeature(); // ⬅️ PENTING
        });
}

/**
 * INIT CHAT FEATURE SETELAH CHAT MUNCUL
 */
function initChatFeature() {
    const textarea = document.getElementById("messageInput");
    const fileInput = document.getElementById("fileInput");

    const previewBox = document.getElementById("previewContainer");
    const previewImg = document.getElementById("previewImage");
    const previewVid = document.getElementById("previewVideo");
    const removePreview = document.getElementById("removePreview");

    const emojiBtn = document.getElementById("emojiBtn");
    const emojiBox = document.getElementById("emojiBox");

    const chatBox = document.getElementById("chatBox");
    const form = document.getElementById("chatForm");

    const viewer = document.getElementById("imageViewer");
    const viewerImg = document.getElementById("viewerImage");
    const closeViewer = document.getElementById("closeViewer");
    const downloadBtn = document.getElementById("downloadImage");

    // ===== FULLSCREEN PREVIEW =====
    document.querySelectorAll(".chat-image").forEach((img) => {
        img.addEventListener("click", () => {
            const src = img.dataset.src;

            viewerImg.src = src;
            downloadBtn.href = src;

            viewer.classList.remove("d-none");
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        const body = document.getElementById("chatBody");
        if (body) {
            body.scrollTop = body.scrollHeight;
        }
    });

    // close button
    closeViewer?.addEventListener("click", () => {
        viewer.classList.add("d-none");
        viewerImg.src = "";
    });

    // click outside image to close
    viewer?.addEventListener("click", (e) => {
        if (e.target === viewer) {
            viewer.classList.add("d-none");
            viewerImg.src = "";
        }
    });

    // ESC key
    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") {
            viewer.classList.add("d-none");
            viewerImg.src = "";
        }
    });
    // ===== AUTO SCROLL =====
    if (chatBox) chatBox.scrollTop = chatBox.scrollHeight;

    // ===== AUTO HEIGHT TEXTAREA =====
    textarea?.addEventListener("input", () => {
        textarea.style.height = "auto";
        textarea.style.height = textarea.scrollHeight + "px";
    });

    // ===== FILE PREVIEW =====
    fileInput?.addEventListener("change", () => {
        const file = fileInput.files[0];
        if (!file) return;

        previewBox.classList.remove("d-none");
        previewImg.classList.add("d-none");
        previewVid.classList.add("d-none");

        const url = URL.createObjectURL(file);

        if (file.type.startsWith("image")) {
            previewImg.src = url;
            previewImg.classList.remove("d-none");
        }

        if (file.type.startsWith("video")) {
            previewVid.src = url;
            previewVid.classList.remove("d-none");
        }
    });

    removePreview?.addEventListener("click", () => {
        previewBox.classList.add("d-none");
        previewImg.src = "";
        previewVid.src = "";
        fileInput.value = "";
    });

    // ===== EMOJI =====
    emojiBtn?.addEventListener("click", (e) => {
        e.preventDefault();
        e.stopPropagation();
        emojiBox.classList.toggle("d-none");
    });

    emojiBox?.addEventListener("click", (e) => {
        e.stopPropagation();

        if (e.target.tagName !== "SPAN") return;

        textarea.value += e.target.textContent;
        textarea.dispatchEvent(new Event("input"));
        textarea.focus();
    });

    // TUTUP SAAT KLIK LUAR
    document.addEventListener("click", () => {
        if (!emojiBox.classList.contains("d-none")) {
            emojiBox.classList.add("d-none");
        }
    });

    form?.addEventListener("submit", function (e) {
        const text = textarea.value.trim();
        const hasFile = fileInput.files.length > 0;

        // ⛔ BENAR-BENAR kosong
        if (!text && !hasFile) {
            e.preventDefault();
            return;
        }

        // ✅ kalau ada file → message boleh kosong
        if (hasFile && !text) {
            textarea.value = "";
        }
    });
}
