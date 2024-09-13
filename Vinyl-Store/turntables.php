<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/wishlist_cart.php';
// Description and image details for Turntables
$turntableDetails = [
    'brand-a' => [
        'description' => 'Brand A offers high-quality turntables with excellent features for audiophiles.',
        'image' => 'brand-a-turntable-bg.jpg'
    ],
    'brand-b' => [
        'description' => 'Brand B turntables are known for their sleek design and reliable performance.',
        'image' => 'brand-b-turntable-bg.jpg'
    ],
    'brand-c' => [
        'description' => 'Experience superior sound with Brand C turntables, perfect for any vinyl enthusiast.',
        'image' => 'brand-c-turntable-bg.jpg'
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plaka Express - Turntables</title>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- Custom CSS File Link -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    
<?php include 'components/user_header.php'; ?>

<section class="category-overview">
    <h1>Turntables</h1>
    <a href="shop.php?category=turntables" class="main-shop-button">View All Turntables</a>

    <div class="brand-category">
        <div class="brand-highlight">
            <div class="brand-info">
                <h2>Pioneer DJ</h2>
                <p>Discover the finest turntables from Brand A, known for their exceptional quality and sound performance.</p>
                <a href="shop.php?brand=a&category=turntables" class="shop-button">Shop Brand A</a>
            </div>
            <img src="images/brand-a-turntable.jpg" alt="Brand A Turntable">
        </div>

        <div class="brand-highlight">
            <div class="brand-info">
                <h2>Audio Technica</h2>
                <p>Explore the advanced features and sleek design of Brand B's turntables, perfect for audiophiles.</p>
                <a href="shop.php?brand=b&category=turntables" class="shop-button">Shop Brand B</a>
            </div>
            <img src="images/brand-b-turntable.jpg" alt="Brand B Turntable">
        </div>

        <div class="brand-highlight">
            <div class="brand-info">
                <h2>Fluance</h2>
                <p>Brand C turntables offer a perfect blend of modern technology and classic appeal.</p>
                <a href="shop.php?brand=c&category=turntables" class="shop-button">Shop Brand C</a>
            </div>
            <img src="images/brand-c-turntable.jpg" alt="Brand C Turntable">
        </div>
    </div>
</section>

<aside class="category-sidebar">
    <h2>Sort By</h2>
    <ul>
        <li><a href="#" onclick="sortBy('price-asc')">Price Low to High</a></li>
        <li><a href="#" onclick="sortBy('price-desc')">Price High to Low</a></li>
        <li><a href="#" onclick="sortBy('popularity')">Popularity</a></li>
    </ul>
</aside>

<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>

</script>
</body>
</html>