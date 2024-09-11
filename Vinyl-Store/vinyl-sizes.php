<?php
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
    <div class="vinyl-sizes">
        <?php foreach ($vinylSizeDetails as $size => $details) { ?>
            <div class="vinyl-size">
                <a href="shop.php?media=vinyl-sizes&size=<?php echo $size; ?>">
                    <img src="images/<?php echo $details['image']; ?>" alt="<?php echo $size; ?>">
                    <h2><?php echo ucfirst(str_replace('-', ' ', $size)); ?></h2>
                    <p><?php echo $details['description']; ?></p>
                </a>
            </div>
        <?php } ?>
    </div>
</section>

<aside class="category-sidebar">
    <h2>Sort By</h2>
    <ul>
        <li><a href="shop.php?media=vinyl-sizes&sort=7-inch">7" Vinyls</a></li>
        <li><a href="shop.php?media=vinyl-sizes&sort=10-inch">10" Vinyls</a></li>
        <li><a href="shop.php?media=vinyl-sizes&sort=12-inch">12" Vinyls</a></li>
    </ul>
</aside>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>
</body>
</html>
