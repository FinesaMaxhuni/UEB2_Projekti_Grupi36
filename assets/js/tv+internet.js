// Modal functionality
const modal = document.getElementById('activationModal');
const closeBtn = document.querySelector('.modal-close');
const activationForm = document.getElementById('activationForm');
const successMessage = document.getElementById('successMessage');
const successPopup = document.getElementById('successPopup');
const successPopupText = document.getElementById('successPopupText');

// Open modal when clicking "Aktivizo Pakon" buttons
document.querySelectorAll('.package-btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        if (successMessage) successMessage.style.display = 'none';
        if (activationForm) activationForm.reset();
        if (modal) modal.style.display = 'block';
    });
});

// Close modal when clicking X
if (closeBtn) {
    closeBtn.addEventListener('click', function() {
        if (modal) modal.style.display = 'none';
    });
}

// Close modal when clicking outside
window.addEventListener('click', function(e) {
    if (e.target === modal && modal) {
        modal.style.display = 'none';
    }
});

// Only allow numbers and '+' symbol in phone input field
const phoneInput = document.querySelector('#activationForm input[type="tel"]');
if (phoneInput) {
    phoneInput.addEventListener('input', (e) => {
        e.target.value = e.target.value.replace(/[^0-9+]/g, '');
    });
}

// Handle form submission
if (activationForm) {
    activationForm.addEventListener('submit', function(e) {

        const pkgSelect = document.getElementById('packageSelect');
        let message = '✓ Pako u aktivizua me sukses! Faleminderit.';

        if (pkgSelect) {
            const val = pkgSelect.value;
            if (val === 'combo-basic') {
                message = '✓ Pako Combo Basic u aktivizua me sukses!';
            } else if (val === 'combo-plus') {
                message = '✓ Pako Combo Plus u aktivizua me sukses!';
            } else if (val === 'combo-sport') {
                message = '✓ Pako Combo Sport u aktivizua me sukses!';
            } else if (val === 'combo-ultra') {
                message = '✓ Pako Combo Ultra u aktivizua me sukses!';
            }
        }

        // Show floating popup 
        if (successPopup && successPopupText) {
            successPopupText.textContent = message;
            successPopup.style.display = 'block';
        } else if (successMessage) {
            successMessage.textContent = message;
            successMessage.style.display = 'block';
        }

        // Reset form after 2 seconds and close modal, hide popup
        setTimeout(() => {
            if (activationForm) activationForm.reset();
            if (modal) modal.style.display = 'none';
            if (successPopup) successPopup.style.display = 'none';
        }, 2000);
    });
}
