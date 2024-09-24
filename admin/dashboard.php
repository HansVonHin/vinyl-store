<?php

include '../Vinyl-Store/components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
}

// Fetch data for the charts
// Monthly sales data (dummy data, you will replace this with actual queries)
$monthly_sales = [3000, 2500, 3200, 4000, 3500, 4200, 5000, 4500, 4700, 4300, 5200, 6000];
$months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

// Order statuses for pie chart (replace with actual queries)
$pending_orders = $conn->query("SELECT COUNT(*) FROM orders WHERE payment_status = 'pending'")->fetchColumn();
$completed_orders = $conn->query("SELECT COUNT(*) FROM orders WHERE payment_status = 'completed'")->fetchColumn();

// Top products (replace with actual queries)
$top_products = [
    ['name' => 'Vinyl A', 'sales' => 120],
    ['name' => 'Vinyl B', 'sales' => 95],
    ['name' => 'Vinyl C', 'sales' => 80],
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plaka Express - Dashboard</title>
    <link rel="icon" href="images/favicon.ico" type="images/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../Vinyl-Store/css/admin_style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<?php include '../Vinyl-Store/components/admin_header.php'; ?>

<section class="dashboard">
    <!-- First section: Welcome and Reports -->
    <div class="dashboard-header">
        <h1>DASHBOARD</h1>
        <h2>Welcome, <?= $fetch_profile['name']; ?>!</h2>
        <a href="#" class="btn report-btn">Download Reports</a>
    </div>

    <!-- Second section: Sales Statistics and Chart -->
    <div class="sales-stats">
        <div class="small-stats">
            <div class="stat-box">
                <p>Total Customers</p>
                <h3>1,200</h3>
                <span>+21% Since last month</span>
            </div>
            <div class="stat-box">
                <p>Sales Today</p>
                <h3>₱5,000</h3>
                <span>-10% Since last month</span>
            </div>
            <div class="stat-box">
                <p>Monthly Sales</p>
                <h3>₱60,000</h3>
                <span>+15% Since last month</span>
            </div>
            <div class="stat-box">
                <p>Yearly Sales</p>
                <h3>₱720,000</h3>
                <span>+18% Since last year</span>
            </div>
        </div>
        <div class="chart-box">
            <h3>Monthly Sales Trend</h3>
            <canvas id="salesChart"></canvas>
        </div>
    </div>

    <!-- Third section: Recent Orders and Sales by Category -->
    <div class="orders-and-category">
        <div class="recent-orders">
            <h3>Recent User Checkouts</h3>
            <table>
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>User ID</th>
                        <th>Created At</th>
                        <th># of Products</th>
                        <th>Cost (PHP)</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Example data, replace with actual queries -->
                    <tr>
                        <td>101</td>
                        <td>501</td>
                        <td>2024-09-21</td>
                        <td>3</td>
                        <td>₱1,500</td>
                    </tr>
                    <!-- Repeat rows -->
                </tbody>
            </table>
            <div class="table-footer">
                <select>
                    <option value="25">25 rows</option>
                    <option value="50">50 rows</option>
                    <option value="75">75 rows</option>
                    <option value="100">100 rows</option>
                </select>
                <p>1-25 of 50</p>
            </div>
        </div>
        <div class="pie-chart-box">
            <h3>Sales by Category</h3>
            <canvas id="categoryChart"></canvas>
            <p>Breakdown of sales by genre and category for this year and total sales.</p>
        </div>
    </div>
</section>

<script>
// Monthly Sales Line Chart
const ctxSales = document.getElementById('salesChart').getContext('2d');
new Chart(ctxSales, {
    type: 'line',
    data: {
        labels: <?= json_encode($months); ?>,
        datasets: [{
            label: 'Monthly Sales (₱)',
            data: <?= json_encode($monthly_sales); ?>,
            borderColor: 'rgba(75, 192, 192, 1)',
            fill: false,
            tension: 0.1
        }]
    }
});

// Sales by Category Pie Chart
const ctxCategory = document.getElementById('categoryChart').getContext('2d');
new Chart(ctxCategory, {
    type: 'pie',
    data: {
        labels: ['Rock', 'Jazz', 'Pop', 'Classical'], // Example categories
        datasets: [{
            data: [3000, 2000, 1500, 1000], // Example data, replace with actual queries
            backgroundColor: ['#ff6384', '#36a2eb', '#cc65fe', '#ffce56']
        }]
    }
});
</script>

<script src="../Vinyl-Store/js/admin_script.js"></script>

</body>
</html>
