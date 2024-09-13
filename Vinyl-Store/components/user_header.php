<header class="header">
   <!-- Top Section: Logo -->
   <section class="top-section">
      <a href="home.php" class="logo-image">
         <img src="images/logo.png" alt="Plaka Express Logo">
      </a>
   </section>

   <!-- Middle Section: Brand Name -->
   <!--<section class="brand-section">
      <a href="home.php" class="brand-name">Plaka<span>Express</span></a>
      <p>www.plakaexpress.com</p>

   </section>-->

   <!-- Bottom Section: Navbar, Search Bar, and Icons -->
   <section class="flex">
      <nav class="navbar">
         <section class="navbar nav-2">
            <div id="menu-btn"></div>
            <div class="menu">
               <ul>
                  <li><a href="home.php">Home</a></li>
                  <li><a href="about.php">About <i class="fas fa-angle-down"></i></a>
                     <ul>
                        <li><a href="about.php?section=our-story">Our Story</a></li>
                        <li><a href="about.php?section=faq">FAQ</a></li>
                        <li><a href="about.php?section=team">Our Team</a></li>
                        <li><a href="about.php?section=contact">Contact Us</a></li>
                     </ul>
                  </li>
                  <li><a href="shop.php">Shop</a></li>
                  <?php if (isset($user_id)) { ?>
                     <li><a href="orders.php">Orders</a></li>
                  <?php } else { ?>
                     <li><a href="user_login.php">Orders</a></li>
                  <?php } ?>
                  <li><a href="category.php">Categories <i class="fas fa-angle-down"></i></a>
                     <ul>
                        <li><a href="shop.php?category=vinyl-genres">Vinyl Genres</a></li>
                        <li><a href="shop.php?category=vinyl-accessories">Vinyl Accessories</a></li>
                        <li><a href="shop.php?category=cds-&-dvds">CDs & DVDs</a></li>
                        <li><a href="shop.php?category=cassette-tapes">Cassette Tapes</a></li>
                        <li><a href="shop.php?category=turntables">Turntables</a></li>
                        <li><a href="shop.php?category=vinyl-sizes">Vinyl Sizes</a></li>
                     </ul>
                  </li>
               </ul>
            </div>
         </section>
      </nav>

      <!-- Search Form -->
      <div class="search">
         <form action="search_page.php" method="post" class="search-bar">
         <input type="text" name="search_box" placeholder="Search here..." maxlength="100" required>
         <button type="submit" class="fas fa-search" name="search_btn"></button>
         </form>
      </div>

      <div class="icons">
         <a href="wishlist.php"><i class="fas fa-heart"></i><span></span></a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span></span></a>
         <div id="user-btn" class="fas fa-user"><span></span></div>
      </div>

      <div class="profile">
         <p><?= isset($fetch_profile["name"]) ? $fetch_profile["name"] : "Guest"; ?></p>
         <?php if (isset($user_id)) { ?>
            <a href="update_user.php" class="btn">Update Profile</a>
            <a href="components/user_logout.php" class="delete-btn" onclick="return confirm('Logout from the website?');">Logout</a> 
         <?php } else { ?>
            <p>Please Login or Register First!</p>
            <div class="flex-btn">
               <a href="user_register.php" class="option-btn">Register</a>
               <a href="user_login.php" class="option-btn">Login</a>
            </div>
         <?php } ?>
      </div>

   </section>
</header>
