<?php
@include 'db_connect.php';
session_start();

// Check if the user is logged in, if not redirect to the login page
if (!isset($_SESSION['user_name'])) {
    header('location:login_forms.php');
    exit();
}

// Fetch user and cart data
$userName = $_SESSION['user_name'];

// Fetch user ID from the database based on the session username
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

$cart = $_SESSION['cart'] ?? [];

// If the cart is empty, redirect to the cart page
if (empty($cart)) {
    header('location:cart_page.php');
    exit();
}

// Fetch user information from the database (optional, to display on the checkout page)
$stmt = $conn->prepare("SELECT * FROM users WHERE User_ID = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$userResult = $stmt->get_result();
$user = $userResult->fetch_assoc();

// Fetch orders for the user
$orderStmt = $conn->prepare("SELECT * FROM orders0 WHERE user_id = ? ORDER BY placed_on DESC");
$orderStmt->bind_param("i", $userId);
$orderStmt->execute();
$orderResult = $orderStmt->get_result();

// Handle the checkout form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure the user has selected a payment method
    if (!isset($_POST['payment_method'])) {
        echo "Please select a payment method.";
        exit();
    }

    $paymentMethod = $_POST['payment_method']; // Get the selected payment method
    $address = $_POST['address']; // Get the user's shipping address
    $contact = $_POST['contact']; // Get the user's contact number

    $totalProducts = [];
    $grandTotal = 0;

    // Process each item in the cart and prepare for insertion
    foreach ($cart as $item) {
        $productName = $item['name'];
        $quantity = $item['quantity'];
        $price = $item['price'];
        $total = $quantity * $price;
        $grandTotal += $total;
        $totalProducts[] = "$productName x$quantity";
    }

    $totalProductsStr = implode(', ', $totalProducts);

    // Insert the order into the database
    $stmt = $conn->prepare("INSERT INTO orders0 (user_id, user_name, contact_no, payment_method, Address, total_product, total_price, placed_on, payment_status) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), 'pending')");
    $stmt->bind_param("isssssi", $userId, $userName, $contact, $paymentMethod, $address, $totalProductsStr, $grandTotal);
    $stmt->execute();

    // Clear the cart after checkout
    $_SESSION['cart'] = [];

    // Redirect to order confirmation or success page
    header('location:order_confirmation.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - The Three Bears</title>
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
                <a href="cart_page.php" class="hover:text-orange-500">
                    <i class="bi bi-cart-check text-2xl"></i> Cart
                </a>
                <a href="user-index.php" class="hover:text-orange-500">
                    <i class="bi bi-house-door text-2xl"></i> Home
                </a>
                <a href="logout.php" class="hover:text-orange-500">
                    <i class="bi bi-box-arrow-right text-2xl"></i> Logout
                </a>
            </nav>
        </div>
    </header>

    <!-- Checkout Content -->
    <div class="max-w-6xl mx-auto p-6">
        <h2 class="text-4xl font-extrabold text-orange-600 mb-6">Checkout</h2>

        <!-- Display Orders History -->
        <h3 class="text-xl font-semibold text-gray-700 mb-4">Previous Orders:</h3>
        <?php if ($orderResult->num_rows > 0) { ?>
            <table class="table table-bordered bg-white">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Total Products</th>
                        <th>Total Price</th>
                        <th>Date Ordered</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($order = $orderResult->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                            <td><?php echo htmlspecialchars($order['total_product']); ?></td>
                            <td>₱<?php echo number_format($order['total_price'], 2); ?></td>
                            <td><?php echo htmlspecialchars($order['placed_on']); ?></td>
                            <td><?php echo htmlspecialchars($order['payment_status']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p class="text-lg text-gray-600">You have no previous orders.</p>
        <?php } ?>

        <!-- Checkout Form -->
        <form method="POST">
            <h3 class="text-xl font-semibold text-gray-700 mb-4">Your Cart:</h3>
            <table class="table table-bordered bg-white">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $grandTotal = 0;
                    foreach ($cart as $item) {
                        $total = $item['price'] * $item['quantity'];
                        $grandTotal += $total;
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['name']); ?></td>
                            <td><img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" style="width: 80px; height: 80px;"></td>
                            <td>₱<?php echo number_format($item['price'], 2); ?></td>
                            <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                            <td>₱<?php echo number_format($total, 2); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-right font-bold">Grand Total</td>
                        <td>₱<?php echo number_format($grandTotal, 2); ?></td>
                    </tr>
                </tfoot>
            </table>

            <!-- Billing and Shipping Details -->
            <div class="mb-4">
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Billing & Shipping Address:</h3>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="address" id="address" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="contact" class="form-label">Contact Number</label>
                    <input type="text" name="contact" id="contact" class="form-control" required>
                </div>
            </div>

            <!-- Payment Method -->
            <div class="mb-4">
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Payment Method:</h3>
                <select name="payment_method" class="form-select" required>
                    <option value="">Select a Payment Method</option>
                    <option value="Credit Card">Credit Card</option>
                    <option value="PayPal">PayPal</option>
                    <option value="Bank Transfer">Bank Transfer</option>
                </select>
            </div>

            <!-- Checkout Button -->
            <button type="submit" class="btn btn-primary btn-lg w-full">Proceed to Checkout</button>
        </form>
    </div>
</body>
</html>
