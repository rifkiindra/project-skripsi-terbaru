document.addEventListener("DOMContentLoaded", () => {

    const preview = document.getElementById("preview-image");
    const items = document.querySelectorAll(".work-item");

    items.forEach(item => {

        item.addEventListener("mouseenter", () => {
            const img = item.getAttribute("data-image");
            item.setAttribute("data-text", item.innerText);

            preview.src = img;
            preview.style.transition = "none";
            preview.style.transform = "scale(1.25)";
            preview.style.opacity = "1";

            void preview.offsetWidth;

            preview.style.transition = "transform 4s ease-out, opacity .3s ease-out";
            preview.style.transform = "scale(1)";

        });

        item.addEventListener("mouseleave", () => {
            preview.style.opacity = "0";
        });
    });

});
