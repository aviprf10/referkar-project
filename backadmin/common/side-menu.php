<div class="page-content">
    <div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">
        <div class="sidebar-mobile-toggler text-center">
            <a href="#" class="sidebar-mobile-main-toggle">
                <i class="icon-arrow-left8"></i>
            </a>
            Navigation
            <a href="#" class="sidebar-mobile-expand">
                <i class="icon-screen-full"></i>
                <i class="icon-screen-normal"></i>
            </a>
        </div>
        <!-- /sidebar mobile toggler -->


        <!-- Sidebar content -->
        <div class="sidebar-content">

            <!-- User menu -->
            <div class="sidebar-user">
                <div class="card-body">
                    <div class="media">
                        <div class="mr-3">
                            <a href="#"><img src="<?php echo $loggedin_user_profile_pic_100; ?>" width="38" height="38" class="rounded-circle" alt=""></a>
                        </div>

                        <div class="media-body">
                            <div class="media-title font-weight-semibold"><?php echo $loggedin_user_first_name . " " . $loggedin_user_last_name ?></div>
                            <div class="font-size-xs opacity-50">
                                <i class="icon-pin font-size-sm"></i> &nbsp;Mumbai, India
                            </div>
                        </div>

                        <div class="ml-3 align-self-center">
                            <a href="#" class="text-white"><i class="icon-cog3"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /user menu -->


            <!-- Main navigation -->
            <div class="card card-sidebar-mobile">
                <ul class="nav nav-sidebar" data-nav-type="accordion">

                    <!-- Main -->
                    <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i></li>
                    <li class="nav-item">
                        <a href="<?php echo $base_url; ?>" <?php if($current_page == 'index.php'){ ?>class="nav-link active" <?php }else{ ?> class="nav-link"<?php } ?> >
                            <i class="icon-home4"></i>
                            <span>
                                Dashboard
                            </span>
                        </a>
                    </li>
                    <li <?php if($current_page == 'settings.php' || $current_page == 'view-country.php' || $current_page == 'add-country.php' || $current_page == 'edit-country.php' || $current_page == 'view-state.php' || $current_page == 'add-state.php' || $current_page == 'edit-state.php' || $current_page == 'view-city.php' || $current_page == 'add-city.php' || $current_page == 'edit-city.php' || $current_page == 'view-area.php' || $current_page == 'add-area.php' || $current_page == 'edit-area.php'){ ?>class="nav-item nav-item-submenu nav-item-open" <?php }else{ ?>  class="nav-item nav-item-submenu"<?php } ?> >
                        <a href="#" <?php if($current_page == 'settings.php' || $current_page == 'view-country.php' || $current_page == 'add-country.php' || $current_page == 'edit-country.php' || $current_page == 'view-state.php' || $current_page == 'add-state.php' || $current_page == 'edit-state.php' || $current_page == 'view-city.php' || $current_page == 'add-city.php' || $current_page == 'edit-city.php' || $current_page == 'view-area.php' || $current_page == 'add-area.php' || $current_page == 'edit-area.php' || $current_page == 'view-bank.php' || $current_page == 'add-bank.php' || $current_page == 'edit-bank.php'){ ?>class="nav-link active" <?php }else{ ?> class="nav-link"<?php } ?> ><i class="icon-copy"></i> <span>Master Module </span></a>
                        <ul class="nav nav-group-sub" data-submenu-title="Layouts" <?php if($current_page == 'settings.php' || $current_page == 'view-country.php' || $current_page == 'add-country.php' || $current_page == 'edit-country.php' || $current_page == 'view-state.php' || $current_page == 'add-state.php' || $current_page == 'edit-state.php' || $current_page == 'view-city.php' || $current_page == 'add-city.php' || $current_page == 'edit-city.php' || $current_page == 'view-area.php' || $current_page == 'add-area.php' || $current_page == 'edit-area.php' || $current_page == 'view-bank.php' || $current_page == 'add-bank.php' || $current_page == 'edit-bank.php'){ ?>style="display:block;" <?php }?>>
                            <li class="nav-item"><a href="<?php echo $base_url; ?>settings"  <?php if($current_page == 'settings.php'){ ?>class="nav-link active" <?php }else{ ?> class="nav-link"<?php } ?> >Company Info</a></li>
                            <li class="nav-item"><a href="<?php echo $base_url; ?>view-country"  <?php if($current_page == 'view-country.php' || $current_page == 'add-country.php' || $current_page == 'edit-country.php'){ ?>class="nav-link active" <?php }else{ ?> class="nav-link"<?php } ?> >Country Master</a></li>
                            <li class="nav-item"><a href="<?php echo $base_url; ?>view-state"  <?php if($current_page == 'view-state.php' || $current_page == 'add-state.php' || $current_page == 'edit-state.php'){ ?>class="nav-link active" <?php }else{ ?> class="nav-link"<?php } ?> >State Master</a></li>
                            <li class="nav-item"><a href="<?php echo $base_url; ?>view-city"  <?php if($current_page == 'view-city.php' || $current_page == 'add-city.php' || $current_page == 'edit-city.php'){ ?>class="nav-link active" <?php }else{ ?> class="nav-link"<?php } ?> >City Master</a></li>
                            <li class="nav-item"><a href="<?php echo $base_url; ?>view-area"  <?php if($current_page == 'view-area.php' || $current_page == 'add-area.php' || $current_page == 'edit-area.php'){ ?>class="nav-link active" <?php }else{ ?> class="nav-link"<?php } ?> >Area Master</a></li>
                            <!-- <li class="nav-item"><a href="<?php echo $base_url; ?>view-bank"  <?php if($current_page == 'view-bank.php' || $current_page == 'add-bank.php' || $current_page == 'edit-bank.php'){ ?>class="nav-link active" <?php }else{ ?> class="nav-link"<?php } ?> >Bank Master</a></li> -->
                        </ul>
                    </li>
                    <li <?php if($current_page == 'cms-page.php'){ ?>class="nav-item nav-item-submenu nav-item-open" <?php }else{ ?>  class="nav-item nav-item-submenu"<?php } ?>>
                        <a href="#" class="nav-link"><i class="icon-file-text2"></i> <span>Manage Pages </span></a>
                        <ul class="nav nav-group-sub" data-submenu-title="Layouts" <?php if($current_page == 'cms-page.php'){ ?> style="display:block" <?php }?> > 
                            <li class="nav-item"><a href="<?php echo $base_url; ?>cms-page" <?php if($current_page == 'cms-page.php'){ ?>class="nav-link active" <?php }else{ ?> class="nav-link"<?php } ?>>CMS Pages</a></li>
                        </ul>
                    </li>
                    <li <?php if($current_page == 'view-category.php' || $current_page == 'add-category.php' || $current_page == 'edit-category.php' || $current_page == 'view-sub-category.php' || $current_page == 'add-sub-category.php' || $current_page == 'edit-sub-category.php' || $current_page == 'view-service.php' || $current_page == 'add-service.php' || $current_page == 'edit-service.php' || $current_page == 'view-sub-service.php' || $current_page == 'add-sub-service.php' || $current_page == 'edit-sub-service.php'){ ?>class="nav-item nav-item-submenu nav-item-open" <?php }else{ ?>  class="nav-item nav-item-submenu"<?php } ?>>
                        <a href="#" class="nav-link"><i class="icon-coins"></i> <span>Loan Master </span></a>
                        <ul class="nav nav-group-sub" data-submenu-title="Layouts" <?php if($current_page == 'view-category.php' || $current_page == 'add-category.php' || $current_page == 'edit-category.php' || $current_page == 'view-sub-category.php' || $current_page == 'add-sub-category.php' || $current_page == 'edit-sub-category.php' || $current_page == 'view-service.php' || $current_page == 'add-service.php' || $current_page == 'edit-service.php' || $current_page == 'view-sub-service.php' || $current_page == 'add-sub-service.php' || $current_page == 'edit-sub-service.php'){ ?> style="display:block" <?php }?> > 
                            <!-- <li class="nav-item"><a href="<?php echo $base_url; ?>view-category" <?php if($current_page == 'view-category.php' || $current_page == 'add-category.php' || $current_page == 'edit-category.php'){ ?>class="nav-link active" <?php }else{ ?> class="nav-link"<?php } ?>>Category</a></li>
                            <li class="nav-item"><a href="<?php echo $base_url; ?>view-sub-category" <?php if($current_page == 'view-sub-category.php' || $current_page == 'add-sub-category.php' || $current_page == 'edit-sub-category.php'){ ?>class="nav-link active" <?php }else{ ?> class="nav-link"<?php } ?>>Sub Category</a></li> -->
                            <li class="nav-item"><a href="<?php echo $base_url; ?>view-service" <?php if($current_page == 'view-service.php' || $current_page == 'add-service.php' || $current_page == 'edit-service.php'){ ?>class="nav-link active" <?php }else{ ?> class="nav-link"<?php } ?>>Service</a></li>
                            <li class="nav-item"><a href="<?php echo $base_url; ?>view-sub-service" <?php if($current_page == 'view-sub-service.php' || $current_page == 'add-sub-service.php' || $current_page == 'edit-sub-service.php'){ ?>class="nav-link active" <?php }else{ ?> class="nav-link"<?php } ?>>Sub Service</a></li>
                        </ul>
                    </li>
                    <li <?php if($current_page == 'view-blog.php'){ ?>class="nav-item nav-item-submenu nav-item-open" <?php }else{ ?>  class="nav-item nav-item-submenu"<?php } ?>>
                        <a href="#" class="nav-link"><i class="icon-bubbles7"></i> <span>Manage Blogs </span></a>
                        <ul class="nav nav-group-sub" data-submenu-title="Layouts" <?php if($current_page == 'view-blog.php'){ ?> style="display:block" <?php }?> > 
                            <li class="nav-item"><a href="<?php echo $base_url; ?>view-blog" <?php if($current_page == 'view-blog.php'){ ?>class="nav-link active" <?php }else{ ?> class="nav-link"<?php } ?>>Blog Master</a></li>
                        </ul>
                    </li>
                    <li <?php if($current_page == 'view-loan-inquiry.php'){ ?>class="nav-item nav-item-submenu nav-item-open" <?php }else{ ?>  class="nav-item nav-item-submenu"<?php } ?>>
                        <a href="#" class="nav-link"><i class="icon-question4"></i> <span>Manage Inqury </span></a>
                        <ul class="nav nav-group-sub" data-submenu-title="Layouts" <?php if($current_page == 'view-loan-inquiry.php'){ ?> style="display:block" <?php }?> > 
                            <li class="nav-item"><a href="<?php echo $base_url; ?>view-loan-inquiry" <?php if($current_page == 'view-loan-inquiry.php'){ ?>class="nav-link active" <?php }else{ ?> class="nav-link"<?php } ?>>Loan Inquiry Master</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /main navigation -->

        </div>
        <!-- /sidebar content -->
        
    </div>
    <!-- /main sidebar -->