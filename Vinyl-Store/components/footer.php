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
         <h3>Contact Us</h3>
         <a href="tel:+12345678999"><i class="fas fa-phone"></i> 0639406858 </a>
         <a href="tel:+1112223333"><i class="fas fa-phone"></i> +632 940-6858</a>
         <a href="mailto:info@vinylstore.com"><i class="fas fa-envelope"></i> Info@plakaexpress.com</a>
      </div>

      <!-- Middle part: Quick Links and Extra Links -->
      <div class="box">
         <div class="links-column">
            <h3>Quick Links</h3>
            <a href="home.php"> <i class="fas fa-angle-right"></i> Home</a>
            <a href="shop.php"> <i class="fas fa-angle-right"></i> Shop</a>
            <a href="categories.php"> <i class="fas fa-angle-right"></i> Categories</a>
         </div>
         <br>
         <div class="links-column">
            <h3>Help</h3>
            <a href="about.php"> <i class="fas fa-angle-right"></i> About Us</a>
            <a href="contact.php"> <i class="fas fa-angle-right"></i>Contact Us</a>
            <a href="about.php?section=faq"> <i class="fas fa-angle-right"></i>FAQ</a>
         </div>
      </div>

      <!-- Right-most part: Google Maps and Newsletter Signup -->
      <div class="box">
            <div class="map-embed">
               <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d964.9700598001808!2d121.03114946450538!3d14.662737175554316!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b6e1b31457a9%3A0x123349dfa5a8d5b6!2sPlaka%20Express!5e0!3m2!1sen!2sph!4v1725799028784!5m2!1sen!2sph" width="300" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" width="300" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <br> <a href="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d964.9700598001808!2d121.03114946450538!3d14.662737175554316!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b6e1b31457a9%3A0x123349dfa5a8d5b6!2sPlaka%20Express!5e0!3m2!1sen!2sph!4v1725799028784!5m2!1sen!2sph"><i class="fas fa-map-marker-alt"></i> 50 Palawan Street, Lungsod Quezon, 1105 Kalakhang Maynila </a>
               <div class="newsletter">
                  <h3>Sign Up for Our Newsletter</h3>
                     <form action="subscribe.php" method="post">
                  <input type="email" name="email" placeholder="Enter your Email..." required>
               <button type="submit"><i class="fas fa-paper-plane"></i> Subscribe</button>
            </form>
         </div>
      </div>

   </section>

   <div class="credit">&copy; <?= date('Y'); ?> by <span>Plaka Express</span> | All rights reserved!</div>

</footer>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>