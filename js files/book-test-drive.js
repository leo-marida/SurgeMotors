window.addEventListener('DOMContentLoaded', () => {
    
    const urlParams = new URLSearchParams(window.location.search);
    const name = urlParams.get('name');
    const year = urlParams.get('year');

    document.getElementById('car-name').textContent = name || 'N/A';
    document.getElementById('car-year').textContent = year || 'N/A';
});

function toggleMenu() {
    document.querySelector('.mobile-menu').classList.toggle('active');
}
