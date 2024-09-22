<?php
include 'components/connect.php';
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

if(isset($_POST['submit'])){
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   // Validate reCAPTCHA
   $recaptchaSecret = 'YOUR_SECRET_KEY_HERE';
   $recaptchaResponse = $_POST['g-recaptcha-response'];
   $recaptchaVerifyUrl = 'https://www.google.com/recaptcha/api/siteverify';

   // Make request to Google reCAPTCHA API
   $response = file_get_contents($recaptchaVerifyUrl . '?secret=' . $recaptchaSecret . '&response=' . $recaptchaResponse);
   $responseKeys = json_decode($response, true);

   if(intval($responseKeys["success"]) !== 1) {
      $message[] = 'Please complete the reCAPTCHA!';
   } else {
      // Proceed with login if reCAPTCHA is successful
      $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
      $select_user->execute([$email, $pass]);
      $row = $select_user->fetch(PDO::FETCH_ASSOC);

      if($select_user->rowCount() > 0){
         $_SESSION['user_id'] = $row['id'];
         header('location:home.php');
      }else{
         $message[] = 'Incorrect Username Or Password!';
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
    <title>Plaka Express - Login</title>
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
            <!-- This section could have an image or branding -->
            <img src="images/login-banner.jpg" alt="Branding Image">
        </div>

        <div class="form-container">
            <form action="" method="post">
                <h3>Login Now</h3>
                <input type="email" name="email" required placeholder="Enter Your Email" class="box" maxlength="50" oninput="this.value=this.value.trim()">
                <input type="password" name="pass" required placeholder="Enter Your Password" class="box" maxlength="20" oninput="this.value=this.value.trim()">

                <!-- Google reCAPTCHA -->
                <div class="g-recaptcha" data-sitekey="your-site-key"></div>

                <input type="submit" value="Login Now" class="btn" name="submit">
                <p>Don't have an account?</p>
                <a href="user_register.php" class="option-btn">Register Now</a>
            </form>
        </div>
    </section>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>
