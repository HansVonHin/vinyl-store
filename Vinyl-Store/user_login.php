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
                <input type="email" name="email" placeholder="Enter Your Email" autocomplete="email" class="box" maxlength="50" oninput="this.value=this.value.trim()">
                <div class="password-container">
                    <input type="password" name="pass" required placeholder="Enter Your Password" class="box" maxlength="20" id="password" oninput="this.value=this.value.trim()">
                    <span class="toggle-password" onclick="togglePasswordVisibility()">
                        <i class="fa fa-eye" id="eyeIcon"></i>
                    </span>
                </div>
                
                <!-- Google reCAPTCHA -->
                <div class="g-recaptcha" data-sitekey="your-site-key"></div>

                <input type="submit" value="Login Now" class="btn" name="submit">
                <p>Don't have an account?</p>
                <a href="user_register.php" class="option-btn">Register Now</a>
                 
                <!-- OR separator -->
                <div class="or-separator">
                    <span>OR</span>
                </div>

                <!-- Social login buttons -->
                <div class="social-login">
                    <button class="google-btn">
                        <img src="path-to-google-icon" alt="Google icon" style="width:20px; margin-right:10px;"> Continue with Google
                    </button>
                    <button class="apple-btn">
                        <img src="path-to-apple-icon" alt="Apple icon" style="width:20px; margin-right:10px;"> Continue with Apple
                    </button>
                    <button class="facebook-btn">
                        <img src="path-to-facebook-icon" alt="Facebook icon" style="width:20px; margin-right:10px;"> Continue with Facebook
                    </button>
                    <script>
                    function mockLogin(provider) {
                        alert('Logging in with ' + provider + ' is currently unavailable on localhost. Please try on a live domain.');
                    }
                    </script>
                </div>
            </form>
        </div>
    </section>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
    var emailField = document.querySelector('input[name="email"]');
    var passwordField = document.querySelector('input[name="pass"]');
    var startTime;

    // Track typing speed
    emailField.addEventListener('input', function() {
        var endTime = new Date().getTime();
        if (!startTime) startTime = endTime;

        if (endTime - startTime < 500) {
            triggerReCAPTCHA();
        }
        startTime = endTime;
    });

    // Track copy-paste
    emailField.addEventListener('paste', function() {
        triggerReCAPTCHA();
    });

    passwordField.addEventListener('paste', function() {
        triggerReCAPTCHA();
    });

    // Track time to fill form
    var form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        var now = new Date().getTime();
        if (now - startTime > 120000) { // 2 minutes
            triggerReCAPTCHA();
        }
    });

    function triggerReCAPTCHA() {
        grecaptcha.execute(); // Trigger reCAPTCHA manually
    }
});
</script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
<script>
    var onloadCallback = function() {
        grecaptcha.render('g-recaptcha', {
            'sitekey': 'your-site-key',
            'callback': onSubmit
        });
    };
</script>

</body>
</html>
