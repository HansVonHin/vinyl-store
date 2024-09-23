<?php

include '../Vinyl-Store/components/connect.php';

session_start();

if(isset($_POST['submit'])){
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   // Validate reCAPTCHA
   //$recaptchaSecret = 'YOUR_SECRET_KEY_HERE';
   //$recaptchaResponse = $_POST['g-recaptcha-response'];
   //$recaptchaVerifyUrl = 'https://www.google.com/recaptcha/api/siteverify';

   // Make request to Google reCAPTCHA API
   //$response = file_get_contents($recaptchaVerifyUrl . '?secret=' . $recaptchaSecret . '&response=' . $recaptchaResponse);
   //$responseKeys = json_decode($response, true);

   //if(intval($responseKeys["success"]) !== 1) {
      //$message[] = 'Please complete the reCAPTCHA!';
   //} else {
      // Proceed with login if reCAPTCHA is successful
      $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ? AND password = ?");
      $select_admin->execute([$name, $pass]);
      $row = $select_admin->fetch(PDO::FETCH_ASSOC);

      if($select_admin->rowCount() > 0){
         $_SESSION['admin_id'] = $row['id'];
         header('location:dashboard.php');
      }else{
         $message[] = 'Incorrect Username Or Password!';
      }
   }
//}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Plaka Express - Login</title>
   <link rel="icon" href="images/favicon.ico" type="images/x-icon">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <script src="https://www.google.com/recaptcha/api.js" async defer></script>
   <link rel="stylesheet" href="../Vinyl-Store/css/admin_style.css">

</head>
<body>

<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

<section class="form-container">

   <form action="" method="post">
      <h3>Login Now</h3>
      <p>Default Username = <span>Admin</span> & Password = <span>111</span></p>
      <input type="text" name="name" required placeholder="Enter Your Username" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="Enter Your Password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      
      <!-- Google reCAPTCHA widget 
      <div class="g-recaptcha" data-sitekey="YOUR_SITE_KEY_HERE"></div>-->

      <input type="submit" value="login now" class="btn" name="submit">
   </form>

</section>
   
</body>
</html>