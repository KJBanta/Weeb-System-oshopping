<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db_connect.php';

header('Content-Type: application/json'); // Set the content type to JSON

// Fetch customer data
$query = "SELECT * FROM customer_info";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo json_encode(["error" => mysqli_error($conn)]);
    exit;
}

$customers = [];
while ($row = mysqli_fetch_assoc($result)) {
    $customers[] = $row;
}

echo json_encode($customers);
?>
