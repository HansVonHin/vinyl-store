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
    <h1 class="heading">Dashboard</h1>

    <div class="box-container">
        <!-- Welcome Card -->
        <div class="box">
            <h3>Welcome!</h3>
            <p><?= $fetch_profile['name']; ?></p>
            <a href="update_profile.php" class="btn">Update Profile</a>
        </div>

        <!-- Total Pending Orders -->
        <div class="box">
            <?php
            $total_pendings = 0;
            $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
            $select_pendings->execute(['pending']);
            if($select_pendings->rowCount() > 0){
               while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
                  $total_pendings += $fetch_pendings['total_price'];
               }
            }
            ?>
            <h3><span>₱</span><?= $total_pendings; ?><span>/-</span></h3>
            <p>Total Pendings</p>
            <a href="placed_orders.php" class="btn">See Orders</a>
        </div>

        <!-- Completed Orders -->
        <div class="box">
            <?php
            $total_completes = 0;
            $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
            $select_completes->execute(['completed']);
            if($select_completes->rowCount() > 0){
               while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
                  $total_completes += $fetch_completes['total_price'];
               }
            }
            ?>
            <h3><span>₱</span><?= $total_completes; ?><span>/-</span></h3>
            <p>Completed Orders</p>
            <a href="placed_orders.php" class="btn">See Orders</a>
        </div>

        <!-- Monthly Sales Chart -->
        <div class="box">
            <h3>Monthly Sales</h3>
            <canvas id="salesChart"></canvas>
        </div>

        <!-- Order Status Pie Chart -->
        <div class="box">
            <h3>Order Status</h3>
            <canvas id="statusChart"></canvas>
        </div>

        <!-- Top Products Bar Chart -->
        <div class="box">
            <h3>Top-Selling Products</h3>
            <canvas id="productsChart"></canvas>
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

// Order Status Pie Chart
const ctxStatus = document.getElementById('statusChart').getContext('2d');
new Chart(ctxStatus, {
    type: 'pie',
    data: {
        labels: ['Pending', 'Completed'],
        datasets: [{
            data: [<?= $pending_orders; ?>, <?= $completed_orders; ?>],
            backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)'],
            borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)'],
        }]
    }
});

// Top Products Bar Chart
const ctxProducts = document.getElementById('productsChart').getContext('2d');
new Chart(ctxProducts, {
    type: 'bar',
    data: {
        labels: <?= json_encode(array_column($top_products, 'name')); ?>,
        datasets: [{
            label: 'Sales',
            data: <?= json_encode(array_column($top_products, 'sales')); ?>,
            backgroundColor: 'rgba(153, 102, 255, 0.2)',
            borderColor: 'rgba(153, 102, 255, 1)',
        }]
    }
});
</script>

<script src="../Vinyl-Store/js/admin_script.js"></script>

</body>
</html>
