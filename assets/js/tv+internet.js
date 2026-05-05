// Modal functionality
const modal = document.getElementById('activationModal');
const closeBtn = document.querySelector('.modal-close');
const activationForm = document.getElementById('activationForm');
const successMessage = document.getElementById('successMessage');

document.querySelectorAll('.package-btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        if (successMessage) successMessage.style.display = 'none';
        if (activationForm) activationForm.reset();
        if (modal) modal.style.display = 'block';
    });
});

if (closeBtn) {
    closeBtn.addEventListener('click', function() {
        if (modal) modal.style.display = 'none';
    });
}

window.addEventListener('click', function(e) {
    if (e.target === modal && modal) {
        modal.style.display = 'none';
    }
});

const phoneInput = document.querySelector('#activationForm input[type="tel"]');
if (phoneInput) {
    phoneInput.addEventListener('input', (e) => {
        e.target.value = e.target.value.replace(/[^0-9+]/g, '');
    });
}
