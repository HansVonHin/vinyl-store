<?php

include '../Vinyl-Store/components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if (isset($_POST['update_artist'])) {
   $artist_name = $_POST['artist_name'];
   $artist_name = filter_var($artist_name, FILTER_SANITIZE_STRING);
   $bio = $_POST['bio'];
   $bio = filter_var($bio, FILTER_SANITIZE_STRING);
   $image_url = $_POST['image_url'];
   $image_url = filter_var($image_url, FILTER_SANITIZE_URL);

   $update_artist = $conn->prepare("UPDATE `artists` SET artist_name = ?, bio = ?, image_url = ? WHERE artist_id = ?");
   $update_artist->execute([$artist_name, $bio, $image_url, $artist_id]);

   $message[] = 'Artist Updated Successfully!';
}

   // Image handling for image_01
   $old_image_01 = $_POST['old_image'];
   $image_01 = $_FILES['image_url']['artist_name'];
   $image_01 = filter_var($image_url, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image_url']['size'];
   $image_tmp_name_01 = $_FILES['image_url']['tmp_name'];
   $image_folder_01 = '/Vinyl-Store/uploaded_img/'.$image_url;

   if(!empty($image_01)){
      if($image_size_01 > 2000000){
         $message[] = 'Image Size Is Too Large!';
      }else{
         $update_image_01 = $conn->prepare("UPDATE `artists` SET image_url = ? WHERE artist_id = ?");
         $update_image_01->execute([$image_url, $artist_id]);
         move_uploaded_file($image_tmp_name_01, $image_folder_01);
         unlink('/Vinyl-Store/uploaded_img/'.$old_image_01);
         $message[] = '1st Image Updated Successfully!';
      }
   }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Artist</title>
   <link rel="icon" href="../Vinyl-Store/images/favicon.ico" type="images/x-icon">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../Vinyl-Store/css/admin_style.css">

</head>
<body>

<?php include '../Vinyl-Store/components/admin_header.php'; ?>

<section class="update-artist">
   <h1 class="heading">Update Artist</h1>
   <?php
      $update_id = $_GET['update'];
      $select_artist = $conn->prepare("SELECT * FROM `artists` WHERE artist_id = ?");
      $select_artist->execute([$update_id]);
      if($select_artist->rowCount() > 0){
         while($fetch_artist = $select_artist->fetch(PDO::FETCH_ASSOC)){ 
   ?>

   <form action="" method="post" enctype="multipart/form-data">
   <input type="hidden" name="artist_id" value="<?= $fetch_artists['artist_id']; ?>">
   <input type="hidden" name="old_image_01" value="<?= $fetch_artists['image_url']; ?>">

      <!-- Display images -->
      <div class="image-container">
         <div class="main-image">
            <img src="../Vinyl-Store/uploaded_img/<?= $fetch_artists['image_url']; ?>" alt="">
         </div>
      </div>
      <span>Update Artist Name</span>
      <input type="text" name="artist_name" required class="box" maxlength="100" value="<?= $fetch_artist['artist_name']; ?>">

      <span>Update Bio</span>
      <textarea name="bio" class="box" required cols="30" rows="10"><?= $fetch_artist['bio']; ?></textarea>

      <span>Update Image URL</span>
      <input type="url" name="image_url" class="box" value="<?= $fetch_artist['image_url']; ?>">

      <div class="flex-btn">
         <input type="submit" class="btn" value="Update Artist" name="update_artist">
         <a href="artists.php" class="option-btn">Go Back</a>
      </div>
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">No Artists Found!</p>';
      }
   ?>
</section>


<script src="../Vinyl-Store/js/script.js"></script>

</body>
</html>