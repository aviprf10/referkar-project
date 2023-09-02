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
    <title>Home | <?php echo $meta_title;?></title>
    <meta name="google-site-verification" content="Y920H2Ng2YNytsEBYLPnZlELKdBYlr_3bxZ7mBmlPfI"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:keyword" content="<?php echo $search_keywords;?>" />
    <meta property="og:title" content="<?php echo $meta_title;?>" />
    <meta property="og:description" content="<?php echo $meta_description;?>" />
    <meta name="p:domain_verify" content="970c34ed80814dd6863224a4cfdaee0d"/>
    <meta name="robots" content="noindex, follow" />
    <link rel="icon" href="<?php echo $base_url_images; ?>fevicon.png" sizes="32x32" />
    <link rel="icon" href="<?php echo $base_url_images; ?>fevicon.png" sizes="192x192" />
    <link rel="apple-touch-icon" href="<?php echo $base_url_images; ?>fevicon.png" />
    <meta name="msapplication-TileImage" content="<?php echo $base_url_images; ?>fevicon.png" />
    <?php include "common/header-css.php";?>
    <link rel="stylesheet" href="<?php echo $base_url_css;?>parsley.css">
    <link rel="stylesheet" href="<?php echo $base_url_js;?>plugins/notifybar/css/jquery.notifyBar.css">
    <style type="text/css">
        @media screen and (max-width: 480px) {
            #mobile{
                width: 53%; 
                float:left
            }

            #input_otp{
                width:54%; 
                float:left
            }
        }

        @media screen and (min-width: 480px) {
            #mobile{
                width: 74%; 
                float:left
            }

            #input_otp{
                width:78%; 
                float:left
            }

        }    
    </style>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-M2T9783');</script>
    <!-- End Google Tag Manager -->
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-3RZCFXZY92"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-3RZCFXZY92');
    </script>
