window.addEventListener('DOMContentLoaded', () => {

    const urlParams = new URLSearchParams(window.location.search);
    const name = urlParams.get('name');
    const price = urlParams.get('price');
    const year = urlParams.get('year');
    const img = urlParams.get('img');

    document.getElementById('car-name').textContent = name || 'N/A';
    document.getElementById('car-price').textContent = price || 'N/A';
    document.getElementById('car-year').textContent = year || 'N/A';
    document.getElementById('car-img').src = img || '';

    // Also update the total cost display
    document.getElementById('total-cost').textContent = price || 'N/A';

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

    // Populate hidden fields for backend form submission
    document.getElementById('hiddenCarName').value = name;
    document.getElementById('hiddenCarYear').value = year;

    // Populate user ID from localStorage
    const userId = localStorage.getItem('user_id');
    if (userId) {
        document.getElementById('userIdInput').value = userId;
    }

});



