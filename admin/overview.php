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
    <link rel="icon" href="../Vinyl-Store/images/favicon.ico" type="images/x-icon">
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
        <select id="salesType" class="sales-toggle">
            <option value="units">Total Units</option>
            <option value="revenue">Total Revenue</option>
        </select>

        <canvas id="overviewChart"></canvas>
    </section>

    <script>
        const ctxOverview = document.getElementById('overviewChart').getContext('2d');
        const chartData = {
            units: [1000, 1200, 1100, 1300, 1400, 1500, 1600], // Replace with dynamic data from database
            revenue: [5000, 6000, 5500, 7000, 7500, 8000, 9000] // Replace with dynamic data from database
        };

        const overviewChart = new Chart(ctxOverview, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'], // Months
                datasets: [{
                    label: 'Total Units',
                    data: chartData.units,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        document.getElementById('salesType').addEventListener('change', function() {
            const selectedType = this.value;
            overviewChart.data.datasets[0].label = selectedType === 'units' ? 'Total Units' : 'Total Revenue';
            overviewChart.data.datasets[0].data = chartData[selectedType];
            overviewChart.update();
        });
        </script>

    <script src="../Vinyl-Store/js/admin_script.js"></script>
</body>
</html>
