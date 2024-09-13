<?php
include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/wishlist_cart.php';
// Description and image details for Vinyl Sizes
$vinylSizeDetails = [
    '7-inch' => [
        'description' => '7" vinyl records are typically used for singles and offer a compact format.',
        'image' => '7-inch-vinyl-bg.jpg'
    ],
    '10-inch' => [
        'description' => '10" vinyl records provide a middle ground between 7" singles and 12" LPs.',
        'image' => '10-inch-vinyl-bg.jpg'
    ],
    '12-inch' => [
        'description' => '12" vinyl records are the standard for full-length albums, offering the best sound quality.',
        'image' => '12-inch-vinyl-bg.jpg'
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plaka Express - Vinyl Sizes</title>
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
    <h1>Vinyl Sizes</h1>
    <a href="shop.php?category=vinyl_sizes" class="main-shop-button">View All Vinyl Sizes</a>

    <div class="size-category">
        <div class="size-highlight">
            <div class="size-info">
                <h2>7 Inch</h2>
                <p>The 7-inch vinyl, perfect for singles and EPs, delivering classic sound in a compact size.</p>
                <a href="shop.php?size=7-inch&category=vinyl_sizes" class="shop-button">Shop 7 Inch Vinyls</a>
            </div>
            <img src="images/7-inch-vinyl.jpg" alt="7 Inch Vinyl">
        </div>

        <div class="size-highlight">
            <div class="size-info">
                <h2>10 Inch</h2>
                <p>The 10-inch vinyl offers a balanced option for collectors, ideal for both singles and albums.</p>
                <a href="shop.php?size=10-inch&category=vinyl_sizes" class="shop-button">Shop 10 Inch Vinyls</a>
            </div>
            <img src="images/10-inch-vinyl.jpg" alt="10 Inch Vinyl">
        </div>

        <div class="size-highlight">
            <div class="size-info">
                <h2>12 Inch</h2>
                <p>Experience the full album experience with 12-inch vinyl, the industry standard for LPs.</p>
                <a href="shop.php?size=12-inch&category=vinyl_sizes" class="shop-button">Shop 12 Inch Vinyls</a>
            </div>
            <img src="images/12-inch-vinyl.jpg" alt="12 Inch Vinyl">
        </div>
    </div>
</section>

<aside class="category-sidebar">
    <h2>Sort By</h2>
    <ul>
        <li><a href="#" onclick="sortBy('7-inch')">7" Vinyls</a></li>
        <li><a href="#" onclick="sortBy('10-inch')">10" Vinyls</a></li>
        <li><a href="#" onclick="sortBy('12-inch')">12" Vinyls</a></li>
    </ul>
</aside>

<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>