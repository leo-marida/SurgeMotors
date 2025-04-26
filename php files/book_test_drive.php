<?php
require_once 'connection.php'; // assumes $conn is set

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $user_id = intval($_GET['user_id']);
    $car_name = trim($_GET['car_name']);
    $booking_date = $_GET['date'];
    $booking_time = $_GET['time'];

    // 1. Find the car_id
    $stmt = $conn->prepare("SELECT id FROM cars WHERE model = ?");
    $stmt->bind_param("s", $car_name);
    $stmt->execute();
    $stmt->bind_result($car_id);
    $stmt->fetch();
    $stmt->close();

    if (!$car_id) {
        echo "Car not found.";
        exit();
    }
    echo "Car Found!\n";

    // 2. Insert the booking
    $stmt = $conn->prepare("INSERT INTO test_drive_bookings (user_id, car_id, booking_date, booking_time) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $user_id, $car_id, $booking_date, $booking_time);

    if ($stmt->execute()) {
        echo "Test drive booked successfully.";
    } else {
        echo "Error booking test drive";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request";
}
?>