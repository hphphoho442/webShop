document.querySelectorAll('.add-to-cart').forEach(btn => {
    btn.addEventListener('click', function (e) {
        e.stopPropagation();

        fetch(this.dataset.url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                product_id: this.dataset.id,
                quantity: 1
            })
        })
        .then(res => res.json())
        .then(data => {
            alert(data.message);
        });
    });
});
