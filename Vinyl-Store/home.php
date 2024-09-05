<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Plaka Express - Home</title>

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
            <div class="swiper-pagination"></div>
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

<section class="home-products">

   <h1 class="heading">Latest Releases</h1>

   <div class="swiper products-slider">

   <div class="swiper-wrapper">

      <!-- Add product items here as needed -->

   </div>

   <div class="swiper-pagination"></div>

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
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
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
