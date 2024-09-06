<footer class="footer">

   <section class="grid">

      <!-- Left-most part: Logo/Brand and Social Media -->
      <div class="box">
         <img src="images/logo.png" alt="Plaka Express Logo" class="footer-logo">  <!-- Adjust the path as needed -->
         <div class="social-links">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin"></i></a>
         </div>
      </div>

      <!-- Middle part: Quick Links and Extra Links -->
      <div class="box">
         <div class="links-column">
            <h3>Quick Links</h3>
            <a href="home.php"> <i class="fas fa-angle-right"></i> Home</a>
            <a href="about.php"> <i class="fas fa-angle-right"></i> About</a>
            <a href="shop.php"> <i class="fas fa-angle-right"></i> Shop</a>
            <a href="contact.php"> <i class="fas fa-angle-right"></i> Contact</a>
         </div>
         <div class="links-column">
            <h3>Extra Links</h3>
            <a href="user_login.php"> <i class="fas fa-angle-right"></i> Login</a>
            <a href="user_register.php"> <i class="fas fa-angle-right"></i> Register</a>
            <a href="cart.php"> <i class="fas fa-angle-right"></i> Cart</a>
            <a href="orders.php"> <i class="fas fa-angle-right"></i> Orders</a>
         </div>
      </div>

      <!-- Right-most part: Contact Us and Newsletter Signup -->
      <div class="box">
         <h3>Contact Us</h3>
         <a href="tel:+12345678999"><i class="fas fa-phone"></i> +123 456 7899</a>
         <a href="tel:+1112223333"><i class="fas fa-phone"></i> +111 222 3333</a>
         <a href="mailto:info@vinylstore.com"><i class="fas fa-envelope"></i> info@vinylstore.com</a>
         <a href="https://www.google.com/maps"><i class="fas fa-map-marker-alt"></i> Timog Avenue, Diliman, Quezon City - 1444 </a>

         <div class="newsletter">
            <h3>Sign Up for Our Newsletter</h3>
            <form action="subscribe.php" method="post">
               <input type="email" name="email" placeholder="Enter your email" required>
               <button type="submit"><i class="fas fa-paper-plane"></i> Subscribe</button>
            </form>
         </div>
      </div>

   </section>

   <div class="credit">&copy; <?= date('Y'); ?> by <span>Plaka Express</span> | All rights reserved!</div>

</footer>
