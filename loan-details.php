<?php
include "common/config.php";    
include "common/check_login.php";
include "common/common_code.php";

$urlb = $base_url.'loan-details/'.$sub_service_unique_slug;
$title=urlencode($sub_service_name);
$url=urlencode($urlb);
$image=urlencode($services_image);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title><?php echo $meta_title; ?> | <?php echo $company_title;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:keyword" content="<?php echo $meta_keyword;?>" />
    <meta property="og:title" content="<?php echo $meta_title;?>" />
    <meta property='og:image' content="<?php echo $services_image; ?>"/>
    <meta property="og:description" content="<?php echo $meta_description;?>" />
    <meta name="robots" content="noindex, follow" />
    <link rel="icon" href="<?php echo $base_url_images; ?>fevicon.png" sizes="32x32" />
    <link rel="icon" href="<?php echo $base_url_images; ?>fevicon.png" sizes="192x192" />
    <link rel="apple-touch-icon" href="<?php echo $base_url_images; ?>fevicon.png" />
    <meta name="msapplication-TileImage" content="<?php echo $base_url_images; ?>fevicon.png" />
    <?php include "common/header-css.php";?>
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
                width: 86%; 
                float:left
            }

            #input_otp{
                width:88%; 
                float:left
            }

        }    
    </style>
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
                    <li><?php echo $sub_service_name; ?> details</li>
                </ul>
                <h2><?php echo ucfirst($sub_service_name); ?> details</h2>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <!--News Details Start-->
    <section class="news-details">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="news-details__left">
                        <div class="news-details__img">
                            <img src="<?php echo $services_image ?>" alt="">
                        </div>
                        <div class="news-details__content">
                            <ul class="list-unstyled news-details__meta">
                                <li><a href="<?php echo $base_url; ?>blog-details"><i class="far fa-calendar"></i> <?php echo date('j F, Y', strtotime($created_on)); ?>  </a>
                                </li>
                                <!-- <li><a href="<?php echo $base_url; ?>blog-details"><i class="far fa-comments"></i> 02 Comments</a>
                                </li> -->
                            </ul>
                            <h3 class="news-details__title"><?php echo ucfirst($sub_service_name); ?></h3>
                            <p class="news-details__text-1"><?php echo html_entity_decode($full_description); ?></p>
                        </div>
                        <div class="news-details__bottom">
                            <p class="news-details__tags">
                                <span>Tags</span>
                                <?php 
                                $keyword = explode(',', $meta_keyword);
                                foreach($keyword as $value){
                                ?>
                                <a href="#"><?php echo $value; ?></a>
                                <?php } ?>
                            </p>
                            <div class="news-details__social-list">
                                <a onClick="window.open('http://twitter.com/intent/tweet?url=<?php echo $url;?>','sharer','toolbar=0,status=0,width=600,height=400');" href="javascript: void(0) "target="_parent" itle="Twitter"><i class="fab fa-twitter"></i></a>
                                <a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title;?>&amp;p[url]=<?php echo $url; ?>&amp;&p[images][0]=<?php echo $image;?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');" target="_parent" href="javascript: void(0)" itle="Facebook"><i class="fab fa-facebook"></i></a>
                                <a href="javascript:void(0)" onclick="window.open( 'http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $url; ?>', 'sharer', 'toolbar=0, status=0, width=626, height=436');return false;" target="_parent"  title="Linkedin"><i class="fab fa-linkedin"></i></a>
                                <a href="javascript:void(0)" onclick="window.open( 'https://www.instagram.com/?url=<?php echo $url; ?>', 'sharer', 'toolbar=0, status=0, width=626, height=436');return false;" title="Instagram" target="_parent"><i class="fab fa-instagram"></i></a>
                                <a href="http://pinterest.com/pin/create/button/?url=<?php echo $url; ?>&media=<?php echo $services_image ?>&description=<?php echo $sort_description; ?>"  title="Pinterest" target="_blank"><i class="fab fa-pinterest-p"></i></a>
                            </div>
                        </div>
                        <div class="comment-one">
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

                                                    <span class="help-inline" id="resend_otp_button_div" style="display: none;float: right;"><input type="button" onclick="get_generate_mobile_otp()"  style="padding: 14px 29px 14px; float: right;" class="thm-btn get-insuracne-two__btne" name="resend" value="Resend OTP"></span>
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
                                                     <option value="<?php echo $id; ?>" selected><?php echo $sub_service_name; ?></option>
                                                    
                                                 </select>
                                             </div>
                                        </div>
                                    </div>         
                                 </div>
                                 
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
    </section>
   <?php include 'common/footer.php';?>
   <?php include 'common/footer-js.php';?>
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

    function share_fb(url) {
          window.open('https://www.facebook.com/sharer/sharer.php?u='+url,'facebook-share-dialog',"width=626, height=436")
        }
    </script>
 </body>    
</html>