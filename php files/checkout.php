<?php
require_once 'connection.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $card_number = preg_replace('/\D/', '', $_POST['card-number']);
    $expiry_date = $_POST['expiry-date'];
    $cvv = htmlspecialchars(trim($_POST['cvv']));
    $car_name = trim($_POST['car_name']);

    if (empty($user_id) || empty($card_number) || empty($expiry_date) || empty($cvv) || empty($car_name)) {
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

    // Only store last 4 digits
    $card_last4 = substr($card_number, -4);

    // Insert into sold_cars
    $stmt = $conn->prepare("INSERT INTO sold_cars (car_id, user_id, card_number_last4, expiry_date, cvv) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iisss", $car_id, $user_id, $card_last4, $expiry_date, $cvv);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Checkout completed successfully!"]);
    } else {
        echo json_encode(["message" => "Error: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["message" => "Invalid request."]);
}
?>
