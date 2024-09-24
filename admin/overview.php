<?php
include '../Vinyl-Store/components/connect.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Overview</title>
    <link rel="icon" href="images/favicon.ico" type="images/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../Vinyl-Store/css/admin_style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <?php include '../Vinyl-Store/components/admin_header.php'; ?>

    <section class="sales-overview">
        <h1>Overview</h1>
        <p>Overview of general revenue and profit</p>

        <label for="sales-toggle">Toggle Between:</label>
        <select id="sales-toggle">
            <option value="units">Total Units</option>
            <option value="revenue">Total Revenue</option>
        </select>

        <div class="chart-container">
            <canvas id="overviewChart"></canvas>
        </div>
    </section>

    <script>
    const ctxOverview = document.getElementById('overviewChart').getContext('2d');
    new Chart(ctxOverview, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Total Units Sold',
                data: [100, 120, 140, 160, 180, 200, 220, 240, 260, 280, 300, 320],
                borderColor: 'rgba(75, 192, 192, 1)',
                fill: false,
                tension: 0.1
            },
            {
                label: 'Total Revenue (₱)',
                data: [10000, 12000, 14000, 16000, 18000, 20000, 22000, 24000, 26000, 28000, 30000, 32000],
                borderColor: 'rgba(255, 99, 132, 1)',
                fill: false,
                tension: 0.1
            }]
        },
        options: {
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Months'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Total Units / Revenue (₱)'
                    }
                }
            }
        }
    });
    </script>

    <script src="../Vinyl-Store/js/admin_script.js"></script>
</body>
</html>
