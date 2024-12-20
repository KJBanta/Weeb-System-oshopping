<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db_connect.php';

// Set the response type to JSON
header('Content-Type: application/json');

// Query to calculate total orders and total income grouped by month
$query = "
    SELECT 
        DATE_FORMAT(Date_ordered, '%Y-%m') AS order_month,
        COUNT(order_ID) AS total_orders,
        SUM(Total) AS total_income
    FROM orders
    GROUP BY order_month
    ORDER BY order_month ASC
";

$result = mysqli_query($conn, $query);

if (!$result) {
    echo json_encode(['error' => mysqli_error($conn)]);
    exit;
}

$sales_data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $sales_data[] = $row;
}

// Return the data as JSON
echo json_encode($sales_data);
?>
