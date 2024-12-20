<?php
// Include database connection
include 'db_connect.php'; // Replace with your actual database connection file

// Fetch all orders from the database
$query = "SELECT order_ID, Product_ID, User_ID, Qty, Price, Total, Date_ordered FROM orders ORDER BY Date_ordered DESC";
$result = mysqli_query($conn, $query);

$orders = array(); // Initialize an array to store the fetched data

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $orders[] = $row; // Add each row to the orders array
    }
}

// Return the data as a JSON response
header('Content-Type: application/json');
echo json_encode($orders);

exit();
?>