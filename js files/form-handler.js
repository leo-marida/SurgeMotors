$(document).ready(function () {

    // ========== Sign In ==========
    $('#signin-form').on('submit', function (e) {
        e.preventDefault();

        const form = this;
        const formData = new FormData(form);

        $.ajax({
            type: 'POST',
            url: '/your_project/php files/signin.php', // <-- Update this URL to match your project name
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json', // expecting JSON from signin.php
            success: function (response) {
                if (response.success) {
                    localStorage.setItem('user_id', response.user_id);
                    alert("Sign in successful!");
                    window.location.href = 'home.html';
                } else {
                    alert(response.message || "Invalid credentials!");
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText); // helpful for debugging
                alert("Error occurred while signing in");
            }
        });
    });



    $('#signup-form').on('submit', function (e) {
        e.preventDefault();

        const form = this;
        const formData = new FormData(form);

        $.ajax({
            type: 'POST',
            url: '/your_project/php files/signup.php', // <-- FIX THE URL if necessary
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    localStorage.setItem('user_id', response.user_id);
                    alert("Sign up successful!");
                    window.location.href = 'home.html';
                } else {
                    alert(response.message || "Sign up failed!");
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText); // <--- important to debug
                alert("Error occurred while signing up");
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
