document.querySelectorAll('.add-to-cart').forEach(btn => {
    btn.addEventListener('click', function () {
        let productId = this.dataset.productId;

        fetch("{{ route('cart.add') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: 1
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                // cập nhật số item
                document.getElementById('cart-count').innerText = data.total_items;

                // toast thông báo
                showToast(data.message);
            }
        });
    });
});

function showToast(message) {
    let toast = document.createElement('div');
    toast.className = 'toast align-items-center text-bg-success show position-fixed bottom-0 end-0 m-3';
    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">${message}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto"></button>
        </div>
    `;

    document.body.appendChild(toast);

    setTimeout(() => toast.remove(), 3000);
}
