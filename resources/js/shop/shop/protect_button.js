document.addEventListener('DOMContentLoaded', function () {

    let activeCard = null;

    document.querySelectorAll('.product-card').forEach(card => {

        card.addEventListener('click', function (e) {
            if (e.target.closest('button')) return;

            if (activeCard && activeCard !== card) {
                activeCard.classList.remove('active');
            }

            card.classList.toggle('active');
            activeCard = card.classList.contains('active') ? card : null;
        });

        card.querySelector('.view-detail').addEventListener('click', function (e) {
            e.stopPropagation();
            window.location.href = card.dataset.url;
        });

        card.querySelector('.add-to-cart').addEventListener('click', function (e) {
            e.stopPropagation();
            card.classList.remove('active');
        });
    });

    document.addEventListener('click', function (e) {
        if (!e.target.closest('.product-card') && activeCard) {
            activeCard.classList.remove('active');
            activeCard = null;
        }
    });

});
