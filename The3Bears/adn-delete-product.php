<?php
// Database connection
$servername = "127.0.0.1";
$username = "root"; // Change if necessary
$password = ""; // Change if necessary
$dbname = "the3bearsdb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all products from the database
$sql = "SELECT product_id, product_name, product_description, product_price, product_image1 FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-light text-dark">
    <header class="bg-gradient-to-r from-amber-100 to-yellow-100 p-4">
        <div class="max-w-6xl mx-auto flex items-center justify-between">
            <h1 class="text-xl font-semibold text-orange-600">Admin Dashboard</h1>
        </div>
    </header>

    <main class="container my-4">
    <!-- Back to Dashboard Button -->
    <div class="mb-3">
        <a href="admin-index.php" class="btn btn-secondary">Back to Admin Dashboard</a>
    </div>

    <h2 class="text-center mb-4">View and Manage Products</h2>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['product_id']; ?></td>
                        <td><?php echo $row['product_name']; ?></td>
                        <td><?php echo $row['product_description']; ?></td>
                        <td><?php echo number_format($row['product_price'], 2); ?></td>
                        <td>
                            <?php 
                            $imagePath = $row['product_image1']; // Path stored in the database
                            if (file_exists($imagePath) && !empty($row['product_image1'])): ?>
                                <img src="<?php echo $imagePath; ?>" alt="Product Image" style="width: 100px; height: auto;">
                            <?php else: ?>
                                <p class="text-danger">Image not found</p>
                            <?php endif; ?>
                        </td>
                        <td>
                            <button class="btn btn-danger delete-btn" data-id="<?php echo $row['product_id']; ?>" data-image="<?php echo $row['product_image1']; ?>">Delete</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">No products found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>

    <footer class="footer bg-dark text-white text-center p-3 mt-4">
        <p>&copy; 2024 The Three Bears Dining. All rights reserved.</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const deleteButtons = document.querySelectorAll('.delete-btn');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const productId = this.dataset.id;
                    const productImage = this.dataset.image;

                    // Confirmation popup using SweetAlert2
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'This action cannot be undone!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Perform AJAX request to delete the product
                            fetch('delete_product.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({ product_id: productId, product_image: productImage })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire('Deleted!', 'Product has been deleted.', 'success');
                                    // Remove the product row from the table
                                    this.closest('tr').remove();
                                } else {
                                    Swal.fire('Error!', data.message, 'error');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire('Error!', 'Something went wrong.', 'error');
                            });
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>
