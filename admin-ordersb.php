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
        // Function to fetch users
        async function fetchUsers() {
            try {
                // Send a GET request to the PHP script
                const response = await fetch('fetch_users.php');
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                // Parse the JSON response
                const data = await response.json();

                // Render the user data
                renderUsers(data);
            } catch (error) {
                console.error('Error fetching users:', error);
            }
        }

        // Function to render user data in the DOM
        function renderUsers(users) {
            const userList = document.getElementById('user-list');
            userList.innerHTML = ''; // Clear existing content

            if (users.length === 0) {
                userList.innerHTML = '<p>No users found.</p>';
                return;
            }

            users.forEach(user => {
                const userItem = document.createElement('div');
                userItem.style.border = '1px solid #ccc';
                userItem.style.margin = '10px';
                userItem.style.padding = '10px';
                userItem.style.borderRadius = '5px';
                userItem.style.backgroundColor = '#f9f9f9';

                userItem.innerHTML = `
                    <p><strong>User ID:</strong> ${user.User_ID}</p>
                    <p><strong>Username:</strong> ${user.username}</p>
                    <p><strong>User Type:</strong> ${user.user_type}</p>
                    <p><strong>Date Added:</strong> ${user.date_added}</p>
                    <p><strong>Customer ID:</strong> ${user.Customer_ID}</p>
                    <p><strong>Orders:</strong> ${user.orders}</p>
                `;

                userList.appendChild(userItem);
            });
        }

        // Fetch users on page load
        fetchUsers();
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
        <div class="status-buttons">
            <button class="status-btn">PENDING</button>
            <button class="status-btn">RECEIVED</button>
        </div>
        <div id="order-list" class="order-list">
            <!-- Orders will be dynamically inserted here -->
        </div>
    </div>
</body>
</html>
