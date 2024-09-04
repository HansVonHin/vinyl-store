<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Plaka Express - Shop</title>
   
   <!-- Font Awesome CDN Link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Custom CSS File Link -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="products">

   <h1 class="heading">Browse Our Vinyl Collection</h1>

   <div class="product-box-container">

      <!-- Example of a product item -->
      <div class="product-box">
         <img src="images/product-placeholder.png" alt="Vinyl Record">
         <h3>Album Name</h3>
         <p>$Price</p>
         <a href="#" class="btn">Add to Cart</a>
      </div>

      <!-- Repeat similar blocks for other products -->

   </div>

</section>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
