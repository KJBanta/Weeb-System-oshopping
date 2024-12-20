<?php
// Include database connection
include 'db_connect.php'; // Replace with your actual database connection file

// Fetch all orders from the orders0 table
$query = "SELECT 
    order_id, 
    user_id, 
    user_name, 
    contact_no, 
    payment_method, 
    Add_ress, 
    total_product, 
    total_price, 
    placed_on, 
    payment_status 
FROM orders0 
ORDER BY placed_on DESC";

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
