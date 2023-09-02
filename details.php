<?php
include "common/config.php";    
include "common/check_login.php";
include "common/common_code.php";

$title = $_GET['title'];
$servicesdetails_data_array = array();
$get_servicesdetails_query = "SELECT * FROM `sub_service` where sub_service_unique_slug='$title' and is_deleted='0' and status='1'";
$result_get_servicesdetails_query = mysqli_query($db_mysqli, $get_servicesdetails_query);
while ($row_get_servicesdetails_query = mysqli_fetch_assoc($result_get_servicesdetails_query))
{
    $servicesdetails_data_array[] = $row_get_servicesdetails_query;
}
 
if(count($servicesdetails_data_array) > 0)
{
    $service_data_array = array();
    $get_service_query = "SELECT * FROM `sub_service` where service_id='1' and is_deleted='0' and status='1'";
    $result_get_service_query = mysqli_query($db_mysqli, $get_service_query);
    while ($row_get_service_query = mysqli_fetch_assoc($result_get_service_query))
    {
        $service_data_array[] = $row_get_service_query;
    } 

    $title = $_GET['title'];

    $servicesdetails_data_array = array();
    $get_servicesdetails_query = "SELECT * FROM `sub_service` where sub_service_unique_slug='$title' and is_deleted='0' and status='1'";
    $result_get_servicesdetails_query = mysqli_query($db_mysqli, $get_servicesdetails_query);
    while ($row_get_servicesdetails_query = mysqli_fetch_assoc($result_get_servicesdetails_query))
    {
        $servicesdetails_data_array[] = $row_get_servicesdetails_query;
    }

    $id =  $servicesdetails_data_array[0]['id'];
    $service_id =  $servicesdetails_data_array[0]['service_id'];
    $id =  $servicesdetails_data_array[0]['id'];
    $sub_service_name =  $servicesdetails_data_array[0]['sub_service_name'];
    $sub_service_unique_slug =  $servicesdetails_data_array[0]['sub_service_unique_slug'];
    $service_image =  $servicesdetails_data_array[0]['service_image'];
    $sort_description =  $servicesdetails_data_array[0]['sort_description'];
    $full_description =  $servicesdetails_data_array[0]['full_description'];
    $meta_title =  $servicesdetails_data_array[0]['meta_title'];
    $meta_keyword =  $servicesdetails_data_array[0]['meta_keyword'];
    $meta_description =  $servicesdetails_data_array[0]['meta_description'];
    $created_on =  $servicesdetails_data_array[0]['created_on'];
    $services_image = $base_url_uploads.'services-images/temp_file/'.$servicesdetails_data_array[0]['service_image'];

    $urlb = $base_url.$sub_service_unique_slug;
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
<?php
}
else 
{

    $service_data_array = array();
    $get_service_query = "SELECT * FROM `sub_service` where service_id='1' and is_deleted='0' and status='1'";
    $result_get_service_query = mysqli_query($db_mysqli, $get_service_query);
    while ($row_get_service_query = mysqli_fetch_assoc($result_get_service_query))
    {
        $service_data_array[] = $row_get_service_query;
    } 

    $title = $_GET['title'];

    $blogsdetails_data_array = array();
    $get_blogsdetails_query = "SELECT * FROM `blogs` where blog_url='$title' and is_deleted='0' and status='1'";
    $result_get_blogsdetails_query = mysqli_query($db_mysqli, $get_blogsdetails_query);
    while ($row_get_blogsdetails_query = mysqli_fetch_assoc($result_get_blogsdetails_query))
    {
        $blogsdetails_data_array[] = $row_get_blogsdetails_query;
    }

    $id =  $blogsdetails_data_array[0]['id'];
    $category_id =  $blogsdetails_data_array[0]['category_id'];
    $subcategory_id =  $blogsdetails_data_array[0]['subcategory_id'];
    $service_id =  $blogsdetails_data_array[0]['service_id'];
    $service_sub_id =  $blogsdetails_data_array[0]['service_sub_id'];
    $blog_name =  $blogsdetails_data_array[0]['blog_name'];
    $blog_url =  $blogsdetails_data_array[0]['blog_url'];
    $sort_description =  $blogsdetails_data_array[0]['sort_description'];
    $full_description =  $blogsdetails_data_array[0]['full_description'];
    $meta_title =  $blogsdetails_data_array[0]['meta_title'];
    $meta_keyword =  $blogsdetails_data_array[0]['meta_keyword'];
    $meta_description =  $blogsdetails_data_array[0]['meta_description'];
    $created_on =  $blogsdetails_data_array[0]['created_on'];
    $blog_image = $base_url_uploads.'blog-images/temp_file/'.$blogsdetails_data_array[0]['blog_image'];

    $servicecat_data_array = array();
    $get_servicecat_query = "SELECT * FROM `sub_service` where service_id='1' and is_deleted='0' and status='1' order by id DESC limit 7";
    $result_get_servicecat_query = mysqli_query($db_mysqli, $get_servicecat_query);
    while ($row_get_servicecat_query = mysqli_fetch_assoc($result_get_servicecat_query))
    {
        $servicecat_data_array[] = $row_get_servicecat_query;
    } 

    $urlb = $base_url.$blog_url;
    $title=urlencode($meta_title);
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
    <meta property='og:image' content="<?php echo $blog_image; ?>"/>
    <meta property="og:description" content="<?php echo $meta_description;?>" />
    <meta name="robots" content="noindex, follow" />
    <link rel="icon" href="<?php echo $base_url_images; ?>fevicon.png" sizes="32x32" />
    <link rel="icon" href="<?php echo $base_url_images; ?>fevicon.png" sizes="192x192" />
    <link rel="apple-touch-icon" href="<?php echo $base_url_images; ?>fevicon.png" />
    <meta name="msapplication-TileImage" content="<?php echo $base_url_images; ?>fevicon.png" />
    <?php include "common/header-css.php";?>
    <style>
        a {
            color: #f1c40f;
        }

        a:hover,
        a:active,
        a:focus {
            color: #dab10d;
        }

        .rating-stars {
            width: 100%;
            text-align: center;
        }

        .rating-stars .rating-stars-container {
            font-size: 0px;
        }

        .rating-stars .rating-stars-container .rating-star {
            display: inline-block;
            font-size: 17px;
            color: #555555;
            cursor: pointer;
            padding: 5px 10px;
        }

        .rating-stars .rating-stars-container .rating-star.is--active,
        .rating-stars .rating-stars-container .rating-star.is--hover {
            color: #f1c40f;
        }

        .rating-stars .rating-stars-container .rating-star.is--no-hover {
            color: #555555;
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
                    <li><?php echo $blog_name; ?></li>
                </ul>
                <h2><?php echo ucfirst($blog_name); ?> details</h2>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <!--News Details Start-->
    <section class="news-details">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7">
                    <div class="news-details__left">
                        <div class="news-details__img">
                            <img src="<?php echo $blog_image ?>" alt="">
                        </div>
                        <div class="news-details__content">
                            <ul class="list-unstyled news-details__meta">
                                <li><a href="#"><i class="far fa-calendar"></i> <?php echo date('j F, Y', strtotime($created_on)); ?> </a>
                                </li>
                                <!-- <li><a href="<?php echo $base_url; ?>blog-details"><i class="far fa-comments"></i> 02 Comments</a>
                                </li> -->
                            </ul>
                            <h3 class="news-details__title"><?php echo ucfirst($blog_name); ?></h3>
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
                        <!-- <div class="blgo-details__pagenation-box">
                            <ul class="list-unstyled news-details__pagenation">
                                <li>We proudly protect our loved ones life</li>
                                <li>Survived not only five centuries</li>
                            </ul>
                        </div> -->
                        <!-- <div class="comment-one">
                            <h3 class="comment-one__title">2 comments</h3>
                            <div class="comment-one__single">
                                <div class="comment-one__image">
                                    <img src="<?php echo $base_url_images ?>blog/comment-1-1.jpg" alt="">
                                </div>
                                <div class="comment-one__content">
                                    <h3>Kevin Martin</h3>
                                    <p>Mauris non dignissim purus, ac commodo diam. Donec sit amet lacinia nulla. Aliquam quis purus in justo pulvinar tempor. Aliquam tellus nulla, sollicitudin at euismod.</p>
                                    <a href="<?php echo $base_url; ?>blog-details" class="thm-btn comment-one__btn">Reply</a>
                                </div>
                            </div>
                            <div class="comment-one__single">
                                <div class="comment-one__image">
                                    <img src="<?php echo $base_url_images ?>blog/comment-1-2.jpg" alt="">
                                </div>
                                <div class="comment-one__content">
                                    <h3>Sarah Albert</h3>
                                    <p>Mauris non dignissim purus, ac commodo diam. Donec sit amet lacinia nulla. Aliquam quis purus in justo pulvinar tempor. Aliquam tellus nulla, sollicitudin at euismod.</p>
                                    <a href="<?php echo $base_url; ?>blog-details" class="thm-btn comment-one__btn">Reply</a>
                                </div>
                            </div>
                        </div> -->
                        <div class="comment-form">
                            <h3 class="comment-form__title">Leave a comment</h3>
                            <form id="contact_form" method="POST" data-parsley-validate class="comment-one__form contact-form-validated">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="comment-form__input-box">
                                            <input type="text" placeholder="Your name" name="textname" data-parsley-required="true">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="comment-form__input-box">
                                            <input type="email" placeholder="Email address" name="textemail" data-parsley-required="true">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="comment-form__input-box text-message-box">
                                            <textarea name="textmessage" placeholder="Write a comment" data-parsley-required="true"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="rating-stars block" style="padding-bottom: 11px;">
                                            <input type="hidden" readonly="readonly" class="form-control rating-value" name="rating_stars" id="rating-stars-value">
                                            <div class="rating-stars-container" style="text-align: left;">
                                                <div class="rating-star">
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <div class="rating-star">
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <div class="rating-star">
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <div class="rating-star">
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <div class="rating-star">
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>    
                                </div>    
                                <div class="row">
                                    <div class="comment-form__btn-box">
                                        <button type="submit" class="thm-btn comment-form__btn">Submit comment</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="sidebar">
                        <!-- <div class="sidebar__single sidebar__search">
                            <form action="#" class="sidebar__search-form">
                                <input type="search" placeholder="Search here">
                                <button type="submit"><i class="icon-magnifying-glass"></i></button>
                            </form>
                        </div> -->
                        <?php
                        $blogscat_data_array = array();
                        $get_blogscat_query = "SELECT * FROM `blogs` where service_id='$service_id' and id!='$id' and is_deleted='0' and status='1'";
                        $result_get_blogscat_query = mysqli_query($db_mysqli, $get_blogscat_query);
                        while ($row_get_blogscat_query = mysqli_fetch_assoc($result_get_blogscat_query))
                        {
                            $blogscat_data_array[] = $row_get_blogscat_query;
                        } 

                        if(count($blogscat_data_array) > 0){ 
                        ?>
                        <div class="sidebar__single sidebar__post">
                            <h3 class="sidebar__title">Latest Posts</h3>
                            <ul class="sidebar__post-list list-unstyled">
                                <?php
                                    foreach($blogscat_data_array as $blogscat_data){
                                ?>
                                <li>
                                    <div class="sidebar__post-image">
                                        <img src="<?php echo $base_url_images ?>blog/lp-1-1.jpg" alt="">
                                    </div>
                                    <div class="sidebar__post-content">
                                        <h3>
                                            <span class="sidebar__post-content-meta"><i class="far fa-user-circle"></i> by Admin</span>
                                            <a href="<?php echo $base_url; ?>blog-details">Get tips to get quick
                                                life insurance</a>
                                        </h3>
                                    </div>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php } ?>
                    <?php 
                         if(count($servicecat_data_array) > 0){
                        ?>
                        <div class="sidebar__single sidebar__category">
                            <h3 class="sidebar__title">Services</h3>
                            <ul class="sidebar__category-list list-unstyled">
                                <?php
                                      foreach($servicecat_data_array as $servicecat_data){ 
                                ?>
                                <li><a href="<?php echo $base_url ?><?php echo $servicecat_data['sub_service_unique_slug']; ?>"><?php echo $servicecat_data['sub_service_name']; ?><span class="fas fa-angle-double-right"></span></a></li>
                                <?php } ?>

                            </ul>
                        </div>
                    <?php } ?>    
                        <div class="sidebar__single sidebar__tags">
                            <h3 class="sidebar__title">Tags</h3>
                            <div class="sidebar__tags-list">
                                <?php 
                                $keyword = explode(',', $meta_keyword);
                                foreach($keyword as $value){
                                ?>
                                <a href="#"><?php echo $value; ?></a>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- <div class="sidebar__single sidebar__comments">
                            <h3 class="sidebar__title">Comments</h3>
                            <ul class="sidebar__comments-list list-unstyled">
                                <li>
                                    <div class="sidebar__comments-icon">
                                        <i class="fas fa-comment"></i>
                                    </div>
                                    <div class="sidebar__comments-text-box">
                                        <p>A Wordpress Commenter <br> on Launch New Mobile App</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar__comments-icon">
                                        <i class="fas fa-comment"></i>
                                    </div>
                                    <div class="sidebar__comments-text-box">
                                        <p><span>John Doe</span> on Template:</p>
                                        <h5>Comments</h5>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar__comments-icon">
                                        <i class="fas fa-comment"></i>
                                    </div>
                                    <div class="sidebar__comments-text-box">
                                        <p>A Wordpress Commenter <br> on Launch New Mobile App</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar__comments-icon">
                                        <i class="fas fa-comment"></i>
                                    </div>
                                    <div class="sidebar__comments-text-box">
                                        <p> <span>John Doe</span> on Template:</p>
                                        <h5>Comments</h5>
                                    </div>
                                </li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include 'common/footer.php';?>
    <?php include 'common/footer-js.php';?>
    <script src="<?php echo $base_url_js; ?>plugins/plugins/parsley/parsley.min.js"></script>
    <script type="text/javascript" src="<?php echo $base_url_js;?>plugins/plugins/loaders/blockui.min.js"></script>
    <script src="<?php echo $base_url_js;?>plugins/plugins/notifybar/jquery.notifyBar.js"></script>
    <script src="<?php echo $base_url_js; ?>jquery.rating-stars.min.js"></script>
    <script>
        var ratingOptions = {
            selectors: {
                starsSelector: '.rating-stars',
                starSelector: '.rating-star',
                starActiveClass: 'is--active',
                starHoverClass: 'is--hover',
                starNoHoverClass: 'is--no-hover',
                targetFormElementSelector: '.rating-value'
            }
        };

        $(".rating-stars").ratingStars(ratingOptions);

        $(".rating-stars").on("ratingChanged", function (ev, data) {
            $("#ratingChanged").html(data.ratingValue);
        });

        $(".rating-stars").on("ratingOnEnter", function (ev, data) {
            $("#ratingOnEnter").html(data.ratingValue);
        });

        $(".rating-stars").on("ratingOnLeave", function (ev, data) {
            $("#ratingOnLeave").html(data.ratingValue);
        });
    </script>
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
                            url: "<?php echo $base_url; ?>comment-form-submit.php",
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
                                    setTimeout(function ()
                                    {
                                        location.reload();
                                    }, 2000);
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
<?php } ?>