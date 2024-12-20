<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db_connect.php';

// Set the response type to JSON
header('Content-Type: application/json');

// Query to calculate total income and total orders grouped by user_id
$query = "
    SELECT 
        user_id,
        COUNT(order_id) AS total_orders,
        SUM(total_price) AS total_income
    FROM orders0
    GROUP BY user_id
";

$result = mysqli_query($conn, $query);

if (!$result) {
    echo json_encode(['error' => mysqli_error($conn)]); // Return error if query fails
    exit;
}

$sales_data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $sales_data[] = $row; // Collect data into an array
}

// Return the data as JSON
echo json_encode($sales_data);

?>

