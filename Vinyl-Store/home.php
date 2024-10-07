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
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Plaka Express - Home</title>
   <link rel="icon" href="images/favicon.ico" type="images/x-icon">
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- Font Awesome CDN Link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Custom CSS File Link -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>

<div class="home-bg">
    <section class="home">
        <div class="swiper home-slider">
            <div class="swiper-wrapper">
               
                <!-- Slide 1: Promotional Deals -->
                <div class="swiper-slide slide">
                    <div class="image">
                        <img src="images/vinyl-sale.png" alt="Vinyl Sale">
                    </div>
                    <div class="content">
                        <span>Up to 50% Off</span>
                        <h3>Featured Vinyl Records</h3>
                        <a href="shop.php" class="btn">Shop Now</a>
                    </div>
                </div>

                <!-- Slide 2: New Releases -->
                <div class="swiper-slide slide">
                    <div class="image">
                        <img src="images/new-releases.png" alt="New Releases">
                    </div>
                    <div class="content">
                        <span>Freshly Released</span>
                        <h3>Latest Albums</h3>
                        <a href="shop.php" class="btn">Discover Now</a>
                    </div>
                </div>

                <!-- Slide 3: Featured Collections -->
                <div class="swiper-slide slide">
                    <div class="image">
                        <img src="images/featured-collections.png" alt="Featured Collections">
                    </div>
                    <div class="content">
                        <span>Exclusive Editions</span>
                        <h3>Curated Collections</h3>
                        <a href="shop.php" class="btn">Explore More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<section class="category">

   <h1 class="heading">Discover & Explore</h1>

   <div class="swiper category-slider">

   <div class="swiper-wrapper">

   <a href="category.php?category=new-releases" class="swiper-slide slide">
      <img src="images/icon-new-releases.png" alt="New Releases">
      <h3>New <br> Releases</h3>
   </a>

   <a href="category.php?category=best-sellers" class="swiper-slide slide">
      <img src="images/icon-best-sellers.png" alt="Best Sellers">
      <h3>Best <br> Sellers</h3>
   </a>

   <a href="category.php?category=featured-artists" class="swiper-slide slide">
      <img src="images/icon-featured-artists.png" alt="Featured Artists">
      <h3>Featured <br> Artists</h3>
   </a>

   <a href="category.php?category=genre-highlights" class="swiper-slide slide">
      <img src="images/icon-genre-highlights.png" alt="Genre Highlights">
      <h3>Genre <br> Highlights</h3>
   </a>

   <a href="category.php?category=exclusive-editions" class="swiper-slide slide">
      <img src="images/icon-exclusive-editions.png" alt="Exclusive Editions">
      <h3>Exclusive <br> Editions</h3>
   </a>

   <a href="category.php?category=seasonal-promotions" class="swiper-slide slide">
      <img src="images/icon-seasonal-promotions.png" alt="Seasonal Promotions">
      <h3>Seasonal <br> Promotions</h3>
   </a>

   <a href="category.php?category=vinyl-accessories" class="swiper-slide slide">
      <img src="images/icon-vinyl-accessories.png" alt="Vinyl Accessories">
      <h3>Vinyl <br> Accessories</h3>
   </a>

   <a href="category.php?category=artist-spotlights" class="swiper-slide slide">
      <img src="images/icon-artist-spotlights.png" alt="Artist Spotlights">
      <h3>Artist <br> Spotlights</h3>
   </a>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>

<!--<section class="home-products">
   <h1 class="heading">Latest Releases</h1>
   <div class="swiper products-slider">
      <div class="swiper-wrapper">
         </?php
         $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6"); 
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
         ?>
         <form action="" method="post" class="swiper-slide slide">
            <input type="hidden" name="pid" value="</?= $fetch_product['id']; ?>">
            <input type="hidden" name="name" value="</?= $fetch_product['name']; ?>">
            <input type="hidden" name="price" value="</?= $fetch_product['price']; ?>">
            <input type="hidden" name="image" value="</?= $fetch_product['image_01']; ?>">
            <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
            <a href="quick_view.php?pid=</?= $fetch_product['id']; ?>" class="fas fa-eye"></a>

            <--Clickable Image->
            <a href="quick_view.php?pid=</?= $fetch_product['id']; ?>">
               <img src="../Vinyl-Store/uploaded_img/</?= $fetch_product['image_01']; ?>" alt="">
            </a>
         
            <-- Clickable Name->
            <a href="quick_view.php?pid=</?= $fetch_product['id']; ?>" class="name"></?= $fetch_product['name']; ?></a>

            <div class="flex">
               <div class="price"><span>₱</span></?= $fetch_product['price']; ?><span>/</span></div>
               <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
            </div>
            <input type="submit" value="add to cart" class="btn" name="add_to_cart">
         </form>
         </?php
            }
         }else{
            echo '<p class="empty">No Products Added Yet!</p>';
         }
         ?>
      </div>
      <div class="swiper-pagination"></div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>

   </div>
</section>-->

