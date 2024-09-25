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

        <form id="dateFilterForm">
            <label for="startDate">Start Date:</label>
            <input type="date" id="startDate" name="startDate" required>
            <label for="endDate">End Date:</label>
            <input type="date" id="endDate" name="endDate" required>
            <button type="submit">Filter</button>
        </form>

        <canvas id="dailyChart"></canvas>
    </section>

    <script>
        const ctxDaily = document.getElementById('dailyChart').getContext('2d');
        let dailyChart = new Chart(ctxDaily, {
            type: 'line',
            data: {
                labels: ['2024-09-21', '2024-09-22', '2024-09-23', '2024-09-24', '2024-09-25', '2024-09-26', '2024-09-27'], // Replace with dynamic dates
                datasets: [{
                    label: 'Daily Sales',
                    data: [100, 110, 120, 130, 140, 150, 160, 170], // Replace with dynamic data
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
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

        document.getElementById('dateFilterForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;

            // Fetch filtered data based on selected date range (you'll need to replace this with actual dynamic data)
            const filteredData = {
                labels: ['2024-09-21', '2024-09-22', '2024-09-23', '2024-09-24', '2024-09-25', '2024-09-26', '2024-09-27'], // Example of filtered dates
                data: [100, 110, 120, 130, 140, 150, 160, 170] // Example of filtered sales
            };

            // Update the chart with filtered data
            dailyChart.data.labels = filteredData.labels;
            dailyChart.data.datasets[0].data = filteredData.data;
            dailyChart.update();
        });
    </script>

    <script src="../Vinyl-Store/js/admin_script.js"></script>
</body>
</html>
