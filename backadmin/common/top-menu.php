
<!-- Second navbar -->
<div class="navbar navbar-default" id="navbar-second">
    <ul class="nav navbar-nav no-border visible-xs-block">
        <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-menu7"></i></a></li>
    </ul>

    <div class="navbar-collapse collapse" id="navbar-second-toggle">
        <ul class="nav navbar-nav">
            <li><a href="<?php echo $base_url; ?>index"><i class="icon-home position-left"></i> Dashboard</a></li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
                    <i class="icon-pie5 position-left"></i> Master Module <span class="caret"></span>
                </a>
                <ul class="dropdown-menu width-250">
                    <li><a href="<?php echo $base_url; ?>settings"><i class="icon-play4"></i>Company Info</a></li>
                    <li><a href="<?php echo $base_url; ?>view-country"><i class="icon-play4"></i>Country Master</a></li>
                    <li><a href="<?php echo $base_url; ?>view-state"><i class="icon-play4"></i>State Master</a></li>
                    <li><a href="<?php echo $base_url; ?>view-city"><i class="icon-play4"></i>City Master</a></li>
                    <li><a href="<?php echo $base_url; ?>view-area"><i class="icon-play4"></i>Area Master</a></li>
                    <li><a href="<?php echo $base_url; ?>view-menu"><i class="icon-play4"></i>Menu Master</a></li>
                    <li><a href="<?php echo $base_url; ?>view-menu-images"><i class="icon-play4"></i>Menu Image Master</a></li>
                    <li><a href="<?php echo $base_url; ?>view-unit"><i class="icon-play4"></i>Unit Master</a></li>
                   
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
                    <i class="icon-pie5 position-left"></i>Product Master<span class="caret"></span>
                </a>
                <ul class="dropdown-menu width-250">
                    <li><a href="<?php echo $base_url; ?>view-category"><i class="icon-play4"></i> Category</a></li>
                    <li><a href="<?php echo $base_url; ?>view-sub-category"><i class="icon-play4"></i> Sub Category</a></li>
                    <li><a href="<?php echo $base_url; ?>view-sub-sub-category"><i class="icon-play4"></i> Sub Sub Category</a></li>
                    <li><a href="<?php echo $base_url; ?>view-product"><i class="icon-play4"></i>Product</a></li>
                     <li><a href="<?php echo $base_url; ?>view-product-images"><i class="icon-play4"></i>Product Images</a></li>
                   
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
                    <i class="icon-cogs position-left"></i> Manage Orders <span class="caret"></span>
                </a>
                <ul class="dropdown-menu width-200">
                    <li><a href="<?php echo $base_url; ?>new-orders"><i class="icon-play4"></i>New Orders</a></li>
                    <li><a href="<?php echo $base_url; ?>return-orders"><i class="icon-play4"></i>Returned Orders</a></li>
                    <li><a href="<?php echo $base_url; ?>cancelled-orders"><i class="icon-play4"></i>Cancelled/Rejected Orders</a></li>
                 </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
                    <i class="icon-cogs position-left"></i> Manage Pages <span class="caret"></span>
                </a>
                <ul class="dropdown-menu width-200">
                   <li><a href="<?php echo $base_url; ?>cms-page"><i class="icon-play4"></i>CMS Page</a></li>
                   <li><a href="<?php echo $base_url; ?>view-home-banner"><i class="icon-play4"></i>Home Banner</a></li>
                   <li><a href="<?php echo $base_url; ?>view-offer-banner"><i class="icon-play4"></i>Home Offer Banner</a></li>
                   <!-- <li><a href="<?php echo $base_url; ?>view-client-portfolio"><i class="icon-play4"></i>Client Portfolio</a></li> -->
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
                    <i class="icon-cogs position-left"></i> Manage Inquiry <span class="caret"></span>
                </a>

                <ul class="dropdown-menu width-200">
                   <!-- <li><a href="<?php echo $base_url; ?>view-product-inquiry"><i class="icon-play4"></i>Product Inquiry</a></li> -->
                   <li><a href="<?php echo $base_url; ?>view-contact-inquiry"><i class="icon-play4"></i>Contact Inquiry</a></li>
                   <!-- <li><a href="<?php echo $base_url; ?>view-customer-management"><i class="icon-play4"></i>Customer Management</a></li> -->
                </ul>
            </li>
            <li class="dropdown">
                <a href="<?php echo $base_url; ?>view-user" >
                    <i class="icon-users position-left"></i> Users
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- /second navbar -->