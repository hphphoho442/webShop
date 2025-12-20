
document.querySelectorAll('.quantity-input').forEach(input => {
    input.addEventListener('blur', function () {
        const itemId = this.dataset.id;
        const quantity = this.value;
        const token = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute('content');
        fetch(`/cart/${itemId}/update`, {
            method: 'POST',
            credentials: 'same-origin', // ⭐ QUAN TRỌNG NHẤT ⭐
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ quantity })
        })
        .then(res => res.json())
        .then(data => {
            // update subtotal
            document.querySelector(
                `.item-subtotal[data-id="${itemId}"]`
            ).innerText = data.subtotal.toLocaleString() + ' đ';

            // update total
            document.getElementById('cart-total')
                .innerText = data.total.toLocaleString() + ' đ';
        })
        .catch(() => {
            alert('Cập nhật số lượng thất bại');
        });
    });
});
