<?php include('common/config.php');
//error_reporting(0);

$theme_color = 'slate';         // This will be the default color before login,  change this color according to user display settings
$unique_key = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $company_title; ?> - Login</title>
    <?php include('common/header-css.php'); ?>
</head>

<body class="login-container">

<?php include('common/header.php'); ?>

<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <div class="content"> <!-- content Start -->
                <form method="POST" id="reset_password_form" data-parsley-validate>
                    <div class="panel panel-body login-form">
                        <div id="response_msg"></div>
                        <div class="text-center">
                            <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
                            <h5 class="content-group">Reset Password of your account
                                <small class="display-block">Enter your New Password</small>
                            </h5>
                            <input type="hidden" name="unique_key" id="unique_key" value="<?php echo $unique_key; ?>">
                        </div>

                        <div class="form-group has-feedback has-feedback-left">
                            <input type="password" name="password" id="password" class="form-control" placeholder="New Password" data-parsley-required="true" minlength="6">
                            <div class="form-control-feedback">
                                <i class="icon-lock2 text-muted"></i>
                            </div>
                        </div>

                        <div class="form-group has-feedback has-feedback-left">
                            <input type="password" name="re_password" id="re_password" placeholder="Confirm New Password" class="form-control" data-parsley-required="true"
                                   data-parsley-equalto="#password" minlength="6">

                            <div class="form-control-feedback">
                                <i class="icon-lock2 text-muted"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn bg-<?php echo $theme_color; ?> btn-block">Reset Password <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </div>
                </form>
                <?php include('common/footer.php'); ?>
            </div> <!-- content ent -->
        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->

<script src="<?php echo $base_url_js; ?>plugins/parsley/parsley.min.js"></script>
<script type="text/javascript">
    $(document).ready(function ()
    {
        $('#reset_password_form').parsley();
        $('#reset_password_form').on('submit', function (e)
        {
            e.preventDefault();
            var f = $(this);
            f.parsley().validate();
            if (f.parsley().isValid())
            {
                $.ajax(
                    {
                        url: "<?php echo $base_url;?>reset-password-submit.php",
                        type: "POST",
                        data: $('#reset_password_form').serialize(),
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
                                $('#reset_password_form').trigger("reset");
                                $('#reset_password_form').parsley().destroy();
                                $('#response_msg').html(data.html_message);
                                setTimeout(function ()
                                {
                                    window.location.href = '<?php echo $base_url;?>login';
                                }, 3000);
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

