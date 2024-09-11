<?php
$genre = isset($_GET['genre']) ? $_GET['genre'] : 'all';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plaka Express - <?php echo ucfirst($genre); ?> Genre</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="genre-overview">
    <h1><?php echo ucfirst($genre); ?></h1>
    <div class="genre-description">
        <img src="images/<?php echo $genre; ?>.jpg" alt="<?php echo ucfirst($genre); ?>">
        <p>A brief description of <?php echo $genre; ?> music...</p>
        <a href="shop.php?category=<?php echo $genre; ?>" class="shop-btn">Shop <?php echo ucfirst($genre); ?> Vinyls</a>
    </div>
</section>

<section class="genre-products">
    <h2><?php echo ucfirst($genre); ?> Vinyls & CDs</h2>
    <div class="products-list">
        <!-- Example product -->
        <div class="product-item">
            <img src="images/sample-vinyl.jpg" alt="Sample Vinyl">
            <h3>Sample Album</h3>
            <p>PHP 1200.00</p>
            <a href="shop.php?product=sample-album" class="product-btn">View Product</a>
        </div>
        <!-- More products -->
    </div>
</section>

<aside class="genre-sidebar">
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
