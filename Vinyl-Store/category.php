<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Plaka Express - Categories</title>
   <link rel="icon" href="images/favicon.ico" type="image/x-icon">
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- Font Awesome CDN Link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Custom CSS File Link -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="category">
   <h1 class="heading">Explore Our Categories</h1>

   <!-- Highlighted Category: Vinyl Genres -->
   <div class="highlighted-category">
      <div class="content">
         <h3>Vinyl Genres</h3>
         <p>Explore a vast selection of music genres from rock to classical, jazz to electronic, and everything in between.</p>
         <a href="shop.php?category=vinyl-genres" class="btn">Browse Genres</a>
         <div class="sub-categories">
            <div class="swiper genre-slider">
               <div class="swiper-wrapper">
                  <div class="swiper-slide"><a href="shop.php?category=rock">Rock</a></div>
                  <div class="swiper-slide"><a href="shop.php?category=jazz">Jazz</a></div>
                  <div class="swiper-slide"><a href="shop.php?category=classical">Classical</a></div>
                  <div class="swiper-slide"><a href="shop.php?category=electronic">Electronic</a></div>
                  <div class="swiper-slide"><a href="shop.php?category=hip-hop">Hip-Hop</a></div>
                  <!-- Add more genres as needed -->
               </div>
               <div class="swiper-pagination"></div>
            </div>
         </div>
      </div>
      <div class="image-slider">
         <div class="swiper genre-image-slider">
            <div class="swiper-wrapper">
               <div class="swiper-slide"><img src="images/rock-genre.jpg" alt="Rock"></div>
               <div class="swiper-slide"><img src="images/jazz-genre.jpg" alt="Jazz"></div>
               <div class="swiper-slide"><img src="images/classical-genre.jpg" alt="Classical"></div>
               <div class="swiper-slide"><img src="images/electronic-genre.jpg" alt="Electronic"></div>
               <div class="swiper-slide"><img src="images/hiphop-genre.jpg" alt="Hip-Hop"></div>
               <!-- Add more images as needed -->
            </div>
         </div>
      </div>
   </div>

   <!-- Highlighted Category: Vinyl Accessories -->
   <div class="highlighted-category">
      <div class="content">
         <h3>Vinyl Accessories</h3>
         <p>Complete your setup with high-quality accessories including phono cartridges, record brushes, and more.</p>
         <a href="shop.php?category=vinyl-accessories" class="btn">Browse Accessories</a>
         <!-- You can add sub-categories here if needed -->
      </div>
      <div class="image-slider">
         <div class="swiper accessory-image-slider">
            <div class="swiper-wrapper">
               <div class="swiper-slide"><img src="images/accessory-1.jpg" alt="Accessory 1"></div>
               <div class="swiper-slide"><img src="images/accessory-2.jpg" alt="Accessory 2"></div>
               <div class="swiper-slide"><img src="images/accessory-3.jpg" alt="Accessory 3"></div>
               <!-- Add more images as needed -->
            </div>
         </div>
      </div>
   </div>

   <!-- Highlighted Category: CDs -->
   <div class="highlighted-category">
      <div class="content">
         <h3>CDs & DVDs</h3>
         <p>Discover our selection of CDs and DVDs, featuring a variety of genres and artists.</p>
         <a href="shop.php?category=cds-dvds" class="btn">Browse CDs & DVDs</a>
         <div class="sub-categories">
            <div class="swiper cd-genre-slider">
               <div class="swiper-wrapper">
                  <div class="swiper-slide"><a href="shop.php?category=pop">Pop</a></div>
                  <div class="swiper-slide"><a href="shop.php?category=rock">Rock</a></div>
                  <div class="swiper-slide"><a href="shop.php?category=jazz">Jazz</a></div>
                  <!-- Add more genres as needed -->
               </div>
               <div class="swiper-pagination"></div>
            </div>
         </div>
      </div>
      <div class="image-slider">
         <div class="swiper cd-image-slider">
            <div class="swiper-wrapper">
               <div class="swiper-slide"><img src="images/cd-pop.jpg" alt="Pop"></div>
               <div class="swiper-slide"><img src="images/cd-rock.jpg" alt="Rock"></div>
               <div class="swiper-slide"><img src="images/cd-jazz.jpg" alt="Jazz"></div>
               <!-- Add more images as needed -->
            </div>
         </div>
      </div>
   </div>

   <!-- Highlighted Category: Tapes -->
   <div class="highlighted-category">
      <div class="content">
         <h3>Cassette Tapes</h3>
         <p>Explore our collection of cassette tapes from various genres and artists.</p>
         <a href="shop.php?category=tapes" class="btn">Browse Tapes</a>
         <div class="sub-categories">
            <div class="swiper tape-genre-slider">
               <div class="swiper-wrapper">
                  <div class="swiper-slide"><a href="shop.php?category=pop">Pop</a></div>
                  <div class="swiper-slide"><a href="shop.php?category=rock">Rock</a></div>
                  <div class="swiper-slide"><a href="shop.php?category=jazz">Jazz</a></div>
                  <!-- Add more genres as needed -->
               </div>
               <div class="swiper-pagination"></div>
            </div>
         </div>
      </div>
      <div class="image-slider">
         <div class="swiper tape-image-slider">
            <div class="swiper-wrapper">
               <div class="swiper-slide"><img src="images/tape-pop.jpg" alt="Pop"></div>
               <div class="swiper-slide"><img src="images/tape-rock.jpg" alt="Rock"></div>
               <div class="swiper-slide"><img src="images/tape-jazz.jpg" alt="Jazz"></div>
               <!-- Add more images as needed -->
            </div>
         </div>
      </div>
   </div>

   <!-- Smaller Categories -->
   <div class="small-categories">
      <div class="category-box">
         <img src="images/turntable.jpg" alt="Turntables">
         <h3>Turntables</h3>
         <p>Find the perfect turntable for your listening experience.</p>
         <a href="shop.php?category=turntables" class="btn">Explore Turntables</a>
      </div>

      <div class="category-box">
         <img src="images/vinyl-sizes.jpg" alt="Vinyl Sizes">
         <h3>Vinyl Sizes</h3>
         <p>Discover vinyl records in 7", 10", and 12" sizes.</p>
         <a href="shop.php?category=vinyl-sizes" class="btn">Explore Sizes</a>
      </div>
   </div>

   <!-- Search by Artist -->
   <div class="search-by-artist">
      <h3>Search by Artist</h3>
      <form action="search_page.php" method="post" class="search-bar">
         <input type="text" name="search_artist" placeholder="Enter artist name..." maxlength="100" required>
         <button type="submit" class="fas fa-search" name="search_btn"></button>
      </form>
   </div>

</section>

<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>
