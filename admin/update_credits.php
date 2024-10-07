<?php

include '../Vinyl-Store/components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if (isset($_POST['update_credit'])) {
   $credit_name = $_POST['credit_name'];
   $credit_name = filter_var($credit_name, FILTER_SANITIZE_STRING);
   $credit_type = $_POST['credit_type'];
   $credit_type = filter_var($credit_type, FILTER_SANITIZE_STRING);
   $image_url = $_POST['image_url'];
   $image_url = filter_var($image_url, FILTER_SANITIZE_URL);

   $update_credit = $conn->prepare("UPDATE `media_credits` SET credit_name = ?, credit_type = ?, image_url = ? WHERE credit_id = ?");
   $update_credit->execute([$credit_name, $credit_type, $image_url, $credit_id]);

   $message[] = 'Credit Updated Successfully!';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Credits</title>
   <link rel="icon" href="../Vinyl-Store/images/favicon.ico" type="images/x-icon">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../Vinyl-Store/css/admin_style.css">

</head>
<body>

<?php include '../Vinyl-Store/components/admin_header.php'; ?>

<section class="update-credit">
   <h1 class="heading">Update Media Credit</h1>
   <?php
      $update_id = $_GET['update'];
      $select_credit = $conn->prepare("SELECT * FROM `media_credits` WHERE credit_id = ?");
      $select_credit->execute([$update_id]);
      if($select_credit->rowCount() > 0){
         while($fetch_credit = $select_credit->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <span>Update Credit Name</span>
      <input type="text" name="credit_name" required class="box" maxlength="100" value="<?= $fetch_credit['credit_name']; ?>">

      <span>Update Credit Type</span>
      <select name="credit_type" class="box">
         <option value="songwriter" <?= $fetch_credit['credit_type'] == 'songwriter' ? 'selected' : ''; ?>>Songwriter</option>
         <option value="producer" <?= $fetch_credit['credit_type'] == 'producer' ? 'selected' : ''; ?>>Producer</option>
      </select>

      <span>Update Image URL</span>
      <input type="url" name="image_url" class="box" value="<?= $fetch_credit['image_url']; ?>">

      <div class="flex-btn">
         <input type="submit" class="btn" value="Update Credit" name="update_credit">
         <a href="media_credits.php" class="option-btn">Go Back</a>
      </div>
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">No Credits Found!</p>';
      }
   ?>
</section>

<script src="../Vinyl-Store/js/script.js"></script>

</body>
</html>
