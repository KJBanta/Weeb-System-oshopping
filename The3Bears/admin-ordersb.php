<?php
session_start();
include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Orders</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        header {
            background: linear-gradient(to right, #fff7d9, #ffecb3);
        }

        header h1 {
            font-size: 24px;
            font-weight: 600;
            margin: 0;
        }

        .container {
            margin: 30px auto;
            max-width: 800px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 22px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 20px;
        }


        .order-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f1f1f1;
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .order-info p {
            margin: 5px 0;
            font-size: 14px;
            color: #333;
        }

        .view-btn {
            background-color: #b11226;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 14px;
            cursor: pointer;
            transition: 0.3s;
        }

        .view-btn:hover {
            background-color: #d11a34;
        }
    </style>

<script>
async function fetchOrderData() {
    try {
        const response = await fetch('fetch-orders.php');

        // Check if response is valid
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const orders = await response.json(); // Parse JSON

        if (orders.error) {
            throw new Error(orders.error); // Handle PHP errors
        }

        renderOrderInfo(orders); // Pass data to render function
    } catch (error) {
        console.error('Error fetching order data:', error.message);

        // Display error message in the UI
        const orderList = document.getElementById('order-list');
        orderList.innerHTML = `<p>${error.message}</p>`;
    }
}

// Function to display order information
function renderOrderInfo(orders) {
    const orderList = document.getElementById('order-list');
    orderList.innerHTML = ''; // Clear existing content

    if (orders.length === 0) {
        orderList.innerHTML = '<p>No orders found.</p>';
        return;
    }

    orders.forEach(order => {
        const orderItem = document.createElement('div');
        orderItem.style.border = '1px solid #ccc';
        orderItem.style.margin = '10px';
        orderItem.style.padding = '10px';
        orderItem.style.borderRadius = '5px';
        orderItem.style.backgroundColor = '#f9f9f9';

        orderItem.innerHTML = `
            <p><strong>Order ID:</strong> ${order.order_id}</p>
            <p><strong>User ID:</strong> ${order.user_id}</p>
            <p><strong>Customer Name:</strong> ${order.user_name}</p>
            <p><strong>Contact Number:</strong> ${order.contact_no}</p>
            <p><strong>Payment Method:</strong> ${order.payment_method}</p>
            <p><strong>Address:</strong> ${order.Add_ress}</p>
            <p><strong>Total Products:</strong> ${order.total_product}</p>
            <p><strong>Total Price:</strong> $${order.total_price}</p>
            <p><strong>Order Placed On:</strong> ${order.placed_on}</p>
            <p><strong>Payment Status:</strong> ${order.payment_status}</p>
        `;

        orderList.appendChild(orderItem);
    });
}

// Function to view detailed order info
function viewOrderDetails(encodedOrder) {
    const order = JSON.parse(decodeURIComponent(encodedOrder));

    const orderDetails = document.getElementById('order-details');
    orderDetails.innerHTML = `
        <p><strong>Order ID:</strong> ${order.order_id}</p>
        <p><strong>User ID:</strong> ${order.user_id}</p>
        <p><strong>Customer Name:</strong> ${order.user_name}</p>
        <p><strong>Contact Number:</strong> ${order.contact_no}</p>
        <p><strong>Payment Method:</strong> ${order.payment_method}</p>
        <p><strong>Address:</strong> ${order.Add_ress}</p>
        <p><strong>Total Products:</strong> ${order.total_product}</p>
        <p><strong>Total Price:</strong> $${order.total_price}</p>
        <p><strong>Order Placed On:</strong> ${order.placed_on}</p>
        <p><strong>Payment Status:</strong> ${order.payment_status}</p>
    `;

    openModal(); // Open the modal
}

// Modal open and close functions
function openModal() {
    document.getElementById('details-modal').style.display = 'block';
    document.getElementById('modal-overlay').style.display = 'block';
}

function closeModal() {
    document.getElementById('details-modal').style.display = 'none';
    document.getElementById('modal-overlay').style.display = 'none';
}

// Fetch order data on page load
fetchOrderData();
</script>

        
</head>

<body>
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
                <a href="admin-index.php" class="hover:text-orange-500">Dashboard</a>
                <a href="contact-us.php" class="hover:text-orange-500">Contact-Us</a>
                <a href="about-us.php" class="hover:text-orange-500">All About Us</a>
            </nav>
        </div>
    </header>

    <div class="container">
        <h1>ORDER LIBRARY</h1>
        <div id="order-list" class="order-list">
            <!-- Orders will be dynamically inserted here -->
        </div>
    </div>
</body>
</html>
