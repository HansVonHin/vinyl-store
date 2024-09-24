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
    <title>Daily Sales</title>
    <link rel="icon" href="images/favicon.ico" type="images/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../Vinyl-Store/css/admin_style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <?php include '../Vinyl-Store/components/admin_header.php'; ?>

    <section class="daily-sales">
        <h1>Daily</h1>
        <p>Chart of Daily Sales</p>

        <div class="calendar-toggles">
            <label for="start-date">From:</label>
            <input type="date" id="start-date">
            <label for="end-date">To:</label>
            <input type="date" id="end-date">
        </div>

        <div class="chart-container">
            <canvas id="dailyChart"></canvas>
        </div>
    </section>

    <script>
    const ctxDaily = document.getElementById('dailyChart').getContext('2d');
    new Chart(ctxDaily, {
        type: 'line',
        data: {
            labels: ['9-02-24', '9-03-24', '9-04-24', '9-05-24', '9-06-24'],
            datasets: [{
                label: 'Total Units Sold',
                data: [15, 30, 25, 40, 50],
                borderColor: 'rgba(75, 192, 192, 1)',
                fill: false,
                tension: 0.1
            },
            {
                label: 'Total Sales (₱)',
                data: [1500, 3000, 2500, 4000, 5000],
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
                        text: 'Date'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Total Units / Sales (₱)'
                    }
                }
            }
        }
    });
    </script>

    <script src="../Vinyl-Store/js/admin_script.js"></script>
</body>
</html>
