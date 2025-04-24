<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $car_name = $_POST['car_name'];
    $car_year = $_POST['car_year'];
    $rental_days = $_POST['rental-days'];
    $pickup_date = $_POST['pickup-date'];
    $return_date = $_POST['return-date'];


    if (empty($user_id) || empty($pickup_date) || empty($return_date) ||
        empty($car_name) || empty($car_year) || empty($email) || empty($license)) {
        echo "All fields are required."; exit;
    }

    // Get car ID
    $stmt = $conn->prepare("SELECT id FROM cars WHERE name = ? AND year = ?");
    $stmt->bind_param("si", $car_name, $car_year);
    $stmt->execute();
    $stmt->bind_result($car_id);
    $stmt->fetch();
    $stmt->close();

    $stmt = $conn->prepare("INSERT INTO rented_cars (rental_days, pickup_date, return_date, full_name, phone, email, license_number) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssss", $rental_days, $pickup_date, $return_date, $full_name, $phone, $email, $license);

    if ($stmt->execute()) {
        $to = "Devsquad@surgemotors.com";
        $subject = "New Car Rental Request";
        $body = "Name: $full_name\nPhone: $phone\nEmail: $email\nPickup: $pickup_date\nReturn: $return_date\nDays: $rental_days\nLicense: $license";
        $headers = "From: $email";

        mail($to, $subject, $body, $headers);
        echo "Car rental submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
