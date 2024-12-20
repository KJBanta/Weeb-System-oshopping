<?php
// Start the session to ensure the user is still logged in
session_start();

// Check if the session has been cleared, if so, redirect to the home page
if (!isset($_SESSION['user_name'])) {
    header('location:user-index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - The Three Bears</title>
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
                <a href="orders.php" class="hover:text-orange-500">
                    <i class="bi bi-cart-check text-2xl"></i> Orders
                </a>
                <a href="user_cart.php" class="hover:text-orange-500">
                    <i class="bi bi-cart text-2xl"></i> Cart
                </a>
                <a href="logout.php" class="hover:text-orange-500">
                    <i class="bi bi-box-arrow-right text-2xl"></i> Logout
                </a>
            </nav>
        </div>
    </header>

    <!-- Confirmation Message -->
    <div class="max-w-6xl mx-auto p-6 text-center">
        <h2 class="text-4xl font-extrabold text-orange-600 mb-4">Thank You for Shopping!</h2>
        <p class="text-lg text-gray-600 mb-6">Your order has been successfully placed, and we are processing it. We will notify you once it's ready for delivery!</p>
        
        <!-- Return Home Button -->
        <a href="user-index.php" class="inline-block bg-orange-500 text-white text-lg py-2 px-6 rounded-lg hover:bg-orange-600 transition duration-300">
            Return to Home
        </a>
    </div>

    <!-- Footer -->
    <footer class="text-center bg-gray-800 text-white p-4 mt-8">
        <p>&copy; 2024 The Three Bears Dining. All rights reserved.</p>
        <p>Indulge Your Senses, One Bite at a Time.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
