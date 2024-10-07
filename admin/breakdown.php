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
    <title>Sales Breakdown</title>
    <link rel="icon" href="../Vinyl-Store/images/favicon.ico" type="images/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../Vinyl-Store/css/admin_style.css">
    <link rel="stylesheet" href="../Vinyl-Store/css/admin_style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <?php include '../Vinyl-Store/components/admin_header.php'; ?>

    <section class="sales-breakdown">
        <h1>Breakdown</h1>
        <p>Breakdown of Sales By Category</p>

        <div class="chart-container">
            <canvas id="breakdownChart"></canvas>
        </div>
    </section>

    <script>
    const ctxBreakdown = document.getElementById('breakdownChart').getContext('2d');
    new Chart(ctxBreakdown, {
        type: 'doughnut',
        data: {
            labels: ['Rock', 'Pop', 'Jazz', 'Classical', 'Other'],
            datasets: [{
                data: [3000, 2000, 1500, 1000, 500],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.label + ': ₱' + context.raw;
                        }
                    }
                }
            },
            cutout: '50%', // Creates the donut effect
            responsive: true,
            maintainAspectRatio: false,
        }
    });
    </script>

    <script src="../Vinyl-Store/js/admin_script.js"></script>
</body>
</html>
