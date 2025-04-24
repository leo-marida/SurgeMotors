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

    const userId = localStorage.getItem('user_id');
    if (userId) {
        document.getElementById('userIdInput').value = userId;
    }


    const urlParams = new URLSearchParams(window.location.search);
    const name = urlParams.get('name');
    const year = urlParams.get('year');
    const img = urlParams.get('img');

    document.getElementById('car-name').textContent = name || 'N/A';
    document.getElementById('car-year').textContent = year || 'N/A';
    document.getElementById('car-img').src = img || '';

    document.getElementById('hiddenCarName').value = name;
    document.getElementById('hiddenCarYear').value = year;

});

function toggleMenu() {
    document.querySelector('.mobile-menu').classList.toggle('active');
}
