<?php
@include 'db_connect.php';
session_start();

// Check if the user is logged in, if not redirect to the login page
if (!isset($_SESSION['user_name'])) {
    header('location:login_forms.php');
    exit();
}

$userName = $_SESSION['user_name'];

// Fetch user ID from the database
$stmt = $conn->prepare("SELECT User_ID FROM users WHERE username = ?");
$stmt->bind_param("s", $userName);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();
if (!$userData) {
    echo "User not found.";
    exit();
}
$userId = $userData['User_ID'];

// Fetch the user's orders from the database
$stmt = $conn->prepare("SELECT * FROM orders0 WHERE user_id = ? ORDER BY placed_on DESC");
$stmt->bind_param("i", $userId);
$stmt->execute();
$orderResult = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - The Three Bears</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles3.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-neutral-100 text-gray-800">
    <!-- Header -->
    <header class="bg-gradient-to-r from-amber-100 to-yellow-100 p-4">
        <div class="max-w-6xl mx-auto flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <img src="images/ThreeBearsLogo.png" alt="Logo" class="h-12 w-12 rounded-full object-cover">
                <div>
                    <h1 class="text-xl font-semibold text-orange-600">THE THREE BEARS</h1>
                    <p class="text-sm text-gray-600">Sweet as honey, soft as fur</p>
                </div>
            </div>
            <nav class="flex items-center space-x-6 text-gray-700">
                <a href="user-index.php" class="hover:text-orange-500">
                    <i class="bi bi-house-door text-2xl"></i> Home
                </a>
                <a href="cart_page.php" class="hover:text-orange-500">
                    <i class="bi bi-cart text-2xl"></i> Cart
                </a>
                <a href="logout.php" class="hover:text-orange-500">
                    <i class="bi bi-box-arrow-right text-2xl"></i> Logout
                </a>
            </nav>
        </div>
    </header>

    <!-- Orders Content -->
    <div class="max-w-6xl mx-auto p-6">
        <h2 class="text-4xl font-extrabold text-orange-600 mb-6">My Orders</h2>

        <?php if ($orderResult->num_rows > 0) { ?>
            <table class="table table-bordered bg-white">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Total Products</th>
                        <th>Total Price</th>
                        <th>Address</th>
                        <th>Contact</th>
                        <th>Date Ordered</th>
                        <th>Payment Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($order = $orderResult->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                            <td><?php echo htmlspecialchars($order['total_product']); ?></td>
                            <td>₱<?php echo number_format($order['total_price'], 2); ?></td>
                            <td><?php echo htmlspecialchars($order['Address']); ?></td>
                            <td><?php echo htmlspecialchars($order['contact_no']); ?></td>
                            <td><?php echo htmlspecialchars($order['placed_on']); ?></td>
                            <td class="<?php echo $order['payment_status'] === 'pending' ? 'text-warning' : 'text-success'; ?>">
                                <?php echo htmlspecialchars(ucfirst($order['payment_status'])); ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p class="text-lg text-gray-600">You have no previous orders. Start shopping to see your order history here!</p>
            <a href="user-index.php" class="btn btn-primary mt-4">Shop Now</a>
        <?php } ?>
    </div>

    <!-- Footer -->
    <footer class="text-center bg-gray-800 text-white p-4 mt-8">
        <p>&copy; 2024 The Three Bears Dining. All rights reserved.</p>
        <p>Indulge Your Senses, One Bite at a Time.</p>
    </footer>
</body>
</html>
