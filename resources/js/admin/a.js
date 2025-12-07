
const input = document.getElementById('supplier-search');
const hidden = document.getElementById('supplier_id');
const box = document.getElementById('supplier-suggestions');
let timer = null;

function debounce(fn, ms) {
  return (...args) => {
    clearTimeout(timer);
    timer = setTimeout(() => fn(...args), ms);
  };
}

async function fetchSuggestions(q) {
  if (!q || q.length < 2) { // min 2 ký tự
    box.style.display = 'none';
    return;
  }
  try {
    const url = `/admin/suppliers/search?q=${encodeURIComponent(q)}`;
    const res = await fetch(url, { headers: { 'Accept': 'application/json' }});
    if (!res.ok) throw new Error('Network error');
    const data = await res.json();
    renderSuggestions(data);
  } catch (e) {
    console.error(e);
    box.style.display = 'none';
  }
}

function renderSuggestions(items) {
  if (!items || items.length === 0) {
    box.style.display = 'none';
    return;
  }
  box.innerHTML = items.map(it => `
    <div class="suggestion-item" data-id="${it.id}" data-name="${escapeHtml(it.name)}" style="padding:8px;cursor:pointer;border-bottom:1px solid #eee;">
      <strong>${escapeHtml(it.name)}</strong><br>
      <small>${escapeHtml(it.phone)} — ${escapeHtml(it.email)}</small>
    </div>
  `).join('');
  box.style.display = 'block';
}

// click handler (event delegation)
box.addEventListener('click', e => {
  const item = e.target.closest('.suggestion-item');
  if (!item) return;
  const id = item.getAttribute('data-id');
  const name = item.getAttribute('data-name');
  hidden.value = id;
  input.value = name;
  box.style.display = 'none';
});

// hide when click outside
document.addEventListener('click', e => {
  if (!input.contains(e.target) && !box.contains(e.target)) {
    box.style.display = 'none';
  }
});

// escape html helper
function escapeHtml(s) {
  return (s ?? '').replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
}

input.addEventListener('input', debounce(e => {
  hidden.value = ''; // reset selected id khi user gõ mới
  fetchSuggestions(e.target.value.trim());
}, 300));

