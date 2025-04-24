const userId = localStorage.getItem('user_id');
if (userId) {
    document.getElementById('userIdInput').value = userId;
}