<?php
require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $date = $_POST['date'];
    $time = $_POST['time'];
    $car_model = htmlspecialchars(trim($_POST['car_model']));

    if (empty($name) || empty($email) || empty($phone) || empty($date) || empty($time) || empty($car_model)) {
        echo "All fields are required."; exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { echo "Invalid email."; exit; }
    if (!preg_match('/^[0-9]{10,}$/', $phone)) { echo "Invalid phone number."; exit; }

    $stmt = $conn->prepare("INSERT INTO test_drive_bookings (name, email, phone, date, time, car_model) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $email, $phone, $date, $time, $car_model);

    if ($stmt->execute()) {
        $to = "Devsquad@surgemotors.com";
        $subject = "New Test Drive Booking";
        $message = "Name: $name\nEmail: $email\nPhone: $phone\nDate: $date\nTime: $time\nCar Model: $car_model";
        $headers = "From: $email";

        if (mail($to, $subject, $message, $headers)) {
            echo "Test Drive Booked Successfully and Email Sent!";
        } else {
            echo "Test Drive Booked, but Email Failed to Send!";
        }
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
