window.addEventListener('DOMContentLoaded', () => {

    document.getElementById('signOutBtn')?.addEventListener('click', function () {
        localStorage.removeItem('user_id');
        localStorage.clear();
    
        window.location.href = 'index.html';
    });

    
    document.getElementById('signOutBtn2')?.addEventListener('click', function () {
        localStorage.removeItem('user_id');
        localStorage.clear();
    
        window.location.href = 'index.html';
    });
    

    // Populate user ID from localStorage
    const userId = localStorage.getItem('user_id');
    if (userId) {
        document.getElementById('userIdInput').value = userId;
    }
});

function toggleMenu() {
    document.querySelector('.mobile-menu').classList.toggle('active');
}

