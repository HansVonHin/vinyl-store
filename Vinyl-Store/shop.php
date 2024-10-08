<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/wishlist_cart.php';

?>

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
               <li><a href="shop.php?category=rock&media=vinyl">Rock</a></li>
               <li><a href="shop.php?category=jazz&media=vinyl">Jazz</a></li>
               <li><a href="shop.php?category=classical&media=vinyl">Classical</a></li>
               <li><a href="shop.php?category=electronic&media=vinyl">Electronic</a></li>
               <li><a href="shop.php?category=hip-hop&media=vinyl">Hip-Hop</a></li>
               <li><a href="shop.php?category=pop&media=vinyl">Pop</a></li>
            </ul> 
         </li>
         <li>
            <a href="#" class="category-link">CD & DVD</a>
            <ul class="sub-category-list">
               <li><a href="shop.php?category=rock&media=cd">Rock</a></li>
               <li><a href="shop.php?category=jazz&media=cd">Jazz</a></li>
               <li><a href="shop.php?category=classical&media=cd">Classical</a></li>
               <li><a href="shop.php?category=electronic&media=cd">Electronic</a></li>
               <li><a href="shop.php?category=hip-hop&media=cd">Hip-Hop</a></li>
               <li><a href="shop.php?category=pop&media=cd">Pop</a></li>
            </ul>
         </li>
         <li><a href="shop.php?category=tape-genres" class="category-link">Cassette Tapes</a>
            <ul class="sub-category-list">
               <li><a href="shop.php?category=rock&media=tape">Rock</a></li>
               <li><a href="shop.php?category=jazz&media=tape">Jazz</a></li>
               <li><a href="shop.php?category=classical&media=tape">Classical</a></li>
               <li><a href="shop.php?category=electronic&media=tape">Electronic</a></li>
               <li><a href="shop.php?category=hip-hop&media=tape">Hip-Hop</a></li>
               <li><a href="shop.php?category=pop&media=tape">Pop</a></li>
            </ul>
         </li>
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
         <?php
            $select_products = $conn->prepare("SELECT * FROM `products`"); 
            $select_products->execute();
            if($select_products->rowCount() > 0){
            while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
         ?>
         <form action="" method="post" class="product-box">
            <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
            <h3><input type="hidden" name="name" value="<?= $fetch_product['name']; ?>"></h3>
            <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
            <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
            <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
            <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
            <img src="../Vinyl-Store/uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
            <div class="name"><?= $fetch_product['name']; ?></div>
            <div class="flex">
               <div class="price"><span>₱</span><?= $fetch_product['price']; ?><span>/-</span></div>
               <input type="number" name="qty" class="qty" min="1" max="9" onkeypress="if(this.value.length == 2) return false;" value="1">
            </div>
            <input type="submit" value="add to cart" class="btn" name="add_to_cart">
         </form>
         <?php
            }
         }else{
            echo '<p class="empty">No Products Found!</p>';
         }
         ?>
      </div>

   </div>

</section>

<?php include 'components/footer.php'; ?>

<script>
   // Category sidebar slide-down on click animation
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

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="Vinyl-Store/js/script.js"></script>

</body>
</html>
