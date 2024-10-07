<?php

include '../Vinyl-Store/components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['update'])){

   $pid = $_POST['pid'];
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);
   $vinyl_size = $_POST['vinyl_size'];
   $vinyl_size = filter_var($vinyl_size, FILTER_SANITIZE_STRING);
   $release_date = $_POST['release_date'];
   $release_date = filter_var($release_date, FILTER_SANITIZE_STRING);
   $inventory_status = $_POST['inventory_status'];
   $inventory_status = filter_var($inventory_status, FILTER_SANITIZE_STRING);
   $quantity = $_POST['quantity'];
   $quantity = filter_var($quantity, FILTER_SANITIZE_NUMBER_INT);

   $update_product = $conn->prepare("UPDATE `products` SET name = ?, price = ?, details = ?, vinyl_size = ?, release_date = ?, inventory_status = ?, quantity = ? WHERE id = ?");
   $update_product->execute([$name, $price, $details, $vinyl_size, $release_date, $inventory_status, $quantity, $pid]);

   $message[] = 'Product Updated Successfully!';

   // Image handling for image_01
   $old_image_01 = $_POST['old_image_01'];
   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = '/Vinyl-Store/uploaded_img/'.$image_01;

   if(!empty($image_01)){
      if($image_size_01 > 2000000){
         $message[] = 'Image Size Is Too Large!';
      }else{
         $update_image_01 = $conn->prepare("UPDATE `products` SET image_01 = ? WHERE id = ?");
         $update_image_01->execute([$image_01, $pid]);
         move_uploaded_file($image_tmp_name_01, $image_folder_01);
         unlink('/Vinyl-Store/uploaded_img/'.$old_image_01);
         $message[] = '1st Image Updated Successfully!';
      }
   }

   // Image handling for image_02
   $old_image_02 = $_POST['old_image_02'];
   $image_02 = $_FILES['image_02']['name'];
   $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
   $image_size_02 = $_FILES['image_02']['size'];
   $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
   $image_folder_02 = '/Vinyl-Store/uploaded_img/'.$image_02;

   if(!empty($image_02)){
      if($image_size_02 > 2000000){
         $message[] = 'Image Size Is Too Large!';
      }else{
         $update_image_02 = $conn->prepare("UPDATE `products` SET image_02 = ? WHERE id = ?");
         $update_image_02->execute([$image_02, $pid]);
         move_uploaded_file($image_tmp_name_02, $image_folder_02);
         unlink('/Vinyl-Store/uploaded_img/'.$old_image_02);
         $message[] = '2nd Image Updated Successfully!';
      }
   }

   // Image handling for image_03
   $old_image_03 = $_POST['old_image_03'];
   $image_03 = $_FILES['image_03']['name'];
   $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
   $image_size_03 = $_FILES['image_03']['size'];
   $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
   $image_folder_03 = '/Vinyl-Store/uploaded_img/'.$image_03;

   if(!empty($image_03)){
      if($image_size_03 > 2000000){
         $message[] = 'Image Size Is Too Large!';
      }else{
         $update_image_03 = $conn->prepare("UPDATE `products` SET image_03 = ? WHERE id = ?");
         $update_image_03->execute([$image_03, $pid]);
         move_uploaded_file($image_tmp_name_03, $image_folder_03);
         unlink('/Vinyl-Store/uploaded_img/'.$old_image_03);
         $message[] = '3rd Image Updated Successfully!';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Product</title>
   <link rel="icon" href="../Vinyl-Store/images/favicon.ico" type="images/x-icon">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../Vinyl-Store/css/admin_style.css">

</head>
<body>

<?php include '../Vinyl-Store/components/admin_header.php'; ?>

<section class="update-product">

   <h1 class="heading">Update Product</h1>

   <?php
      $update_id = $_GET['update'];
      $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
      $select_products->execute([$update_id]);
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <input type="hidden" name="old_image_01" value="<?= $fetch_products['image_01']; ?>">
      <input type="hidden" name="old_image_02" value="<?= $fetch_products['image_02']; ?>">
      <input type="hidden" name="old_image_03" value="<?= $fetch_products['image_03']; ?>">
      
      <!-- Display images -->
      <div class="image-container">
         <div class="main-image">
            <img src="../Vinyl-Store/uploaded_img/<?= $fetch_products['image_01']; ?>" alt="">
         </div>
         <div class="sub-image">
            <img src="../Vinyl-Store/uploaded_img/<?= $fetch_products['image_01']; ?>" alt="">
            <img src="../Vinyl-Store/uploaded_img/<?= $fetch_products['image_02']; ?>" alt="">
            <img src="../Vinyl-Store/uploaded_img/<?= $fetch_products['image_03']; ?>" alt="">
         </div>
      </div>

      <!-- Form fields for update -->
      <span>Update Name</span>
      <input type="text" name="name" required class="box" maxlength="100" placeholder="Enter Product Name" value="<?= $fetch_products['name']; ?>">

      <span>Update Price</span>
      <input type="number" name="price" required class="box" min="0" max="9999999999" placeholder="Enter Product Price" value="<?= $fetch_products['price']; ?>">

      <span>Update Details</span>
      <textarea name="details" class="box" required cols="30" rows="10"><?= $fetch_products['details']; ?></textarea>

      <?php if (isset($fetch_products['vinyl_size'])): ?>
      <span>Update Vinyl Size</span>
      <input type="text" name="vinyl_size" class="box" value="<?= $fetch_products['vinyl_size']; ?>">
      <?php endif; ?>

      <span>Update Release Date</span>
      <input type="date" name="release_date" class="box" value="<?= $fetch_products['release_date']; ?>">

      <span>Update Inventory Status</span>
      <input type="text" name="inventory_status" class="box" value="<?= $fetch_products['inventory_status']; ?>">

      <span>Update Quantity</span>
      <input type="number" name="quantity" class="box" value="<?= $fetch_products['quantity']; ?>">

      <span>Update 1st Image</span>
      <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png" class="box">

      <span>Update 2nd Image</span>
      <input type="file" name="image_02" accept="image/jpg, image/jpeg, image/png" class="box">

      <span>Update 3rd Image</span>
      <input type="file" name="image_03" accept="image/jpg, image/jpeg, image/png" class="box">

      <div class="flex-btn">
         <input type="submit" class="btn" value="Update Product" name="update">
         <a href="products.php" class="option-btn">Go Back</a>
      </div>
   </form>

   <?php
         }
      }else{
         echo '<p class="empty">No Products Found!</p>';
      }
   ?>

</section>

<script src="../Vinyl-Store/js/script.js"></script>

</body>
</html>
