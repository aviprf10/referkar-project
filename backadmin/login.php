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
    <!-- /main navbar -->


    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content d-flex justify-content-center align-items-center">

                <!-- Login form -->
                <form class="login-form" method="POST" id="login_form" data-parsley-validate>
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                                <h5 class="mb-0">Login to your account</h5>
                                <span class="d-block text-muted">Enter your credentials below</span>
                            </div>

                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="email" class="form-control" placeholder="Enter Email" name="email" id="email" data-parsley-required="true">
                                <div class="form-control-feedback">
                                    <i class="icon-user text-muted"></i>
                                </div>
                            </div>

                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="password" class="form-control" placeholder="Enter Password" name="password" id="password" data-parsley-required="true">
                                <div class="form-control-feedback">
                                    <i class="icon-lock2 text-muted"></i>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 ml-2"></i></button>
                            </div>

                            <div class="text-center">
                                <a href="<?php echo $base_url;?>forgot-password">Forgot password?</a>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- /login form -->

            </div>
            <?php include('common/footer.php'); ?>
        </div>
        <!-- /main content -->

    </div>
<script src="<?php echo $base_url_js; ?>plugins/parsley/parsley.min.js"></script>
<script type="text/javascript">
    $(document).ready(function ()
    {
        $('#login_form').parsley();
        $('#login_form').on('submit', function (e)
        {
            e.preventDefault();
            var f = $(this);
            f.parsley().validate();
            if (f.parsley().isValid())
            {
                $.ajax(
                    {
                        url: "<?php echo $base_url;?>login-submit.php",
                        type: "POST",
                        data: $('#login_form').serialize(),
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
                                if (data.page != '')
                                {
                                    window.location.href = '<?php echo $base_url;?>' + data.page;
                                    $('#response_msg').html(data.html_message);
                                }
                                else
                                {
                                    //$('#login_form').trigger("reset");
                                    //$('#response_msg').html(data.html_message);
                                }
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

