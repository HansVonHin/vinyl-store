<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About Us | Plaka Express</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- Font Awesome CDN Link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Custom CSS File Link -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>

<?php
   // Determine which section to display
   $section = isset($_GET['section']) ? $_GET['section'] : 'about';
?>

<!-- Primary About Page: Our Story and Reviews -->
<?php if ($section == 'about'): ?>
<section class="about">
   <div class="row">
      <div class="image">
         <img src="images/about-img.svg" alt="Our Story">
      </div>
      <div class="content">
         <h3>Our Journey into Vinyl</h3>
         <p>At Plaka Express, our love for vinyl began decades ago when music was experienced in its purest form—on records. Our journey started as a small collection of vintage records and has grown into a thriving community of vinyl enthusiasts. We believe that vinyl records offer an unparalleled listening experience that captures the warmth and authenticity of music as it was meant to be heard.</p>
         <p>Our mission is to bring the joy of vinyl to everyone, whether you're a seasoned collector or just starting your journey. With a carefully curated selection of records, exclusive editions, and a community of like-minded enthusiasts, Plaka Express is more than just a store—it's a celebration of music history.</p>
         <a href="about.php?section=contact" class="btn">Get in Touch</a>
      </div>
   </div>
</section>

<!-- Where We're Located Section -->
<section class="location">
   <div class="content">
      <h3>Where We're Located</h3>
      <p>Plaka Express is situated in the vibrant heart of Quezon City, a place where music and culture blend seamlessly. Our store is a sanctuary for vinyl enthusiasts, offering a diverse selection of records that span genres and generations.</p>
      <p>We invite you to visit us, explore our curated collections, and immerse yourself in the rich soundscapes that only vinyl can provide. Whether you’re a seasoned collector or new to the world of records, our knowledgeable staff is here to guide you on your musical journey.</p>
      <p>Our store is not just a retail space; it’s a community hub where like-minded individuals gather to share their passion for music. Join us for in-store events, exclusive listening sessions, and discover why Plaka Express is the go-to destination for vinyl lovers in the city.</p>
   </div>
   <div class="map-embed">
      <iframe 
         src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d964.9700598001808!2d121.03114946450538!3d14.662737175554316!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b6e1b31457a9%3A0x123349dfa5a8d5b6!2sPlaka%20Express!5e0!3m2!1sen!2sph!4v1725799028784!5m2!1sen!2sph" 
         width="100%" 
         height="350" 
         style="border:0;" 
         allowfullscreen="" 
         loading="lazy"></iframe>
   </div>
   <div class="contact-info">
      <p><strong>Phone:</strong> +123 456 7890</p>
      <p><strong>Email:</strong> contact@plakaexpress.com</p>
      <p><strong>Business Hours:</strong></p>
      <p>Mon-Fri: 10:00 AM - 8:00 PM</p>
      <p>Sat-Sun: 11:00 AM - 6:00 PM</p>
      <a href="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d964.9700598001808!2d121.03114946450538!3d14.662737175554316!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b6e1b31457a9%3A0x123349dfa5a8d5b6!2sPlaka%20Express!5e0!3m2!1sen!2sph!4v1725799028784!5m2!1sen!2sph" target="_blank" class="btn">Get Directions</a>
   </div>
</section>

<section class="reviews">
   
   <h1 class="heading">What Our Customers Say</h1>

   <div class="swiper reviews-slider">

   <div class="swiper-wrapper">

      <div class="swiper-slide slide">
         <img src="images/pic-1.png" alt="Customer Review 1">
         <p>"Plaka Express has an amazing selection of vinyl! The exclusive editions are a must-have for any collector. Their customer service is top-notch too!"</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Jane Doe</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="images/pic-2.png" alt="Customer Review 2">
         <p>"The quality of the records is outstanding, and the staff really know their stuff. It's my go-to place for all things vinyl."</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>John Smith</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="images/pic-3.png" alt="Customer Review 3">
         <p>"I found records here that I thought I'd never get my hands on. The atmosphere and selection make it a must-visit for any music lover."</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Sarah Lee</h3>
      </div>
      <div class="swiper-slide slide">
         <img src="images/pic-4.png" alt="">
         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia tempore distinctio hic, iusto adipisci a rerum nemo perspiciatis fugiat sapiente.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>john deo</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="images/pic-5.png" alt="">
         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia tempore distinctio hic, iusto adipisci a rerum nemo perspiciatis fugiat sapiente.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>john deo</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="images/pic-6.png" alt="">
         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia tempore distinctio hic, iusto adipisci a rerum nemo perspiciatis fugiat sapiente.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>john deo</h3>
      </div>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>

