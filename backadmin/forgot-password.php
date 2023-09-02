<?php include('common/config.php');
error_reporting(0);

$theme_color = 'slate';         // This will be the default color before login,  change this color according to user display settings
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $company_title; ?> - Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="<?php echo $base_url_global_assets; ?>css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $base_url_css; ?>bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $base_url_css; ?>bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $base_url_css; ?>layout.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $base_url_css; ?>components.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $base_url_css; ?>colors.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $base_url_css;?>parsley.css" rel="stylesheet" type="text/css">
    <script src="<?php echo $base_url_global_assets; ?>js/main/jquery.min.js"></script>
    <script src=".<?php echo $base_url_global_assets; ?>main/bootstrap.bundle.min.js"></script>
    <script src="<?php echo $base_url_global_assets; ?>js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="<?php echo $base_url_global_assets; ?>js/plugins/forms/styling/uniform.min.js"></script>

    <script src="<?php echo $base_url_js; ?>core/app.js"></script>
    <script src="<?php echo $base_url_global_assets; ?>js/demo_pages/login.js"></script>
</head>
<body class="login-container">
    <div class="navbar navbar-expand-md navbar-dark">
        <div class="navbar-brand">
            <a class="navbar-brand" href="<?php echo $base_url; ?>index" style="font-size:20px">
            <i class="icon-office"></i>

            <span style="font-size: 16px;margin-left: 15px"><?php echo $company_title; ?></span>
        </a>
        </div>

        <div class="d-md-none">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
                <i class="icon-tree5"></i>
            </button>
        </div>
    </div>
    <div class="page-content">
         <div class="content-wrapper">
            <div class="content d-flex justify-content-center align-items-center">

            <!-- Password recovery form -->
            <form class="login-form" method="POST" id="forgot_password_form" data-parsley-validate>
               <div class="card mb-0">
                  <div class="card-body">
                     <div class="text-center mb-3">
                        <i class="icon-spinner11 icon-2x text-warning border-warning border-3 rounded-round p-3 mb-3 mt-1"></i>
                        <h5 class="mb-0">Password recovery</h5>
                        <span class="d-block text-muted">We'll send you instructions in email</span>
                     </div>

                     <div class="form-group form-group-feedback form-group-feedback-right">
                        <input type="email" name="email" class="form-control" placeholder="Your email" data-type="email" data-parsley-required="true">
                        <div class="form-control-feedback">
                           <i class="icon-mail5 text-muted"></i>
                        </div>
                     </div>

                     <button type="submit" class="btn bg-blue btn-block"><i class="icon-spinner11 mr-2"></i> Reset password</button>
                     <a href="<?php echo $base_url; ?>" class="btn bg-success btn-block"><i class="icon-circle-right2 ml-2"></i> Sign in</a>
                  </div>
               </div>
            </form>
            <!-- /password recovery form -->

         </div>
            <?php include('common/footer.php'); ?>
        </div>
        <!-- /main content -->

   </div>
   <script src="<?php echo $base_url_js; ?>plugins/parsley/parsley.min.js"></script>
   <script type="text/javascript">
       $(document).ready(function ()
       {
           $('#forgot_password_form').parsley();
           $('#forgot_password_form').on('submit', function (e)
           {
               e.preventDefault();
               var f = $(this);
               f.parsley().validate();
               if (f.parsley().isValid())
               {
                   $.ajax(
                       {
                           url: "<?php echo $base_url;?>forgot-password-submit.php",
                           type: "POST",
                           data: $('#forgot_password_form').serialize(),
                           dataType: 'json',
                           encode: true,
                           beforeSend: function ()
                           {
                               $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url_images;?>loading.gif" alt="Loading.."/>'});
                           },
                           success: function (data)
                           {
                               $.unblockUI();
                               if (data.status == 'success')
                               {
                                   $('#forgot_password_form').trigger("reset");
                                   $('#forgot_password_form').parsley().destroy();
                                   $('#response_msg').html(data.html_message);
                               }
                               else
                               {
   //                                $.notifyBar({cssClass: "error", html: data.html_message});
                                   $('#response_msg').html(data.html_message);
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
   </script>
</body>
</html>

