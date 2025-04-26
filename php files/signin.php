<?php
require_once 'connection.php';
header('Content-Type: application/json');
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $username = trim($_GET['username']);
    $password = trim($_GET['password']);

    if (empty($username) || empty($password)) {
        echo json_encode(["success" => false, "message" => "All fields are required."]);
        exit;
    }

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashedPassword);
        $stmt->fetch();

        if (password_verify($password, $hashedPassword)) {
            echo json_encode([
                "success" => true,
                "message" => "Login successful!",
                "user_id" => $user_id
            ]);
        } else {
            echo json_encode(["success" => false, "message" => "Incorrect password."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "User not found."]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request."]);
}
?>
