// Autocomplete supplier — advanced version
document.addEventListener('DOMContentLoaded', () => {
  const input = document.getElementById('supplier');
  const hidden = document.getElementById('supplier_id');
  let results = document.getElementById('supplier_results');
  if (!input) return console.error('Autocomplete: #supplier not found');

  // create results container if missing
  if (!results) {
    results = document.createElement('div');
    results.id = 'supplier_results';
    document.body.appendChild(results);
  }

  // state
  let items = [];           // last fetched items
  let focusedIndex = -1;    // keyboard focus
  let timer = null;

  // utils
  const escapeHtml = s => String(s ?? '').replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
  const debounce = (fn, ms=250) => (...args) => { clearTimeout(timer); timer = setTimeout(()=>fn(...args), ms); };

  // highlight match in text (case-insensitive)
  function highlight(text, q) {
    if (!q) return escapeHtml(text);
    const re = new RegExp(q.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'), 'ig');
    return escapeHtml(text).replace(re, m => `<span class="supplier-highlight">${escapeHtml(m)}</span>`);
  }

  // position results under input
  function positionResults() {
    const rect = input.getBoundingClientRect();
    results.style.position = 'absolute';
    results.style.left = (rect.left + window.scrollX) + 'px';
    results.style.top = (rect.bottom + window.scrollY) + 'px';
    results.style.width = rect.width + 'px';
  }

  // render items
  function render(itemsList, q) {
    if (!itemsList || itemsList.length === 0) {
      results.style.display = 'none';
      input.setAttribute('aria-expanded', 'false');
      return;
    }

    results.innerHTML = itemsList.map((s, idx) => `
      <div class="supplier-item" role="option" data-index="${idx}" data-id="${escapeHtml(s.id)}" data-name="${escapeHtml(s.name)}">
        <div class="supplier-main">${highlight(s.name, q)}</div>
        <div class="supplier-meta">${highlight(s.phone ?? '', q)} ${s.phone && s.email ? ' — ' : ''} ${highlight(s.email ?? '', q)}</div>
      </div>
    `).join('');

    // reset focus state
    focusedIndex = -1;
    // position + show
    positionResults();
    results.style.display = 'block';
    input.setAttribute('aria-expanded', 'true');
  }

  // fetch suggestions
  async function fetchSuggestions(q) {
    if (!q || q.length < 2) {
      render([], q);
      return;
    }
    try {
      const url = `/admin/product/search?q=${encodeURIComponent(q)}`;
      const res = await fetch(url, { headers: { 'Accept': 'application/json' }});
      if (!res.ok) { console.warn('Autocomplete fetch failed', res.status); render([], q); return; }
      const data = await res.json();
      items = Array.isArray(data) ? data : [];
      render(items, q);
    } catch (err) {
      console.error('Autocomplete fetch error', err);
      render([], q);
    }
  }

  // choose item
  function choose(idx) {
    if (idx < 0 || idx >= items.length) return;
    const sel = items[idx];
    input.value = sel.name;
    if (hidden) hidden.value = sel.id;
    render([], ''); // hide
  }

  // update focused class visually
  function updateFocus() {
    const nodes = results.querySelectorAll('.supplier-item');
    nodes.forEach(n => n.classList.remove('focused'));
    if (focusedIndex >= 0 && focusedIndex < nodes.length) {
      nodes[focusedIndex].classList.add('focused');
      // scroll into view inside results
      const el = nodes[focusedIndex];
      const rRect = results.getBoundingClientRect();
      const eRect = el.getBoundingClientRect();
      if (eRect.top < rRect.top) el.scrollIntoView({block:'nearest'});
      else if (eRect.bottom > rRect.bottom) el.scrollIntoView({block:'nearest'});
    }
  }

  // event handlers
  input.addEventListener('input', debounce(function(e) {
    const q = (e && e.target && e.target.value) ? e.target.value.trim() : '';
    if (hidden) hidden.value = ''; // reset selected id
    fetchSuggestions(q);
  }, 250));

  // keyboard nav
  input.addEventListener('keydown', function(e) {
    if (results.style.display === 'none') return;
    const key = e.key;
    if (key === 'ArrowDown') {
      e.preventDefault();
      focusedIndex = Math.min(focusedIndex + 1, items.length - 1);
      updateFocus();
    } else if (key === 'ArrowUp') {
      e.preventDefault();
      focusedIndex = Math.max(focusedIndex - 1, 0);
      updateFocus();
    } else if (key === 'Enter') {
      e.preventDefault();
      if (focusedIndex >= 0) choose(focusedIndex);
      else {
        // if nothing focused, optionally choose first
        if (items.length > 0) choose(0);
      }
    } else if (key === 'Escape') {
      render([], '');
    }
  });

  // mouse click on result
  results.addEventListener('click', function(e) {
    const item = e.target.closest('.supplier-item');
    if (!item) return;
    const idx = parseInt(item.getAttribute('data-index'), 10);
    choose(idx);
  });

  // hide on outside click
  document.addEventListener('click', function(e) {
    if (!input.contains(e.target) && !results.contains(e.target)) {
      render([], '');
    }
  });

  // reposition on resize/scroll
  window.addEventListener('resize', () => { if (results.style.display !== 'none') positionResults(); });
  window.addEventListener('scroll', () => { if (results.style.display !== 'none') positionResults(); }, true);

  // prevent form submit on Enter when dropdown open (optional)
  input.form?.addEventListener('submit', () => { /* nothing special */ });
});