</head>
<body class="custom-cursor">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M2T9783"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
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

    <!--Main Slider Start-->
    <section class="main-slider clearfix">
        <div class="swiper-container thm-swiper__slider" data-swiper-options='{"slidesPerView": 1, "loop": true,
            "effect": "fade",
            "pagination": {
            "el": "#main-slider-pagination",
            "type": "bullets",
            "clickable": true
            },
            "navigation": {
            "nextEl": "#main-slider__swiper-button-next",
            "prevEl": "#main-slider__swiper-button-prev"
            },
            "autoplay": {
            "delay": 5000
            }}'>
            <div class="swiper-wrapper">

                <div class="swiper-slide">
                    <div class="image-layer"
                        style="background-image: url(assets/images/backgrounds/slide-2.jpg);"></div>
                    <!-- /.image-layer -->

                    <div class="main-slider-shape-1 float-bob-x">
                        <img src="assets/images/shapes/main-slider-shape-1.png" alt="">
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="main-slider__content">
                                    <h2 class="main-slider__title">Give <br> your 2 min <br> to  <span>earn 1lacs.</span></h2>
                                    <p class="main-slider__text">Is your friends or family looking for any kind of Loan ? <br>If Yes then refer us ,we will give you payout upto 1L*</p>
                                    <div class="main-slider__btn-box">
                                        <a href="#home" class="thm-btn main-slider__btn">Let’s Get Started</a>
                                        <a href="<?php echo $base_url ?>emi" class="thm-btn main-slider__btn">Check EMI</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="image-layer"
                        style="background-image: url(assets/images/backgrounds/slide.jpg);"></div>
                    
                    <div class="main-slider-shape-1 float-bob-x">
                        <img src="assets/images/shapes/main-slider-shape-1.png" alt="">
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="main-slider__content">
                                    <h2 class="main-slider__title">Sapno ka  <br>ghar khareedna hai , <br> <span>to Referkar….</span></h2>
                                    <p class="main-slider__text">Are you or your friend is looking for the cheapest Home loan with less <br>documentation then refer us and get payout upto 1 Lacs ..</p>
                                    <div class="main-slider__btn-box">
                                        <a href="#home" class="thm-btn main-slider__btn">Let’s Get Started</a>
                                        <a href="<?php echo $base_url ?>emi" class="thm-btn main-slider__btn">Check EMI</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="image-layer"
                        style="background-image: url(assets/images/backgrounds/slide-1.jpg);"></div>
                    <!-- /.image-layer -->

                    <div class="main-slider-shape-1 float-bob-x">
                        <img src="assets/images/shapes/main-slider-shape-1.png" alt="">
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="main-slider__content">
                                    <h2 class="main-slider__title">Dost <br> gadi khareed raha, <br> to <span>Referkar….</span></h2>
                                    <p class="main-slider__text">Are you or your friend is looking for cheapest car loan then give us <br> the reference and earn the exciting commission ..</p>
                                    <div class="main-slider__btn-box">
                                        <a href="#home" class="thm-btn main-slider__btn">Let’s Get Started</a>
                                        <a href="<?php echo $base_url ?>emi" class="thm-btn main-slider__btn">Check EMI</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- If we need navigation buttons -->
            <div class="main-slider__nav">
                <div class="swiper-button-prev" id="main-slider__swiper-button-next">
                    <i class="icon-right-arrow"></i>
                </div>
                <div class="swiper-button-next" id="main-slider__swiper-button-prev">
                    <i class="icon-right-arrow1"></i>
                </div>
            </div>

        </div>
    </section>

     <!--Get Loan Start-->
     <section class="get-insuracne-two">
         <div class="get-insuracne-two-shape-3 float-bob-x">
             <img src="assets/images/shapes/get-insuracne-two-shape-3.png" alt="">
         </div>
         <div class="container">
             <div class="row">
                 <div class="col-xl-5">
                     <div class="get-insuracne-two__left">
                         <div class="get-insuracne-two__shape-box">
                             <div class="get-insuracne-two-shape-1"
                                 style="background-image: url(assets/images/shapes/get-insuracne-two-shape-1.png);">
                             </div>
                             <div class="get-insuracne-two-shape-2">
                                 <img src="assets/images/shapes/get-insuracne-two-shape-2.png" alt="">
                             </div>
                         </div>
                         <div class="get-insuracne-two__img">
                             <img src="assets/images/resources/get-insurance-two-img-1.jpg" alt="">
                         </div>
                     </div>
                 </div>
                 <div class="col-xl-7">
                     <div class="get-insuracne-two__right">
                         <div class="section-title text-left">
                             <div class="section-sub-title-box">
                                 <p class="section-sub-title">ReferKar</p>
                                 <div class="section-title-shape-1">
                                     <img src="assets/images/shapes/section-title-shape-1.png" alt="">
                                 </div>
                                 <div class="section-title-shape-2">
                                     <img src="assets/images/shapes/section-title-shape-2.png" alt="">
                                 </div>
                             </div>
                             <h2 class="section-title__title">Provide your reference here!</h2>
                         </div>
                         <div class="get-insuracne-two__tab clearfix">
                             <div class="get-insuracne-two__tab-box tabs-box clearfix">
                                 <div class="get-insuracne-two__inner clearfix">
                                    <div class="get-insuracne-two__tab-right">
                                        <div class="tabs-content">
                                             <!--tab-->
                                            <div class="tab active-tab" id="home">
                                                <div class="get-insuracne-two__content">
                                                     <form class="get-insuracne-two__form" id="homeloan_form" method="POST" data-parsley-validate>
                                                         <div class="get-insuracne-two__content-box">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="get-insuracne-two__input-box">
                                                                        <input type="text" placeholder="Enter your name" name="name" data-parsley-required="true">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">   
                                                                    <div class="get-insuracne-two__input-box"> 
                                                                        <input type="email" placeholder="Enter your email" id="email"
                                                                     name="email" data-parsley-required="true" data-parsley-type="email">
                                                                    </div>
                                                                </div>     
                                                            </div> 
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                     <div class="get-insuracne-two__input-box">
                                                                            <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Enter your mobile" maxlength="10" id="mobile"
                                                                             name="mobile" data-parsley-required="true">
                                                                            <span class="help-inline" id="generate_otp_button_div"><input type="button" onclick="get_generate_mobile_otp()" class="thm-btn get-insuracne-two__btn" name="register" value="Send OTP" style="margin-left: 10px;"></span>

                                                                            <span class="help-inline" id="resend_otp_button_div" style="display: none;float: right;"><input type="button" onclick="get_generate_mobile_otp()"  style="padding: 14px 29px 14px;     float: right;" class="thm-btn get-insuracne-two__btne" name="resend" value="Resend OTP"></span>
                                                                            <span id="mobile_verification_status"> </span>
                                              
                                                                     </div>
                                                                </div>
                                                            </div>
                                                            <div class="row"  style="padding-top: 10px;">
                                                                <div class="col-md-12">         
                                                                    <div id="otp_verify_div" style="display:none; margin-top: 10px;">
                                                                    <div class="get-insuracne-two__input-box">
                                                                      <input type="text" class="form-control unicase-form-control text-input" placeholder="OTP No" name="input_otp" id="input_otp" onkeypress="return event.charCode >= 48 && event.charCode <= 57"  autocomplete="off">
                                                                      <span class="help-inline" style="margin:0px;">
                                                                        <input type="button" onclick="get_verify_mobile_otp()" class="thm-btn get-insuracne-two__btn" style="margin-left: 14px;" name="resend" value="Verify" />
                                                                      </span>  
                                                                  </div>
                                                                    </div>
                                                                </div>
                                                            </div>        
                                                            <div class="row">
                                                                <div class="col-md-6">  
                                                                      <div class="get-insuracne-two__input-box">
                                                                         <input type="text" placeholder="Enter refer name" name="refer_name" data-parsley-required="true" id="refer_name">
                                                                     </div>
                                                                </div> 
                                                                <div class="col-md-6">     
                                                                     <div class="get-insuracne-two__input-box">
                                                                         <input type="email" placeholder="Enter refer email"
                                                                             name="refer_email" id="refer_email">
                                                                     </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">  
                                                                     <div class="get-insuracne-two__input-box">
                                                                         <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Enter refer mobile" maxlength="10"
                                                                             name="refer_mobile" id="refer_mobile" data-parsley-required="true">
                                                                     </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="get-insuracne-two__input-box">
                                                                         <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Enter loan amount" maxlength="10"
                                                                             name="loan_amount" id="loan_amount" data-parsley-required="true">
                                                                    </div>
                                                                </div>    
                                                            </div>         
                                                            <div class="row">
                                                                <div class="col-md-12">  
                                                                     <div class="get-insuracne-two__input-box">
                                                                         <select class="selectpicker"
                                                                             aria-label="Default select example" data-parsley-required="true" name="loan_type" id="loan_type">
                                                                             <option selected>Select type of Loan
                                                                             </option>
                                                                             <?php 
                                                                                 if(count($service_data_array) > 0){
                                                                                    foreach($service_data_array as $service_data){ 
                                                                                ?>
                                                                             <option value="<?php echo $service_data['id']; ?>" <?php if($service_data['id'] == '1'){ echo 'selected';} ?>><?php echo $service_data['sub_service_name']; ?></option>
                                                                              <?php } }?>
                                                                         </select>
                                                                     </div>
                                                                </div>
                                                            </div> 
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label><input type="checkbox" name="disclaimer" id="disclaimer" value="1" checked> I declare that the information I have provided is accurate & complete to the best of my knowledge. I hereby authorize referkar. and its affilliates to call, email, send a text throught the Short Messaging Service (SMS) and/or whatsapp  me in relation to reference provided by me</label>
                                                                </div>    
                                                            </div>        
                                                         </div><br>
                                                         
                                                         <div class="get-insuracne-two__content-bottom">
                                                             <button type="submit"
                                                                 class="thm-btn get-insuracne-two__btn">Submit</button>
                                                          </div>

                                                     </form>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section>
     <!--Get Loan End-->

     <!--Feature Two Start-->
     <section class="feature-one">
            <div class="container">
                <div class="feature-one__inner">
                    <div class="row">
                        <!--Feature One Single Start-->
                        <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="100ms">
                            <div class="feature-one__single">
                                <div class="feature-one__single-inner">
                                    <div class="feature-one__icon">
                                        <span class="icon-insurance"></span>
                                    </div>
                                    <div class="feature-one__count"></div>
                                    <div class="feature-one__shape">
                                        <img src="assets/images/shapes/feature-one-shape-1.png" alt="">
                                    </div>
                                    <h3 class="feature-one__title"><a href="about.html">Give your reference</a></h3>
                                    <p class="feature-one__text">Provide your reference for loan and get exciting payout on loan amount</p>
                                </div>
                            </div>
                        </div>
                        <!--Feature One Single End-->
                        <!--Feature One Single Start-->
                        <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="200ms">
                            <div class="feature-one__single">
                                <div class="feature-one__single-inner">
                                    <div class="feature-one__icon">
                                        <span class="icon-cashback"></span>
                                    </div>
                                    <div class="feature-one__count"></div>
                                    <div class="feature-one__shape">
                                        <img src="assets/images/shapes/feature-one-shape-1.png" alt="">
                                    </div>
                                    <h3 class="feature-one__title"><a href="about.html">Procedure</a></h3>
                                    <p class="feature-one__text">We provide fastest disbursement of loan through our channel partners like Banks and NBFCs</p>
                                </div>
                            </div>
                        </div>
                        <!--Feature One Single End-->
                        <!--Feature One Single Start-->
                        <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="300ms">
                            <div class="feature-one__single">
                                <div class="feature-one__single-inner">
                                    <div class="feature-one__icon">
                                        <span class="icon-house"></span>
                                    </div>
                                    <div class="feature-one__count"></div>
                                    <div class="feature-one__shape">
                                        <img src="assets/images/shapes/feature-one-shape-1.png" alt="">
                                    </div>
                                    <h3 class="feature-one__title"><a href="about.html">Commission</a></h3>
                                    <p class="feature-one__text">We Provide excitimg commission on loan amount . The payout credits directly in the account of referee</p>
                                </div>
                            </div>
                        </div>
                        <!--Feature One Single End-->
                    </div>
                </div>
            </div>
        </section>
     <!--Feature Two End-->

     <!--About Two Start-->
     <!-- <section class="about-two">
         <div class="container">
             <div class="row">
                 <div class="col-xl-5">
                     <div class="about-two__left">
                         <div class="section-title text-left">
                             <div class="section-sub-title-box">
                                 <p class="section-sub-title">About company</p>
                                 <div class="section-title-shape-1">
                                     <img src="assets/images/shapes/section-title-shape-1.png" alt="">
                                 </div>
                                 <div class="section-title-shape-2">
                                     <img src="assets/images/shapes/section-title-shape-2.png" alt="">
                                 </div>
                             </div>
                             <h2 class="section-title__title">Get reliable & quick Loan for any purpose</h2>
                         </div>
                         <p class="about-two__text">Nullam eu nibh vitae est tempor molestie id sed ex. Quisque
                             dignissim maximus ipsum, sed rutrum metus tincidunt et. Sed eget tincidunt ipsum.</p>
                         <ul class="list-unstyled about-two__points">
                             <li>
                                 <div class="icon">
                                     <i class="fa fa-check"></i>
                                 </div>
                                 <div class="text">
                                     <p>Pina & Associates Loan</p>
                                 </div>
                             </li>
                             <li>
                                 <div class="icon">
                                     <i class="fa fa-check"></i>
                                 </div>
                                 <div class="text">
                                     <p>Payment at Contingency</p>
                                 </div>
                             </li>
                             <li>
                                 <div class="icon">
                                     <i class="fa fa-check"></i>
                                 </div>
                                 <div class="text">
                                     <p>Amount of Payment</p>
                                 </div>
                             </li>
                             <li>
                                 <div class="icon">
                                     <i class="fa fa-check"></i>
                                 </div>
                                 <div class="text">
                                     <p>Large Number of Loan</p>
                                 </div>
                             </li>
                         </ul>
                         <a href="about.html" class="thm-btn about-two__btn">Discover More</a>
                     </div>
                 </div>
                 <div class="col-xl-5">
                     <div class="about-two__middle">
                         <div class="about-two__img-box">
                             <div class="about-two__img">
                                 <img src="assets/images/resources/about-two-img-1.jpg" alt="">
                             </div>
                             <div class="about-two__awards-box">
                                 <div class="about-two__awards-inner">
                                     <h2 class="about-two__awards-year">28</h2>
                                     <p class="about-two__awards-content">National Awards Won</p>
                                     <div class="about-two__awards-shape-2">
                                         <img src="assets/images/shapes/about-two-awards-shape-2.png" alt="">
                                     </div>
                                 </div>
                             </div>
                             <div class="about-two__dots float-bob-y">
                                 <img src="assets/images/shapes/about-two-dots.png" alt="">
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-xl-2">
                     <div class="about-two__counter">
                         <ul class="list-unstyled about-two__counter-list">
                             <li>
                                 <div class="about-two__counter-single">
                                     <div class="about-two__counter-count count-box">
                                         <h3 class="count-text" data-speed="4000" data-stop="1234">00</h3>
                                     </div>
                                     <p class="about-two__counter-text-1">Projects completed</p>
                                     <p class="about-two__counter-text-2">Nulla viverra tortor eu nulla pulvinar
                                         dignissim.</p>
                                 </div>
                             </li>
                             <li>
                                 <div class="about-two__counter-single">
                                     <div class="about-two__counter-count count-box">
                                         <h3 class="count-text" data-speed="4000" data-stop="955">00</h3>
                                     </div>
                                     <p class="about-two__counter-text-1">Satisfied customers</p>
                                     <p class="about-two__counter-text-2">Nulla viverra tortor eu nulla pulvinar
                                         dignissim.</p>
                                 </div>
                             </li>
                             <li>
                                 <div class="about-two__counter-single">
                                     <div class="about-two__counter-count count-box">
                                         <h3 class="count-text" data-speed="4000" data-stop="100">00</h3>
                                         <span class="about-two__counter-percent">%</span>
                                     </div>
                                     <p class="about-two__counter-text-1">Claim success rates</p>
                                     <p class="about-two__counter-text-2">Nulla viverra tortor eu nulla pulvinar
                                         dignissim.</p>
                                 </div>
                             </li>
                         </ul>
                     </div>
                 </div>
             </div>
         </div>
     </section> -->
     <!--About Two End-->

     <!--Services Two Start-->
     <section class="services-two" id="loans">
         <div class="services-two-shape-1"
             style="background-image: url(assets/images/shapes/services-two-shape-1.png);"></div>
         <div class="container">
             <div class="services-two__top">
                 <div class="row">
                     <div class="col-xl-6 col-lg-6">
                         <div class="services-two__top-left">
                             <div class="section-title text-left">
                                 <div class="section-sub-title-box">
                                     <p class="section-sub-title">Our services</p>
                                     <div class="section-title-shape-1">
                                         <img src="assets/images/shapes/section-title-shape-5.png" alt="">
                                     </div>
                                     <div class="section-title-shape-2">
                                         <img src="assets/images/shapes/section-title-shape-6.png" alt="">
                                     </div>
                                 </div>
                                 <h2 class="section-title__title">We have variety of loan services</h2>
                             </div>
                         </div>
                     </div>
                     <div class="col-xl-6 col-lg-6">
                         <div class="services-two__top-right">
                             <p class="services-two__top-text">We have various type of loan services ,Provide your reference to get the sanction letter in rapid time .Your data will be highly sacure and encrypted and we make sure that it will not be misused for any kind of malicious intent</p>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="services-two__bottom">
                 <div class="row">
                     <!--Services Two Single Start-->
                     <?php 
                         if(count($service_data_array) > 0){
                            foreach($service_data_array as $servicedata){
                        ?>
                     <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="100ms">
                        <a href="<?php echo $base_url; ?><?php echo $servicedata['sub_service_unique_slug']; ?>">
                         <div class="services-two__single">
                             <div class="services-two__icon-box">
                                 <div class="services-two__icon">
                                     <span class="<?php echo $servicedata['icon']; ?>"></span>
                                 </div>
                             </div>
                             <h3 class="services-two__title" style="color:#fff;"><?php echo ucfirst($servicedata['sub_service_name']) ?></h3>
                             <p class="services-two__text"><?php echo substr($servicedata['sort_description'], 0, 100); ?>..</p>
                         </div>
                         </a>
                     </div>
                     <?php }} ?>
                 </div>
             </div>
         </div>
     </section>
     <!--Services Two End-->

     <!--Work Together Start-->
     <section class="work-together">
         <div class="container">
             <div class="row">
                 <div class="col-xl-6 col-lg-6">
                     <div class="work-together__left">
                         <div class="section-title text-left">
                             <div class="section-sub-title-box">
                                 <p class="section-sub-title">We always help</p>
                                 <div class="section-title-shape-1">
                                     <img src="assets/images/shapes/section-title-shape-1.png" alt="">
                                 </div>
                                 <div class="section-title-shape-2">
                                     <img src="assets/images/shapes/section-title-shape-2.png" alt="">
                                 </div>
                             </div>
                             <h2 class="section-title__title">Let’s work together for all life’s moments</h2>
                         </div>
                         <div class="work-together__content-box">
                             <div class="work-together__img">
                                 <img src="assets/images/resources/work-together-img.jpg" alt="">
                             </div>
                             <div class="work-together__text-box">
                                 <p class="work-together__text"> Here are the FAQs which will help you to understand our Entire process 
                                 </p>
                             </div>
                         </div>
                         <div class="work-together__progress">
                             <div class="work-together__progress-single">
                                 <h4 class="work-together__progress-title">Consultation</h4>
                                 <div class="bar">
                                     <div class="bar-inner count-bar" data-percent="95%">
                                         <div class="count-text">95%</div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-xl-6 col-lg-6">
                     <div class="work-together__right">
                         <div class="accrodion-grp" data-grp-name="faq-one-accrodion">
                             <div class="accrodion">
                                 <div class="accrodion-title">
                                     <h4><span>?</span> Why should I Refer you ?</h4>
                                 </div>
                                 <div class="accrodion-content">
                                     <div class="inner">
                                         <p>India is fastest growing country in the world .We have huge domestic demands of Loan .Provide us the reference and get the exciting payout. Make your second income in just 2 Min</p>
                                     </div><!-- /.inner -->
                                 </div>
                             </div>
                             <div class="accrodion active">
                                 <div class="accrodion-title">
                                     <h4><span>?</span> How will I get my commission ?</h4>
                                 </div>
                                 <div class="accrodion-content">
                                     <div class="inner">
                                         <p>We Provide commission post disbursment of the loan. The payout will credit in your account post verification.</p>
                                     </div><!-- /.inner -->
                                 </div>
                             </div>
                             <div class="accrodion last-chiled">
                                 <div class="accrodion-title">
                                     <h4><span>?</span> How will documentation of loans happen ?</h4>
                                 </div>
                                 <div class="accrodion-content">
                                     <div class="inner">
                                         <p>We have veriuos channel partner ,they will do documentation part in one go. We take most the documents on email for fastest processing of the loan</p>
                                     </div><!-- /.inner -->
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section>

     <!--Brand One Start-->
     <!-- <section class="brand-one">
         <div class="container">
             <div class="row">
                 <div class="col-xl-3">
                     <div class="brand-one__title">
                         <h2>Trusted and funded by more then 800 companies</h2>
                     </div>
                 </div>
                 <div class="col-xl-9">
                     <div class="brand-one__main-content">
                         <div class="thm-swiper__slider swiper-container" data-swiper-options='{"spaceBetween": 100, "slidesPerView": 5, "autoplay": { "delay": 5000 }, "breakpoints": {
                             "0": {
                                 "spaceBetween": 30,
                                 "slidesPerView": 2
                             },
                             "375": {
                                 "spaceBetween": 30,
                                 "slidesPerView": 2
                             },
                             "575": {
                                 "spaceBetween": 30,
                                 "slidesPerView": 3
                             },
                             "767": {
                                 "spaceBetween": 50,
                                 "slidesPerView": 4
                             },
                             "991": {
                                 "spaceBetween": 50,
                                 "slidesPerView": 5
                             },
                             "1199": {
                                 "spaceBetween": 100,
                                 "slidesPerView": 5
                                 }
                             }}'>
                             <div class="swiper-wrapper">
                                 <div class="swiper-slide">
                                     <img src="assets/images/brand/brand-1-1.png" alt="">
                                 </div>
                                 <div class="swiper-slide">
                                     <img src="assets/images/brand/brand-1-2.png" alt="">
                                 </div>
                                 <div class="swiper-slide">
                                     <img src="assets/images/brand/brand-1-3.png" alt="">
                                 </div>
                                 <div class="swiper-slide">
                                     <img src="assets/images/brand/brand-1-4.png" alt="">
                                 </div>
                                 <div class="swiper-slide">
                                     <img src="assets/images/brand/brand-1-5.png" alt="">
                                 </div>
                                 <div class="swiper-slide">
                                     <img src="assets/images/brand/brand-1-1.png" alt="">
                                 </div>
                                 <div class="swiper-slide">
                                     <img src="assets/images/brand/brand-1-2.png" alt="">
                                 </div>
                                 <div class="swiper-slide">
                                     <img src="assets/images/brand/brand-1-3.png" alt="">
                                 </div>
                                 <div class="swiper-slide">
                                     <img src="assets/images/brand/brand-1-4.png" alt="">
                                 </div>
                                 <div class="swiper-slide">
                                     <img src="assets/images/brand/brand-1-5.png" alt="">
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section> -->
     <!--Brand One End-->

     <!--Process Start-->
     <section class="process" style="background: azure;">
         <div class="container">
             <div class="section-title text-center">
                 <div class="section-sub-title-box">
                     <p class="section-sub-title">work process</p>
                     <div class="section-title-shape-1">
                         <img src="assets/images/shapes/section-title-shape-1.png" alt="">
                     </div>
                     <div class="section-title-shape-2">
                         <img src="assets/images/shapes/section-title-shape-2.png" alt="">
                     </div>
                 </div>
                 <h2 class="section-title__title">Our easy work process <br> in 4 steps</h2>
             </div>
             <div class="process__inner">
                 <div class="process-shape-1">
                     <img src="assets/images/shapes/process-shape-1.png" alt="">
                 </div>
                 <div class="row">
                     <!--Process Single Start-->
                     <div class="col-xl-3 col-lg-3 col-md-6">
                         <div class="process__single">
                             <div class="process__icon-box">
                                 <div class="process__icon">
                                     <span class="icon-select"></span>
                                 </div>
                                 <div class="process__count"></div>
                             </div>
                             <div class="process__content">
                                 <h3 class="process__title">Provide Refrence</h3>
                                 <p class="process__text">Provide the details of refrence</p>
                             </div>
                         </div>
                     </div>
                     <!--Process Single End-->
                     <!--Process Single Start-->
                     <div class="col-xl-3 col-lg-3 col-md-6">
                         <div class="process__single process__single-2">
                             <div class="process__icon-box">
                                 <div class="process__icon">
                                     <span class="icon-meeting"></span>
                                 </div>
                                 <div class="process__count"></div>
                             </div>
                             <div class="process__content">
                                 <h3 class="process__title">Documentation</h3>
                                 <p class="process__text">Hassle free way of documention physically & on email</p>
                             </div>
                         </div>
                     </div>
                     <!--Process Single End-->
                     <!--Process Single Start-->
                     <div class="col-xl-3 col-lg-3 col-md-6">
                         <div class="process__single process__single-3">
                             <div class="process__icon-box">
                                 <div class="process__icon">
                                     <span class="icon-agreement"></span>
                                 </div>
                                 <div class="process__count"></div>
                             </div>
                             <div class="process__content">
                                 <h3 class="process__title">Sanction & Disbursement</h3>
                                 <p class="process__text">Sanction & Disbursement of loans through our various channel partners</p>
                             </div>
                         </div>
                     </div>
                     <!--Process Single End-->
                     <!--Process Single Start-->
                     <div class="col-xl-3 col-lg-3 col-md-6">
                         <div class="process__single process__single-4">
                             <div class="process__icon-box">
                                 <div class="process__icon">
                                     <span class="icon-insurance-agent"></span>
                                 </div>
                                 <div class="process__count"></div>
                             </div>
                             <div class="process__content">
                                 <h3 class="process__title">Cradit of commission</h3>
                                 <p class="process__text">Cradit of commission will be post disbursement of loans</p>
                             </div>
                         </div>
                     </div>
                     <!--Process Single End-->
                 </div>
             </div>
         </div>
     </section>
     <!--Process End-->

     <!--Testimonial Two Start-->
     <!-- <section class="testimonial-two">
         <div class="testimonial-two-shape-1"
             style="background-image: url(assets/images/shapes/testimonial-two-shape-1.png);"></div>
         <div class="container">
             <div class="row">
                 <div class="col-xl-6">
                     <div class="testimonial-two__left">
                         <div class="section-title text-left">
                             <div class="section-sub-title-box">
                                 <p class="section-sub-title">testimonials</p>
                                 <div class="section-title-shape-1">
                                     <img src="assets/images/shapes/section-title-shape-1.png" alt="">
                                 </div>
                                 <div class="section-title-shape-2">
                                     <img src="assets/images/shapes/section-title-shape-2.png" alt="">
                                 </div>
                             </div>
                             <h2 class="section-title__title">What our happy customers are talking about our
                                 Loan company</h2>
                         </div>
                         <p class="testimonial-two__text">Pellentesque habitant morbi tristique senectus netus et
                             malesuada fames ac turp egestas. Aliquam viverra arcu. Donec aliquet blandit enim
                             feugiat mattis.</p>
                         <div class="testimonial-two__point-box">
                             <ul class="list-unstyled testimonial-two__point">
                                 <li>
                                     <div class="icon">
                                         <span class="icon-tick"></span>
                                     </div>
                                     <div class="text">
                                         <p>We promise to respect <br> your time</p>
                                     </div>
                                 </li>
                                 <li>
                                     <div class="icon">
                                         <span class="icon-tick"></span>
                                     </div>
                                     <div class="text">
                                         <p>We promise to provide <br> upfront pricing</p>
                                     </div>
                                 </li>
                             </ul>
                             <ul class="list-unstyled testimonial-two__point testimonial-two__point-two">
                                 <li>
                                     <div class="icon">
                                         <span class="icon-tick"></span>
                                     </div>
                                     <div class="text">
                                         <p>We hire professionals <br> you can trust</p>
                                     </div>
                                 </li>
                                 <li>
                                     <div class="icon">
                                         <span class="icon-tick"></span>
                                     </div>
                                     <div class="text">
                                         <p>We’re quick and reliable <br> Loan</p>
                                     </div>
                                 </li>
                             </ul>
                         </div>
                     </div>
                 </div>
                 <div class="col-xl-6">
                     <div class="testimonial-two__right">
                         <div class="owl-carousel owl-theme thm-owl__carousel testimonial-two__carousel"
                             data-owl-options='{
                             "loop": true,
                             "autoplay": true,
                             "margin": 0,
                             "nav": false,
                             "dots": true,
                             "smartSpeed": 500,
                             "autoplayTimeout": 10000,
                             "navText": ["<span class=\"fa fa-angle-left\"></span>","<span class=\"fa fa-angle-right\"></span>"],
                             "responsive": {
                                 "0": {
                                     "items": 1
                                 },
                                 "768": {
                                     "items": 1
                                 },
                                 "992": {
                                     "items": 1
                                 },
                                 "1200": {
                                     "items": 1
                                 }
                             }
                         }'>
                             <div class="testimonial-two__wrap">
                                 <div class="testimonial-two__single">
                                     <div class="testimonial-two__single-inner">
                                         <div class="testimonial-two-shape-2">
                                             <img src="assets/images/shapes/testimonial-two-shape-2.png" alt="">
                                         </div>
                                         <div class="testimonial-two__content-box">
                                             <h5 class="testimonial-two__client-name">Jessica Brown</h5>
                                             <p class="testimonial-two__text-2">Pellentesque habitant morbi tristique
                                                 senectus netus et malesuada fames ac turp egestas.</p>
                                         </div>
                                         <div class="testimonial-two__client-review">
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                         </div>
                                     </div>
                                     <div class="testimonial-two__founder-box">
                                         <div class="testimonial-two__founder">
                                             <p class="testimonial-two__founder-text">CEO & Co founder</p>
                                             <div class="testimonial-two__founder-shape">
                                                 <img src="assets/images/shapes/testimonial-two-founder-shape.png"
                                                     alt="">
                                             </div>
                                         </div>
                                         <div class="testimonial-two__client-img-box">
                                             <div class="testimonial-two__client-img">
                                                 <img src="assets/images/testimonial/testimonial-3-1.jpg" alt="">
                                             </div>
                                             <div class="testimonial-two__quote">
                                                 <img src="assets/images/testimonial/testimonial-1-quote.png" alt="">
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="testimonial-two__single">
                                     <div class="testimonial-two__single-inner">
                                         <div class="testimonial-two-shape-2">
                                             <img src="assets/images/shapes/testimonial-two-shape-2.png" alt="">
                                         </div>
                                         <div class="testimonial-two__content-box">
                                             <h5 class="testimonial-two__client-name">Smith Vectoria</h5>
                                             <p class="testimonial-two__text-2">Pellentesque habitant morbi tristique
                                                 senectus netus et malesuada fames ac turp egestas.</p>
                                         </div>
                                         <div class="testimonial-two__client-review">
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                         </div>
                                     </div>
                                     <div class="testimonial-two__founder-box">
                                         <div class="testimonial-two__founder">
                                             <p class="testimonial-two__founder-text">CEO & Co founder</p>
                                             <div class="testimonial-two__founder-shape">
                                                 <img src="assets/images/shapes/testimonial-two-founder-shape.png"
                                                     alt="">
                                             </div>
                                         </div>
                                         <div class="testimonial-two__client-img-box">
                                             <div class="testimonial-two__client-img">
                                                 <img src="assets/images/testimonial/testimonial-3-2.jpg" alt="">
                                             </div>
                                             <div class="testimonial-two__quote">
                                                 <img src="assets/images/testimonial/testimonial-1-quote.png" alt="">
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="testimonial-two__wrap">
                                 <div class="testimonial-two__single">
                                     <div class="testimonial-two__single-inner">
                                         <div class="testimonial-two-shape-2">
                                             <img src="assets/images/shapes/testimonial-two-shape-2.png" alt="">
                                         </div>
                                         <div class="testimonial-two__content-box">
                                             <h5 class="testimonial-two__client-name">Hallen Smith</h5>
                                             <p class="testimonial-two__text-2">Pellentesque habitant morbi tristique
                                                 senectus netus et malesuada fames ac turp egestas.</p>
                                         </div>
                                         <div class="testimonial-two__client-review">
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                         </div>
                                     </div>
                                     <div class="testimonial-two__founder-box">
                                         <div class="testimonial-two__founder">
                                             <p class="testimonial-two__founder-text">CEO & Co founder</p>
                                             <div class="testimonial-two__founder-shape">
                                                 <img src="assets/images/shapes/testimonial-two-founder-shape.png"
                                                     alt="">
                                             </div>
                                         </div>
                                         <div class="testimonial-two__client-img-box">
                                             <div class="testimonial-two__client-img">
                                                 <img src="assets/images/testimonial/testimonial-3-3.jpg" alt="">
                                             </div>
                                             <div class="testimonial-two__quote">
                                                 <img src="assets/images/testimonial/testimonial-1-quote.png" alt="">
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="testimonial-two__single">
                                     <div class="testimonial-two__single-inner">
                                         <div class="testimonial-two-shape-2">
                                             <img src="assets/images/shapes/testimonial-two-shape-2.png" alt="">
                                         </div>
                                         <div class="testimonial-two__content-box">
                                             <h5 class="testimonial-two__client-name">Kevin Martin</h5>
                                             <p class="testimonial-two__text-2">Pellentesque habitant morbi tristique
                                                 senectus netus et malesuada fames ac turp egestas.</p>
                                         </div>
                                         <div class="testimonial-two__client-review">
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                         </div>
                                     </div>
                                     <div class="testimonial-two__founder-box">
                                         <div class="testimonial-two__founder">
                                             <p class="testimonial-two__founder-text">CEO & Co founder</p>
                                             <div class="testimonial-two__founder-shape">
                                                 <img src="assets/images/shapes/testimonial-two-founder-shape.png"
                                                     alt="">
                                             </div>
                                         </div>
                                         <div class="testimonial-two__client-img-box">
                                             <div class="testimonial-two__client-img">
                                                 <img src="assets/images/testimonial/testimonial-3-4.jpg" alt="">
                                             </div>
                                             <div class="testimonial-two__quote">
                                                 <img src="assets/images/testimonial/testimonial-1-quote.png" alt="">
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="testimonial-two__wrap">
                                 <div class="testimonial-two__single">
                                     <div class="testimonial-two__single-inner">
                                         <div class="testimonial-two-shape-2">
                                             <img src="assets/images/shapes/testimonial-two-shape-2.png" alt="">
                                         </div>
                                         <div class="testimonial-two__content-box">
                                             <h5 class="testimonial-two__client-name">Jessica Brown</h5>
                                             <p class="testimonial-two__text-2">Pellentesque habitant morbi tristique
                                                 senectus netus et malesuada fames ac turp egestas.</p>
                                         </div>
                                         <div class="testimonial-two__client-review">
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                         </div>
                                     </div>
                                     <div class="testimonial-two__founder-box">
                                         <div class="testimonial-two__founder">
                                             <p class="testimonial-two__founder-text">CEO & Co founder</p>
                                             <div class="testimonial-two__founder-shape">
                                                 <img src="assets/images/shapes/testimonial-two-founder-shape.png"
                                                     alt="">
                                             </div>
                                         </div>
                                         <div class="testimonial-two__client-img-box">
                                             <div class="testimonial-two__client-img">
                                                 <img src="assets/images/testimonial/testimonial-3-1.jpg" alt="">
                                             </div>
                                             <div class="testimonial-two__quote">
                                                 <img src="assets/images/testimonial/testimonial-1-quote.png" alt="">
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="testimonial-two__single">
                                     <div class="testimonial-two__single-inner">
                                         <div class="testimonial-two-shape-2">
                                             <img src="assets/images/shapes/testimonial-two-shape-2.png" alt="">
                                         </div>
                                         <div class="testimonial-two__content-box">
                                             <h5 class="testimonial-two__client-name">Smith Vectoria</h5>
                                             <p class="testimonial-two__text-2">Pellentesque habitant morbi tristique
                                                 senectus netus et malesuada fames ac turp egestas.</p>
                                         </div>
                                         <div class="testimonial-two__client-review">
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                         </div>
                                     </div>
                                     <div class="testimonial-two__founder-box">
                                         <div class="testimonial-two__founder">
                                             <p class="testimonial-two__founder-text">CEO & Co founder</p>
                                             <div class="testimonial-two__founder-shape">
                                                 <img src="assets/images/shapes/testimonial-two-founder-shape.png"
                                                     alt="">
                                             </div>
                                         </div>
                                         <div class="testimonial-two__client-img-box">
                                             <div class="testimonial-two__client-img">
                                                 <img src="assets/images/testimonial/testimonial-3-2.jpg" alt="">
                                             </div>
                                             <div class="testimonial-two__quote">
                                                 <img src="assets/images/testimonial/testimonial-1-quote.png" alt="">
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section> -->
     <!--Testimonial Two End-->

     <!--News Two Start-->
     <section class="news-two">
         <div class="container">
             <div class="section-title text-center">
                 <div class="section-sub-title-box">
                     <p class="section-sub-title">recent news feed</p>
                     <div class="section-title-shape-1">
                         <img src="assets/images/shapes/section-title-shape-1.png" alt="">
                     </div>
                     <div class="section-title-shape-2">
                         <img src="assets/images/shapes/section-title-shape-2.png" alt="">
                     </div>
                 </div>
                 <h2 class="section-title__title">Latest news & articles <br> from the blog</h2>
             </div>
             <div class="row">
                 <!--News Two Single Start-->
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

   <script type="text/javascript">
        var rangeSlider = function(){
        var slider = $('.range-slider'),
            range = $('.range-slider__range'),
            value = $('.range-slider__value');
            
        slider.each(function(){

            value.each(function(){
            var value = $(this).prev().attr('value');
            $(this).html(value);
            });

            range.on('input', function(){
            $(this).next(value).html(this.value);
            });
        });
    };

    rangeSlider();
   </script>
    <script type="text/javascript">
    function get_generate_mobile_otp()
    {
        var mobile = $('#mobile').val();
        var hide_modal = 0;
        if(mobile.length != 10)
        {
          //$.growl.error({ title:"Error",message: "Please enter valid mobile."});
          $.notifyBar({ cssClass: "error", html: "Please enter valid mobile."});
        } 
        else 
        {
            var email = $('#email').val();
            if(email == "")
            {
                $.notifyBar({ cssClass: "error", html: "Please enter valid email."});
                return false;
            } 
            

            $('#generate_otp').attr("enabled","true");
            $.ajax(
            {
                url      : "<?php echo $base_url; ?>get-generate-otp.php",
                type     : "POST",
                data    : {"mobile":mobile,"email":email}, 
                dataType: 'json', 
                encode  : true,
                beforeSend: function(){
                    $.blockUI({ message: '<img id="loading-image" src="<?php echo $base_url_images;?>loading.gif" alt="Loading.."/>' });
                },
                success:function(data)
                {
                  $.unblockUI();
                  
                  if(data.status == 'success')
                  {
                      $('#generate_otp_button_div').css({"display":"none"});
                      $('#resend_otp_button_div').css({"display":"block"});
                      //timer_count();
                      $('#mobile_verification_status').html("");
                      $('#otp_verify_div').css({"display":"block"});
                      //$.growl.notice({ title:"Success",message: data.html_message });
                      $.notifyBar({ cssClass: "Success", html: data.html_message});
                      //$('#input_otp').val(data.generate_otp);
                      //$('select').select2();
                  }
                  else if(data.status == 'error')
                  {
                      $('#generate_otp_button_div').css({"display":"none"});
                      $('#resend_otp_button_div').css({"display":"block"}); 
                      //$.growl.error({ title:"Error",message: data.html_message });
                      $.notifyBar({ cssClass: "error", html: data.html_message});
                  }
                },
                error: function (error) 
                {
                    $.unblockUI();
                    //$.growl.error({ title:"Error",message:"Error occured: Please try again!" });
                    $.notifyBar({ cssClass: "error", html: "Error occured: Please try again!"});
                }
            });
        }   
    }
    function get_verify_mobile_otp()
    {
        var input_otp = $('#input_otp').val();
        var mobile = $('#mobile').val();
        var email = $('#email').val();
        
        $.ajax(
        {
            url      : "<?php echo $base_url; ?>get-verify-otp.php",
            type     : "POST",
            data    : {"input_otp":input_otp,"mobile":mobile,"email":email}, 
            dataType: 'json', 
            encode  : true,
            beforeSend: function(){
                $.blockUI({ message: '<img id="loading-image" src="<?php echo $base_url_images;?>loading.gif" alt="Loading.."/>' });
            },
            success:function(data)
            {
              $.unblockUI();
              
              if(data.status == 'success')
              {
                  $('#generate_otp_div').css({"display":"none"});
                  $('#otp_verify_div').css({"display":"none"});
                  $('#mobile').attr('readonly',true);
                  $('.btn-register').attr('disabled',false);
                  $('.btn-step').attr('disabled',false);
                  $('#resend_otp_button_div').css({"display":"none"});

                  
                  $('#mobile_verification_status').html(data.mobile_verification_status);
                  $('#mobile_verification_status').css({"color":"green",'font-size': '15px','width':'100px'});
                  //$.growl.notice({ title:"Success",message: data.html_message });
                  $.notifyBar({ cssClass: "Success", html: data.html_message});
                  //$('select').select2();
              }
              else
              {
                  //$.growl.error({ title:"Error",message: data.html_message });
                  $.notifyBar({ cssClass: "error", html: data.html_message});

                  $('#mobile_verification_status').html(data.mobile_verification_status);
                  $('#mobile_verification_status').css({"color":"#d40511",'font-size': '15px','width':'100px'});
                  
              }
            },
            error: function (error) 
            {
                $.unblockUI();
                    //$.growl.error({ title:"Error",message:"Error occured: Please try again!"});
                    $.notifyBar({ cssClass: "error", html: "Error occured: Please try again!"});

            }
        });
    }
    </script>
 </body>    
</html>