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

// Get elements
const agreeCheckbox = document.getElementById("agree-checkbox");
const agreeButton = document.getElementById("agree-btn");
const termsContent = document.getElementById("terms-content");

// Enable the button when the checkbox is checked
agreeCheckbox.addEventListener("change", function () {
    agreeButton.disabled = !this.checked;
});

// Force user to scroll to the bottom before agreeing
termsContent.addEventListener("scroll", function () {
    if (termsContent.scrollTop + termsContent.clientHeight >= termsContent.scrollHeight) {
        agreeCheckbox.disabled = false;
    }
});
