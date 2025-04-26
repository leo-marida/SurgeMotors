$(document).ready(function () {

    // ========== Sign In ==========
    $('#signin-form').on('submit', function (e) {
        e.preventDefault();
        const form = this;
        const formData = new FormData(form);
        const queryString = new URLSearchParams(formData).toString();

        $.ajax({
            type: 'GET',
            url: '../php files/signin.php?' + queryString,
            success: function (response) {
                try {
                    const jsonResponse = JSON.parse(response);

                    if (jsonResponse.success) {
                        localStorage.setItem('user_id', jsonResponse.user_id);
                        alert("Sign in successful!");
                        window.location.href = 'home.html';
                    } else {
                        alert("Invalid credentials!");
                    }
                } catch (error) {
                    alert("Error occurred while signing in");
                }
            },
            error: function () {
                alert("Error occurred while submitting form");
            }
        });
    });

    // ========== Sign Up ==========
    $('#signup-form').on('submit', function (e) {
        e.preventDefault();
        const form = this;
        const formData = new FormData(form);
        const queryString = new URLSearchParams(formData).toString();

        $.ajax({
            type: 'GET',
            url: '../php files/signup.php?' + queryString,
            success: function (response) {
                try {
                    const jsonResponse = JSON.parse(response);

                    if (jsonResponse.success) {
                        localStorage.setItem('user_id', jsonResponse.user_id);
                        alert("Sign up successful!");
                        window.location.href = 'home.html';
                    } else {
                        alert("Sign up failed!");
                    }
                } catch (error) {
                    alert("Error occurred while signing up");
                }
            },
            error: function () {
                alert("Error occurred while submitting form");
            }
        });
    });

    // ========== Sell Car ==========
    $('#sell-car-form').on('submit', function (e) {
        e.preventDefault();
        const form = this;
        const formData = new FormData(form);
        const queryString = new URLSearchParams(formData).toString();

        $.ajax({
            type: 'GET',
            url: '../php files/sell_car.php?' + queryString,
            success: function () {
                alert("Thank you for submiting form, will get back to you soon!");
            },
            error: function () {
                alert("Error occurred while submitting form");
            }
        });
    });

    // ========== Rent Car ==========
    $('#rent-car-form').on('submit', function (e) {
        e.preventDefault();
        const form = this;
        const formData = new FormData(form);
        const queryString = new URLSearchParams(formData).toString();

        $.ajax({
            type: 'GET',
            url: '../php files/rent_car.php?' + queryString,
            success: function () {
                alert("Car rental request sent!");
            },
            error: function () {
                alert("Error occurred while submitting form");
            }
        });
    });

    // ========== Contact Us ==========
    $('#contact-form').on('submit', function (e) {
        e.preventDefault();
        const form = this;
        const formData = new FormData(form);
        const queryString = new URLSearchParams(formData).toString();

        $.ajax({
            type: 'GET',
            url: 'contact_us.php?' + queryString,
            success: function () {
                alert("Message sent successfully!");
            },
            error: function () {
                alert("Error occurred while submitting form");
            }
        });
    });

    // ========== Checkout ==========
    $('#checkout-form').on('submit', function (e) {
        e.preventDefault();
        const form = this;
        const formData = new FormData(form);
        const queryString = new URLSearchParams(formData).toString();

        $.ajax({
            type: 'GET',
            url: '../php files/checkout.php?' + queryString,
            success: function () {
                alert("Thank you for your purchase!");
            },
            error: function () {
                alert("Error occurred while submitting form");
            }
        });
    });

    // ========== Test Drive Booking ==========
    $('#testDriveForm').on('submit', function (e) {
        e.preventDefault();
        const form = this;
        const formData = new FormData(form);
        const queryString = new URLSearchParams(formData).toString();

        $.ajax({
            type: 'GET',
            url: '../php files/book_test_drive.php?' + queryString,
            success: function () {
                alert("Test drive booked successfully!");
            },
            error: function () {
                alert("Error occurred while submitting form");
            }
        });
    });

    // ========== Submit Review ==========
    $('#review-form').on('submit', function (e) {
        e.preventDefault();
        const form = this;
        const formData = new FormData(form);
        const queryString = new URLSearchParams(formData).toString();

        $.ajax({
            type: 'GET',
            url: '../php files/submit_review.php?' + queryString,
            success: function () {
                alert("Review submitted successfully!");
            },
            error: function () {
                alert("Error occurred while submitting form");
            }
        });
    });

    // ========== Star Rating Logic ==========
    $(".star").on("click", function () {
        $(".star").removeClass("selected");
        $(this).prevAll().addBack().addClass("selected");
    });

});