<div class="home-bg">
    <section class="home">
        <div class="swiper home-slider">
            <div class="swiper-wrapper">
               
                <!-- Slide 1: Promotional Deals -->
                <div class="swiper-slide slide">
                    <div class="image">
                        <img src="images/vinyl-sale.png" alt="Vinyl Sale">
                    </div>
                    <div class="content">
                        <span>Up to 50% Off</span>
                        <h3>Featured Vinyl Records</h3>
                        <a href="shop.php" class="btn">Shop Now</a>
                    </div>
                </div>

                <!-- Slide 2: New Releases -->
                <div class="swiper-slide slide">
                    <div class="image">
                        <img src="images/new-releases.png" alt="New Releases">
                    </div>
                    <div class="content">
                        <span>Freshly Released</span>
                        <h3>Latest Albums</h3>
                        <a href="shop.php" class="btn">Discover Now</a>
                    </div>
                </div>

                <!-- Slide 3: Featured Collections -->
                <div class="swiper-slide slide">
                    <div class="image">
                        <img src="images/featured-collections.png" alt="Featured Collections">
                    </div>
                    <div class="content">
                        <span>Exclusive Editions</span>
                        <h3>Curated Collections</h3>
                        <a href="shop.php" class="btn">Explore More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<section class="home-products">
   <h1 class="heading">Latest Media Products</h1>
   <div class="swiper products-slider">
      <div class="swiper-wrapper">
         <?php
         // Query for media products (vinyl, CDs, DVDs, cassette tapes)
         $select_media_products = $conn->prepare("SELECT * FROM `products` WHERE media_type_id IS NOT NULL LIMIT 6");
         $select_media_products->execute();
         if($select_media_products->rowCount() > 0){
            while($fetch_product = $select_media_products->fetch(PDO::FETCH_ASSOC)){
         ?>
         <form action="" method="post" class="swiper-slide slide">
            <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
            <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
            <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
            <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
            <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
            <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>

            <!-- Clickable Image -->
            <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>">
               <img src="../Vinyl-Store/uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
            </a>
         
            <!-- Clickable Name -->
            <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="name"><?= $fetch_product['name']; ?></a>

            <div class="flex">
               <div class="price"><span>₱</span><?= $fetch_product['price']; ?><span>/</span></div>
               <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
            </div>
            <input type="submit" value="add to cart" class="btn" name="add_to_cart">
         </form>
         <?php
            }
         } else {
            echo '<p class="empty">No Media Products Added Yet!</p>';
         }
         ?>
      </div>
      <div class="swiper-pagination"></div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
   </div>
</section>

<div class="home-bg">
    <section class="home">
        <div class="swiper home-slider">
            <div class="swiper-wrapper">
               
                <!-- Slide 1: Promotional Deals -->
                <div class="swiper-slide slide">
                    <div class="image">
                        <img src="images/vinyl-sale.png" alt="Vinyl Sale">
                    </div>
                    <div class="content">
                        <span>Up to 50% Off</span>
                        <h3>Featured Vinyl Records</h3>
                        <a href="shop.php" class="btn">Shop Now</a>
                    </div>
                </div>

                <!-- Slide 2: New Releases -->
                <div class="swiper-slide slide">
                    <div class="image">
                        <img src="images/new-releases.png" alt="New Releases">
                    </div>
                    <div class="content">
                        <span>Freshly Released</span>
                        <h3>Latest Albums</h3>
                        <a href="shop.php" class="btn">Discover Now</a>
                    </div>
                </div>

                <!-- Slide 3: Featured Collections -->
                <div class="swiper-slide slide">
                    <div class="image">
                        <img src="images/featured-collections.png" alt="Featured Collections">
                    </div>
                    <div class="content">
                        <span>Exclusive Editions</span>
                        <h3>Curated Collections</h3>
                        <a href="shop.php" class="btn">Explore More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<section class="home-products">
   <h1 class="heading">Latest Non-Media Products</h1>
   <div class="swiper products-slider">
      <div class="swiper-wrapper">
         <?php
         // Query for non-media products (turntables, accessories)
         $select_non_media_products = $conn->prepare("SELECT * FROM `products` WHERE category_id = 1 LIMIT 6");
         $select_non_media_products->execute();
         if($select_non_media_products->rowCount() > 0){
            while($fetch_product = $select_non_media_products->fetch(PDO::FETCH_ASSOC)){
         ?>
         <form action="" method="post" class="swiper-slide slide">
            <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
            <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
            <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
            <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
            <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
            <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>

            <!-- Clickable Image -->
            <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>">
               <img src="../Vinyl-Store/uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
            </a>
         
            <!-- Clickable Name -->
            <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="name"><?= $fetch_product['name']; ?></a>

            <div class="flex">
               <div class="price"><span>₱</span><?= $fetch_product['price']; ?><span>/</span></div>
               <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
            </div>
            <input type="submit" value="add to cart" class="btn" name="add_to_cart">
         </form>
         <?php
            }
         } else {
            echo '<p class="empty">No Non-Media Products Added Yet!</p>';
         }
         ?>
      </div>
      <div class="swiper-pagination"></div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
   </div>
</section>

<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".home-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
    },
});

var swiper = new Swiper(".category-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
         slidesPerView: 2,
       },
      650: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 4,
      },
      1024: {
        slidesPerView: 5,
      },
   },
});

var swiper = new Swiper(".products-slider", {
   loop: true,
   loopFillGroupWithBlank: true, // Prevents disappearing slides when looping
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable: true,
   },
   autoplay: {
      delay: 3000,
      disableOnInteraction: false,
   },
   navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
   },
   breakpoints: {
      550: {
         slidesPerView: 2,
      },
      768: {
         slidesPerView: 2,
      },
      1024: {
         slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>
