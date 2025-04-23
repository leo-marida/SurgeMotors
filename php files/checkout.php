<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $car_id = $_POST['car_id'];
    $user_id = $_POST['user_id'];

    $full_name = htmlspecialchars(trim($_POST['full-name']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $email = htmlspecialchars(trim($_POST['email']));
    $address = htmlspecialchars(trim($_POST['address']));
    $card_number = preg_replace('/\D/', '', $_POST['card-number']);
    $expiry_date = $_POST['expiry-date'];
    $cvv = htmlspecialchars(trim($_POST['cvv']));

    if (empty($car_id) || empty($user_id) || empty($full_name) || empty($phone) ||
        empty($email) || empty($address) || empty($card_number) || empty($expiry_date) || empty($cvv) ||
        !isset($_FILES['idFront']) || !isset($_FILES['idBack'])) {
        echo "All fields are required.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email.";
        exit;
    }

    // Upload ID images
    $uploads_dir = '../uploads/ids';
    if (!file_exists($uploads_dir)) {
        mkdir($uploads_dir, 0777, true);
    }

    $id_front_path = $uploads_dir . '/' . basename($_FILES['idFront']['name']);
    $id_back_path = $uploads_dir . '/' . basename($_FILES['idBack']['name']);

    move_uploaded_file($_FILES['idFront']['tmp_name'], $id_front_path);
    move_uploaded_file($_FILES['idBack']['tmp_name'], $id_back_path);

    // Store only the last 4 digits of card number
    $card_last4 = substr($card_number, -4);

    $stmt = $conn->prepare("INSERT INTO sold_cars (car_id, sold_to_user_id, full_name, phone, email, address, id_front_path, id_back_path, card_number_last4, expiry_date, cvv) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iisssssssss", $car_id, $user_id, $full_name, $phone, $email, $address, $id_front_path, $id_back_path, $card_last4, $expiry_date, $cvv);

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
              . "ID Files:\n"
              . "Front: $id_front_path\n"
              . "Back: $id_back_path\n"
              . "User ID: $user_id\n"
              . "Car ID: $car_id\n";

        $headers = "From: $email";

        mail($to, $subject, $body, $headers);

        echo "Checkout completed successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
