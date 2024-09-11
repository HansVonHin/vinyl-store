<?php
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
    <div class="turntable-brands">
        <?php foreach ($turntableDetails as $brand => $details) { ?>
            <div class="turntable-brand">
                <a href="shop.php?media=turntables&brand=<?php echo $brand; ?>">
                    <img src="images/<?php echo $details['image']; ?>" alt="<?php echo $brand; ?>">
                    <h2><?php echo ucfirst(str_replace('-', ' ', $brand)); ?></h2>
                    <p><?php echo $details['description']; ?></p>
                </a>
            </div>
        <?php } ?>
    </div>
</section>

<aside class="category-sidebar">
    <h2>Sort By</h2>
    <ul>
        <li><a href="shop.php?media=turntables&sort=price-asc">Price - Low to High</a></li>
        <li><a href="shop.php?media=turntables&sort=price-desc">Price - High to Low</a></li>
        <li><a href="shop.php?media=turntables&sort=popularity">Popularity</a></li>
    </ul>
</aside>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>
</body>
</html>
