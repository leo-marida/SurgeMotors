<?php
require_once 'connection.php'; // Assumes $conn is set

// Set the response header to JSON
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = intval($_POST['user_id']);
    $car_name = trim($_POST['car_name']);
    $booking_date = $_POST['date'];
    $booking_time = $_POST['time'];

    // 1. Find the car_id
    $stmt = $conn->prepare("SELECT id FROM cars WHERE model = ?");
    $stmt->bind_param("s", $car_name);
    $stmt->execute();
    $stmt->bind_result($car_id);
    $stmt->fetch();
    $stmt->close();

    if (!$car_id) {
        echo json_encode(["message" => "Car not found."]);
        exit();
    }

    // 2. Insert the booking
    $stmt = $conn->prepare("INSERT INTO test_drive_bookings (user_id, car_id, booking_date, booking_time) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $user_id, $car_id, $booking_date, $booking_time);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Test drive booked successfully."]);
    } else {
        echo json_encode(["message" => "Error booking test drive."]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["message" => "Invalid request."]);
}
?>
