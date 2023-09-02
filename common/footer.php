<footer class="site-footer">
   <div class="site-footer-bg" style="background-image: url(<?php echo $base_url_images ?>backgrounds/site-footer-bg.png);">
   </div>
   <div class="container">
       <div class="site-footer__top">
           <div class="row">
               <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="100ms">
                   <div class="footer-widget__column footer-widget__about">
                       <div class="footer-widget__logo">
                           <a href="<?php echo $base_url; ?>"><img src="<?php echo $base_url_images; ?>resources/logo-1.png" alt="<?php echo $company_title;  ?>" title="<?php echo $company_title;  ?>"></a>
                       </div>
                       <div class="footer-widget__about-text-box">
                           <p class="footer-widget__about-text"><?php echo substr($company_description, 0, 100); ?></p>
                       </div>
                       <div class="site-footer__social">
                           <a href="<?php echo $twitter_link;?>" target="_blank"><i class="fab fa-twitter"></i></a>
                           <a href="<?php echo $facebook_link;?>" target="_blank"><i class="fab fa-facebook"></i></a>
                           <a href="<?php echo $pintrest_link;?>" target="_blank"><i class="fab fa-pinterest-p"></i></a>
                           <a href="<?php echo $linkedin_link;?>" target="_blank"><i class="fab fa-linkedin"></i></a>
                           <a href="<?php echo $insta_link;?>" target="_blank"><i class="fab fa-instagram"></i></a>
                           <a href="<?php echo $skype_link;?>" target="_blank"><i class="fab fa-skype"></i></a>
                       </div>
                   </div>
               </div>
               <div class="col-xl-2 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="200ms">
                   <div class="footer-widget__column footer-widget__contact clearfix">
                       <h3 class="footer-widget__title">Contact</h3>
                       <ul class="footer-widget__contact-list list-unstyled clearfix">
                           <li>
                               <div class="icon">
                                   <span class="icon-email"></span>
                               </div>
                               <div class="text">
                                   <p><a href="mailto:info@referkar.com">info@referkar.com</a></p>
                               </div>
                           </li>
                           <li>
                               <div class="icon">
                                   <span class="icon-pin"></span>
                               </div>
                               <div class="text">
                                   <p>Comming soon</p>
                               </div>
                           </li>
                       </ul>
                       <!-- <div class="footer-widget__open-hour">
                           <h3 class="footer-widget__open-hour-title">Open Hours</h3>
                           <h3 class="footer-widget__open-hour-text">Mon – Sat: 09:00 am to 07:00 pm Sunday:
                               Closed</h3>
                       </div> -->
                   </div>
               </div>
               <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="300ms">
                   <div class="footer-widget__column footer-widget__gallery clearfix">
                       <h3 class="footer-widget__title">Search Menu</h3>
                       <div class="text">
                            <a href="#loans" style="color:#97a2b7">Loans</a>
                       </div>
                       <div class="text">
                            <a href="<?php $base_url ?>blogs" style="color:#97a2b7">Blogs</a>
                       </div>
                       <div class="text">
                            <a href="<?php $base_url ?>support" style="color:#97a2b7">Contact Us</a>
                       </div>
                       <div class="text">
                            <a href="<?php $base_url ?>privacy-policy" style="color:#97a2b7">Privacy Policy</a>
                       </div>
                       <div class="text">
                            <a href="<?php $base_url ?>disclaimer" style="color:#97a2b7">Disclaimer</a>
                       </div>
                       <div class="text">
                            <a href="<?php $base_url ?>terms-and-conditions" style="color:#97a2b7">Terms & Conditions</a>
                       </div>
                       
                   </div>
               </div>
               <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="400ms">
                   <div class="footer-widget__column footer-widget__newsletter">
                       <h3 class="footer-widget__title">Newsletter</h3>
                       <p class="footer-widget__newsletter-text">Subscribe our newsletter to get our <br>
                           latest update & news.</p>
                       <form class="footer-widget__newsletter-form">
                           <div class="footer-widget__newsletter-input-box">
                               <input type="email" placeholder="Email address" name="email">
                               <button type="submit" class="footer-widget__newsletter-btn"><i
                                       class="far fa-paper-plane"></i></button>
                           </div>
                       </form>
                       <div class="footer-widget__phone">
                           <div class="footer-widget__phone-icon">
                               <span class="icon-telephone"></span>
                           </div>
                           <div class="footer-widget__phone-text">
                               <a href="tel:9200368090">+91 9987355655</a>
                               <p>Call to Our Experts</p>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <div class="site-footer__bottom">
           <div class="row">
               <div class="col-xl-12">
                   <div class="site-footer__bottom-inner">
                       <p class="site-footer__bottom-text">© All Copyright <?php echo date('Y'); ?> by <a href="#">www.referkar.com</a>
                       </p>
                   </div>
               </div>
           </div>
       </div>
   </div>
</footer>
<!--Site Footer End-->


</div><!-- /.page-wrapper -->


<div class="mobile-nav__wrapper">
<div class="mobile-nav__overlay mobile-nav__toggler"></div>
<!-- /.mobile-nav__overlay -->
<div class="mobile-nav__content">
   <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>

   <div class="logo-box">
       <a href="index.html" aria-label="logo image"><img src="<?php echo $base_url_images ?>resources/logo-1.png" width="143"
               alt="" /></a>
   </div>
   <!-- /.logo-box -->
   <div class="mobile-nav__container"></div>
   <!-- /.mobile-nav__container -->

   <ul class="mobile-nav__contact list-unstyled">
       <li>
           <i class="fa fa-envelope"></i>
           <a href="mailto:needhelp@packageName__.com">info@referkar.com</a>
       </li>
       <li>
           <i class="fa fa-phone-alt"></i>
           <a href="tel:666-888-0000">+91 9987355655</a>
       </li>
   </ul><!-- /.mobile-nav__contact -->
   <div class="mobile-nav__top">
       <div class="mobile-nav__social">
           <a href="#" class="fab fa-twitter"></a>
           <a href="#" class="fab fa-facebook-square"></a>
           <a href="#" class="fab fa-pinterest-p"></a>
           <a href="#" class="fab fa-instagram"></a>
       </div><!-- /.mobile-nav__social -->
   </div><!-- /.mobile-nav__top -->



</div>
<!-- /.mobile-nav__content -->
</div>
<!-- /.mobile-nav__wrapper -->

<div class="search-popup">
<div class="search-popup__overlay search-toggler"></div>
<!-- /.search-popup__overlay -->
<div class="search-popup__content">
   <form action="#">
       <label for="search" class="sr-only">search here</label><!-- /.sr-only -->
       <input type="text" id="search" placeholder="Search Here..." />
       <button type="submit" aria-label="search submit" class="thm-btn">
           <i class="icon-magnifying-glass"></i>
       </button>
   </form>
</div>
<!-- /.search-popup__content -->
</div>