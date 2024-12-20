<?php
header('Content-Type: application/json');

// Database connection
$servername = "127.0.0.1";
$username = "root"; 
$password = "";
$dbname = "the3bearsdb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit;
}

// Parse the JSON input
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['product_id'], $data['product_image'])) {
    $productId = intval($data['product_id']);
    $productImage = $data['product_image'];

    // Delete the product record
    $sql = "DELETE FROM products WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId);

    if ($stmt->execute()) {
        // Remove the associated image file
        if (file_exists($productImage)) {
            unlink($productImage); // Delete the file
        }
        echo json_encode(['success' => true, 'message' => 'Product deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete product: ' . $conn->error]);
    }
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
}

$conn->close();
?>
