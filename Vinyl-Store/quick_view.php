<?php

include 'components/connect.php';
session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/wishlist_cart.php';

// Fetch products for display
$products = $conn->query("SELECT * FROM `products` ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);

// Fetch orders for display
$orders = $conn->query("SELECT * FROM `orders` ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);

// Fetch artists
$artists = $conn->query("SELECT * FROM `artists` ORDER BY artist_id DESC")->fetchAll(PDO::FETCH_ASSOC);

// Fetch product_artists
$product_artists = $conn->query("SELECT * FROM `product_artists` ORDER BY artist_id DESC")->fetchAll(PDO::FETCH_ASSOC);

// Fetch product_styles with styles using a join
$product_styles = $conn->query("
    SELECT styles.style_name 
    FROM product_styles 
    JOIN styles ON product_styles.style_id = styles.style_id 
    WHERE product_styles.product_id = product_id
")->fetchAll(PDO::FETCH_ASSOC);

$product_credits = $conn->query("
    SELECT media_credits.credit_name, media_credits.credit_type 
    FROM product_credits 
    JOIN media_credits ON product_credits.credit_id = media_credits.credit_id 
    WHERE product_credits.product_id = product_id
")->fetchAll(PDO::FETCH_ASSOC);

// Fetch tracklists
$media_tracklists = $conn->query("SELECT * FROM `media_tracklists` ORDER BY tracklist_id DESC")->fetchAll(PDO::FETCH_ASSOC);

// Fetch credits
$media_credits = $conn->query("SELECT * FROM `media_credits` ORDER BY credit_id DESC")->fetchAll(PDO::FETCH_ASSOC);

//$side_a_tracks = json_decode($product['side_a_tracks'], true);
//$side_b_tracks = json_decode($product['side_b_tracks'], true);

//if (isset($side_a_tracks) && is_array($side_a_tracks)) {
   //foreach ($side_a_tracks as $track) {
       //echo "<li>{$track}</li>";
   //}
//}

//$checkout_count = $conn->query("SELECT COUNT(*) FROM orders WHERE id = $id")->fetchColumn();
//$rating_count = $conn->query("SELECT COUNT(*) FROM reviews WHERE product_id = $product_id")->fetchColumn();
//$avg_rating = $conn->query("SELECT AVG(rating) FROM reviews WHERE product_id = $product_id")->fetchColumn();
//$recommended_products = $conn->query("SELECT * FROM products WHERE genre_id = {$product['genre_id']} AND id != $product_id LIMIT 5")->fetchAll();
//$reviews = $conn->query("SELECT reviews.*, users.name AS user_name, users.profile_pic AS user_image FROM reviews JOIN users ON reviews.user_id = users.id WHERE product_id = $product_id")->fetchAll();

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
     $select_products = $conn->prepare("SELECT p.*, g.genre_name, c.category_name, mt.media_type_name, i.status, a.artist_name, t.tracklist_url, cr.credit_name, pr.credit_id FROM `products` p 
                                        LEFT JOIN genres g ON p.genre_id = g.id 
                                        LEFT JOIN categories c ON p.category_id = c.id
                                        LEFT JOIN `media_types` mt ON p.media_type_id = mt.id
                                        LEFT JOIN `inventory` i ON p.id = i.product_id
                                        LEFT JOIN `artists` a ON a.artist_id = g.id
                                        LEFT JOIN `media_tracklists` t ON t.tracklist_id = g.id
                                        LEFT JOIN `media_credits` cr ON cr.credit_id = c.id
                                        LEFT JOIN `product_credits` pr ON pr.credit_id = c.id
                                        WHERE p.id = ?");
     $select_products->execute([$pid]);
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
<div class="quick-view">

<!-- Left Section: Album Details -->
<div class="left-section">

   <!-- General Details: Image, Artist, Album Name, Genre, Style, Release Year -->
   <div class="general-details">
      <div class="album-image">
         <img src="../Vinyl-Store/uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
      </div>
      <div class="album-info">
         <h1><?= $fetch_product['name']; ?></h1>
         <h2>by <?= $fetch_product['artist_name']; ?></h2>
         <p><strong>Genre:</strong> <?= $fetch_product['genre_name']; ?></p>
         <p><strong>Style:</strong> <?= implode(", ", array_column($product_styles, 'style_name')); ?></p>
         <p><strong>Year:</strong> <?= $fetch_product['release_date']; ?></p>
      </div>
   </div>

   <!-- Tracklist -->
   <div class="tracklist">
      <h3>Tracklist:</h3>

      <!-- Side A -->
      <table class="tracklist-table">
         <thead>
            <tr>
               <th>#</th>
               <th>Song Title</th>
               <th>Length</th>
            </tr>
         </thead>
         <tbody>
            <?php foreach ($side_a_tracks as $track): ?>
               <tr>
                  <td><?= $track['track_number']; ?></td>
                  <td><?= $track['track_title']; ?></td>
                  <td><?= $track['track_length']; ?></td>
               </tr>
            <?php endforeach; ?>
         </tbody>
      </table>

      <!-- Side B (if available) -->
      <table class="tracklist-table">
         <thead>
            <tr>
               <th>#</th>
               <th>Title</th>
               <th>Length</th>
            </tr>
         </thead>
         <tbody>
            <?php foreach ($side_b_tracks as $track): ?>
               <tr>
                  <td><?= $track['track_number']; ?></td>
                  <td><?= $track['track_title']; ?></td>
                  <td><?= $track['track_length']; ?></td>
               </tr>
            <?php endforeach; ?>
         </tbody>
      </table>
   </div>

   <!-- Credits -->
   <div class="credits">
      <h3>Credits:</h3>
      <ul>
         <?php foreach (array_slice($product_credits, 0, 4) as $credit): ?>
            <li><?= htmlspecialchars($credit['credit_name']) ?> (<?= htmlspecialchars($credit['credit_type']) ?>)</li>
         <?php endforeach; ?>
      </ul>

      <?php if (count($product_credits) > 4): ?>
         <button id="show-more-credits">Show More</button>
         <ul id="extra-credits" style="display: none;">
            <?php foreach (array_slice($product_credits, 4) as $credit): ?>
               <li><?= htmlspecialchars($credit['credit_name']) ?> (<?= htmlspecialchars($credit['credit_type']) ?>)</li>
            <?php endforeach; ?>
         </ul>
      <?php endif; ?>
   </div>

   <!-- Details/Notes -->
   <div class="details">
      <h3>Details/Notes:</h3>
      <p><?= $fetch_product['details']; ?></p>
   </div>
</div>

<!-- Right Section: Quantity, Actions, Stats, Video -->
<div class="right-section">
   <!-- Quantity and Action Buttons -->
   <div class="actions">
      <div class="price">₱<?= $fetch_product['price']; ?>/-</div>
      <input type="number" name="qty" class="qty" min="1" max="99" value="1">
      <button class="btn add-to-cart">Add to Cart</button>
      <button class="btn add-to-wishlist">Add to Wishlist</button>
   </div>

   <!-- Stats -->
   <div class="stats">
      <p><strong>In Collection:</strong> <?= $checkout_count; ?></p>
      <p><strong>Want List:</strong> <?= $wishlist_count; ?></p>
      <p><strong>Avg Rating:</strong> <?= $avg_rating; ?> / 5 (<?= $rating_count; ?> ratings)</p>
   </div>

   <!-- Embedded Youtube -->
   <div class="video">
      <iframe width="100%" height="315" src="https://www.youtube.com/embed/<?= $video_link ?>" frameborder="0"></iframe>
   </div>
</div>
</div>

<!-- Recommendations Section -->
<div class="recommendations">
<h3>Recommendations:</h3>
<div class="swiper">
   <?php foreach ($recommended_products as $recommended): ?>
      <div class="swiper-slide">
         <img src="../Vinyl-Store/uploaded_img/<?= $recommended['image_01']; ?>" alt="">
         <p><?= $recommended['name']; ?></p>
      </div>
   <?php endforeach; ?>
</div>
</div>

<!-- Reviews Section -->
<div class="reviews">
<h3>Reviews:</h3>
<?php foreach ($reviews as $review): ?>
   <div class="review">
      <img src="<?= $review['user_image']; ?>" alt="User Image">
      <div class="review-content">
         <strong><?= $review['user_name']; ?></strong>
         <span><?= $review['review_date']; ?></span>
         <div class="rating"><?= str_repeat('★', $review['rating']); ?> / 5</div>
         <p><?= htmlspecialchars($review['review_text']); ?></p>
      </div>
   </div>
<?php endforeach; ?>
</div>

   <?php
      }
   }else{
      echo '<p class="empty">No Products Found!</p>';
   }
   ?>
</section>

<?php include 'components/footer.php'; ?>

<script>
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

   document.getElementById('show-more-credits').addEventListener('click', function() {
   document.getElementById('extra-credits').style.display = 'block';
   this.style.display = 'none';
});

</script>
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>
