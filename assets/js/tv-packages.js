const modal = document.getElementById('activationModal');
const closeBtn = document.querySelector('.modal-close');
const form = document.getElementById('activationForm');
const successPopup = document.getElementById('successPopup');
const pkgSelect = document.getElementById('packageSelect');
const channelSel = document.getElementById('channelSelection');
const selectAllBtn = document.getElementById('selectAllBtn');
const clearBtn = document.getElementById('clearBtn');
const countEl = document.getElementById('selectedCount');
const checkboxes = () => Array.from(document.querySelectorAll('input[name="channels"]'));

function updateSelected() {
    if (!form || !pkgSelect || !countEl) return;

    const picked = checkboxes().filter(c => c.checked).map(c => c.value);
    const selectedOption = pkgSelect.options[pkgSelect.selectedIndex];
    const isCustomPackage = selectedOption && selectedOption.dataset.custom === '1';
    countEl.textContent = picked.length;
    localStorage.setItem('selectedChannels', JSON.stringify(picked));

    const submitBtn = form.querySelector('button[type="submit"]');
    if (!submitBtn) return;

    if (isCustomPackage && picked.length === 0) {
        submitBtn.disabled = true;
        submitBtn.style.opacity = '0.5';
        submitBtn.style.cursor = 'not-allowed';
    } else {
        submitBtn.disabled = false;
        submitBtn.style.opacity = '1';
        submitBtn.style.cursor = 'pointer';
    }
}

if (pkgSelect && channelSel) {
    pkgSelect.addEventListener('change', () => {
        const selectedOption = pkgSelect.options[pkgSelect.selectedIndex];
        const isCustomPackage = selectedOption && selectedOption.dataset.custom === '1';

        if (isCustomPackage) {
            channelSel.style.display = 'block';
            try {
                const saved = JSON.parse(localStorage.getItem('selectedChannels') || '[]');
                checkboxes().forEach(cb => cb.checked = saved.includes(cb.value));
            } catch (e) {}
            updateSelected();
        } else {
            channelSel.style.display = 'none';
            const submitBtn = form ? form.querySelector('button[type="submit"]') : null;
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.style.opacity = '1';
                submitBtn.style.cursor = 'pointer';
            }
        }
    });
}

if (selectAllBtn) {
    selectAllBtn.addEventListener('click', () => {
        checkboxes().forEach(cb => cb.checked = true);
        updateSelected();
    });
}

if (clearBtn) {
    clearBtn.addEventListener('click', () => {
        checkboxes().forEach(cb => cb.checked = false);
        updateSelected();
    });
}

checkboxes().forEach(cb => cb.addEventListener('change', updateSelected));

document.querySelectorAll('.toggle-header').forEach(toggle => {
    const target = document.getElementById(toggle.dataset.target);
    const arrow = toggle.querySelector('span');
    if (!target || !arrow) return;

    target.style.overflow = 'hidden';
    target.style.maxHeight = '0px';
    target.style.transition = 'max-height 220ms ease, padding 220ms ease';

    function openList() {
        target.style.display = 'block';
        arrow.style.transform = 'rotate(90deg)';
        requestAnimationFrame(() => target.style.maxHeight = target.scrollHeight + 'px');
    }

    function closeList() {
        target.style.maxHeight = '0px';
        arrow.style.transform = 'rotate(0deg)';
        setTimeout(() => target.style.display = 'none', 260);
    }

    toggle.addEventListener('click', () => {
        if (target.style.display === 'block') closeList();
        else openList();
    });
});

function collapseAllLists() {
    document.querySelectorAll('.toggle-header').forEach(h => {
        const target = document.getElementById(h.dataset.target);
        const arrow = h.querySelector('span');
        if (target && arrow && target.style.display === 'block') {
            target.style.maxHeight = '0px';
            arrow.style.transform = 'rotate(0deg)';
            setTimeout(() => target.style.display = 'none', 260);
        }
    });

    checkboxes().forEach(cb => cb.checked = false);
    if (countEl) countEl.textContent = '0';
    localStorage.removeItem('selectedChannels');
}

document.querySelectorAll('.package-btn').forEach(btn => {
    btn.addEventListener('click', e => {
        e.preventDefault();
        if (successPopup) successPopup.style.display = 'none';
        if (form) form.reset();
        if (channelSel) channelSel.style.display = 'none';
        if (countEl) countEl.textContent = '0';
        if (modal) modal.style.display = 'block';
    });
});

if (closeBtn) closeBtn.addEventListener('click', () => {
    if (modal) modal.style.display = 'none';
    collapseAllLists();
});

window.addEventListener('click', e => {
    if (e.target === modal) {
        modal.style.display = 'none';
        collapseAllLists();
    }
});

const phoneInput = document.querySelector('input[type="tel"]');
if (phoneInput) {
    phoneInput.addEventListener('input', (e) => {
        e.target.value = e.target.value.replace(/[^0-9+]/g, '');
    });
}
