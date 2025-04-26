<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $user_id = $_GET['user_id'];
    $car_name = $_GET['car_name'];
    $num_of_days = $_GET['rental-days'];
    $pickup_date = $_GET['pickup-date'];
    $return_date = $_GET['return-date'];

    echo "values received";

    if (empty($user_id) || empty($pickup_date) || empty($return_date) || empty($car_name) || empty($num_of_days)) {
        echo "All fields are required."; exit;
    }

    // Get car ID
    $stmt = $conn->prepare("SELECT id FROM cars WHERE model = ?");
    $stmt->bind_param("s", $car_name);
    $stmt->execute();
    $stmt->bind_result($car_id);
    $stmt->fetch();
    $stmt->close();

    echo "car_id found!";
    $stmt = $conn->prepare("INSERT INTO rented_cars (car_id, user_id, num_of_days, rent_start_date, rent_end_date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iisss", $car_id, $user_id, $num_of_days, $pickup_date, $return_date);

    if ($stmt->execute()) {
        echo "Car rental submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
