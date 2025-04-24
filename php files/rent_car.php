<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $car_name = $_POST['car_name'];
    $car_year = $_POST['car_year'];
    $num_of_days = $_POST['rental-days'];
    $pickup_date = $_POST['pickup-date'];
    $return_date = $_POST['return-date'];


    if (empty($user_id) || empty($pickup_date) || empty($return_date) || empty($car_name) || empty($car_year) || empty($num_of_days)) {
        echo "All fields are required."; exit;
    }

    // Get car ID
    $stmt = $conn->prepare("SELECT id FROM cars WHERE name = ? AND year = ?");
    $stmt->bind_param("si", $car_name, $car_year);
    $stmt->execute();
    $stmt->bind_result($car_id);
    $stmt->fetch();
    $stmt->close();

    $stmt = $conn->prepare("INSERT INTO rented_cars (car_id, user_id, num_of_days, rent_start_date, rent_end_date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issssss", $car_id, $user_id, $num_of_days, $rent_start_date, $rent_end_date);

    if ($stmt->execute()) {
        echo "Car rental submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
