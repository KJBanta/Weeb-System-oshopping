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

    <!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Fetch sales data
    async function fetchSalesData() {
        try {
            const response = await fetch('fetch-sales-data.php');

            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            const salesData = await response.json();

            if (salesData.error) {
                throw new Error(salesData.error);
            }

            renderSalesChart(salesData);
        } catch (error) {
            console.error('Error fetching sales data:', error.message);

            // Optionally, display an error message in the UI
            document.getElementById('chart-container').innerHTML = `<p>${error.message}</p>`;
        }
    }

    // Render sales chart
    function renderSalesChart(data) {
        const months = data.map(item => item.order_month);
        const totalOrders = data.map(item => parseInt(item.total_orders, 10));
        const totalIncome = data.map(item => parseFloat(item.total_income));

        const ctx = document.getElementById('salesChart').getContext('2d');

        new Chart(ctx, {
            type: 'bar', // Chart type
            data: {
                labels: months,
                datasets: [
                    {
                        label: 'Total Orders',
                        data: totalOrders,
                        backgroundColor: 'rgba(75, 192, 192, 0.5)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                    },
                    {
                        label: 'Total Income',
                        data: totalIncome,
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1,
                    },
                ],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });
    }

    // Fetch and display data on page load
    fetchSalesData();
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
    <div id="chart-containerb">
        <canvas id="salesChart"></canvas>
    </div>
</div>


</body>
</html>
