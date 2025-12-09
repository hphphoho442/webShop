// Autocomplete category — improved
document.addEventListener('DOMContentLoaded', () => {
  const input = document.getElementById('category');
  const hidden = document.getElementById('category_id');
  let results = document.getElementById('category_results');
  const container = document.getElementById('d_category');

  if (!input) return console.error('Autocomplete: #category not found');
  if (!container) return console.error('Autocomplete: #d_category not found');

  // create results container if missing
  if (!results) {
    results = document.createElement('div');
    results.id = 'category_results';
    results.setAttribute('role', 'listbox');
    results.setAttribute('aria-label', 'Gợi ý danh mục'); // sửa
    results.style.display = 'none';
    container.appendChild(results);
  }

  // style defaults (bỏ qua nếu bạn dùng css)
  results.style.position = 'absolute';
  results.style.boxSizing = 'border-box';
  results.style.zIndex = '1000';
  results.style.maxHeight = '240px';
  results.style.overflowY = 'auto';
  results.style.background = 'white';

  // state
  let items = [];
  let focusedIndex = -1;

  // safer debounce: timer inside closure
  const debounce = (fn, ms = 250) => {
    let t = null;
    return (...args) => { clearTimeout(t); t = setTimeout(() => fn(...args), ms); };
  };

  const escapeHtml = s => String(s ?? '').replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
  function highlight(text, q) {
    if (!q) return escapeHtml(text);
    const re = new RegExp(q.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'), 'ig');
    return escapeHtml(text).replace(re, m => `<span class="category-highlight">${escapeHtml(m)}</span>`);
  }

  function positionResults() {
    const left = input.offsetLeft;
    const top = input.offsetTop + input.offsetHeight;
    results.style.left = left + 'px';
    results.style.top = top + 'px';
    results.style.width = input.offsetWidth + 'px';
  }

  function render(itemsList, q) {
    if (!itemsList || itemsList.length === 0) {
      results.style.display = 'none';
      input.setAttribute('aria-expanded', 'false');
      return;
    }

    results.innerHTML = itemsList.map((s, idx) => `
      <div class="category-item" role="option" data-index="${idx}" data-id="${escapeHtml(s.id)}" data-name="${escapeHtml(s.name)}" data-parent="${escapeHtml(s.parent_id ?? '')}">
        <div class="category-main">${highlight(s.name ?? '', q)}</div>
        <div class="category-meta">${highlight(s.parent_name ?? '', q)}</div>
      </div>
    `).join('');

    results.querySelectorAll('.category-item').forEach((el, i) => {
      el.addEventListener('mouseenter', () => { focusedIndex = i; updateFocus(); });
      el.addEventListener('mouseleave', () => { focusedIndex = -1; updateFocus(); });
    });

    focusedIndex = -1;
    positionResults();
    results.style.display = 'block';
    input.setAttribute('aria-expanded', 'true');
  }

  async function fetchSuggestions(q) {
    if (!q || q.length < 2) { render([], q); return; }
    try {
      const url = `/admin/categories/search?q=${encodeURIComponent(q)}`;
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

  function choose(idx) {
    if (idx < 0 || idx >= items.length) return;
    const sel = items[idx];
    input.value = sel.name ?? '';
    if (hidden) hidden.value = sel.id ?? '';
    render([], '');
  }

  function updateFocus() {
    const nodes = results.querySelectorAll('.category-item');
    nodes.forEach(n => n.classList.remove('focused'));
    if (focusedIndex >= 0 && focusedIndex < nodes.length) {
      nodes[focusedIndex].classList.add('focused');
      const el = nodes[focusedIndex];
      const rTop = results.scrollTop;
      const rBottom = rTop + results.clientHeight;
      const eTop = el.offsetTop;
      const eBottom = eTop + el.offsetHeight;
      if (eTop < rTop) results.scrollTop = eTop;
      else if (eBottom > rBottom) results.scrollTop = eBottom - results.clientHeight;
    }
  }

  // events
  input.addEventListener('input', debounce(function(e) {
    const q = (e && e.target && e.target.value) ? e.target.value.trim() : '';
    if (hidden) hidden.value = '';
    fetchSuggestions(q);
  }, 250));

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
      else if (items.length > 0) choose(0);
    } else if (key === 'Escape') {
      render([], '');
    }
  });

  results.addEventListener('click', function(e) {
    const item = e.target.closest('.category-item');
    if (!item) return;
    const idx = parseInt(item.getAttribute('data-index'), 10);
    choose(idx);
  });

  document.addEventListener('click', function(e) {
    if (!input.contains(e.target) && !results.contains(e.target)) {
      render([], '');
    }
  });

  window.addEventListener('resize', () => { if (results.style.display !== 'none') positionResults(); });
  window.addEventListener('scroll', () => { if (results.style.display !== 'none') positionResults(); }, true);
});
