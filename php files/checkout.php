<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    

    $full_name = htmlspecialchars(trim($_POST['full-name']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $email = htmlspecialchars(trim($_POST['email']));
    $address = htmlspecialchars(trim($_POST['address']));
    $card_number = preg_replace('/\D/', '', $_POST['card-number']);
    $expiry_date = $_POST['expiry-date'];
    $cvv = htmlspecialchars(trim($_POST['cvv']));

    // Lookup user_id by email
    $sold_to_user_id = null;
    $user_query = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $user_query->bind_param("s", $email);
    $user_query->execute();
    $user_result = $user_query->get_result();
    if ($user_result->num_rows > 0) {
        $sold_to_user_id = $user_result->fetch_assoc()['id'];
    }

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

    if (empty($car_id) || empty($sold_to_user_id) || empty($full_name) || empty($phone) ||
        empty($email) || empty($address) || empty($card_number) || empty($expiry_date) || empty($cvv) ||
        !isset($_FILES['idFront']) || !isset($_FILES['idBack'])) {
        echo "All fields are required.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email.";
        exit;
    }

    // Store only the last 4 digits of card number
    $card_last4 = substr($card_number, -4);

    $stmt = $conn->prepare("INSERT INTO sold_cars (car_id, sold_to_user_id, full_name, phone, email, address, card_number_last4, expiry_date, cvv) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iisssssssss", $car_id, $sold_to_user_id, $full_name, $phone, $email, $address, $card_last4, $expiry_date, $cvv);

    if ($stmt->execute()) {
        // 📧 Send notification email to SurgeMotors
        $to = "Devsquad@surgemotors.com";
        $subject = "New Car Purchase Completed";
        $body = "A new car has been purchased.\n\n"
              . "Buyer Details:\n"
              . "Name: $full_name\n"
              . "Phone: $phone\n"
              . "Email: $email\n"
              . "Address: $address\n\n"
              . "Card (Last 4): $card_last4\n"
              . "Expiry Date: $expiry_date\n"
              . "CVV: $cvv\n\n"
              . "User ID: $sold_to_user_id\n"
              . "Car ID: $car_id\n";

        $headers = "From: $email";

        mail($to, $subject, $body, $headers);

        echo "Checkout completed successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
