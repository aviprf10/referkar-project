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
    <title>Track your reference | <?php echo $company_title;?></title>
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

    <!--Page Header Start-->
        <section class="page-header">
            <div class="page-header-bg" style="background-image: url(assets/images/backgrounds/page-header-bg.jpg)">
            </div>
            <div class="page-header-shape-1"><img src="assets/images/shapes/page-header-shape-1.png" alt=""></div>
            <div class="container">
                <div class="page-header__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="index.html">Home</a></li>
                        <li><span>/</span></li>
                        <li>Track your reference</li>
                    </ul>
                    <h2>Track your reference</h2>
                </div>
            </div>
        </section>
        <!--Page Header End-->

        <!--About Four Start-->
        <section class="about-four">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="search-popup__content" style="max-width: 100%;">
                           <form id="contact_form" method="POST" data-parsley-validate style="border-radius: 4px;">
                               <label for="search" class="sr-only">search here</label>
                               <input type="text" class="form-control" name="track_num" id="track_num" placeholder="Enter reference number..." style="border: 1px solid #b5afaf;" data-parsley-required="true">
                                
                               <button type="submit" aria-label="search submit" class="thm-btn">
                                   <i class="icon-magnifying-glass"></i>
                               </button>
                           </form>
                        </div>
                    </div>
                </div><br><br>
                <div class="row" id="history_dev">
                </div>    

            </div>
        </section>
       
   <?php include 'common/footer.php';?>
   <?php include 'common/footer-js.php';?>
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
                            url: "<?php echo $base_url; ?>track-refrence-num.php",
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
                                    $('#history_dev').html(data.html_message);
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