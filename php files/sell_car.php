<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $user_id = $_GET['user_id'];
    $make = trim($_GET['make']);
    $model = trim($_GET['model']);
    $year = $_GET['year'];
    $mileage = $_GET['mileage'];
    $expected_price = $_GET['expected_price'];
    $car_condition = $_GET['car_condition'];
    $add_description = isset($_GET['add_description']) ? trim($_GET['add_description']) : null;
    if ($add_description === '') {
        $add_description = null;
    }

    echo "all values received \n";
    // Basic validations
    if (
        empty($user_id) || empty($make) || empty($model) || empty($year) || empty($mileage) ||
        empty($expected_price) || empty($car_condition)
    ) {
        echo "All required fields must be filled.";
        exit;
    }



    if (!is_numeric($year) || $year < 1900 || $year > 2025) {
        echo "Invalid year.";
        exit;
    }

    if (!is_numeric($mileage) || $mileage < 0) {
        echo "Invalid mileage.";
        exit;
    }

    if (!is_numeric($expected_price) || $expected_price < 0) {
        echo "Invalid expected price.";
        exit;
    }

    echo "now validation of images \n";
    // Handle image uploads
    // Handle image uploads
    $uploadedImages = [];

    if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
        $targetDir = '../uploads/';
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            $imageName = basename($_FILES['images']['name'][$key]);
            $imagePath = $targetDir . time() . '_' . preg_replace("/[^a-zA-Z0-9._-]/", "_", $imageName);

            if (move_uploaded_file($tmp_name, $imagePath)) {
                $uploadedImages[] = $imagePath;
            }
        }
    }

    // If no images uploaded, set NULL instead of empty array
    $imagesJson = !empty($uploadedImages) ? json_encode($uploadedImages) : null;


    echo "images prepared \n";
    $stmt = $conn->prepare("INSERT INTO car_sale_requests (user_id, make, model, year, mileage, expected_price, car_condition, add_description, image_paths) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issiidsss", $user_id, $make, $model, $year, $mileage, $expected_price, $car_condition, $add_description, $imagesJson);

    if ($stmt->execute()) {
        echo "Thank you for submitting this form, we will get back to you soon.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>