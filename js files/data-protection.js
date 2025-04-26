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


const confirmCheckbox = document.getElementById("confirm-checkbox");
const confirmButton = document.getElementById("confirm-btn");

// Enable button when checkbox is checked
confirmCheckbox.addEventListener("change", function () {
    confirmButton.disabled = !this.checked;
});
