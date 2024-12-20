<?php
@include 'db_connect.php';
session_start();

// Check if the user is logged in, if not redirect to the login page
if (!isset($_SESSION['user_name'])) {
    header('location:login_forms.php');
    exit();
}

// Handle removing items from the cart
if (isset($_POST['remove_from_cart'])) {
    $productId = $_POST['product_id'];

    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $index => $item) {
            if ($item['id'] === $productId) {
                unset($_SESSION['cart'][$index]);
                $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex the array
                break;
            }
        }
    }
}

// Handle updating quantities
if (isset($_POST['update_quantity'])) {
    $productId = $_POST['product_id'];
    $newQuantity = (int)$_POST['quantity'];

    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $index => $item) {
            if ($item['id'] === $productId) {
                $_SESSION['cart'][$index]['quantity'] = max(1, $newQuantity); // Ensure quantity is at least 1
                break;
            }
        }
    }
}

// Cart data
$cart = $_SESSION['cart'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - The Three Bears</title>
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
                <a href="user-orders.php" class="hover:text-orange-500">
                    <i class="bi bi-cart-check text-2xl"></i> Orders
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

    <!-- Cart Content -->
    <div class="max-w-6xl mx-auto p-6">
        <h2 class="text-4xl font-extrabold text-orange-600 mb-6">Your Cart</h2>

        <?php if (empty($cart)) { ?>
            <p class="text-lg text-gray-600">Your cart is empty. Start shopping now!</p>
        <?php } else { ?>
            <table class="table table-bordered bg-white">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Actions</th>
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
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                                    <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" class="form-control w-20">
                                    <button type="submit" name="update_quantity" class="btn btn-sm btn-primary mt-2">Update</button>
                                </form>
                            </td>
                            <td>₱<?php echo number_format($total, 2); ?></td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                                    <button type="submit" name="remove_from_cart" class="btn btn-sm btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-right font-bold">Grand Total</td>
                        <td colspan="2">₱<?php echo number_format($grandTotal, 2); ?></td>
                    </tr>
                </tfoot>
            </table>
            <!-- Checkout Button -->
            <div class="text-right mt-4">
                <a href="checkout.php" class="btn btn-success btn-lg">Proceed to Checkout</a>
            </div>
        <?php } ?>
    </div>

    <!-- Footer -->
    <footer class="text-center bg-gray-800 text-white p-4 mt-8">
        <p>&copy; 2024 The Three Bears Dining. All rights reserved.</p>
        <p>Indulge Your Senses, One Bite at a Time.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
