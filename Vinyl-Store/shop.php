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

<?php include 'components/user_header.php'; 
$category = isset($_GET['category']) ? $_GET['category'] : 'all';
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'latest';
$availability = isset($_GET['availability']) ? $_GET['availability'] : 'all';
$minPrice = isset($_GET['min-price']) ? $_GET['min-price'] : 0;
$maxPrice = isset($_GET['max-price']) ? $_GET['max-price'] : 1000000; // Set a high default max price
?>

<section class="shop-container">

   <!-- Sidebar for Categories and Sorting -->
   <aside class="sidebar">
      <!-- Search Form -->
      <form action="shop.php" method="GET" class="search-bar">
         <input type="text" name="search" placeholder="Search products...">
         <button type="submit">Search</button>
      </form>
      <br>
      <h2>Categories</h2>
      <ul class="category-list">
         <li>
            <a href="#" class="category-link">Vinyl</a>
            <ul class="sub-category-list">
               <li><a href="shop.php?category=rock-vinyl">Rock</a></li>
               <li><a href="shop.php?category=jazz-vinyl">Jazz</a></li>
               <li><a href="shop.php?category=classical-vinyl">Classical</a></li>
               <li><a href="shop.php?category=electronic-vinyl">Electronic</a></li>
               <li><a href="shop.php?category=hip-hop-vinyl">Hip-Hop</a></li>
               <li><a href="shop.php?category=pop-vinyl">Pop</a></li>
            </ul>
         </li>
         <li>
            <a href="#" class="category-link">CD & DVD</a>
            <ul class="sub-category-list">
               <li><a href="shop.php?category=rock-cd-dvd">Rock</a></li>
               <li><a href="shop.php?category=jazz-cd-dvd">Jazz</a></li>
               <li><a href="shop.php?category=classical-cd-dvd">Classical</a></li>
               <li><a href="shop.php?category=electronic-cd-dvd">Electronic</a></li>
               <li><a href="shop.php?category=hip-hop-cd-dvd">Hip-Hop</a></li>
               <li><a href="shop.php?category=pop-cd-dvd">Pop</a></li>
            </ul>
         </li>
         <li><a href="shop.php?category=tape-genres" class="category-link">Tape Genres</a></li>
         <li>
            <a href="#" class="category-link">Vinyl Accessories</a>
            <ul class="sub-category-list">
               <li><a href="shop.php?category=phono-cartridges">Phono Cartridges</a></li>
               <li><a href="shop.php?category=record-brushes">Record Brushes</a></li>
               <li><a href="shop.php?category=record-weights">Record Weights</a></li>
               <li><a href="shop.php?category=protective-sleeves">Protective Sleeves</a></li>
               <li><a href="shop.php?category=record-storage-boxes">Record Storage Boxes</a></li>
               <li><a href="shop.php?category=stylus-cleaners">Stylus Cleaners</a></li>
            </ul>
         </li>
         <li><a href="shop.php?category=turntables" class="category-link">Turntables</a></li>
         <li><a href="shop.php?category=vinyl-sizes" class="category-link">Vinyl Sizes</a></li>
      </ul>
      <br>
      <!-- Sort By Section -->
      <h2>Sort By</h2>
      <ul class="sort-list">
         <li><a href="shop.php?sort=latest" class="category-link">Latest Releases</a></li>
         <li><a href="shop.php?sort=oldest" class="category-link">Oldest First</a></li>
         <li><a href="shop.php?sort=price-asc" class="category-link">Price: Low to High</a></li>
         <li><a href="shop.php?sort=price-desc" class="category-link">Price: High to Low</a></li>
         <li>
            <a href="#" class="category-link">By Decade</a>
            <ul class="sub-category-list">
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

<script>
   document.querySelectorAll('.category-link').forEach(link => {
      link.addEventListener('click', function(event) {
         event.preventDefault();
         const subMenu = this.nextElementSibling;
         const isActive = this.classList.contains('active');

         // Close all submenus
         document.querySelectorAll('.category-link').forEach(link => {
            link.classList.remove('active');
            if (link.nextElementSibling) {
               link.nextElementSibling.style.display = 'none';
            }
         });

         // Toggle the clicked submenu
         if (!isActive) {
            this.classList.add('active');
            subMenu.style.display = 'block';
         }
      });
   });
</script>

<script src="js/script.js"></script>

</body>
</html>
