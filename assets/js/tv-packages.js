const modal = document.getElementById('activationModal');
const closeBtn = document.querySelector('.modal-close');
const form = document.getElementById('activationForm');
const successPopup = document.getElementById('successPopup');
const successPopupText = document.getElementById('successPopupText');
const pkgSelect = document.getElementById('packageSelect');
const channelSel = document.getElementById('channelSelection');
const selectAllBtn = document.getElementById('selectAllBtn');
const clearBtn = document.getElementById('clearBtn');
const countEl = document.getElementById('selectedCount');
const checkboxes = () => Array.from(document.querySelectorAll('input[name="channels"]'));

function updateSelected() {
    const picked = checkboxes().filter(c=>c.checked).map(c=>c.value);
    countEl.textContent = picked.length;
    localStorage.setItem('selectedChannels', JSON.stringify(picked));
    
    // Disable submit button if custom package selected with no channels
    const submitBtn = form.querySelector('button[type="submit"]');
    if (pkgSelect.value === 'custom' && picked.length === 0) {
        submitBtn.disabled = true;
        submitBtn.style.opacity = '0.5';
        submitBtn.style.cursor = 'not-allowed';
    } else {
        submitBtn.disabled = false;
        submitBtn.style.opacity = '1';
        submitBtn.style.cursor = 'pointer';
    }
}

pkgSelect.addEventListener('change', ()=>{
    if (pkgSelect.value === 'custom') {
        channelSel.style.display = 'block';
        try {
            const saved = JSON.parse(localStorage.getItem('selectedChannels')||'[]');
            checkboxes().forEach(cb=>cb.checked = saved.includes(cb.value));
        } catch(e){ }
        updateSelected();
    } else {
        channelSel.style.display = 'none';
        const submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.disabled = false;
        submitBtn.style.opacity = '1';
        submitBtn.style.cursor = 'pointer';
    }
});

selectAllBtn.addEventListener('click', ()=>{ checkboxes().forEach(cb=>cb.checked = true); updateSelected(); });
clearBtn.addEventListener('click', ()=>{ checkboxes().forEach(cb=>cb.checked = false); updateSelected(); });
checkboxes().forEach(cb=>cb.addEventListener('change', updateSelected));

// Category toggles: expand/collapse sublists when arrow clicked
document.querySelectorAll('.toggle-header').forEach(toggle => {
    const target = document.getElementById(toggle.dataset.target);
    const arrow = toggle.querySelector('span');
    if (!target) return;

    // slide
    target.style.overflow = 'hidden';
    target.style.maxHeight = '0px';
    target.style.transition = 'max-height 220ms ease, padding 220ms ease';

    function openList() {
        target.style.display = 'block';
        arrow.style.transform = 'rotate(90deg)';
        const h = target.scrollHeight;
        requestAnimationFrame(()=> target.style.maxHeight = h + 'px');
    }

    function closeList() {
        target.style.maxHeight = '0px';
        arrow.style.transform = 'rotate(0deg)';
        setTimeout(()=>{
            target.style.display = 'none';
        }, 260);
    }

    toggle.addEventListener('click', ()=>{
        if (target.style.display === 'block') closeList(); else openList();
    });
});

function collapseAllLists() {
    document.querySelectorAll('.toggle-header').forEach(h => {
        const target = document.getElementById(h.dataset.target);
        const arrow = h.querySelector('span');
        if (target && target.style.display === 'block') {
            target.style.maxHeight = '0px';
            arrow.style.transform = 'rotate(0deg)';
            setTimeout(()=> target.style.display = 'none', 260);
        }
    });
    // Largon te gjitha zgjedhjet, rivendos numratorin ne 0, dhe pastron localStorage
    checkboxes().forEach(cb => cb.checked = false);
    countEl.textContent = '0';
    localStorage.removeItem('selectedChannels');
}

document.querySelectorAll('.package-btn').forEach(b=> b.addEventListener('click', e=>{
    e.preventDefault(); successPopup.style.display='none'; form.reset(); channelSel.style.display='none'; countEl.textContent='0'; modal.style.display='block';
}));

closeBtn.addEventListener('click', ()=> { modal.style.display='none'; collapseAllLists(); });
window.addEventListener('click', e=> { if (e.target === modal) { modal.style.display='none'; collapseAllLists(); } });

// Only allow numbers and '+' symbol in phone input field
const phoneInput = document.querySelector('input[type="tel"]');
if (phoneInput) {
    phoneInput.addEventListener('input', (e) => {
        e.target.value = e.target.value.replace(/[^0-9+]/g, '');
    });
}

form.addEventListener('submit', e=>{
        
    let message = '';
    const pkgValue = pkgSelect.value;
    
    if (pkgValue === 'custom') {
        const picked = JSON.parse(localStorage.getItem('selectedChannels')||'[]');
        message = `✓ Pako Custom u aktivizua — ${picked.length} kanale të zgjedhura.`;
    } else if (pkgValue === 'economy') {
        message = '✓ Pako TV Economy u aktivizua me sukses! Shijoni 90+ kanale në HD.';
    } else if (pkgValue === 'premium') {
        message = '✓ Pako TV Premium u aktivizua me sukses! Shijoni 150+ kanale HD/4K.';
    } else if (pkgValue === 'sport') {
        message = '✓ Pako TV Sport u aktivizua me sukses! Shijoni të gjitha ngjarjet sportive.';
    }
    
    successPopupText.textContent = message;
    successPopup.style.display = 'block';
    modal.style.display = 'none';
    collapseAllLists();
    setTimeout(()=>{ form.reset(); channelSel.style.display='none'; successPopup.style.display='none'; }, 2000);
});
