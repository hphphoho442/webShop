document.querySelectorAll('.toggle-active').forEach((toggle) => {
    toggle.addEventListener('change', function () {
        const productId = this.dataset.id;
        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute('content');

fetch(`/admin/product/${productId}/toggle-active`, {
    method: 'PATCH',
    headers: {
        'X-CSRF-TOKEN': csrfToken,
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'Cache-Control': 'no-cache',
    },
    cache: 'no-store'
})
        
        .then(res => {
            if (!res.ok) throw new Error('CSRF error');
            return res.json();
        })
        .catch(() => {
            alert('Không thể cập nhật trạng thái');
            this.checked = !this.checked; // rollback UI
        });
    });
});
