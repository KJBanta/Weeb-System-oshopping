<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - The Three Bears</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="styles (1).css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body class="bg-neutral-100 text-gray-800">
    <!-- Header -->
    <header class="bg-gradient-to-r from-amber-100 to-yellow-100 p-4">
        <div class="max-w-6xl mx-auto flex items-center justify-between">
            <!-- Logo and Title -->
            <div class="flex items-center space-x-3">
                <img src="images/ThreeBearsLogo.png" alt="Logo" class="h-12 w-12 rounded-full object-cover">
                <h1 class="text-xl font-semibold text-orange-600">THE THREE BEARS</h1>
            </div>
            <!-- Navigation -->
            <nav class="flex items-center space-x-6 text-gray-700">
                <a href="index.php" class="hover:text-orange-500">Home</a>
                <a href="shop.php" class="hover:text-orange-500">Shop</a>
                <a href="contact-us.php" class="hover:text-orange-500">Contact-Us</a>
                <a href="about-us.php" class="hover:text-orange-500">All About Us</a>
                <!-- Bootstrap User Icon for My Account -->
                <a href="my-account.html" class="hover:text-orange-500">
                    <i class="bi bi-person-circle text-2xl"></i>
                </a>
                <!-- Cart Icon -->
    <a href="add-cart.html" class="hover:text-orange-500 relative">
        <i class="bi bi-cart-fill text-2xl"></i>
        <span id="cart-counter" 
              class="absolute top-0 right-0 bg-red-600 text-white text-xs font-bold rounded-full px-2 py-0.5">
            0
        </span>
    </a>
            </nav>
        </div>
    </header>
    <!-- Shop Page -->
    <main class="max-w-6xl mx-auto p-6">
        <h2 class="text-2xl font-semibold mb-6">Shop Our Items</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- Product Items 1 -->
            <div class="product-card border bg-white p-4 rounded-md shadow hover:shadow-lg transition" onclick="goToProductPage('Bear-Bread')">
                <img src="images/Bear-Bread1.jpg" alt="Bear-Bread" class="w-full h-40 object-contain mb-4">
                <h3 class="text-lg font-semibold">Bear-Bread</h3>
                <p class="text-sm text-gray-500">Pen Holder Desk Friend</p>
                <p class="text-orange-600 font-semibold">₱40.00</p>
            </div>
            <!-- Product Item 2 -->
            <div class="product-card border bg-white p-4 rounded-md shadow hover:shadow-lg transition" onclick="goToProductPage('Bear-paws')">
                <img src="images/Bear-pows1jpg.jpg" alt="Bear-paws" class="w-full h-40 object-contain mb-4">
                <h3 class="text-lg font-semibold">Bear-paws</h3>
                <p class="text-sm text-gray-500">Pen Holder Desk Friend</p>
                <p class="text-orange-600 font-semibold">₱100.00</p>
            </div>
            <!-- Product Item 3 -->
            <div class="product-card border bg-white p-4 rounded-md shadow hover:shadow-lg transition" onclick="goToProductPage('Bear-Shaped Macarons')">
                <img src="images/Bear-Shaped Macarons1.jpg" alt="Bear-Shaped Macarons" class="w-full h-40 object-contain mb-4">
                <h3 class="text-lg font-semibold">Bear-Shaped Macarons 5 pieces</h3>
                <p class="text-sm text-gray-500">Pen Holder Desk Friend</p>
                <p class="text-orange-600 font-semibold">₱250.00</p>
            </div>
             <!-- Product Item 4-->
             <div class="product-card border bg-white p-4 rounded-md shadow hover:shadow-lg transition" onclick="goToProductPage('Bearbread-rolls')">
                <img src="images/bearbread-rolls-2.jpg" alt="Bearbread-rolls" class="w-full h-40 object-contain mb-4">
                <h3 class="text-lg font-semibold">Bearbread-rolls</h3>
                <p class="text-sm text-gray-500">Pen Holder Desk Friend</p>
                <p class="text-orange-600 font-semibold">₱65.00</p>
            </div>
             <!-- Product Item 5-->
             <div class="product-card border bg-white p-4 rounded-md shadow hover:shadow-lg transition" onclick="goToProductPage('Choco Chips Bears')">
                <img src="images/choco chip1.jpg" alt="Choco chips bears" class="w-full h-40 object-contain mb-4">
                <h3 class="text-lg font-semibold">Choco Chips Bear 5 pieces</h3>
                <p class="text-sm text-gray-500">Pen Holder Desk Friend</p>
                <p class="text-orange-600 font-semibold">₱70.00</p>
            </div>
            <!-- Product Item 6 -->
                <div class="product-card border bg-white p-4 rounded-md shadow hover:shadow-lg transition" onclick="goToProductPage('Cupcake Bears')">
                <img src="images/cupcake1_.jpg" alt="cupcake bears" class="w-full h-40 object-contain mb-4">
                <h3 class="text-lg font-semibold">Cupcake Bears 3 pieces</h3>
                <p class="text-sm text-gray-500">Pen Holder Desk Friend</p>
                <p class="text-orange-600 font-semibold">₱50.00</p>
             </div>
              <!-- Product Item 7-->
            <div class="product-card border bg-white p-4 rounded-md shadow hover:shadow-lg transition" onclick="goToProductPage('grizzly burger')">
                <img src="images/grizzly burger.jpg" alt="grizzly burger" class="w-full h-40 object-contain mb-4">
                <h3 class="text-lg font-semibold">grizzly burger</h3>
                <p class="text-sm text-gray-500">Pen Holder Desk Friend</p>
                <p class="text-orange-600 font-semibold">₱300.00</p>
            </div>
             <!-- Product Item 8-->
             <div class="product-card border bg-white p-4 rounded-md shadow hover:shadow-lg transition" onclick="goToProductPage('grizzly coffee')">
                <img src="images/grizzly coffee.jpg" alt="grizzly coffee" class="w-full h-40 object-contain mb-4">
                <h3 class="text-lg font-semibold">grizzly coffee</h3>
                <p class="text-sm text-gray-500">Pen Holder Desk Friend</p>
                <p class="text-orange-600 font-semibold">₱80.00</p>
            </div>
             <!-- Product Item 9-->
             <div class="product-card border bg-white p-4 rounded-md shadow hover:shadow-lg transition" onclick="goToProductPage('honey bear latte')">
                <img src="images/honey bear latte1.jpg" alt="honey bear latte" class="w-full h-40 object-contain mb-4">
                <h3 class="text-lg font-semibold">honey bear latte</h3>
                <p class="text-sm text-gray-500">Pen Holder Desk Friend</p>
                <p class="text-orange-600 font-semibold">₱40.00</p>
            </div>
             <!-- Product Item 10-->
             <div class="product-card border bg-white p-4 rounded-md shadow hover:shadow-lg transition" onclick="goToProductPage('panda express')">
                <img src="images/panda express1.jpg" alt="panda express" class="w-full h-40 object-contain mb-4">
                <h3 class="text-lg font-semibold">panda express</h3>
                <p class="text-sm text-gray-500">Pen Holder Desk Friend</p>
                <p class="text-orange-600 font-semibold">₱70.00</p>
            </div>
             <!-- Product Item 11-->
             <div class="product-card border bg-white p-4 rounded-md shadow hover:shadow-lg transition" onclick="goToProductPage('polar bear smoothie')">
                <img src="images/polar bear smoothie 2.png" alt="polar bear smoothie" class="w-full h-40 object-contain mb-4">
                <h3 class="text-lg font-semibold">polar bear smoothie</h3>
                <p class="text-sm text-gray-500">Pen Holder Desk Friend</p>
                <p class="text-orange-600 font-semibold">₱65.00</p>
            </div>
             <!-- Product Item 12 -->
             <div class="product-card border bg-white p-4 rounded-md shadow hover:shadow-lg transition" onclick="goToProductPage('Teddy Bear Pizza')">
                <img src="images/Teddy Bear Pizza.jpg" alt="Teddy Bear Pizza" class="w-full h-40 object-contain mb-4">
                <h3 class="text-lg font-semibold">Teddy Bear Pizza</h3>
                <p class="text-sm text-gray-500">Pen Holder Desk Friend</p>
                <p class="text-orange-600 font-semibold">₱80.00</p>
            </div>
             <!-- Product Item 13 -->
             <div class="product-card border bg-white p-4 rounded-md shadow hover:shadow-lg transition" onclick="goToProductPage('The Bear Claw Tenders')">
                <img src="images/The Bear Claw Tenders1.jpg" alt="The Bear Claw Tenders" class="w-full h-40 object-contain mb-4">
                <h3 class="text-lg font-semibold">The Bear Claw Tenders</h3>
                <p class="text-sm text-gray-500">Pen Holder Desk Friend</p>
                <p class="text-orange-600 font-semibold">₱150.00</p>
            </div>
            <!-- Add other product items similarly -->
            <!-- Ensure the `onclick="goToProductPage('Product-Key')"` matches the key in the product data -->
        </div>
    </main>

    <!-- Footer -->
    <footer class="text-center bg-gray-800 text-white p-4 mt-8">
        <p>&copy; 2024 The Three Bears Dining. All rights reserved.</p>
        <p>Indulge Your Senses, One Bite at a Time.</p>
    </footer>

    <!-- JavaScript -->
    <script>
        function goToProductPage(product) {
            window.location.href = `product.html?item=${product}`;
        }
    </script>
</body>
</html>
