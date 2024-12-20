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

    .containerb {
        max-width: 800px;
        margin: 30px auto;
        padding: 20px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    #salesChart {
        max-width: 100%;
        height: auto;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
async function fetchSalesSummary() {
    try {
        const response = await fetch('fetch-sales-data.php'); // Replace with your actual PHP endpoint
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const salesData = await response.json();
        console.log(salesData); // Log the data for debugging

        // Check if data is valid
        if (!Array.isArray(salesData)) {
            throw new Error('Invalid data format: Expected an array');
        }

        // Calculate totals
        const totalIncome = salesData.reduce((sum, data) => sum + parseFloat(data.total_income || 0), 0);
        const totalOrders = salesData.reduce((sum, data) => sum + parseInt(data.total_orders || 0), 0);
        const uniqueUsers = new Set(salesData.map(data => data.user_id)).size;

        // Display the totals
        displaySalesSummary(totalIncome, totalOrders, uniqueUsers);
    } catch (error) {
        console.error('Error fetching sales summary:', error.message);
        displaySalesSummaryError(error.message);
    }
}

function displaySalesSummary(totalIncome, totalOrders, uniqueUsers) {
    const summaryContainer = document.getElementById('sales-summary');
    summaryContainer.innerHTML = `
        <div style="border: 1px solid #ccc; padding: 10px; margin: 10px; border-radius: 5px; background-color: #f9f9f9;">
            <h3>Total Income</h3>
            <p style="font-size: 20px; font-weight: bold;">$${totalIncome.toFixed(2)}</p>
        </div>
        <div style="border: 1px solid #ccc; padding: 10px; margin: 10px; border-radius: 5px; background-color: #f9f9f9;">
            <h3>Total Orders</h3>
            <p style="font-size: 20px; font-weight: bold;">${totalOrders}</p>
        </div>
        <div style="border: 1px solid #ccc; padding: 10px; margin: 10px; border-radius: 5px; background-color: #f9f9f9;">
            <h3>Total Users</h3>
            <p style="font-size: 20px; font-weight: bold;">${uniqueUsers}</p>
        </div>
    `;
}

function displaySalesSummaryError(errorMessage) {
    const summaryContainer = document.getElementById('sales-summary');
    summaryContainer.innerHTML = `<p style="color: red;">Error: ${errorMessage}</p>`;
}

// Fetch the sales summary on page load
fetchSalesSummary();

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

<div class="containerb">
    <h1>Sales Report</h1>
    <div id="sales-summary" style="display: flex; justify-content: space-around; margin-top: 20px;">
    <!-- Summary will be dynamically injected here -->
</div>

</div>


</body>
</html>
