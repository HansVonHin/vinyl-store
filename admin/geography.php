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
    <title>Geography</title>
    <link rel="icon" href="images/favicon.ico" type="images/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../Vinyl-Store/css/admin_style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
</head>
<body>

<?php include '../Vinyl-Store/components/admin_header.php'; ?>

<section class="geography">
    <h1>Geography</h1>
    <p>Find where your users are located</p>

    <div id="map" style="height: 500px;"></div>

    <div class="map-legend">
        <h3>Legend</h3>
        <div><span style="background-color: rgba(0, 128, 0, 0.5);"></span> High Density</div>
        <div><span style="background-color: rgba(255, 165, 0, 0.5);"></span> Medium Density</div>
        <div><span style="background-color: rgba(255, 0, 0, 0.5);"></span> Low Density</div>
    </div>
</section>

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
const map = L.map('map').setView([14.6091, 121.0223], 11); // Center on Metro Manila

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
}).addTo(map);

// Example user density data for cities
const cityData = {
    'Quezon City': { lat: 14.676041, lng: 121.0437, users: 500 },
    'Makati': { lat: 14.5547, lng: 121.0244, users: 200 },
    'Pasig': { lat: 14.5764, lng: 121.0851, users: 100 }
};

// Color coding based on user density
function getColor(users) {
    return users > 400 ? 'rgba(0, 128, 0, 0.5)' :
           users > 200 ? 'rgba(255, 165, 0, 0.5)' :
                         'rgba(255, 0, 0, 0.5)';
}

// Add markers for each city with a popup showing user count
Object.keys(cityData).forEach(city => {
    const data = cityData[city];
    L.circle([data.lat, data.lng], {
        color: 'gray',
        fillColor: getColor(data.users),
        fillOpacity: 0.7,
        radius: data.users * 10 // Scale the circle size by user count
    }).addTo(map)
      .bindPopup(`${city}: ${data.users} users`);
});
</script>

</body>
</html>
