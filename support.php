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
    <title>Our Support | <?php echo $company_title;?></title>
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
        <div class="page-header-bg" style="background-image: url(assets/images/backgrounds/page-header-bg.jpg)">
        </div>
        <div class="page-header-shape-1"><img src="assets/images/shapes/page-header-shape-1.png" alt=""></div>
        <div class="container">
            <div class="page-header__inner">
                <ul class="thm-breadcrumb list-unstyled">
                    <li><a href="index.html">Home</a></li>
                    <li><span>/</span></li>
                    <li>Support</li>
                </ul>
                <h2>Support</h2>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <!--Contact Page Start-->
    <section class="contact-page">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-5">
                    <div class="contact-page__left">
                        <div class="section-title text-left">
                            <div class="section-sub-title-box">
                                <p class="section-sub-title">Contact us</p>
                                <div class="section-title-shape-1">
                                    <img src="assets/images/shapes/section-title-shape-1.png" alt="">
                                </div>
                                <div class="section-title-shape-2">
                                    <img src="assets/images/shapes/section-title-shape-2.png" alt="">
                                </div>
                            </div>
                            <h2 class="section-title__title">Feel free to get in touch with experts</h2>
                        </div>
                        <div class="contact-page__call-email">
                            <div class="contact-page__call-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="contact-page__call-email-content" <?php if(!empty($company_mobile) && empty($company_mobile2)){ ?> style="padding-top: 12px;" <?php } ?>>
                                <h4>
                                    <a href="tel:<?php echo $company_mobile; ?>" class="contact-page__call-number" style="float:left;">+91 <?php echo $company_mobile; ?></a>
                                    <?php if(!empty($company_mobile2)){?> 
                                      <span style="color:#ea9914">, </span> <a href="tel:<?php echo $company_mobile2; ?>" class="contact-page__call-number">+91 <?php echo $company_mobile2; ?></a>
                                    <?php } ?>
                                </h4>
                            </div>
                        </div><br>
                        <div class="contact-page__call-email">
                            <div class="contact-page__call-icon">
                                <i class="fa fa-envelope"></i>
                            </div>
                            <div class="contact-page__call-email-content" <?php if(!empty($company_email) && empty($company_email2)){ ?> style="padding-top: 12px;" <?php } ?>>
                                <h4>
                                    <a href="mailto:<?php echo $company_email; ?>" class="contact-page__email" style="float:left;"><?php echo $company_email; ?></a>
                                    <?php if(!empty($company_email2)){?> 
                                      <span style="color:#ea9914">, </span> <a href="mailto:<?php echo $company_email2; ?>" class="contact-page__email"><?php echo $company_email2; ?></a>
                                    <?php } ?>
                                </h4>
                            </div>
                        </div><br>
                        <div class="contact-page__call-email">
                            <div class="contact-page__call-icon">
                                <i class="fa fa-map-marker"></i>
                            </div>
                            <div class="contact-page__call-email-content" <?php if(!empty($company_address) && empty($company_address2)){ ?> style="padding-top: 12px;" <?php } ?>>
                                <h4>
                                    <p style="float:left;" class="contact-page__email"><?php echo $company_address; ?></p>
                                    <?php if(!empty($company_address2)){?> 
                                      <span style="color:#ea9914">, </span> <p class="contact-page__email"><?php echo $company_address2; ?></p>
                                    <?php } ?>
                                    <?php if(!empty($city)){?> 
                                        <p class="contact-page__email" style="float:left;"><?php echo $city; ?><span style="color:#ea9914">, &nbsp;</span></p> 
                                    <?php } ?>
                                    <?php if(!empty($state)){?> 
                                       <p class="contact-page__email" style="float:left;"><?php echo $state; ?><span style="color:#ea9914">- </span></p>  
                                        <p class="contact-page__email" style="float:left;"><?php echo $pincode; ?></p>
                                    <?php } ?>
                                    <?php if(!empty($country)){?> 
                                      <p class="contact-page__email"><?php echo $country; ?></p>
                                    <?php } ?>
                                </h4>
                            </div>
                        </div>

                        <p class="contact-page__location-text">Follow us:</p>
                        <div class="site-footer__social" style="margin-top: 8px;">
                           <a href="<?php echo $twitter_link;?>" target="_blank" style="color: #ea9914;"><i class="fab fa-twitter"></i></a>
                           <a href="<?php echo $facebook_link;?>" target="_blank" style="color: #ea9914;"><i class="fab fa-facebook"></i></a>
                           <a href="<?php echo $pintrest_link;?>" target="_blank" style="color: #ea9914;"><i class="fab fa-pinterest-p"></i></a>
                           <a href="<?php echo $linkedin_link;?>" target="_blank" style="color: #ea9914;"><i class="fab fa-linkedin"></i></a>
                           <a href="<?php echo $insta_link;?>" target="_blank" style="color: #ea9914;"><i class="fab fa-instagram"></i></a>
                           <a href="<?php echo $skype_link;?>" target="_blank" style="color: #ea9914;"><i class="fab fa-skype"></i></a>
                       </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-7">
                    <div class="contact-page__right">
                        <div class="contact-page__form">
                            <form id="contact_form" method="POST" data-parsley-validate class="comment-one__form contact-form-validated">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="comment-form__input-box">
                                            <input name="nametext" placeholder="Name*" type="text"  data-parsley-required="true">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="comment-form__input-box">
                                            <input name="emailtext" placeholder="Email*" type="email" data-parsley-required="true" data-parsley-type="email">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="comment-form__input-box">
                                            <input type="text" placeholder="Phone number" maxlength="10" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="mobile" data-parsley-required="true" >
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="comment-form__input-box">
                                            <input type="text" placeholder="Subject" name="subjecttext">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="comment-form__input-box text-message-box">
                                            <textarea name="message_text" placeholder="Write a message*" data-parsley-required="true" ></textarea>
                                        </div>
                                        <div class="comment-form__btn-box">
                                            <button type="submit" class="thm-btn comment-form__btn">Send a Message</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Contact Page End-->

    <!--CTA One Start-->
    <section class="cta-one cta-three">
        <div class="container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d241317.11647807498!2d72.74075526143301!3d19.082197578879484!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c6306644edc1%3A0x5da4ed8f8d648c69!2sMumbai%2C%20Maharashtra!5e0!3m2!1sen!2sin!4v1660553353955!5m2!1sen!2sin" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>
   <?php include 'common/footer.php';?>
   <?php include 'common/footer-js.php';?>
    <script src="<?php echo $base_url_js; ?>plugins/plugins/parsley/parsley.min.js"></script>
    <script type="text/javascript" src="<?php echo $base_url_js;?>plugins/plugins/loaders/blockui.min.js"></script>
    <script src="<?php echo $base_url_js;?>plugins/plugins/notifybar/jquery.notifyBar.js"></script>
    <script type="text/javascript">
        $(document).ready(function ()
        {

            $('#contact_form').parsley();
            $('#contact_form').on('submit', function (e)
            {

                e.preventDefault();
                var f = $(this);
                f.parsley().validate();
                if (f.parsley().isValid())
                {
                    $.ajax(
                        {
                            url: "<?php echo $base_url; ?>contact-form-submit.php",
                            type: "POST",
                            data: $('#contact_form').serialize(),
                            dataType: 'json',
                            encode: true,
                            beforeSend: function ()
                            {
                                $.blockUI({message: '<img src="<?php echo $base_url_images;?>loading-old.gif" alt="Loading.."/>'});
                            },
                            success: function (data)
                            {

                                $.unblockUI();
                                if (data.status == 'success')
                                {
                                    $('#contact_form').trigger("reset");
                                    $.notifyBar({cssClass: "success", html: data.html_message});
                                    //dataTable.ajax.reload();
                                }
                                else
                                {
                                    $.notifyBar({cssClass: "error", html: data.html_message});
                                    //dataTable.ajax.reload();
                                }
                            },
                            error: function (data, errorThrown)
                            {
                                $.unblockUI();
                                $.notifyBar({cssClass: "error", html: "Error occured!"});
                            }

                        });

                }
                else
                {
                    e.preventDefault();
                }

            });

        });



        $("#contact_form").click(function ()
        {

            $('#contact_form').parsley().destroy();
        });



    </script>
 </body>    
</html>