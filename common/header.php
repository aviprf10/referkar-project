<header class="main-header clearfix">
    <div class="main-header-two__top-social-box" style="background-color: aliceblue;">
        <div class="container">
            <div class="main-header-two__top-social-box-inner">
                <p class="main-header-two__top-social-text"> <!-- <i class="fa fa-clock"></i> <span>Open
                        Hours:</span> Mon – Sat: 09 am – 07 pm, Sunday: CLOSED --></p>
                <div class="main-header-two__top-menu-social-box">
                    <div class="main-header-two__top-menu-box">
                        <ul class="list-unstyled main-header-two__top-menu">
                            <li><a href="<?php echo $base_url ?>track-refrencenum">Track your refer enquiry</a></li>
                            <!-- <li><a href="#">FAQs</a></li>
                            <li><a href="#">About</a></li> -->
                        </ul>
                    </div>
                    <div class="main-header-two__top-social">
                       <a href="<?php echo $twitter_link;?>" target="_blank"><i class="fab fa-twitter"></i></a>
                       <a href="<?php echo $facebook_link;?>" target="_blank"><i class="fab fa-facebook"></i></a>
                       <a href="<?php echo $pintrest_link;?>" target="_blank"><i class="fab fa-pinterest-p"></i></a>
                       <a href="<?php echo $linkedin_link;?>" target="_blank"><i class="fab fa-linkedin"></i></a>
                       <a href="<?php echo $insta_link;?>" target="_blank"><i class="fab fa-instagram"></i></a>
                       <a href="<?php echo $skype_link;?>" target="_blank"><i class="fab fa-skype"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="main-menu clearfix">
        <div class="main-menu__wrapper clearfix">
            <div class="container">
                <div class="main-menu__wrapper-inner clearfix">
                    <div class="main-menu__left">
                        <div class="main-menu__logo">
                            <a href="<?php echo $base_url; ?>"><img src="<?php echo $base_url_images ?>resources/logo-1.png" alt="<?php echo $company_title;  ?>" title="<?php echo $company_title;  ?>"></a>
                        </div>
                        <div class="main-menu__main-menu-box">
                            <div class="main-menu__main-menu-box-inner">
                                <a href="#" class="mobile-nav__toggler"><i class="fa fa-bars"></i></a>
                                <ul class="main-menu__list">
                                    <li><a href="<?php echo $base_url;?>">Home </a></li>
                                    <li class="dropdown">
                                        <a href="#">Loans</a>
                                        <?php 
                                         if(count($service_data_array) > 0){
                                        ?>
                                        <ul>
                                            <?php
                                                  foreach($service_data_array as $service_data){ 
                                            ?>
                                            <li><a href="<?php echo $base_url ?><?php echo $service_data['sub_service_unique_slug']; ?>"><?php echo $service_data['sub_service_name']; ?></a></li>
                                        <?php } ?>
                                        </ul>
                                    <?php  } ?>
                                    </li>
                                    <li><a href="<?php echo $base_url; ?>blogs">Blogs</a></li>
                                    <li><a href="<?php echo $base_url; ?>about-us">About </a></li>
                                    <li><a href="<?php echo $base_url; ?>support">Support </a></li>
                                </ul>
                            </div>
                            <div class="main-menu__main-menu-box-search-get-quote-btn">
                                <div class="main-menu__main-menu-box-search">
                                    <a href="#" class="main-menu__search search-toggler icon-magnifying-glass"></a>
                                </div>
                                <div class="main-menu__main-menu-box-get-quote-btn-box">
                                    <a href="<?php echo $base_url ?>support" class="thm-btn main-menu__main-menu-box-get-quote-btn">Get a Quote</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="main-menu__right">
                        <div class="main-menu__call">
                            <div class="main-menu__call-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="main-menu__call-content">
                                <a href="tel:9200368090">+91 9987355655</a>
                                <p>Call to Our Experts</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>