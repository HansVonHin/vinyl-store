<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
}

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $username = $_POST['username'];
   $username = filter_var($username, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   // For profile pic, we will store the file path
   if(isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
      $profile_pic = 'uploads/' . basename($_FILES['profile_pic']['name']);
      move_uploaded_file($_FILES['profile_pic']['tmp_name'], $profile_pic);
   } else {
      $profile_pic = 'uploads/default-profile.png'; // Fallback in case no file is uploaded
   }

   // reCAPTCHA Validation
   $recaptchaSecret = 'YOUR_SECRET_KEY_HERE';
   $recaptchaResponse = $_POST['g-recaptcha-response'];
   $recaptchaVerifyUrl = 'https://www.google.com/recaptcha/api/siteverify';
   $response = file_get_contents($recaptchaVerifyUrl . '?secret=' . $recaptchaSecret . '&response=' . $recaptchaResponse);
   $responseKeys = json_decode($response, true);

   if(intval($responseKeys["success"]) !== 1) {
      $message[] = 'Please complete the reCAPTCHA!';
   } else {
      $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? OR username = ?");
      $select_user->execute([$email, $username]);
      $row = $select_user->fetch(PDO::FETCH_ASSOC);

      if($select_user->rowCount() > 0){
         $message[] = 'Email or Username Already Exists!';
      } else {
         if($pass != $cpass){
            $message[] = 'Confirm Password Not Matched!';
         } else {
            $created_at = date('Y-m-d H:i:s');
            $insert_user = $conn->prepare("INSERT INTO `users`(name, username, email, password, profile_pic, created_at, updated_at) VALUES(?,?,?,?,?,?,?)");
            $insert_user->execute([$name, $username, $email, $cpass, $profile_pic, $created_at, $created_at]);
            $message[] = 'Registered Successfully!';
         }
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
   <title>Plaka Express - Register</title>
   <link rel="icon" href="images/favicon.ico" type="images/x-icon">
   <!-- Font Awesome and reCAPTCHA -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <script src="https://www.google.com/recaptcha/api.js" async defer></script>

   <!-- Custom CSS -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
<section class="login-container">
   <div class="back-to-home">
      <a href="home.php" class="option-btn">← Back to Home</a>
   </div>
   
   <div class="image-container">
      <img src="images/login-banner.jpg" alt="Register Branding">
   </div>

   <section class="form-container">
      <form action="" method="post" enctype="multipart/form-data">
         <h3>Create Your Account</h3>
         <input type="text" name="name" required placeholder="Enter Your Full Name" maxlength="20" class="box">
         <input type="text" name="username" required placeholder="Choose a Username" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="email" name="email" required placeholder="Enter Your Email" maxlength="50" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="password" name="pass" required placeholder="Enter Your Password" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="password" name="cpass" required placeholder="Confirm Your Password" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')">

         <!-- Profile Picture Input -->
         <input type="file" name="profile_pic" accept="image/*" class="box" placeholder="Upload Profile Picture">
         
         <!-- Google reCAPTCHA -->
         <div class="g-recaptcha" data-sitekey="your-site-key"></div>

         <input type="submit" value="Register Now" class="btn" name="submit">
         <p>Already Have An Account?</p>
         <a href="user_login.php" class="option-btn">Login Now</a>
      </form>

      <?php
         if(isset($message)){
            foreach($message as $message){
               echo '<div class="message">'.$message.'</div>';
            }
         }
      ?>
   </section>
</section>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>
