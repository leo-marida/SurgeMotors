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
    
});