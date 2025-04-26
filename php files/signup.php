<?php
require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $username = $_GET["username"];
    $email = $_GET["email"];
    $password = $_GET["password"];
    $confirm_password = $_GET["confirm_password"];

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        echo json_encode(["success" => false, "message" => "All fields are required."]);
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["success" => false, "message" => "Invalid email format."]);
        exit();
    }

    if ($password !== $confirm_password) {
        echo json_encode(["success" => false, "message" => "Passwords do not match."]);
        exit();
    }

    $check_stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_stmt->store_result();
    if ($check_stmt->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "Email already registered."]);
        $check_stmt->close();
        exit();
    }
    $check_stmt->close();

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) {
        $user_id = $stmt->insert_id;
        echo json_encode([
            "success" => true,
            "message" => "Signup successful!",
            "user_id" => $user_id
        ]);
    } else {
        echo json_encode(["success" => false, "message" => "Error: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>
