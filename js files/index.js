window.onload = function () {
    const user_id = localStorage.getItem('user_id');
    
    if (user_id) {
      // User is signed in → go to home.html
      window.location.href = '../html files/home.html';
    } else {
      // User not signed in → go to signup.html
      window.location.href = '../html files/signup.html';
    }
  };