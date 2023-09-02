<div class="sidebar-module-container custom-account-sidebar-active">
   <div class="sidebar-widget  outer-bottom-small outer-top-vs outer-top-n">
      <h3 class="section-title" style="font-size: 18px;">Account</h3>
      <div class="sidebar-widget-body outer-top-xs custom-account-sidebar">
         <h5><a href="<?php echo $base_url;?>account-dashboard" <?php if($current_page == 'account-dashboard.php'){ echo 'class="active"';} ?> >Account Dashboard</a></h5>
         <h5><a href="<?php echo $base_url;?>account-information" <?php if($current_page == 'account-information.php'){ echo 'class="active"';} ?>>Account Information</a></h5>
         <h5><a href="<?php echo $base_url;?>edit-password" <?php if($current_page == 'edit-password.php'){ echo 'class="active"';} ?>>Change Password</a></h5>
         <!-- <h5><a href="<?php //echo $base_url;?>address-book" <?php //if($current_page == 'address-book.php'){ echo 'class="active"';} ?>>Address Book</a></h5> -->
         <h5><a href="<?php echo $base_url;?>my-wishlist" <?php if($current_page == 'my-wishlist.php'){ echo 'class="active"';} ?>>Wish List</a></h5>
         <h5><a href="<?php echo $base_url;?>my-order" <?php if($current_page == 'my-order.php'){ echo 'class="active"';} ?>>Order History</a></h5>
         <!-- <h5><a href="<?php //echo $base_url;?>newsletter-subscription.php" <?php //if($current_page == 'newsletter-subscription'){ echo 'class="active"';} ?>>Newsletter</a></h5> -->
         <h5><a href="<?php echo $base_url;?>logout">Logout</a></h5>
      </div>
   </div>
</div>