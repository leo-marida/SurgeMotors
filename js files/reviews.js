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
});


// JavaScript for Review Functionality
const reviewForm = document.getElementById('reviewForm');
const reviewsContainer = document.getElementById('reviewsContainer');
const stars = document.querySelectorAll('.star-rating .star');

let selectedRating = 0;

// Star Rating Functionality
stars.forEach((star) => {
  star.addEventListener('click', () => {
    selectedRating = star.getAttribute('data-value');
    stars.forEach((s) => s.classList.remove('active'));
    for (let i = 0; i < selectedRating; i++) {
      stars[i].classList.add('active');
    }
  });
});



function toggleMenu() {
  document.querySelector('.mobile-menu').classList.toggle('active');
}




