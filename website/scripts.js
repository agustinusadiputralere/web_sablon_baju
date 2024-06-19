// scripts.js

function searchProducts(event) {
    event.preventDefault();
    const query = document.getElementById('searchQuery').value.toLowerCase();
    const products = document.querySelectorAll('.gallery ul li');

    products.forEach(product => {
        const productName = product.querySelector('p').textContent.toLowerCase();
        if (productName.includes(query)) {
            product.style.display = 'block';
        } else {
            product.style.display = 'none';
        }
    });
}

document.querySelectorAll('.icon-button').forEach(button => {
    button.addEventListener('click', function() {
        this.classList.add('clicked');
        setTimeout(() => {
            this.classList.remove('clicked');
        }, 300);
    });
});
