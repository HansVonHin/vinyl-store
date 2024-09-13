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
   <title>Plaka Express - Categories</title>
   <link rel="icon" href="images/favicon.ico" type="images/x-icon">
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
        <div class="dropdown-container">
            <a class="btn">Browse Genres
            <span class="fas fa-angle-down-toggle">&#9662;</span>
            </a>
            <div class="dropdown-menu">
                  <ul class="genre-list">
                     <li class="swiper-slide"><a href="genre.php?genre=rock">Rock</a></li>
                     <li class="swiper-slide"><a href="genre.php?genre=jazz">Jazz</a></li>
                     <li class="swiper-slide"><a href="genre.php?genre=classical">Classical</a></li>
                     <li class="swiper-slide"><a href="genre.php?genre=electronic">Electronic</a></li>
                     <li class="swiper-slide"><a href="genre.php?genre=hip-hop">Hip-Hop</a></li>
                     <li class="swiper-slide"><a href="genre.php?genre=pop">Pop</a></li>
                     <!-- Add more genres as needed -->
                </ui>
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
                <div class="swiper-slide"><img src="images/pop-genre.jpg" alt="Pop"></div>
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
        <div class="dropdown-container">
            <a class="btn">Browse Accessories
            <span class="fas fa-angle-down-toggle">&#9662;</span>
            </a>
            <div class="dropdown-menu">
                  <ul class="genre-list">
                     <li class="swiper-slide"><a href="vinyl_accessories.php?accessory=phono-cartridges">Phono Cartridges</a></li>
                     <li class="swiper-slide"><a href="vinyl_accessories.php?accessory=record-brushes">Record Brushes</a></li>
                     <li class="swiper-slide"><a href="vinyl_accessories.php?accessory=record-weights">Record Weights</a></li>
                     <li class="swiper-slide"><a href="vinyl_accessories.php?accessory=protective-sleeves">Protective Sleeves</a></li>
                     <li class="swiper-slide"><a href="vinyl_accessories.php?accessory=record-storage-boxes">Record Storage Boxes</a></li>
                     <li class="swiper-slide"><a href="vinyl_accessories.php?accessory=stylus-cleaners">Stylus Cleaners</a></li>
                     <!-- Add more genres as needed -->
                </ui>
            </div>
        </div>
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

<!-- Highlighted Category: CDs & DVDs -->
<div class="highlighted-category">
    <div class="content">
        <h3>CDs & DVDs</h3>
        <p>Discover our selection of CDs and DVDs, featuring a variety of genres and artists.</p>
        <div class="dropdown-container">
            <a class="btn">Browse CDs & DVDs
            <span class="fas fa-angle-down-toggle">&#9662;</span>
            </a>
            <div class="dropdown-menu">
                <ul class="genre-list">
                    <li class="swiper-slide"><a href="genre.php?media=cd&genre=rock">Rock</a></li>
                    <li class="swiper-slide"><a href="genre.php?media=cd&genre=jazz">Jazz</a></li>
                    <li class="swiper-slide"><a href="genre.php?media=cd&genre=classical">Classical</a></li>
                    <li class="swiper-slide"><a href="genre.php?media=cd&genre=electronic">Electronic</a></li>
                    <li class="swiper-slide"><a href="genre.php?media=cd&genre=hip-hop">Hip-Hop</a></li>
                    <li class="swiper-slide"><a href="genre.php?media=cd&genre=pop">Pop</a></li>
                </ul>
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

<!-- Highlighted Category: Cassette Tapes -->
<div class="highlighted-category">
    <div class="content">
        <h3>Cassette Tapes</h3>
        <p>Explore our collection of cassette tapes from various genres and artists.</p>
        <div class="dropdown-container">
            <a class="btn">Browse Tapes
            <span class="fas fa-angle-down-toggle">&#9662;</span>
            </a>
            <div class="dropdown-menu">
                <ul class="genre-list">
                    <li class="swiper-slide"><a href="genre.php?media=tape&genre=rock">Rock</a></li>
                    <li class="swiper-slide"><a href="genre.php?media=tape&genre=jazz">Jazz</a></li>
                    <li class="swiper-slide"><a href="genre.php?media=tape&genre=classical">Classical</a></li>
                    <li class="swiper-slide"><a href="genre.php?media=tape&genre=electronic">Electronic</a></li>
                    <li class="swiper-slide"><a href="genre.php?media=tape&genre=hip-hop">Hip-Hop</a></li>
                    <li class="swiper-slide"><a href="genre.php?media=tape&genre=pop">Pop</a></li>
                </ul>
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
         <a href="turntables.php" class="btn">Explore Turntables</a>
      </div>

      <div class="category-box">
         <img src="images/vinyl-sizes.jpg" alt="Vinyl Sizes">
         <h3>Vinyl Sizes</h3>
         <p>Discover vinyl records in 7", 10", and 12" sizes.</p>
         <a href="vinyl-sizes.php" class="btn">Explore Sizes</a>
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
