<?php
@include 'db_connect.php';

session_start();

// Check if admin is logged in, if not redirect to login page
if (!isset($_SESSION['admin_name'])) {
    header('location:logsign.html'); // Redirect to login page if not logged in
    exit();  // Ensure no further code is executed after redirection
}

// Fetch the admin's username from the session
$admin_name = $_SESSION['admin_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Three Bears - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles (1).css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Header -->
    <header class="bg-gradient-to-r from-amber-100 to-yellow-100 p-4 shadow-md">
        <div class="max-w-6xl mx-auto flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <img src="images/ThreeBearsLogo.png" alt="Logo" class="h-12 w-12 rounded-full object-cover">
                <div>
                    <h1 class="text-xl font-semibold text-orange-600">THE THREE BEARS</h1>
                    <p class="text-sm text-gray-600">Sweet as honey, soft as fur</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Admin Dashboard Sidebar & Content -->
    <div class="container-fluid mt-6">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 p-4 bg-secondary text-white">
                <h4 class="text-white">Admin Dashboard</h4>
                <ul class="nav flex-column text-white mt-4">
                    <li class="nav-item mb-3">
                        <a href="adn-insert-product.php" class="nav-link text-white hover:bg-amber-500 hover:text-black p-2 rounded-md">
                            <i class="bi bi-plus-square-fill"></i> Insert Product
                        </a>
                    </li>
                    <li class="nav-item mb-3">
                        <a href="adn-delete-product.php" class="nav-link text-white hover:bg-amber-500 hover:text-black p-2 rounded-md">
                            <i class="bi bi-trash-fill"></i> Delete Product
                        </a>
                    </li>
                    <li class="nav-item mb-3">
                        <a href="view-product.html" class="nav-link text-white hover:bg-amber-500 hover:text-black p-2 rounded-md">
                            <i class="bi bi-eye-fill"></i> View Product
                        </a>
                    </li>
                    <!-- Logout Button -->
                    <li class="nav-item mb-3">
                        <a href="logout.php" class="nav-link text-white p-2 rounded-md">
                            <button class="btn btn-danger w-100">Logout</button>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 p-4 bg-white shadow-lg rounded-md">
                <h2 class="text-3xl font-semibold mb-4">Welcome, Admin <?php echo htmlspecialchars($admin_name); ?>!</h2>
                <p class="mb-6 text-lg">Manage your store, view analytics, and handle orders with ease.</p>

                <!-- Example of Admin Actions -->
                <div class="flex space-x-6">
                    <!-- Manage Orders -->
                    <div class="bg-amber-100 p-4 rounded-md shadow-md w-1/3 text-center">
                        <a href="manage-orders.php" class="text-decoration-none">
                            <i class="bi bi-cart-fill text-3xl text-orange-600 mb-2"></i>
                            <h3 class="font-semibold text-xl text-black">Manage Orders</h3>
                            <p class="text-gray-600">View and manage all customer orders.</p>
                        </a>
                    </div>

                    <!-- Manage Payments -->
                    <div class="bg-amber-100 p-4 rounded-md shadow-md w-1/3 text-center">
                        <a href="manage-payments.php" class="text-decoration-none">
                            <i class="bi bi-credit-card-fill text-3xl text-orange-600 mb-2"></i>
                            <h3 class="font-semibold text-xl text-black">Manage Payments</h3>
                            <p class="text-gray-600">Check all payment statuses and transactions.</p>
                        </a>
                    </div>

                    <!-- Manage Users -->
                    <div class="bg-amber-100 p-4 rounded-md shadow-md w-1/3 text-center">
                        <a href="manage-users.php" class="text-decoration-none">
                            <i class="bi bi-person-fill text-3xl text-orange-600 mb-2"></i>
                            <h3 class="font-semibold text-xl text-black">Manage Users</h3>
                            <p class="text-gray-600">View and manage users for your bakery.</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


