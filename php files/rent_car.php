<?php
require_once 'connection.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $car_name = trim($_POST['car_name']);
    $num_of_days = $_POST['rental-days'];
    $pickup_date = $_POST['pickup-date'];
    $return_date = $_POST['return-date'];

    if (empty($user_id) || empty($pickup_date) || empty($return_date) || empty($car_name) || empty($num_of_days)) {
        echo json_encode(["message" => "All fields are required."]);
        exit;
    }

    // Get car ID
    $stmt = $conn->prepare("SELECT id FROM cars WHERE model = ?");
    $stmt->bind_param("s", $car_name);
    $stmt->execute();
    $stmt->bind_result($car_id);
    $stmt->fetch();
    $stmt->close();

    if (!$car_id) {
        echo json_encode(["message" => "Car not found."]);
        exit;
    }

    // Insert into rented_cars
    $stmt = $conn->prepare("INSERT INTO rented_cars (car_id, user_id, num_of_days, rent_start_date, rent_end_date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iisss", $car_id, $user_id, $num_of_days, $pickup_date, $return_date);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Car rental submitted successfully!"]);
    } else {
        echo json_encode(["message" => "Error: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["message" => "Invalid request."]);
}
?>
