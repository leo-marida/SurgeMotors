<?php
require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $car_model = htmlspecialchars(trim($_POST['car_model']));

    if (empty($name) || empty($email) || empty($phone) || empty($date) || empty($time) || empty($car_model)) {
        echo "All fields are required."; exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { echo "Invalid email."; exit; }
    if (!preg_match('/^[0-9]{10}$/', $phone)) { echo "Invalid phone number."; exit; }

    // Lookup car_id by car model
    $car_id = null;
    $car_query = $conn->prepare("SELECT id FROM cars WHERE model = ?");
    $car_query->bind_param("s", $car_model);
    $car_query->execute();
    $car_result = $car_query->get_result();
    if ($car_result->num_rows > 0) {
        $car_id = $car_result->fetch_assoc()['id'];
    } else {
        echo "Car not found."; exit;
    }

    $stmt = $conn->prepare("
        INSERT INTO test_drive_bookings 
        (user_id, car_id, booking_date, booking_time, name, email, phone) 
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("iisssss", $user_id, $car_id, $date, $time, $name, $email, $phone);

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
