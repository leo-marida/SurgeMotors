<?php
include 'db_connection.php'; // assumes $conn is set

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = intval($_POST['user_id']);
    $car_name = trim($_POST['car_name']);
    $car_year = intval($_POST['car_year']);
    $booking_date = $_POST['date'];
    $booking_time = $_POST['time'];

    // 1. Find the car_id
    $stmt = $conn->prepare("SELECT id FROM cars WHERE name = ? AND year = ?");
    $stmt->bind_param("ssi", $car_name, $car_year);
    $stmt->execute();
    $stmt->bind_result($car_id);
    $stmt->fetch();
    $stmt->close();

    if (!$car_id) {
        http_response_code(404);
        echo "Car not found.";
        exit();
    }

    // 2. Insert the booking
    $stmt = $conn->prepare("INSERT INTO test_drive_bookings (user_id, car_id, booking_date, booking_time) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $user_id, $car_id, $booking_date, $booking_time);

    if ($stmt->execute()) {
        echo "Test drive booked successfully.";
    } else {
        if ($conn->errno == 1062) {
            echo "You already booked this test drive.";
        } else {
            echo "Error booking test drive: " . $conn->error;
        }
    }

    $stmt->close();
    $conn->close();
} else {
    http_response_code(405);
    echo "Method Not Allowed";
}
?>
