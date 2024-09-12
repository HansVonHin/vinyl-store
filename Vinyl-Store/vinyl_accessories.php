<?php
$accessory = isset($_GET['accessory']) ? $_GET['accessory'] : 'all';
// Description and image details for Vinyl Accessories
$accessoryDetails = [
    'phono-cartridges' => [
        'description' => 'Phono Cartridges are essential for achieving the best sound quality from your vinyl records.',
        'image' => 'phono-cartridges-bg.jpg'
    ],
    'record-brushes' => [
        'description' => 'Keep your records clean and dust-free with high-quality Record Brushes.',
        'image' => 'record-brushes-bg.jpg'
    ],
    'record-weights' => [
        'description' => 'Record Weights help stabilize your records during play for consistent audio performance.',
        'image' => 'record-weights-bg.jpg'
    ],
    'protective-sleeves' => [
        'description' => 'Protect your valuable vinyl records with durable Protective Sleeves.',
        'image' => 'protective-sleeves-bg.jpg'
    ],
    'record-storage-boxes' => [
        'description' => 'Organize and store your record collection with stylish and sturdy Record Storage Boxes.',
        'image' => 'record-storage-boxes-bg.jpg'
    ],
    'stylus-cleaners' => [
        'description' => 'Maintain your stylus in top condition with effective Stylus Cleaners.',
        'image' => 'stylus-cleaners-bg.jpg'
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plaka Express - <?php echo ucfirst($accessory); ?></title>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- Custom CSS File Link -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="genre-overview" style="background-image: url('images/<?php echo $accessoryDetails[$accessory]['image']; ?>');">
    <h1><?php echo ucfirst($accessory); ?></h1>
    <div class="genre-description">
        <p><?php echo $accessoryDetails[$accessory]['description']; ?></p>
        <br>
        <a href="shop.php?category=<?php echo $accessory;?>"class="shop-btn">Shop <?php echo ucfirst($accessory); ?></a>
    </div>
</section>

<section id="accessory-section" class="accessory-overview">
    <?php foreach ($accessoryDetails as $category => $details) { ?>
        <div class="accessory-item">
            <a href="shop.php?media=vinyl-accessories&category=<?php echo $category; ?>">
                <img src="images/<?php echo $details['image']; ?>" alt="<?php echo $category; ?>">
                <h2><?php echo ucfirst(str_replace('-', ' ', $category)); ?></h2>
                <p><?php echo $details['description']; ?></p>
            </a>
        </div>
    <?php } ?>
</section>

<aside class="category-sidebar">
    <h2>Sort By</h2>
    <ul>
        <li><a href="shop.php?media=vinyl-accessories&sort=price-asc">Price - Low to High</a></li>
        <li><a href="shop.php?media=vinyl-accessories&sort=price-desc">Price - High to Low</a></li>
        <li><a href="shop.php?media=vinyl-accessories&sort=popularity">Popularity</a></li>
    </ul>
</aside>

<?php include 'components/footer.php'; ?>

<script>
   let header = document.querySelector('.header');
   let lastScrollTop = 0;

   window.addEventListener('scroll', () => {
    let scrollTop = window.scrollY || document.documentElement.scrollTop;
    
    if (scrollTop > lastScrollTop && scrollTop > 250) {
        // Scrolling down and past 100px, hide the header
        header.classList.add('hidden');
    } else if (scrollTop < lastScrollTop && scrollTop <= 250) {
        // Scrolling up or near the top of the page, show the header
        header.classList.remove('hidden');
    }
    
    lastScrollTop = scrollTop;
   });
</script>
<script src="js/script.js"></script>
</body>
</html>
