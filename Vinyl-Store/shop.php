<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Plaka Express - Shop</title>
   <link rel="icon" href="images/favicon.ico" type="images/x-icon">
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- Font Awesome CDN Link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   
   <!-- Custom CSS File Link -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="shop-container">

   <!-- Sidebar for Categories and Sorting -->
   <aside class="sidebar">
            <!-- Search Form -->
      <form action="shop.php" method="GET" class="search-form">
         <input type="text" name="search" placeholder="Search products...">
         <button type="submit">Search</button>
      </form>
      <h2>Categories</h2>
      <ul class="category-list">
         <li>
            <a href="shop.php?category=vinyl">Vinyl</a>
            <ul>
               <li><a href="shop.php?category=rock-vinyl">Rock</a></li>
               <li><a href="shop.php?category=jazz-vinyl">Jazz</a></li>
               <li><a href="shop.php?category=classical-vinyl">Classical</a></li>
               <li><a href="shop.php?category=electronic-vinyl">Electronic</a></li>
               <li><a href="shop.php?category=hip-hop-vinyl">Hip-Hop</a></li>
               <li><a href="shop.php?category=pop-vinyl">Pop</a></li>
            </ul>
         </li>
         <li>
            <a href="shop.php?category=cd-dvd">CD & DVD</a>
            <ul>
               <li><a href="shop.php?category=rock-cd-dvd">Rock</a></li>
               <li><a href="shop.php?category=jazz-cd-dvd">Jazz</a></li>
               <li><a href="shop.php?category=classical-cd-dvd">Classical</a></li>
               <li><a href="shop.php?category=electronic-cd-dvd">Electronic</a></li>
               <li><a href="shop.php?category=hip-hop-cd-dvd">Hip-Hop</a></li>
               <li><a href="shop.php?category=pop-cd-dvd">Pop</a></li>
            </ul>
         </li>
         <li><a href="shop.php?category=tape-genres">Tape Genres</a></li>
         <li><a href="shop.php?category=vinyl-accessories">Vinyl Accessories</a>
            <ul>
               <li><a href="shop.php?category=phono-cartridges">Phono Cartridges</a></li>
               <li><a href="shop.php?category=record-brushes">Record Brushes</a></li>
               <li><a href="shop.php?category=record-weights">Record Weights</a></li>
               <li><a href="shop.php?category=protective-sleeves">Protective Sleeves</a></li>
               <li><a href="shop.php?category=record-storage-boxes">Record Storage Boxes</a></li>
               <li><a href="shop.php?category=stylus-cleaners">Stylus Cleaners</a></li>
            </ul>
         </li>
         <li><a href="shop.php?category=turntables">Turntables</a></li>
         <li><a href="shop.php?category=vinyl-sizes">Vinyl Sizes</a></li>
      </ul>
      
      <!-- Sort By Section -->
      <h2>Sort By</h2>
      <ul class="sort-list">
         <li><a href="shop.php?sort=latest">Latest Releases</a></li>
         <li><a href="shop.php?sort=oldest">Oldest First</a></li>
         <li><a href="shop.php?sort=price-asc">Price: Low to High</a></li>
         <li><a href="shop.php?sort=price-desc">Price: High to Low</a></li>
         <li><a href="shop.php?sort=popularity">Most Popular</a></li>
         <li><a href="shop.php?sort=decades">By Decade</a>
            <ul>
               <li><a href="shop.php?sort=70s">70s</a></li>
               <li><a href="shop.php?sort=80s">80s</a></li>
               <li><a href="shop.php?sort=90s">90s</a></li>
               <li><a href="shop.php?sort=00s">2000s</a></li>
               <li><a href="shop.php?sort=10s">2010s</a></li>
            </ul>
         </li>
      </ul>
   </aside>

   <!-- Products Section -->
   <div class="products">
      <h2 class="heading">Our Collection</h2>

      <div class="product-box-container">
         <!-- Sample Vinyl Product 1 -->
         <div class="product-box">
            <img src="images/sample-vinyl1.jpg" alt="Sample Vinyl 1">
            <h3>Classic Rock Vinyl</h3>
            <p>Experience the timeless classics with this rock vinyl collection.</p>
            <a href="product-details.php?id=1" class="btn">View Details</a>
         </div>

         <!-- Sample Vinyl Product 2 -->
         <div class="product-box">
            <img src="images/sample-vinyl2.jpg" alt="Sample Vinyl 2">
            <h3>Jazz Vinyl Collection</h3>
            <p>Immerse yourself in smooth jazz with these carefully curated records.</p>
            <a href="product-details.php?id=2" class="btn">View Details</a>
         </div>

         <!-- Sample Vinyl Product 3 -->
         <div class="product-box">
            <img src="images/sample-vinyl3.jpg" alt="Sample Vinyl 3">
            <h3>Hip-Hop Classics</h3>
            <p>A must-have for any hip-hop enthusiast, featuring the greatest hits.</p>
            <a href="product-details.php?id=3" class="btn">View Details</a>
         </div>

         <!-- Sample Vinyl Product 4 -->
         <div class="product-box">
            <img src="images/sample-vinyl4.jpg" alt="Sample Vinyl 4">
            <h3>Electronic Beats</h3>
            <p>Get your groove on with this selection of top electronic records.</p>
            <a href="product-details.php?id=4" class="btn">View Details</a>
         </div>

         <!-- Sample Vinyl Product 5 -->
         <div class="product-box">
            <img src="images/sample-vinyl5.jpg" alt="Sample Vinyl 5">
            <h3>Classical Masterpieces</h3>
            <p>Discover the world's finest classical music on high-quality vinyl.</p>
            <a href="product-details.php?id=5" class="btn">View Details</a>
         </div>

         <!-- Sample Vinyl Product 6 -->
         <div class="product-box">
            <img src="images/sample-vinyl6.jpg" alt="Sample Vinyl 6">
            <h3>Pop Hits</h3>
            <p>Enjoy the biggest pop hits from the past and present on vinyl.</p>
            <a href="product-details.php?id=6" class="btn">View Details</a>
         </div>
      </div>

   </div>

</section>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>
</body>
</html>
