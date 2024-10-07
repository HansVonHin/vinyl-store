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
   <title>Plaka Express - Quick View</title>
   <link rel="icon" href="images/favicon.ico" type="images/x-icon">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="quick-view">
   <h1 class="heading">Quick View</h1>

   <?php
     $pid = $_GET['pid'];
     $select_products = $conn->prepare("SELECT p.*, g.name AS genre, c.name AS category FROM `products` p 
                                        LEFT JOIN genres g ON p.genre_id = g.id 
                                        LEFT JOIN categories c ON p.category_id = c.id
                                        WHERE p.id = ?");
     $select_products->execute([$pid]);
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">

      <div class="row">
         <div class="image-container">
            <div class="main-image">
               <img src="/Vinyl-Store/uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
            </div>
            <div class="sub-image">
               <img src="/Vinyl-Store/uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
               <img src="/Vinyl-Store/uploaded_img/<?= $fetch_product['image_02']; ?>" alt="">
               <img src="/Vinyl-Store/uploaded_img/<?= $fetch_product['image_03']; ?>" alt="">
            </div>
         </div>

         <div class="content">
            <div class="name"><?= $fetch_product['name']; ?></div>
            <div class="flex">
               <div class="price"><span>₱</span><?= $fetch_product['price']; ?><span>/-</span></div>
               <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
            </div>

            <!-- Display genre, style, and release date -->
            <div class="genre"><strong>Genre:</strong> <?= $fetch_product['genre']; ?></div>
            <div class="style"><strong>Style:</strong> <?= $fetch_product['style']; ?></div>
            <div class="release-date"><strong>Release Date:</strong> <?= $fetch_product['release_date']; ?></div>

            <!-- Product details and tracklist -->
            <div class="details"><?= $fetch_product['details']; ?></div>
            <div class="tracklist">
               <h3>Tracklist:</h3>
               <p><?= nl2br($fetch_product['tracklist']); ?></p>
            </div>

            <!-- Credits section -->
            <div class="credits">
               <h3>Credits:</h3>
               <p><?= nl2br($fetch_product['credits']); ?></p>
            </div>

            <div class="flex-btn">
               <input type="submit" value="Add to Cart" class="btn" name="add_to_cart">
               <input class="option-btn" type="submit" name="add_to_wishlist" value="Add to Wishlist">
            </div>
         </div>
      </div>
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">No Products Found!</p>';
   }
   ?>
</section>

<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>
