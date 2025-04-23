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
});


const acceptCheckbox = document.getElementById("accept-checkbox");
const acceptButton = document.getElementById("accept-btn");

// Enable button when checkbox is checked
acceptCheckbox.addEventListener("change", function () {
    acceptButton.disabled = !this.checked;
});

