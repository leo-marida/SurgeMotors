window.addEventListener('DOMContentLoaded', () => {
    
    document.getElementById('signOutBtn')?.addEventListener('click', function () {
        localStorage.removeItem('username');
        localStorage.clear();
    
        window.location.href = 'index.html';
    });

    
    document.getElementById('signOutBtn2')?.addEventListener('click', function () {
        localStorage.removeItem('username');
        localStorage.clear();
    
        window.location.href = 'index.html';
    });

    const urlParams = new URLSearchParams(window.location.search);
    const name = urlParams.get('name');
    const year = urlParams.get('year');

    document.getElementById('car-name').textContent = name || 'N/A';
    document.getElementById('car-year').textContent = year || 'N/A';
});

function toggleMenu() {
    document.querySelector('.mobile-menu').classList.toggle('active');
}
