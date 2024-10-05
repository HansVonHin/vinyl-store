<?php

include '../Vinyl-Store/components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if (isset($_POST['update_tracklist'])) {
   $platform = $_POST['platform'];
   $platform = filter_var($platform, FILTER_SANITIZE_STRING);
   $tracklist_url = $_POST['tracklist_url'];
   $tracklist_url = filter_var($tracklist_url, FILTER_SANITIZE_URL);
   $tracklist_name = $_POST['tracklist_name'];
   $tracklist_name = filter_var($tracklist_name, FILTER_SANITIZE_STRING);

   $update_tracklist = $conn->prepare("UPDATE `media_tracklists` SET platform = ?, tracklist_url = ?, tracklist_name = ? WHERE tracklist_id = ?");
   $update_tracklist->execute([$platform, $tracklist_url, $tracklist_name, $tracklist_id]);

   $message[] = 'Tracklist Updated Successfully!';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Product</title>
   <link rel="icon" href="images/favicon.ico" type="images/x-icon">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../Vinyl-Store/css/admin_style.css">

</head>
<body>

<?php include '../Vinyl-Store/components/admin_header.php'; ?>

<section class="update-tracklist">
   <h1 class="heading">Update Tracklist</h1>
   <?php
      $update_id = $_GET['update'];
      $select_tracklist = $conn->prepare("SELECT * FROM `media_tracklists` WHERE tracklist_id = ?");
      $select_tracklist->execute([$update_id]);
      if($select_tracklist->rowCount() > 0){
         while($fetch_tracklist = $select_tracklist->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <span>Update Platform</span>
      <select name="platform" class="box">
         <option value="YouTube" <?= $fetch_tracklist['platform'] == 'YouTube' ? 'selected' : ''; ?>>YouTube</option>
         <option value="Spotify" <?= $fetch_tracklist['platform'] == 'Spotify' ? 'selected' : ''; ?>>Spotify</option>
         <option value="AppleMusic" <?= $fetch_tracklist['platform'] == 'AppleMusic' ? 'selected' : ''; ?>>Apple Music</option>
      </select>

      <span>Update Tracklist URL</span>
      <input type="url" name="tracklist_url" class="box" value="<?= $fetch_tracklist['tracklist_url']; ?>">

      <span>Update Tracklist Name</span>
      <input type="text" name="tracklist_name" class="box" value="<?= $fetch_tracklist['tracklist_name']; ?>">

      <div class="flex-btn">
         <input type="submit" class="btn" value="Update Tracklist" name="update_tracklist">
         <a href="media_tracklists.php" class="option-btn">Go Back</a>
      </div>
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">No Tracklists Found!</p>';
      }
   ?>
</section>

<script src="../Vinyl-Store/js/script.js"></script>

</body>
</html>
