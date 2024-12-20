leftover code

<?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '
                    <div class="order-item">
                        <div class="order-info">
                            <p><strong>ORDER ID:</strong> ' . $row['order_ID'] . '</p>
                            <p><strong>Total:</strong> Php ' . number_format($row['Total'], 2) . '</p>
                        </div>
                        <button class="view-btn">VIEW</button>
                    </div>
                    ';
                }
            } else {
                echo '<p>No orders found.</p>';
            }
            ?>

    <!-- JavaScript to Handle Filtering -->
    <script>
        function filterOrders(status) {
            const buttons = document.querySelectorAll('.filter-buttons button');
            buttons.forEach(button => button.classList.remove('active'));

            event.target.classList.add('active');
            
            const orders = document.querySelectorAll('.order-item');
            orders.forEach(order => {
                if (status === 'all' || order.getAttribute('data-status') === status) {
                    order.style.display = 'flex';
                } else {
                    order.style.display = 'none';
                }
            });
        }
    </script>

    <!-- Orders List -->
    <div id="order-list"></div>
        <script>
        // Function to fetch orders from the server
        async function fetchOrders() {
            try {
                // Make an AJAX call to the PHP script
                const response = await fetch('fetch_orders.php');
                
                // Check if the response is OK
                if (!response.ok) {
                    throw new Error('Failed to fetch orders');
                }
                
                // Parse the response JSON
                const orders = await response.json();
                
                // Render the orders to the DOM
                renderOrders(orders);
            } catch (error) {
                console.error('Error:', error);
            }
        }

        // Function to render the orders on the page
        function renderOrders(orders) {
            const orderList = document.getElementById('order-list');
            orderList.innerHTML = ''; // Clear any existing content

            // Check if there are any orders
            if (orders.length === 0) {
                orderList.innerHTML = '<p>No orders found.</p>';
                return;
            }

            // Create and append each order as an HTML element
            orders.forEach(order => {
                const orderItem = document.createElement('div');
                orderItem.className = 'order-item';
                orderItem.style.border = '1px solid #ccc';
                orderItem.style.margin = '10px';
                orderItem.style.padding = '10px';

                orderItem.innerHTML = `
                    <p><strong>Order ID:</strong> ${order.order_ID}</p>
                    <p><strong>Product ID:</strong> ${order.Product_ID}</p>
                    <p><strong>User ID:</strong> ${order.User_ID}</p>
                    <p><strong>Quantity:</strong> ${order.Qty}</p>
                    <p><strong>Price:</strong> Php ${parseFloat(order.Price).toFixed(2)}</p>
                    <p><strong>Total:</strong> Php ${parseFloat(order.Total).toFixed(2)}</p>
                    <p><strong>Date Ordered:</strong> ${order.Date_ordered}</p>
                `;

                orderList.appendChild(orderItem);
            });
        }

        // Call the function to fetch orders on page load
        fetchOrders();
    </script>