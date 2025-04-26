<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $user_id = $_GET['user_id'];
    $subject = htmlspecialchars(trim($_GET['subject']));
    $message = htmlspecialchars(trim($_GET['message']));

    if (empty($user_id) || empty($subject) || empty($message)) {
        echo "All fields are required.";
        exit;
    }

    // Use prepared statement for security
    $stmt = $conn->prepare("INSERT INTO contact_messages (user_id, subject, message) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $subject, $message);

    if ($stmt->execute()) {
        echo "Message sent successfully!";
    } else {
        echo "Failed to send message.";
    }

    $stmt->close();
    $conn->close();
}
?>
