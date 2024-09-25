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

<header class="header">

   <section class="flex">

      <!-- Left sidebar -->
      <div class="sidebar">
         <a href="../admin/dashboard.php" class="logo">
            <i class="fas fa-store"></i>
            <span>Plaka Express</span>
         </a>
         <ul class="navbar">
            <li><a href="../admin/dashboard.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
            <li class="client-facing">
               <span>Client Facing</span>
               <ul class="submenu">
                  <li><a href="../admin/products.php"><i class="fas fa-box-open"></i><span>Products</span></a></li>
                  <li><a href="../admin/users_accounts.php"><i class="fas fa-users"></i><span>Customers</span></a></li>
                  <li><a href="../admin/placed_orders.php"><i class="fas fa-shopping-cart"></i><span>Transactions</span></a></li>
                  <li><a href="../admin/messages.php"><i class="fas fa-comments"></i><span>Messages</span></a></li>
                  <li><a href="../admin/geography.php"><i class="fas fa-globe"></i><span>Geography</span></a></li>
               </ul>
            </li>
            <li class="sales">
               <span>Sales</span>
               <ul class="submenu">
                  <li><a href="../admin/overview.php"><i class="fas fa-chart-line"></i><span>Overview</span></a></li>
                  <li><a href="../admin/daily.php"><i class="fas fa-calendar-day"></i><span>Daily</span></a></li>
                  <li><a href="../admin/monthly.php"><i class="fas fa-calendar-alt"></i><span>Monthly</span></a></li>
                  <li><a href="../admin/breakdown.php"><i class="fas fa-chart-pie"></i><span>Breakdown</span></a></li>
               </ul>
            </li>
            <li class="management">
               <span>Management</span>
               <ul class="submenu">
                  <li><a href="../admin/admin_accounts.php"><i class="fas fa-user-shield"></i><span>Admins</span></a></li>
                  <li><a href="#"><i class="fas fa-tasks"></i><span>Performance</span></a></li>
               </ul>
            </li>
         </ul>
         
         <!-- Profile section at the bottom -->
         <div class="profile-sidebar">
            <?php
               $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
               $select_profile->execute([$admin_id]);
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>
            <div class="profile-picture">
               <img src="Vinyl-Store/images/pic.jpg" alt="Admin Picture">
            </div>
            <p><?= $fetch_profile['name']; ?></p>
            <span><?= $fetch_profile['position']; ?></span>
            <i class="fa fa-cog" id="sidebar-settings"></i> <!-- Gear icon -->
            <div class="profile-dropdown">
            <a href="admin/update_profile.php" class="btn">Update Profile</a>
            <a href="Vinyl-Store/components/admin_logout.php" class="delete-btn" onclick="return confirm('Logout From The Website?');">Logout</a>
         </div>
      </div>

      <!-- Top Navbar -->
      <div class="top-navbar">
         <div class="icons">
            <i id="menu-btn" class="fas fa-bars"></i>
            <div class="search-bar">
               <input type="text" placeholder="Search...">
               <button type="submit"><i class="fas fa-search"></i></button>
            </div>
            <div class="profile-top">
               <i class="fa fa-cog" id="profile-settings"></i>
               <img src="Vinyl-Store/images/pic.jpg" alt="Admin Picture">
               <span><?= $fetch_profile['name']; ?> | <?= $fetch_profile['position']; ?></span>
               <i class="fas fa-chevron-down"></i>
            </div>
         </div>
      </div>
      
   </section>

</header>

<script src="../Vinyl-Store/js/admin_script.js"></script>