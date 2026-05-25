// assets/js/contact-modal.js

const modal = document.getElementById("contactModal");
const openBtn = document.getElementById("openContactBtn");
const closeBtn = document.getElementById("closeContactBtn");
const overlay = document.getElementById("modalOverlay");

if (openBtn) {
    openBtn.addEventListener("click", function() {
        modal.classList.add("active");
        document.body.style.overflow = "hidden"; // Ndalon skrollimin mbrapa
    });
}

if (closeBtn) closeBtn.addEventListener("click", closeModal);
if (overlay) overlay.addEventListener("click", closeModal);

function closeModal() {
    modal.classList.remove("active");
    document.body.style.overflow = "auto"; // Rikthen skrollimin
}