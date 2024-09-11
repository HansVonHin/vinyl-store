<?php
$genre = isset($_GET['genre']) ? $_GET['genre'] : 'all';
$media = isset($_GET['media']) ? $_GET['media'] : 'vinyl';  // Default to vinyl

// Descriptions and image files for each genre
$genreDetails = [
    'rock' => [
        'description' => 'Rock music emerged in the 1950s and is known for its powerful beats, electric guitars, and rebellious spirit. Iconic artists include The Beatles, Led Zeppelin, and The Rolling Stones.',
        'image' => 'rock-bg.jpg'
    ],
    'jazz' => [
        'description' => 'Jazz originated in the African-American communities of New Orleans in the late 19th and early 20th centuries. It is characterized by swing, improvisation, and complex harmonies.',
        'image' => 'jazz-bg.jpg'
    ],
    'classical' => [
        'description' => 'Classical music spans over several centuries, from the Baroque period to the Romantic era. It is known for its orchestral and symphonic compositions.',
        'image' => 'classical-bg.jpg'
    ],
    'electronic' => [
        'description' => 'Electronic music encompasses a wide range of styles, from house and techno to ambient and dubstep. It emerged in the late 20th century, driven by advancements in technology.',
        'image' => 'electronic-bg.jpg'
    ],
    'hip-hop' => [
        'description' => 'Hip-Hop began in the Bronx in the 1970s as a cultural movement encompassing DJing, rapping, breakdancing, and graffiti art.',
        'image' => 'hiphop-bg.jpg'
    ],
    'pop' => [
        'description' => 'Pop music is characterized by its catchy melodies and widespread appeal. It evolved from rock and roll in the 1950s and has continued to dominate the charts.',
        'image' => 'pop-bg.jpg'
    ],
    'vinyl-accessories' => [
        'description' => 'Vinyl accessories are essential tools for maintaining and enhancing your vinyl collection. These include cleaning kits, storage solutions, and protective covers.',
        'image' => 'vinyl-accessories-bg.jpg'
    ],
    'turntables' => [
        'description' => 'Turntables are the primary devices used for playing vinyl records. From entry-level to high-end models, turntables come in various types and features.',
        'image' => 'turntables-bg.jpg'
    ],
    'vinyl-sizes' => [
        'description' => 'Vinyl records come in various sizes, each offering a different listening experience. Explore the range of 7", 10", and 12" records to find your preferred format.',
        'image' => 'vinyl-sizes-bg.jpg'
    ]
];

// Media-specific titles
$mediaTitles = [
    'vinyl' => 'Vinyls',
    'cd' => 'CDs & DVDs',
    'tape' => 'Cassettes',
    'vinyl-accessories' => 'Vinyl Accessories',
    'turntables' => 'Turntables',
    'vinyl-sizes' => 'Vinyl Sizes'
];

$mediaImages = [
    'vinyl' => 'vinyl-bg.jpg',
    'cd' => 'cd-bg.jpg',
    'tape' => 'tape-bg.jpg',
    'vinyl-accessories' => 'vinyl-accessories-bg.jpg',
    'turntables' => 'turntables-bg.jpg',
    'vinyl-sizes' => 'vinyl-sizes-bg.jpg'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plaka Express - <?php echo ucfirst($genre); ?> <?php echo $mediaTitles[$media]; ?></title>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- Font Awesome CDN Link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Custom CSS File Link -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="genre-overview" style="background-image: url('images/<?php echo $genreDetails[$genre]['image']; ?>');">
    <h1><?php echo ucfirst($genre); ?> - <?php echo $mediaTitles[$media]; ?></h1>
    <div class="genre-description">
        <p><?php echo $genreDetails[$genre]['description']; ?></p>
        <a href="shop.php?category=<?php echo $genre; ?>&media=<?php echo $media; ?>" class="shop-btn">Shop <?php echo ucfirst($genre); ?> <?php echo $mediaTitles[$media]; ?></a>
    </div>
</section>

<section class="genre-products">
    <?php if ($media === 'vinyl-sizes') { ?>
        <h2>Explore Vinyl Sizes</h2>
        <div class="vinyl-sizes-list">
            <div class="vinyl-size">
                <h3>7" Vinyls</h3>
                <!-- Add code to dynamically fetch and display 7" vinyl records -->
            </div>
            <div class="vinyl-size">
                <h3>10" Vinyls</h3>
                <!-- Add code to dynamically fetch and display 10" vinyl records -->
            </div>
            <div class="vinyl-size">
                <h3>12" Vinyls (LP)</h3>
                <!-- Add code to dynamically fetch and display 12" vinyl records -->
            </div>
        </div>
    <?php } elseif ($media === 'vinyl-accessories' || $media === 'turntables') { ?>
        <h2><?php echo $mediaTitles[$media]; ?> Collection</h2>
        <div class="products-list accessory-reel">
            <!-- Add code to dynamically fetch and display accessories or turntables -->
        </div>
    <?php } else { ?>
        <h2>Iconic <?php echo $mediaTitles[$media]; ?></h2>
        <div class="products-list iconic-reel">
            <!-- Add code to dynamically fetch and display iconic records -->
        </div>

        <h2>Bestselling <?php echo $mediaTitles[$media]; ?></h2>
        <div class="products-list bestseller-reel">
            <!-- Add code to dynamically fetch and display bestselling records -->
        </div>

        <h2><?php echo $mediaTitles[$media]; ?> Throughout the Years</h2>
        <div class="products-list year-reel">
            <!-- Add code to dynamically fetch and display records by year -->
        </div>

        <h2>All <?php echo $mediaTitles[$media]; ?></h2>
        <div class="products-list full-catalogue">
            <!-- Add code to dynamically fetch and display the full catalogue -->
        </div>
    <?php } ?>
</section>

<aside class="genre-sidebar">
    <h2>Search Artist</h2>
    <form action="shop.php" method="GET">
        <input type="hidden" name="category" value="<?php echo $genre; ?>">
        <input type="hidden" name="media" value="<?php echo $media; ?>">
        <input type="text" name="artist" placeholder="Search Artist...">
        <button type="submit">Search</button>
    </form>

    <h2>Sort By</h2>
    <ul>
        <?php if ($media === 'vinyl-sizes') { ?>
            <li><a href="shop.php?category=<?php echo $genre; ?>&media=<?php echo $media; ?>&sort=7-inch">7" Vinyls</a></li>
            <li><a href="shop.php?category=<?php echo $genre; ?>&media=<?php echo $media; ?>&sort=10-inch">10" Vinyls</a></li>
            <li><a href="shop.php?category=<?php echo $genre; ?>&media=<?php echo $media; ?>&sort=12-inch">12" Vinyls</a></li>
        <?php } else { ?>
            <li><a href="shop.php?category=<?php echo $genre; ?>&media=<?php echo $media; ?>&sort=latest">Latest Releases</a></li>
            <li><a href="shop.php?category=<?php echo $genre; ?>&media=<?php echo $media; ?>&sort=oldest">Oldest First</a></li>
            <li><a href="shop.php?category=<?php echo $genre; ?>&media=<?php echo $media; ?>&sort=price-asc">Price: Low to High</a></li>
            <li><a href="shop.php?category=<?php echo $genre; ?>&media=<?php echo $media; ?>&sort=price-desc">Price: High to Low</a></li>
            <li><a href="shop.php?category=<?php echo $genre; ?>&media=<?php echo $media; ?>&sort=popularity">Popularity</a></li>
        <?php } ?>
    </ul>
</aside>

<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>
