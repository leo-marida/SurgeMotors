<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    if (empty($user_id) ||  empty($subject) || empty($message)) {
        echo "All fields are required.";
        exit;
    }

    $sql = "INSERT INTO contact_messages (user_id, subject, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $user_id, $subject, $message);

    if ($stmt->execute()) {
        echo "Message sent successfully!";
        } else {
            echo "Message saved, but email failed to send.";
        }
    } else {
        echo "Error: " . $stmt->error;
    }
?>
