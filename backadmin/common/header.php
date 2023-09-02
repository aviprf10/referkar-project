<div class="navbar navbar-expand-md navbar-dark">
    <div class="navbar-brand" style="font-size: 16px;">
        <a href="<?php echo $base_url; ?>" class="d-inline-block" style="color:#fff;">
            ReferKar.com
        </a>
    </div>

    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>
    </div>

    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li>
            <li class="nav-item dropdown"></li>
        </ul>
        <span class="navbar-text ml-md-3 mr-md-auto"></span>
        <ul class="navbar-nav">
            
            <li class="nav-item dropdown dropdown-user">
                <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                    <img src="<?php echo $loggedin_user_profile_pic_100; ?>" class="rounded-circle" alt="" style="width: 40px; height: 40px;">
                    <span><?php echo $loggedin_user_first_name . " " . $loggedin_user_last_name ?></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a href="<?php echo $base_url; ?>account-settings" class="dropdown-item"><i class="icon-user-plus"></i> Account settings</a>
                    <a href="<?php echo $base_url; ?>logout.php" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
                </div>
            </li>
        </ul>
    </div>
</div>