<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $user_id = $_GET['user_id'];
    $comment = trim($_GET['reviewText']);
    $rating = $_GET['rating'];

    if (empty($comment) || empty($rating) || empty($user_id)) {
        echo "All fields are required.";
        exit;
    }

    if (!is_numeric($rating) || $rating < 1 || $rating > 5) {
        echo "Rating must be a number between 1 and 5.";
        exit;
    }

    $sql = "INSERT INTO reviews (user_id, comment, rating) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi",$user_id, $comment, $rating);

    if ($stmt->execute()) {
        echo "Review submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
