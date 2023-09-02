<?php
include 'common/config.php';
include 'common/check_login.php';
if ($admin == 1)
{
    if (1 == 1)
    {
        $module_full_name = 'Account Settings';
        $module_short_name = 'Account Settings';
        $module_name = 'account-settings';

        $get_user_query = "SELECT * FROM user WHERE id='$loggedin_user_id'";

        $result_get_user_query = mysqli_query($db_mysqli, $get_user_query);
        $all_user_data_array = array();
        while ($row_get_user_query = mysqli_fetch_assoc($result_get_user_query))
        {
            $all_user_data_array[] = $row_get_user_query;
        }
    ?> 
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $company_title; ?>  - Add <?php echo $module_full_name; ?></title>
        <?php include('common/header-css.php'); ?>
        <style>
        table#all-<?php echo $module_name; ?>-table tr td:first-child{display:none;}
        table#all-<?php echo $module_name; ?>-table th:first-child{display:none;} 
        <?php if($page_layout == 1){ ?>
        .page-title 
        {
            padding: 15px 36px 15px 0;
        }     
        .content:first-child
        {
            padding-top: 2px;
        }

        .heading-elements > a
        {
            padding: 7px 15px;
        }
        <?php } ?>
    </style>
    </head>
    <body>
    <?php include('common/header.php'); ?> 
    <?php include('common/side-menu.php'); ?>
    <div class="content-wrapper">
        <!-- Page header -->
        <div class="page-header page-header-light">
            <!-- <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                    <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Dashboard</h4>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>

                <div class="header-elements d-none">
                    <div class="d-flex justify-content-center">
                        <a href="#" class="btn btn-link btn-float text-default"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
                        <a href="#" class="btn btn-link btn-float text-default"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
                        <a href="#" class="btn btn-link btn-float text-default"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
                    </div>
                </div>
            </div> -->

            <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                <div class="d-flex">
                    <div class="breadcrumb">
                        <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                        <span class="breadcrumb-item active">Add <?php echo $module_full_name; ?></span>
                    </div>

                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>

                <!-- <div class="header-elements d-none">
                    <div class="breadcrumb justify-content-center">
                        <a href="#" class="breadcrumb-elements-item">
                            <i class="icon-comment-discussion mr-2"></i>
                            Support
                        </a>

                        <div class="breadcrumb-elements-item dropdown p-0">
                            <a href="#" class="breadcrumb-elements-item dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-gear mr-2"></i>
                                Settings
                            </a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="#" class="dropdown-item"><i class="icon-user-lock"></i> Account security</a>
                                <a href="#" class="dropdown-item"><i class="icon-statistics"></i> Analytics</a>
                                <a href="#" class="dropdown-item"><i class="icon-accessibility"></i> Accessibility</a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item"><i class="icon-gear"></i> All settings</a>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
        <!-- /page header -->

        <!-- Content area -->
        <div class="content"> <!-- content Start -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php if($admin == 1 || ($sub_admin == 1 && $is_country_write == 1)){?> 
                            <div class="heading-elements" style="float: right;">
                                <!--  <a href="<?php echo $base_url; ?>view-<?php echo $module_name; ?>">
                                    <button type="button"
                                            class="btn bg-<?php echo $theme_color; ?> heading-btn">
                                        <i class="icon-file-plus position-left"></i>
                                        View <?php echo $module_full_name; ?>
                                    </button>
                                </a> --><br><br>
                            </div>
                            <?php }?>
                        </div>
                        
                        <div class="panel-body">
                            <div class="table-responsive">
                                <div class="card">
                                    <div class="card-header header-elements-inline">
                                        <h6 class="card-title">Left aligned buttons</h6>
                                        <div class="header-elements">
                                            <div class="list-icons">
                                                <a class="list-icons-item" data-action="collapse"></a>
                                                <a class="list-icons-item" data-action="reload"></a>
                                                <a class="list-icons-item" data-action="remove"></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel-body">

                                        <?php if (1 == 1)
                                        { ?>

                                            <div id="accordion-styled">
                                                <div class="card">
                                                    <div class="card-header bg-danger">
                                                        <h6 class="card-title">
                                                            <a data-toggle="collapse" class="text-white" href="#accordion-styled-group1">Basic  Details</a>
                                                        </h6>
                                                    </div>

                                                    <div id="accordion-styled-group1" class="collapse show" data-parent="#accordion-styled">
                                                        <div class="card-body">
                                                            <div class="panel-body">
                                                                <form class="form-basic" method="POST" id="basic_details_form" data-parsley-validate>
                                                                    <fieldset>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>First Name: <span class="text-danger">*</span></label>
                                                                                    <input type="hidden" name="edit_user_id"
                                                                                           value="<?php echo $all_user_data_array[0]['id']; ?>"
                                                                                           class="form-control">
                                                                                    <input type="hidden" name="edit_user_unique_slug"
                                                                                           value="<?php echo $all_user_data_array[0]['user_unique_slug']; ?>"
                                                                                           class="form-control">
                                                                                    <input type="text" name="first_name" id="first_name"
                                                                                           value="<?php echo $all_user_data_array[0]['first_name']; ?>"
                                                                                           class="form-control" placeholder="Enter Your First Name"
                                                                                           data-parsley-required="true">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Last Name: <span class="text-danger">*</span></label>
                                                                                    <input type="text" name="last_name" id="last_name"
                                                                                           value="<?php echo $all_user_data_array[0]['last_name']; ?>"
                                                                                           class="form-control" placeholder="Enter Your Last Name"
                                                                                           data-parsley-required="true">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <label>Email address: <span class="text-danger">*</span></label>
                                                                                <input type="email" name="email"
                                                                                       value="<?php echo $all_user_data_array[0]['email']; ?>"
                                                                                       class="form-control"
                                                                                       placeholder="Enter Your Email" data-type="email"
                                                                                       data-parsley-required="true">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>User Details:</label>
                                                                                    <input type="text" name="user_details" id="user_details"
                                                                                           value="<?php echo $all_user_data_array[0]['user_details']; ?>"
                                                                                           class="form-control" placeholder="Enter Your Details">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label class="control-label">Mobile No: <span
                                                                                                class="text-danger">*</span></label>
                                                                                    <input type="text" name="mobile"
                                                                                           value="<?php echo $all_user_data_array[0]['mobile']; ?>"
                                                                                           placeholder="Enter Your Mobile No."
                                                                                           onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                                                           class="form-control" maxlength="10"
                                                                                           minlength="10"
                                                                                           data-parsley-required="true">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label>Landline Number: </label>
                                                                                <input type="text" name="landline_no"
                                                                                       value="<?php echo $all_user_data_array[0]['landline_no']; ?>"
                                                                                       placeholder="Enter Your Landline No."
                                                                                       onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                                                       class="form-control"
                                                                                       data-parsley-type="integer">
                                                                            </div>
                                                                        </div>
                                                                    </fieldset>
                                                                    <!--                                                                <div class="form-wizard-actions">-->
                                                                    <!--                                                                    <input class="btn btn-default" id="basic-back" value="Clear" type="reset">-->
                                                                    <!--                                                                    <input class="btn bg-slate-800" id="basic-next" value="Submit" type="submit">-->
                                                                    <!--                                                                </div>-->

                                                                    <div style="margin-top:25px">
                                                                        <div class="text-left">
                                                                            <button type="submit" class="btn bg-<?php echo $theme_color; ?>">Submit <i class="icon-arrow-right14 position-right"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card">
                                                    <div class="card-header bg-teal">
                                                        <h6 class="card-title">
                                                            <a class="collapsed text-white" data-toggle="collapse" href="#accordion-styled-group2">Change  Password Details</a>
                                                        </h6>
                                                    </div>

                                                    <div id="accordion-styled-group2" class="collapse" data-parent="#accordion-styled">
                                                         <div class="card-body">
                                                            <div class="panel-body">
                                                                <form class="form-basic" method="POST" id="change_password_details_form"
                                                                      data-parsley-validate>
                                                                    <fieldset>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Current password: <span class="text-danger">*</span></label>
                                                                                    <input type="password" name="old_password" class="form-control"
                                                                                           placeholder="Current Password" data-parsley-required="true"
                                                                                           minlength="6">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>New password: <span class="text-danger">*</span></label>
                                                                                    <input type="password" name="new_password" id="new_password" class="form-control"
                                                                                           placeholder="New Password" data-parsley-required="true"
                                                                                           minlength="6">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <label>Repeat New password: <span class="text-danger">*</span></label>
                                                                                <input type="password" name="repeat_password" class="form-control"
                                                                                       placeholder="Repeat New Password" data-parsley-required="true"
                                                                                       minlength="6" data-parsley-equalto="#new_password">
                                                                            </div>
                                                                        </div>
                                                                    </fieldset>
                                                                    <!--                                                                <div class="form-wizard-actions">-->
                                                                    <!--                                                                    <input class="btn btn-default" id="basic-back" value="Clear" type="reset">-->
                                                                    <!--                                                                    <input class="btn bg-slate-800" id="basic-next" value="Submit" type="submit">-->
                                                                    <!--                                                                </div>-->
                                                                    <div style="margin-top:25px">
                                                                        <div class="text-left">
                                                                            <button type="submit" class="btn bg-<?php echo $theme_color; ?>">Submit <i class="icon-arrow-right14 position-right"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>    
                                                    </div>
                                                </div>

                                                <div class="card">
                                                    <div class="card-header bg-primary">
                                                        <h6 class="card-title">
                                                            <a class="collapsed text-white" data-toggle="collapse" href="#accordion-styled-group3">Display preferences</a>
                                                        </h6>
                                                    </div>

                                                    <div id="accordion-styled-group3" class="collapse" data-parent="#accordion-styled">
                                                        <div class="card-body">
                                                            <div class="panel-body">
                                                                <form class="form-basic" method="POST" id="display_preferences_form"
                                                                      data-parsley-validate>
                                                                    <fieldset>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Theme color: <span class="text-danger">*</span></label>
                                                                                    <?php
                                                                                    $all_theme_color_array = ['pink', 'violet', 'purple', 'indigo', 'blue', 'teal', 'green', 'orange', 'brown', 'grey', 'slate'];
                                                                                    ?>

                                                                                    <select class="form-control select-search" id="theme_color"
                                                                                            name="theme_color">
                                                                                        <?php
                                                                                        foreach ($all_theme_color_array as $selected_theme_color)
                                                                                        { ?>
                                                                                            <option <?php if ($all_user_data_array[0]['theme_color'] == $selected_theme_color) echo " selected='selected'" ?>
                                                                                                    value="<?php echo $selected_theme_color ?>"><?php echo $selected_theme_color ?></option>
                                                                                            <?php
                                                                                        }
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Theme layout: <span class="text-danger">*</span></label>
                                                                                    <select class="form-control select" id="theme_layout"
                                                                                            name="theme_layout">
                                                                                        <option value="1" <?php if ($all_user_data_array[0]['theme_layout'] == 1)
                                                                                        {
                                                                                            echo " selected='selected'";
                                                                                        } ?>>Layout 1 - Top menu
                                                                                        </option>
                                                                                        <option value="2" <?php if ($all_user_data_array[0]['theme_layout'] == 2)
                                                                                        {
                                                                                            echo " selected='selected'";
                                                                                        } ?>>Layout 2 - Side menu
                                                                                        </option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label class="control-label" style="">Upload profile pic :</label>
                                                                                    <div style="clear:both"></div>
                                                                                    <div style="margin-top:10px;margin-bottom: 15px;">
                                                                                        <?php
                                                                                        $i = 1;
                                                                                        $profile_pic = $all_user_data_array[0]['profile_pic'];
                                                                                        for ($i = 1; $i <= 1; $i++)
                                                                                        {
                                                                                            ?>
                                                                                            <div style="height: 200px;float:left;margin-left:15px;margin-top: 15px;">
                                                                                                <div id="upload<?php echo $i; ?>" style="width:160px;height:160px;padding: 0px;border: 1px solid #dedede;"
                                                                                                     class="">
                                                                                                    <ul class="" id="files<?php echo $i; ?>"
                                                                                                        style="width: auto;padding: 0px;margin:0px;height: 103px;text-align:center">
                                                                                                        <?php
                                                                                                        if ($profile_pic != '')
                                                                                                        {
                                                                                                            ?>
                                                                                                            <img src="<?php echo $base_url; ?>uploads/profile-pic/size_450/<?php echo $profile_pic; ?>"
                                                                                                                 style="margin-bottom:20px;width:150px;height:150px;">
                                                                                                            <div style="clear:both"></div>
                                                                                                            <center><a class="" style="cursor:pointer" onclick="delete_upload(<?php echo $i; ?>)">
                                                                                                                    <i class="icon icon-subtract"></i>
                                                                                                                    <div style="clear:both"></div>
                                                                                                                    DELETE
                                                                                                                </a></center>
                                                                                                            <?php
                                                                                                        }
                                                                                                        else
                                                                                                        {
                                                                                                            ?>
                                                                                                            <img src="<?php echo $base_url_images; ?>default_profile.jpg"
                                                                                                                 style="margin-bottom:20px;width:150px;height:150px;">
                                                                                                            <div style="clear:both"></div>
                                                                                                            <center><a class="" style="cursor:pointer" onclick="delete_upload(<?php echo $i; ?>)">
                                                                                                                    <i class="icon icon-subtract"></i>
                                                                                                                    <div style="clear:both"></div>
                                                                                                                    DELETE
                                                                                                                </a></center>
                                                                                                            <?php
                                                                                                        }
                                                                                                        ?>
                                                                                                    </ul>
                                                                                                    <input type="hidden" name="file_name<?php echo $i; ?>" id="file_name<?php echo $i; ?>"
                                                                                                           value="<?php echo $profile_pic; ?>">
                                                                                                </div>
                                                                                            </div>
                                                                                            <?php
                                                                                        }
                                                                                        ?>
                                                                                        <div style="clear:both"></div>
                                                                                        <div id="status"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </fieldset>


                                                                    <div style="margin-top:25px">
                                                                        <div class="text-left">
                                                                            <button type="submit" class="btn bg-<?php echo $theme_color; ?>">Submit <i class="icon-arrow-right14 position-right"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php }
                                        else
                                        { ?>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p>No <?php echo $module_full_name; ?> Exists.</p>
                                                </div>
                                            </div>

                                        <?php } ?>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div id="modal_response_search_modules_div"></div>
            <?php include('common/footer.php'); ?>
        </div>
        <script src="<?php echo $base_url_js; ?>plugins/parsley/parsley.min.js"></script>
        <script type="text/javascript" src="<?php echo $base_url_js_upload; ?>ajaxupload.3.5.js"></script>
        <script type="text/javascript">
            <?php for($i = 1;$i <= 1;$i++){ ?>
            var file_name;
            $(function ()
            {
                var btnUpload = $('#upload<?php echo $i; ?>');
                var status = $('#status<?php echo $i; ?>');
                new AjaxUpload(btnUpload, {
                    action: '<?php echo $base_url;?>upload-profilepic-image.php',
                    name: 'uploadfile',
                    onSubmit: function (file, ext)
                    {
                        if (!(ext && /^(jpg|png|jpeg|gif)$/.test(ext)))
                        {
                            $('#status').html('<p style="color:#d05165;margin-left:10px">Only JPG, JPEG, PNG or GIF files are allowed.</p>');
                            $('#files<?php echo $i; ?>').html('<center><i class="icon  icon-add" style="color:#3333FF;font-size: 20px;margin-top: 20px;"></i><div style="clear:both"></div>ADD <br/> PHOTOS </center>');
                            return false;
                        }
                        document.getElementById('files<?php echo $i;?>').innerHTML = '<center><img src="<?php echo $base_url_images?>loading.gif" style="width:30px;margin-top:35px"></center>';
                    },
                    onComplete: function (file, response)
                    {
                        var file_name_split = response.split("$$");
                        file = file_name_split[1];
                        file1 = file_name_split[0];

                        if (file1 === "success")
                        {
                            document.getElementById('file_name<?php echo $i; ?>').value = file;
                            $('<li></li>').add('#files<?php echo $i; ?>').html('<img src="<?php echo $base_url_uploads;?>profile-pic/size_450/' + file + '" style="margin-bottom:10px;width:150px;height:150px;"  alt="" /><div style="clear:both"></div><center><a class="" style="cursor:pointor" onclick="delete_upload(<?php echo $i;?>)"><i class="icon icon-subtract"></i><div style="clear:both"></div>DELETE </a></center>').addClass('success');
                            $('input').attr('title', ' ');
                        }
                        else if (response == 'size_error')
                        {
                            $('#status').html('<p style="color:#d05165;margin-left:10px">Please upload image with max size 2MB.</p>');
                            $('#files<?php echo $i; ?>').html('<center><i class="icon-add" style="color:#3333FF;font-size: 20px;margin-top: 20px;"></i><div style="clear:both"></div>ADD <br/> PHOTOS </center>');
                            return false;
                        }
                        else
                        {
                            $('<li></li>').add('#files<?php echo $i; ?>').text(file).addClass('error');
                        }
                    }
                });
            });
            <?php } ?>

            $(document).ready(function ()
            {
                //basic_details_form action

                $('#basic_details_form').parsley();
                $('#basic_details_form').on('submit', function (e)
                {
//                    debugger;
                    e.preventDefault();
                    var f = $(this);
                    f.parsley().validate();
                    if (f.parsley().isValid())
                    {
                        $.ajax(
                            {
                                url: "<?php echo $base_url;?>basic-details-submit.php",
                                type: "POST",
                                data: $('#basic_details_form').serialize(), // our data object
                                dataType: 'json', // what type of data do we expect back from the server
                                encode: true,
                                beforeSend: function ()
                                {
                                    $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url_images;?>loading.gif" />'});
                                },
                                success: function (data)
                                {
                                    $.unblockUI();
                                    if (data.status == 'success')
                                    {
                                        $('#basic_details_form').parsley().destroy();
                                        $.notifyBar({cssClass: "success", html: data.html_message});
                                    }
                                    else
                                    {
                                        $.notifyBar({cssClass: "error", html: data.html_message});
                                    }
                                }
                            });
                    }
                    else
                    {
                        e.preventDefault();
                    }
                });

                //change_password_details_form action
                $('#change_password_details_form').parsley();
                $('#change_password_details_form').on('submit', function (e)
                {
                    e.preventDefault();
                    var f = $(this);
                    f.parsley().validate();
                    if (f.parsley().isValid())
                    {
                        $.ajax(
                            {
                                url: "<?php echo $base_url;?>edit-password-submit.php",
                                type: "POST",
                                data: $('#change_password_details_form').serialize(),
                                dataType: 'json',
                                encode: true,
                                beforeSend: function ()
                                {
                                    $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url_images;?>loading.gif" />'});
                                },
                                success: function (data)
                                {
                                    $.unblockUI();
                                    if (data.status == 'success')
                                    {
                                        $('#change_password_details_form').parsley().destroy();
                                        $.notifyBar({cssClass: "success", html: data.html_message});
                                    }
                                    else
                                    {
                                        $.notifyBar({cssClass: "error", html: data.html_message});
                                    }
                                }
                            });
                    }
                    else
                    {
                        e.preventDefault();
                    }
                });


                //address_details_form action
                $('#address_details_form').parsley();
                $('#address_details_form').on('submit', function (e)
                {
                    e.preventDefault();
                    var f = $(this);
                    f.parsley().validate();
                    if (f.parsley().isValid())
                    {
                        $.ajax(
                            {
                                url: "<?php echo $base_url;?>address-details-submit.php",
                                type: "POST",
//                            data: $('#' + form_id + '').serialize(),
                                data: $('#address_details_form').serialize(),
                                dataType: 'json',
                                encode: true,
                                beforeSend: function ()
                                {
                                    $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url_images;?>loading.gif" />'});
                                },
                                success: function (data)
                                {
                                    $.unblockUI();
                                    if (data.status == 'success')
                                    {
                                        $('#address_details_form').parsley().destroy();
                                        $.notifyBar({cssClass: "success", html: data.html_message});
                                    }
                                    else
                                    {
                                        $.notifyBar({cssClass: "error", html: data.html_message});
                                    }
                                }
                            });
                    }
                    else
                    {
                        e.preventDefault();
                    }
                });

                $('#display_preferences_form').parsley();
                $('#display_preferences_form').on('submit', function (e)
                {
                    e.preventDefault();
                    var f = $(this);
                    f.parsley().validate();
                    if (f.parsley().isValid())
                    {
                        $.ajax(
                            {
                                url: "<?php echo $base_url;?>display-preferences-submit.php",
                                type: "POST",
//                            data: $('#' + form_id + '').serialize(),
                                data: $('#display_preferences_form').serialize(),
                                dataType: 'json',
                                encode: true,
                                beforeSend: function ()
                                {
                                    $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url_images;?>loading.gif" />'});
                                },
                                success: function (data)
                                {
                                    $.unblockUI();
                                    if (data.status == 'success')
                                    {
                                        $.notifyBar({cssClass: "success", html: data.html_message});
                                        setTimeout(function ()
                                        {
                                            location.reload();
                                        }, 1000);
                                    }
                                    else
                                    {
                                        $.notifyBar({cssClass: "error", html: data.html_message});
                                    }
                                }
                            });
                    }
                    else
                    {
                        e.preventDefault();
                    }
                });
            });


            var form_id = '';
            function get_state_selection(country_id, form_id)
            {
                $('#address_details_form').parsley().destroy();

                if (country_id > 0)
                {
                    $.ajax({
                        url: "<?php echo $base_url;?>get-state-selection-div.php",
                        type: "POST",
                        data: {
                            "country_id": country_id,
                            "form_id": form_id
                        },
                        dataType: 'json',
                        encode: true,

                        beforeSend: function ()
                        {
                            $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url_images;?>loading.gif" />'});
                        },
                        success: function (data)
                        {
                            $.unblockUI();
                            if (data.status === 'success')
                            {

                                $('#' + form_id + '_state_selection_div').html(data.html_message);
                                $('#' + form_id + '_city_selection_div').html("");

                                $('#' + form_id + '_state_id').attr('data-parsley-required', 'true').select2();
                            }
                            else
                            {
                                $('#' + form_id + '_state_selection_div').html("");
                            }
                        }
                    });
                }
                else
                {
                    $('#' + form_id + '_state_selection_div').html("");
                    $('#' + form_id + '_city_selection_div').html("");

                    $('#address_details_form').parsley().destroy();

                    if ($('#' + form_id + '_state_id').size() > 0)
                    {
                        $('#' + form_id + '_state_id').attr('data-parsley-required', 'false');
                    }
                    if ($('#' + form_id + '_city_id').size() > 0)
                    {
                        $('#' + form_id + '_city_id').attr('data-parsley-required', 'false');
                    }
                }
                $('#address_details_form').parsley();
            }

            function get_city_selection(state_id, form_id)
            {
                $('#address_details_form').parsley().destroy();
                if (state_id > 0)
                {

                    $.ajax({
                        url: "<?php echo $base_url;?>get-city-selection-div.php",
                        type: "POST",
                        data: {
                            "state_id": state_id,
                            "form_id": form_id
                        },
                        dataType: 'json',
                        encode: true,

                        beforeSend: function ()
                        {
                            $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url_images;?>loading.gif" />'});
                        },
                        success: function (data)
                        {
                            $.unblockUI();

                            if (data.status == 'success')
                            {
                                $('#' + form_id + '_city_selection_div').html(data.html_message);
                                $('#' + form_id + '_city_id').attr('data-parsley-required', 'true').select2();
                            }
                            else
                            {
                                $('#' + form_id + '_city_selection_div').html("");
                            }
                        }
                    });
                }
                else
                {
                    $('#' + form_id + '_city_selection_div').html("");
                    $('#' + form_id + '_city_id').attr('data-parsley-required', 'false');
                }

                $('#address_details_form').parsley();
            }

            function delete_upload(delete_file_id)
            {
//                debugger;
                $('#files' + delete_file_id).html('<center style="margin-top: 20px;"><i class="icon icon-add"></i><div style="clear:both"></div>ADD <br/> PHOTOS </center>');
                $('#file_name' + delete_file_id).val("");
            }

            //
            //            $("#address_reset").click(function ()
            //            {
            //                $('select').select2('val', '');
            //            });
        </script>
    </body>
</html>

    <?php
    }
    else
    {
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'logout">';
    }
}
else
{
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'logout">';
}
?>
