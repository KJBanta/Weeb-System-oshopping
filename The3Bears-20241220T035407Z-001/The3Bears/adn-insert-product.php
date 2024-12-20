
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Product - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-dark">
    <!-- Header -->
    <header class="bg-gradient-to-r from-amber-100 to-yellow-100 p-4">
        <div class="max-w-6xl mx-auto flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <img src="images/ThreeBearsLogo.png" alt="Logo" class="h-12 w-12 rounded-full object-cover">
                <h1 class="text-xl font-semibold text-orange-600">Admin Dashboard</h1>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container my-4">
        <h2 class="text-center mb-4">Insert New Product</h2>
        <!-- Form Start -->
        <form action="insert_product.php" method="POST" enctype="multipart/form-data" class="p-4 bg-white shadow rounded">
            <!-- Product Name -->
            <div class="mb-3">
                <label for="product_name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter product name" required>
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="product_description" class="form-label">Product Description</label>
                <textarea class="form-control" id="product_description" name="product_description" rows="4" placeholder="Enter product description" required></textarea>
            </div>

            <!-- Keywords -->
            <div class="mb-3">
                <label for="product_keywords" class="form-label">Keywords</label>
                <input type="text" class="form-control" id="product_keywords" name="product_keywords" placeholder="Enter keywords (comma-separated)" required>
            </div>

            <!-- Product Photos -->
            <div class="mb-3">
                <label for="product_photo-1" class="form-label">Product Photo 1</label>
                <input type="file" class="form-control" id="product_photo_1" name="product_photo_1" accept="image/*" required>
            </div>
            <div class="mb-3">
                <label for="product_photo-2" class="form-label">Product Photo 2</label>
                <input type="file" class="form-control" id="product_photo_2" name="product_photo_2" accept="image/*" required>
            </div>

            <!-- Product Price -->
            <div class="mb-3">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="number" class="form-control" id="product_price" name="product_price" placeholder="Enter product price" min="0" step="0.01" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-success w-100">Submit Product</button>
        </form>
    </main>

    <!-- Footer -->
    <footer class="footer bg-dark text-white text-center p-3 mt-4">
        <p>&copy; 2024 The Three Bears Dining. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');

    form.addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent default form submission

        // Create a FormData object from the form
        const formData = new FormData(form);

        // Send the data using fetch
        fetch('insert_product.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json()) // Parse the JSON response
        .then(data => {
            if (data.success) {
                alert('Product added successfully!');
                console.log(data);
                // Redirect to admin dashboard
                window.location.href = 'admin-index.php'; // Change this to your actual admin dashboard URL
            } else {
                alert('Error: ' + data.message);
                console.log(data);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});
</script>