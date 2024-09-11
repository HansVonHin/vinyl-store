<?php
$genre = isset($_GET['genre']) ? $_GET['genre'] : 'all';

// Descriptions and image files for each genre
$genreDetails = [
    'rock' => [
        'description' => 'Rock music emerged in the 1950s and is known for its powerful beats, electric guitars, and rebellious spirit. Iconic artists include The Beatles, Led Zeppelin, and The Rolling Stones. Rock music has had a profound impact on popular culture, influencing fashion, attitudes, and politics.',
        'image' => 'rock-bg.jpg'
    ],
    'jazz' => [
        'description' => 'Jazz originated in the African-American communities of New Orleans in the late 19th and early 20th centuries. It is characterized by swing, improvisation, and complex harmonies. Legendary artists include Miles Davis, John Coltrane, and Louis Armstrong.',
        'image' => 'jazz-bg.jpg'
    ],
    'classical' => [
        'description' => 'Classical music spans over several centuries, from the Baroque period to the Romantic era. It is known for its orchestral and symphonic compositions. Iconic composers include Ludwig van Beethoven, Wolfgang Amadeus Mozart, and Johann Sebastian Bach.',
        'image' => 'classical-bg.jpg'
    ],
    'electronic' => [
        'description' => 'Electronic music encompasses a wide range of styles, from house and techno to ambient and dubstep. It emerged in the late 20th century, driven by advancements in technology. Pioneers of electronic music include Kraftwerk, Daft Punk, and Aphex Twin.',
        'image' => 'electronic-bg.jpg'
    ],
    'hip-hop' => [
        'description' => 'Hip-Hop began in the Bronx in the 1970s as a cultural movement encompassing DJing, rapping, breakdancing, and graffiti art. It has since become a global phenomenon. Key figures include Tupac Shakur, Notorious B.I.G., and Jay-Z.',
        'image' => 'hiphop-bg.jpg'
    ],
    'pop' => [
        'description' => 'Pop music is characterized by its catchy melodies and widespread appeal. It evolved from rock and roll in the 1950s and has continued to dominate the charts. Influential artists include Michael Jackson, Madonna, and Britney Spears.',
        'image' => 'pop-bg.jpg'
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plaka Express - <?php echo ucfirst($genre); ?> Genre</title>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="genre-overview" style="background-image: url('images/<?php echo $genreDetails[$genre]['image']; ?>');">
    <h1><?php echo ucfirst($genre); ?></h1>
    <div class="genre-description">
        <p><?php echo $genreDetails[$genre]['description']; ?></p>
        <br>
        <a href="shop.php?category=<?php echo $genre; ?>" class="shop-btn">Shop <?php echo ucfirst($genre); ?> Vinyls</a>
    </div>
</section>

<section class="genre-products">
    <h2>Iconic <?php echo ucfirst($genre); ?> Vinyls</h2>
    <div class="products-list iconic-reel">
        <!-- Add code to dynamically fetch and display iconic vinyl records of the genre -->
    </div>

    <h2>Bestselling <?php echo ucfirst($genre); ?> Vinyls</h2>
    <div class="products-list bestseller-reel">
        <!-- Add code to dynamically fetch and display bestselling vinyl records of the genre -->
    </div>

    <h2><?php echo ucfirst($genre); ?> Throughout the Years</h2>
    <div class="products-list year-reel">
        <!-- Add code to dynamically fetch and display vinyl records of the genre by year -->
    </div>

    <h2>All <?php echo ucfirst($genre); ?> Vinyls & CDs</h2>
    <div class="products-list full-catalogue">
        <!-- Add code to dynamically fetch and display the full catalogue of the genre -->
    </div>
</section>

<aside class="genre-sidebar">
    <h2>Search Artist</h2>
    <form action="shop.php" method="GET">
        <input type="hidden" name="category" value="<?php echo $genre; ?>">
        <input type="text" name="artist" placeholder="Search Artist...">
        <button type="submit">Search</button>
    </form>
    <br>
    <h2>Sort By</h2>
    <ul>
        <li><a href="shop.php?category=<?php echo $genre; ?>&sort=latest">Latest Releases</a></li>
        <li><a href="shop.php?category=<?php echo $genre; ?>&sort=oldest">Oldest First</a></li>
        <li><a href="shop.php?category=<?php echo $genre; ?>&sort=price-asc">Price: Low to High</a></li>
        <li><a href="shop.php?category=<?php echo $genre; ?>&sort=price-desc">Price: High to Low</a></li>
        <li><a href="shop.php?category=<?php echo $genre; ?>&sort=decades">By Decade</a></li>
    </ul>

    <h2>Availability</h2>
    <ul>
        <li><a href="shop.php?category=<?php echo $genre; ?>&availability=in-stock">In Stock</a></li>
        <li><a href="shop.php?category=<?php echo $genre; ?>&availability=out-of-stock">Out of Stock</a></li>
    </ul>

    <h2>Price Range</h2>
    <form action="shop.php" method="GET">
        <input type="hidden" name="category" value="<?php echo $genre; ?>">
        <input type="number" name="min-price" placeholder="Min PHP" step="0.01">
        <input type="number" name="max-price" placeholder="Max PHP" step="0.01">
        <button type="submit">Apply</button>
    </form>
</aside>

<?php include 'components/footer.php'; ?>

</body>
</html>
