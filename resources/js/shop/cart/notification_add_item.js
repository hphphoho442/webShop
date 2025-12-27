document.addEventListener('DOMContentLoaded', () => {

    function showTopNotification(message, duration = 1500) {
        const box = document.getElementById('top-notification');
        if (!box) return;

        box.innerHTML = `<div class="top-notify">${message}</div>`;
        box.classList.add('show');

        setTimeout(() => {
            box.classList.remove('show');
        }, duration);
    }

    document.querySelectorAll('.add-to-cart').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();

            // 🔑 TÌM INPUT quantity TRONG CÙNG FORM
            const form = this.closest('form');
            const qtyInput = form.querySelector('input[name="quantity"]');
            const quantity = qtyInput ? parseInt(qtyInput.value) : 1;

            const url = this.dataset.url;

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    quantity: quantity
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // update badge
                    const cartCount = document.getElementById('cart-count');
                    if (cartCount) {
                        cartCount.innerText = data.total_items;
                    }

                    showTopNotification(data.message);
                }
            })
            .catch(err => console.error(err));
        });
    });
});
