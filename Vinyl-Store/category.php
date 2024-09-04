<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Plaka Express - Category</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- Font Awesome CDN Link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Custom CSS File Link -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="category">
   <h1 class="heading">Category: <?php // echo $_GET['category']; ?></h1>

   <div class="products-container">
      <div class="products-grid">

         <!-- Example of a product item -->
         <div class="product-box">
            <img src="images/product-placeholder.png" alt="Product">
            <h3>Product Name</h3>
            <p>$Price</p>
            <a href="#" class="btn">Buy Now</a>
         </div>

         <!-- Repeat similar blocks for other products -->

      </div>
   </div>
</section>

<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>
