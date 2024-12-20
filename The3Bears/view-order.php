<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    echo "Access Denied. Only admins can view this page.";
    exit();
}

if (isset($_GET['order_id'])) {
    $order_id = intval($_GET['order_id']);
    $query = "SELECT * FROM orders WHERE order_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $order_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $order = mysqli_fetch_assoc($result);
} else {
    echo "Invalid Order ID.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
</head>
<body>
    <h1>Order Details</h1>
    <?php if ($order) { ?>
        <p>Order ID: <?php echo htmlspecialchars($order['order_id']); ?></p>
        <p>User ID: <?php echo htmlspecialchars($order['user_id']); ?></p>
        <p>Total Amount: Php <?php echo number_format($order['total_amount'], 2); ?></p>
        <p>Status: <?php echo htmlspecialchars($order['order_status']); ?></p>
        <p>Created At: <?php echo $order['created_at']; ?></p>
    <?php } else { ?>
        <p>Order not found.</p>
    <?php } ?>
</body>
</html>
