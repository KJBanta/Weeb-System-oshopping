<?php
@include 'db_connect.php';
session_start();

// Check if the user is logged in, if not redirect to the login page
if (!isset($_SESSION['user_name'])) {
    header('location:login_forms.php');
    exit();
}

// Fetch products from the database
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);

// Check for query errors
if (!$result) {
    die("Error fetching products: " . mysqli_error($conn));
}

// Handle adding to cart
if (isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];
    $productImage = $_POST['product_image'];

    // If the cart is not set, initialize it
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if product already exists in cart
    $productIndex = -1;
    foreach ($_SESSION['cart'] as $index => $item) {
        if ($item['id'] === $productId) {
            $productIndex = $index;
            break;
        }
    }

    // If product exists, update quantity
    if ($productIndex >= 0) {
        $_SESSION['cart'][$productIndex]['quantity']++;
    } else {
        // If product is new, add it to the cart
        $_SESSION['cart'][] = [
            'id' => $productId,
            'name' => $productName,
            'price' => $productPrice,
            'image' => $productImage,
            'quantity' => 1
        ];
    }

    // Redirect to avoid resubmission
    header('Location: user-index.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Three Bears</title>
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
                <a href="user_cart.php" class="hover:text-orange-500">
                    <i class="bi bi-cart text-2xl"></i> Cart
                </a>
                <a href="logout.php" class="hover:text-orange-500">
                    <i class="bi bi-box-arrow-right text-2xl"></i> Logout
                </a>
            </nav>
        </div>
    </header>

    <!-- Personalized Greeting -->
    <div class="max-w-6xl mx-auto p-6">
        <h2 class="text-4xl font-extrabold text-orange-600 mb-6">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h2>
        <p class="text-lg text-gray-600 mb-6">Thank you for visiting The Three Bears. Enjoy shopping!</p>

        <h2 class="text-2xl font-semibold mb-6">Shop Our Products</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="product-card border bg-white p-4 rounded-md shadow hover:shadow-lg transition">
                    <img src="<?php echo htmlspecialchars($row['product_image1']); ?>" alt="<?php echo htmlspecialchars($row['product_name']); ?>" class="w-full h-40 object-contain mb-4" style="height: 200px;">
                    <h3 class="text-lg font-semibold text-center mb-2"><?php echo htmlspecialchars($row['product_name']); ?></h3>
                    <p class="text-sm text-gray-500 text-center">₱<?php echo number_format($row['product_price'], 2); ?></p>
                    <form action="user-index.php" method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                        <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>">
                        <input type="hidden" name="product_image" value="<?php echo $row['product_image1']; ?>">
                        <button type="submit" name="add_to_cart" class="add-to-cart bg-orange-500 text-white py-2 px-4 rounded mt-4 w-full block text-center">Add to Cart</button>
                    </form>
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center bg-gray-800 text-white p-4 mt-8">
        <p>&copy; 2024 The Three Bears Dining. All rights reserved.</p>
        <p>Indulge Your Senses, One Bite at a Time.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>