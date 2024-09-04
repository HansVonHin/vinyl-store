<header class="header">
   <section class="flex">

      <a href="home.php" class="logo">Plaka<span>Express</span></a>

      <nav class="navbar">
         <section class="navbar nav-2">
            <div id="menu-btn" class="fas fa-bars"></div>

            <div class="menu">
               <ul>
                  <li><a href="home.php">Home</a></li>
                  <li><a href="about.php">About</a></li>
                  <li><a href="orders.php">Orders</a></li>
                  <li><a href="shop.php">Shop</a></li>
                  <li><a href="contact.php">Contact</a></li>
                  <li><a href="#">Categories <i class="fas fa-angle-down"></i></a>
                     <ul>
                        <li><a href="shop.php?category=vinyl">Vinyls</a></li>
                        <li><a href="shop.php?category=exclusive">Exclusives</a></li>
                        <li><a href="shop.php?category=new">New Arrivals</a></li>
                        <li><a href="shop.php?category=merch">Merchandise</a></li>
                     </ul>
                  </li>
               </ul>
            </div>
         </section>
      </nav>

      <div class="icons">
         <a href="search_page.php"><i class="fas fa-search"></i></a>
         <a href="wishlist.php"><i class="fas fa-heart"></i><span>(0)</span></a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(0)</span></a>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <p><?= isset($fetch_profile["name"]) ? $fetch_profile["name"] : "Guest"; ?></p>
         <a href="update_user.php" class="btn">Update Profile</a>
         <div class="flex-btn">
            <a href="user_register.php" class="option-btn">Register</a>
            <a href="user_login.php" class="option-btn">Login</a>
         </div>
         <a href="components/user_logout.php" class="delete-btn" onclick="return confirm('Logout from the website?');">Logout</a> 
         <p>Please login or register first!</p>
         <div class="flex-btn">
            <a href="user_register.php" class="option-btn">Register</a>
            <a href="user_login.php" class="option-btn">Login</a>
         </div>    
      </div>
   </section>
</header>
