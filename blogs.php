<?php
include "common/config.php";    
include "common/check_login.php";
include "common/common_code.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Our Blogs | <?php echo $company_title;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:keyword" content="<?php echo $company_title;?>" />
    <meta property="og:title" content="<?php echo $company_title;?>" />
     <meta property="og:description" content="<?php echo $company_title;?>" />
    <meta name="robots" content="noindex, follow" />
    <link rel="icon" href="<?php echo $base_url_images; ?>fevicon.png" sizes="32x32" />
    <link rel="icon" href="<?php echo $base_url_images; ?>fevicon.png" sizes="192x192" />
    <link rel="apple-touch-icon" href="<?php echo $base_url_images; ?>fevicon.png" />
    <meta name="msapplication-TileImage" content="<?php echo $base_url_images; ?>fevicon.png" />
    <?php include "common/header-css.php";?>
</head>
<body class="custom-cursor">
   <div class="custom-cursor__cursor"></div>
   <div class="custom-cursor__cursor-two"></div>
   <!-- <div class="preloader">
        <div class="preloader__image"></div>
   </div> -->
   

   <div class="page-wrapper">
   <?php include 'common/header.php';?>
    <div class="stricky-header stricked-menu main-menu">
        <div class="sticky-header__content"></div><!-- /.sticky-header__content -->
    </div><!-- /.stricky-header -->

    <section class="page-header">
        <div class="page-header-bg" style="background-image: url(<?php echo $base_url_images ?>backgrounds/page-header-bg.jpg)">
        </div>
        <div class="page-header-shape-1"><img src="<?php echo $base_url_images ?>shapes/page-header-shape-1.png" alt=""></div>
        <div class="container">
            <div class="page-header__inner">
                <ul class="thm-breadcrumb list-unstyled">
                    <li><a href="index.html">Home</a></li>
                    <li><span>/</span></li>
                    <li>Blogs</li>
                </ul>
                <h2>Latest blogs</h2>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <!--News One Start-->
    <section class="news-one">
        <div class="container">
            <div class="row">
                <?php
                 if(count($blogs_data_array) > 0)
                 { 
                    foreach($blogs_data_array as $blogs_data){

                        $blogimage = $base_url_uploads.'blog-images/temp_file/'.$blogs_data['blog_image'];
                 ?>
                 <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="100ms">
                        <div class="news-one__single">
                            <div class="news-one__img">
                                <img src="<?php echo $blogimage; ?>" alt="">
                                <div class="news-one__tag">
                                    <p><i class="far fa-folder"></i>LOANS</p>
                                </div>
                                <div class="news-one__arrow-box">
                                    <a href="<?php $base_url ?><?php echo $blogs_data['blog_url']; ?>" class="news-one__arrow">
                                        <span class="icon-right-arrow1"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="news-one__content">
                                <ul class="list-unstyled news-one__meta">
                                    <li><a href="<?php $base_url ?><?php echo $blogs_data['blog_url']; ?>"><i class="far fa-calendar"></i> <?php echo date('j F, Y', strtotime($blogs_data['created_on'])); ?></a>
                                    </li>
                                    <!-- <li><a href="#"><i class="far fa-comments"></i> 02 Comments</a>
                                    </li> -->
                                </ul>
                                <h3 class="news-one__title"><a href="<?php $base_url ?><?php echo $blogs_data['blog_url']; ?>"><?php echo ucfirst($blogs_data['blog_name']); ?></a></h3>
                                <p class="news-one__text"><?php echo $blogs_data['sort_description']; ?></p>
                                <div class="news-one__read-more">
                                    <a href="<?php $base_url ?><?php echo $blogs_data['blog_url']; ?>">Read More <i class="fas fa-angle-double-right"></i></a>
                                </div>
                            </div>
                        </div>
                </div>
                <?php } }else { echo 'No blogs found!'; } ?>
            </div>
        </div>
    </section>
   <?php include 'common/footer.php';?>
   <?php include 'common/footer-js.php';?>
 </body>    
</html>