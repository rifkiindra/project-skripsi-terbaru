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
    emojiBtn?.addEventListener("click", () => {
        emojiBox.classList.toggle("d-none");
    });

    emojiBox?.addEventListener("click", (e) => {
        if (e.target.tagName !== "SPAN") return;

        textarea.value += e.target.textContent;
        textarea.dispatchEvent(new Event("input"));
        textarea.focus();
    });

    form?.addEventListener("submit", function (e) {
        const text = textarea.value.trim();
        const file = fileInput.files.length;

        if (!text && !file) {
            e.preventDefault();
            return; // ⛔ STOP KIRIM PESAN KOSONG
        }
    });
}
