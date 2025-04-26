<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $user_id = $_GET['user_id'];
    $card_number = preg_replace('/\D/', '', $_GET['card-number']);
    $expiry_date = $_GET['expiry-date'];
    $cvv = htmlspecialchars(trim($_GET['cvv']));
    $car_name = trim($_GET['car_name']);

    echo"values received\n";
    // Get car ID
    $stmt = $conn->prepare("SELECT id FROM cars WHERE model = ?");
    $stmt->bind_param("s", $car_name);
    $stmt->execute();
    $stmt->bind_result($car_id);
    $stmt->fetch();
    $stmt->close();

    echo"car_id found!\n";
    if (empty($user_id) || empty($card_number) || empty($expiry_date) || empty($cvv)) {
        echo "All fields are required.";
        exit;
    }

    // Only store last 4 digits
    $card_last4 = substr($card_number, -4);

    // Insert into sold_cars
    $stmt = $conn->prepare("INSERT INTO sold_cars (car_id, user_id, card_number_last4, expiry_date, cvv) VALUES (?, ?, ?, ?, ?)");
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
