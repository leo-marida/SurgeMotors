<?php
require_once 'connection.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    if (empty($user_id) || empty($subject) || empty($message)) {
        echo json_encode(["message" => "All fields are required."]);
        exit;
    }

    // Insert into contact_messages
    $stmt = $conn->prepare("INSERT INTO contact_messages (user_id, subject, message) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $subject, $message);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Message sent successfully!"]);
    } else {
        echo json_encode(["message" => "Failed to send message."]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["message" => "Invalid request."]);
}
?>
