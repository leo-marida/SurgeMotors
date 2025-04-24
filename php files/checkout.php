<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $card_number = preg_replace('/\D/', '', $_POST['card-number']);
    $expiry_date = $_POST['expiry-date'];
    $cvv = htmlspecialchars(trim($_POST['cvv']));
    $car_name = trim($_POST['car_name']);
    $car_year = intval($_POST['car_year']);

    // Get car ID
    $stmt = $conn->prepare("SELECT id FROM cars WHERE name = ? AND year = ?");
    $stmt->bind_param("si", $car_name, $car_year);
    $stmt->execute();
    $stmt->bind_result($car_id);
    $stmt->fetch();
    $stmt->close();

    if (empty($user_id) || empty($card_number) || empty($expiry_date) || empty($cvv)) {
        echo "All fields are required.";
        exit;
    }

    // Only store last 4 digits
    $card_last4 = substr($card_number, -4);

    // Insert into sold_cars
    $stmt = $conn->prepare("INSERT INTO sold_cars (car_id, sold_to_user_id, card_number_last4, expiry_date, cvv) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iisss", $car_id, $user_id, $card_last4, $expiry_date, $cvv);

    if ($stmt->execute()) {
        echo "Checkout completed successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
