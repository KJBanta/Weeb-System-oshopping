<?php
header('Content-Type: application/json');

// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Replace with your database password if applicable
$dbname = "the3bearsdb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit;
}

// Validate required fields
if (isset($_POST['product_name'], $_POST['product_description'], $_POST['product_keywords'], $_POST['product_price']) &&
    isset($_FILES['product_photo_1']) && isset($_FILES['product_photo_2'])) {
    
    // Sanitize form inputs
    $product_name = $conn->real_escape_string($_POST['product_name']);
    $product_description = $conn->real_escape_string($_POST['product_description']);
    $product_keywords = $conn->real_escape_string($_POST['product_keywords']);
    $product_price = floatval($_POST['product_price']);

    // File upload configuration
    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true); // Create upload directory if it doesn't exist
    }

    // Handle Product Photo 1
    $photo1Path = $uploadDir . uniqid() . "_" . basename($_FILES['product_photo_1']['name']);
    $photo1Type = mime_content_type($_FILES['product_photo_1']['tmp_name']);
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

    // Handle Product Photo 2
    $photo2Path = $uploadDir . uniqid() . "_" . basename($_FILES['product_photo_2']['name']);
    $photo2Type = mime_content_type($_FILES['product_photo_2']['tmp_name']);

    // Validate and move uploaded files
    if (in_array($photo1Type, $allowedTypes) && in_array($photo2Type, $allowedTypes)) {
        if (move_uploaded_file($_FILES['product_photo_1']['tmp_name'], $photo1Path) &&
            move_uploaded_file($_FILES['product_photo_2']['tmp_name'], $photo2Path)) {
            
            // Insert data into the database
            $sql = "INSERT INTO products (product_name, product_description, product_keywords, product_image1, product_image2, product_price) 
                    VALUES (?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("sssssd", $product_name, $product_description, $product_keywords, $photo1Path, $photo2Path, $product_price);

                if ($stmt->execute()) {
                    echo json_encode(['success' => true, 'message' => 'Product added successfully']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Database error: ' . $stmt->error]);
                }
                $stmt->close();
            } else {
                echo json_encode(['success' => false, 'message' => 'Error preparing statement: ' . $conn->error]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Error moving uploaded files']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid file type. Allowed types are JPEG, PNG, GIF.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
}

// Close database connection
$conn->close();
?>
