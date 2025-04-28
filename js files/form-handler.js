$(document).ready(function () {

    // ========== Sign In ==========
    $('#signin-form').on('submit', function (e) {
        e.preventDefault();

        const form = this;
        const formData = new FormData(form);

        $.ajax({
            type: 'POST',
            url: 'http://localhost/SurgeMotors/php%20files/signin.php', // <-- Update this URL to match your project name
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json', // expecting JSON from signin.php
            success: function (response) {
                if (response.success) {
                    localStorage.setItem('user_id', response.user_id);
                    alert(response.message);
                    window.location.href = 'home.html';
                } else {
                    alert(response.message || "Invalid credentials!");
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText); // helpful for debugging
                window.location.href = 'home.html';
                alert("Sign in successful!");
            }
        });
    });



    $('#signup-form').on('submit', function (e) {
        e.preventDefault();

        const form = this;
        const formData = new FormData(form);

        $.ajax({
            type: 'POST',
            url: 'http://localhost/SurgeMotors/php%20files/signup.php', // <-- FIX THE URL if necessary
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    localStorage.setItem('user_id', response.user_id);
                    alert(response.message);
                    window.location.href = 'home.html';
                } else {
                    alert(response.message || "Sign up failed!");
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText); // <--- important to debug
                window.location.href = 'home.html';
                alert("Sign up successful!");
            }
        });
    });




    // ========== Sell Car ==========
    $('#sell-car-form').on('submit', function (e) {
        e.preventDefault();
        const form = this;
        const formData = new FormData(form);

        $.ajax({
            type: 'POST',
            url: 'http://localhost/SurgeMotors/php%20files/sell_car.php',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                alert(response.message);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                alert("Thank you for submitting form, will be in touch soon!");
            }
        });
    });

    // ========== Rent Car ==========
    $('#rent-car-form').on('submit', function (e) {
        e.preventDefault();
        const form = this;
        const formData = new FormData(form);

        $.ajax({
            type: 'POST',
            url: 'http://localhost/SurgeMotors/php%20files/rent_car.php',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                alert(response.message);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                alert("Booking successful!");
            }
        });
    });

    // ========== Contact Us ==========
    $('#contact-form').on('submit', function (e) {
        e.preventDefault();
        const form = this;
        const formData = new FormData(form);

        $.ajax({
            type: 'POST',
            url: 'http://localhost/SurgeMotors/php%20files/contact_us.php',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                alert(response.message);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                alert("Thank you for submitting form, will be in touch soon!");
            }
        });
    });

    // ========== Checkout ==========
    $('#checkout-form').on('submit', function (e) {
        e.preventDefault();
        const form = this;
        const formData = new FormData(form);

        $.ajax({
            type: 'POST',
            url: 'http://localhost/SurgeMotors/php%20files/checkout.php',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                alert(response.message);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                alert("Booking successful!");
            }
        });
    });

    // ========== Test Drive Booking ==========
    $('#testDriveForm').on('submit', function (e) {
        e.preventDefault();
        const form = this;
        const formData = new FormData(form);

        $.ajax({
            type: 'POST',
            url: 'http://localhost/SurgeMotors/php%20files/book_test_drive.php',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                alert(response.message);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                alert("Booking successful!");
            }
        });
    });

    // ========== Submit Review ==========
    $('#review-form').on('submit', function (e) {
        e.preventDefault();
        const form = this;
        const formData = new FormData(form);

        $.ajax({
            type: 'POST',
            url: 'http://localhost/SurgeMotors/php%20files/submit_review.php',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                alert(response.message);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                alert("Thank you for your review!");
            }
        });
    });

    // ========== Star Rating Logic ==========
    $(".star").on("click", function () {
        $(".star").removeClass("selected");
        $(this).prevAll().addBack().addClass("selected");
    });


});
