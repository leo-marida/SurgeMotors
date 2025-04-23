$(document).ready(function () {
    // ========== Sign Up ==========
    $('#signup-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '../php files/signup.php',
            data: $(this).serialize(),
            success: function (response) {
                $('#signupResponse').html('<div class="form-response">' + response + '</div>');
            },
            error: function () {
                $('#signupResponse').html('<p style="color:red;">Something went wrong. Try again.</p>');
            }
        });
    });

    // ========== Sign In ==========
    $('#signin-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '../php files/signin.php',
            data: $(this).serialize(),
            success: function (response) {
                $('#signinResponse').html('<div class="form-response">' + response + '</div>');
            },
            error: function () {
                $('#signinResponse').html('<p style="color:red;">Something went wrong. Try again.</p>');
            }
        });
    });

    // ========== Sell Car ==========
    $('#sell-car-form').on('submit', function (e) {
        e.preventDefault();
        const form = this;
        $.ajax({
            type: 'POST',
            url: '../php files/sell_car.php',
            data: new FormData(form),
            processData: false,
            contentType: false,
            success: function (response) {
                $('#sellCarResponse').html('<div class="form-response">' + response + '</div>');
            },
            error: function () {
                $('#sellCarResponse').html('<p style="color:red;">Something went wrong. Try again.</p>');
            }
        });
    });

    // ========== Rent Car ==========
    $('#rent-car-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '../php files/rent_car.php',
            data: $(this).serialize(),
            success: function (response) {
                $('#rentCarResponse').html('<div class="form-response">' + response + '</div>');
            },
            error: function () {
                $('#rentCarResponse').html('<p style="color:red;">Something went wrong. Try again.</p>');
            }
        });
    });

    // ========== Contact Us ==========
    $('#contact-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'http://localhost/SurgeMotors/php%20files/contact_us.php',
            data: $(this).serialize(),
            success: function (response) {
                $('#contactResponse').html('<div class="form-response">' + response + '</div>');
            },
            error: function () {
                $('#contactResponse').html('<p class="form-response" style="color:red;">Something went wrong. Try again.</p>');
            }
        });
    });

    // ========== Checkout ==========
    $('#checkout-form').on('submit', function (e) {
        e.preventDefault();
        const form = this;
        $.ajax({
            type: 'POST',
            url: '../php files/checkout.php',
            data: new FormData(form),
            processData: false,
            contentType: false,
            success: function (response) {
                $('#checkoutResponse').html('<div class="form-response">' + response + '</div>');
            },
            error: function () {
                $('#checkoutResponse').html('<p style="color:red;">Something went wrong. Try again.</p>');
            }
        });
    });

    // ========== Star Rating Logic ==========
    $(".star").on("click", function () {
        $(".star").removeClass("selected");
        $(this).prevAll().addBack().addClass("selected");
    });

    // ========== Test Drive Booking ==========
    $('#testDriveForm').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '../php files/book_test_drive.php',
            data: $(this).serialize(),
            success: function (response) {
                $('#responseMessage').html('<div class="form-response">' + response + '</div>');
            },
            error: function () {
                $('#responseMessage').html('<p style="color:red;">Something went wrong. Try again.</p>');
            }
        });
    });
});