<?php endif; ?>

<!-- Our Story Section -->
<?php if ($section == 'our-story'): ?>
<section class="our-story">

   <div class="row">

      <div class="image">
         <img src="images/about-img.svg" alt="Our Story Image">
      </div>

      <div class="content">
         <h3>Our Story</h3>
         <p>Founded by a group of passionate music lovers, Plaka Express has been serving the vinyl community since 1998. Our mission is to provide a curated selection of records, from the classics that defined generations to the newest releases that push the boundaries of music. We believe in the tangible connection that only vinyl can offer—each crackle, each pop is a piece of history.</p>
         <p>Over the years, we’ve expanded our collection to include rare and exclusive editions, making Plaka Express a go-to destination for collectors and casual listeners alike. But we’re more than just a store—we’re a community. Our space is a haven for those who appreciate the artistry of vinyl, where you can explore, discover, and share your love for music.</p>
         <a href="contact.php" class="btn">Contact Us</a>
      </div>

   </div>

</section>
<?php endif; ?>

<!-- FAQ Section -->
<?php if ($section == 'faq'): ?>
<section class="faq">
   <h1 class="heading">Frequently Asked Questions</h1>
   <div class="faq-container">
      <div class="faq-item">
         <h3>What is Plaka Express?</h3>
         <p>Plaka Express is your one-stop shop for all things vinyl. We specialize in offering a wide range of vinyl records, including new releases, exclusive editions, and classic albums.</p>
      </div>
      <div class="faq-item">
         <h3>How do I place an order?</h3>
         <p>Placing an order is easy! Browse our collection, add your favorite records to your cart, and proceed to checkout. You'll receive a confirmation email with your order details.</p>
      </div>
      <div class="faq-item">
         <h3>What payment methods do you accept?</h3>
         <p>We accept all major credit cards, PayPal, and other secure payment methods.</p>
      </div>
      <div class="faq-item">
         <h3>Can I return or exchange a record?</h3>
         <p>Yes, we have a hassle-free return policy. If you're not satisfied with your purchase, you can return or exchange it within 30 days of receipt.</p>
      </div>
      <!-- Add more FAQ items as needed -->
   </div>
</section>
<?php endif; ?>

<!-- Our Team Section -->
<?php if ($section == 'team'): ?>
<section class="team">
   <h1 class="heading">Meet Our Team</h1>
   <div class="team-container">
      <div class="team-member">
         <img src="images/team-member-1.jpg" alt="Team Member 1">
         <h3>Alex Johnson</h3>
         <p>Founder & CEO</p>
      </div>
      <div class="team-member">
         <img src="images/team-member-2.jpg" alt="Team Member 2">
         <h3>Maria Rodriguez</h3>
         <p>Head of Vinyl Curation</p>
      </div>
      <div class="team-member">
         <img src="images/team-member-3.jpg" alt="Team Member 3">
         <h3>James Lee</h3>
         <p>Customer Experience Manager</p>
      </div>
      <!-- Add more team members as needed -->
   </div>
</section>
<?php endif; ?>

<!-- Contact Us Section -->
<?php if ($section == 'contact'): ?>
<section class="contact">
   <h1 class="heading">Get in Touch</h1>
   <form action="" method="post">
      <input type="text" name="name" placeholder="Enter Your Name" required maxlength="20" class="box">
      <input type="email" name="email" placeholder="Enter Your Email" required maxlength="50" class="box">
      <input type="number" name="number" placeholder="Enter Your Number" required oninput="if(this.value.length > 10) this.value = this.value.slice(0, 10);" class="box">
      <textarea name="msg" class="box" placeholder="Enter Your Message" required cols="30" rows="10"></textarea>
      <input type="submit" value="Send Message" name="send" class="btn">
   </form>
</section>
<?php endif; ?>

<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>

<script>
var swiper = new Swiper(".reviews-slider", {
   loop: true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable: true,
   },
   breakpoints: {
      0: {
         slidesPerView: 1,
      },
      760: {
         slidesPerView: 2,
      },
      990: {
         slidesPerView: 3,
      },
   },
});
</script>

</body>
</html>
