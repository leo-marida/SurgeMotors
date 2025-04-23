document.addEventListener('DOMContentLoaded', function () {
  const carList = document.getElementById('carList');
  const emptyState = document.getElementById('emptyState');
  let savedCars = JSON.parse(localStorage.getItem('bookmarkedCars') || '[]');

  function updateEmptyState() {
    if (savedCars.length === 0) {
      emptyState.style.display = 'block';
    } else {
      emptyState.style.display = 'none';
    }
  }

  function renderCars() {
    carList.innerHTML = ''; // Clear existing list
    savedCars.forEach((car, index) => {
      const card = document.createElement('div');
      card.className = 'car-card';

      card.innerHTML = `
              <img src="${car.image}" alt="${car.title}">
              <h3>${car.title}</h3>
              <p><strong>${car.price}</strong></p>
              <br>
              <div class="button-group">
                  <button style="background-color:red" class="view-btn">View Details</button>
                  <button style="background-color:red" class="remove-btn">UnSave</button>
              </div>
          `;

      // View button
      card.querySelector('.view-btn').onclick = () => {
        window.location.href = car.detailsLink;
      };

      // Remove button
      card.querySelector('.remove-btn').onclick = () => {
        savedCars.splice(index, 1); // Remove from array
        localStorage.setItem('bookmarkedCars', JSON.stringify(savedCars)); // Update storage
        renderCars(); // Re-render list
        updateEmptyState(); // Check if we need to show empty state
      };

      carList.appendChild(card);
    });
  }

  renderCars();
  updateEmptyState();

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
