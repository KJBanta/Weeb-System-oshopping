<?php
session_start();
include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Library</title>

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

        .status-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .status-btn {
            padding: 10px 20px;
            border-radius: 25px;
            background-color: #ffd700;
            border: none;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
        }

        .status-btn:hover {
            background-color: #ffcc00;
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
async function fetchCustomerData() {
    try {
        const response = await fetch('fetch-users.php');

        // Check if response is valid
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const customers = await response.json(); // Parse JSON

        if (customers.error) {
            throw new Error(customers.error); // Handle PHP errors
        }

        renderCustomerInfo(customers); // Pass data to render function
    } catch (error) {
        console.error('Error fetching customer data:', error.message);

        // Display error message in the UI
        const userList = document.getElementById('user-list');
        userList.innerHTML = `<p>${error.message}</p>`;
    }
}


// Function to display customer information
function renderCustomerInfo(customers) {
    const userList = document.getElementById('user-list');
    userList.innerHTML = ''; // Clear existing content

    if (customers.length === 0) {
        userList.innerHTML = '<p>No customers found.</p>';
        return;
    }

    customers.forEach(customer => {
        const customerItem = document.createElement('div');
        customerItem.style.border = '1px solid #ccc';
        customerItem.style.margin = '10px';
        customerItem.style.padding = '10px';
        customerItem.style.borderRadius = '5px';
        customerItem.style.backgroundColor = '#f9f9f9';

        customerItem.innerHTML = `
            <p><strong>Customer ID:</strong> ${customer.Customer_ID}</p>
            <p><strong>Name:</strong> ${customer.Fname} ${customer.MI} ${customer.Lname}</p>
            <p><strong>Address:</strong> ${customer.Address}</p>
            <p><strong>Contact Number:</strong> ${customer.Contact_num}</p>
            <p><strong>Gender:</strong> ${customer.Gender}</p>
            <p><strong>User Type:</strong> ${customer.user_type}</p>
        `;

        userList.appendChild(customerItem);
    });
}

// Function to view detailed customer info
function viewCustomerDetails(encodedCustomer) {
    const customer = JSON.parse(decodeURIComponent(encodedCustomer));

    const userDetails = document.getElementById('user-details');
    userDetails.innerHTML = `
        <p><strong>Customer ID:</strong> ${customer.Customer_ID}</p>
        <p><strong>Name:</strong> ${customer.Fname} ${customer.MI}. ${customer.Lname}</p>
        <p><strong>Address:</strong> ${customer.Address}</p>
        <p><strong>Contact Number:</strong> ${customer.Contact_num}</p>
        <p><strong>Gender:</strong> ${customer.Gender}</p>
        <p><strong>User Type:</strong> ${customer.user_type}</p>
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

// Fetch customer data on page load
fetchCustomerData();
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
        <h1>USER LIBRARY</h1>
        <div id="user-list" class="order-list">
    <!-- Customer info will be dynamically inserted here -->
</div>

<!-- Modal for customer details -->
<div id="details-modal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <div id="user-details"></div>
    </div>
</div>
<div id="modal-overlay" class="modal-overlay" style="display: none;" onclick="closeModal()"></div>
    </div>
</body>
</html>
