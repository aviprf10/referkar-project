<?php
include 'common/config.php';
include 'common/check_login.php';
if ($admin == 1)
{
    if (1 == 1)
    {
        $module_full_name = 'Company Info';
        $module_short_name = 'Company Info';
        $module_name = 'settings';
        $edit_id = 1;
        $edit_data_array = array();
        $get_company_info_query = "select * from company_info WHERE id='$edit_id'";
        $result_get_company_info_query = mysqli_query($db_mysqli, $get_company_info_query);
        while ($row_get_company_info_query = mysqli_fetch_assoc($result_get_company_info_query))
        {
            $edit_data_array[] = $row_get_company_info_query;
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

                                    <div class="card-body">
                                         <form id="<?php echo $module_name; ?>_form" method="POST" data-parsley-validate>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Company title : <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="company_title" name="company_title" value="<?php echo $edit_data_array[0]['company_title']; ?>"
                                                                   placeholder="Enter Company Title" data-parsley-required="true">
                                                            <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $edit_id; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Company Description : <span class="text-danger">*</span></label>
                                                            <textarea name="company_description"
                                                                      id="company_description" rows="2" cols="2" placeholder="Enter Description" data-parsley-required="true" class="form-control"><?php echo $edit_data_array[0]['company_description']; ?></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Address 1 : <span class="text-danger">*</span></label>
                                                            <textarea name="company_address"
                                                                      id="company_address" rows="2" cols="2" placeholder="Enter Address 1" data-parsley-required="true" class="form-control"><?php echo $edit_data_array[0]['company_address']; ?></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Address 2 : </label>
                                                            <textarea name="company_address2" id="company_address2" rows="2" cols="2"
                                                                      placeholder="Enter Address 2" class="form-control"><?php echo $edit_data_array[0]['company_address2']; ?></textarea>
                                                        </div>
                                                    </div>
                                                   <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Country : <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="country" name="country" value="<?php echo $edit_data_array[0]['country']; ?>"
                                                                   placeholder="Enter country" data-parsley-required="true">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>State : <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="state" name="state" value="<?php echo $edit_data_array[0]['state']; ?>"
                                                                   placeholder="Enter state" data-parsley-required="true">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>City : <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="city" name="city" value="<?php echo $edit_data_array[0]['city']; ?>"
                                                                   placeholder="Enter city" data-parsley-required="true">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Pincode : <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="pincode" name="pincode" value="<?php echo $edit_data_array[0]['pincode']; ?>"
                                                                   placeholder="Enter pincode" data-parsley-required="true">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Phone number 1: </label>
                                                            <input type="text" class="form-control" id="company_mobile" name="company_mobile" value="<?php echo $edit_data_array[0]['company_mobile']; ?>"
                                                                   placeholder="Enter phone number 1">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Phone number 2: </label>
                                                            <input type="text" class="form-control" id="company_mobile2" name="company_mobile2" value="<?php echo $edit_data_array[0]['company_mobile2']; ?>"
                                                                   placeholder="Enter phone number 2">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Email 1: </label>
                                                            <input type="email" class="form-control" id="company_email" name="company_email" value="<?php echo $edit_data_array[0]['company_email']; ?>"
                                                                   placeholder="Enter email">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Email 2: </label>
                                                            <input type="email" class="form-control" id="company_email2" name="company_email2" value="<?php echo $edit_data_array[0]['company_email2']; ?>"
                                                                   placeholder="Enter email 2">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Facebook Link : </label>
                                                            <textarea name="facebook_link"
                                                                      id="facebook_link" rows="2" cols="2"
                                                                      placeholder="Enter Facebook Link"
                                                                      class="form-control"><?php echo $edit_data_array[0]['facebook_link']; ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Linkedin Link: </label>
                                                            <textarea name="linkedin_link"  id="linkedin_link" rows="2" cols="2" placeholder="Enter Linkedin Link" class="form-control"><?php echo $edit_data_array[0]['linkedin_link']; ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Pinterest Link : </label>
                                                            <textarea name="pintrest_link"
                                                                      id="pintrest_link" rows="2" cols="2"
                                                                      placeholder="Enter Pinterest Link"
                                                                      class="form-control"><?php echo $edit_data_array[0]['pintrest_link']; ?></textarea>
                                                        </div>
                                                    </div>
                                                
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Instagram Link : </label>
                                                            <textarea name="insta_link"
                                                                      id="insta_link" rows="2" cols="2"
                                                                      placeholder="Enter Instagram Link"
                                                                      class="form-control"><?php echo $edit_data_array[0]['insta_link']; ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Twitter Link: </label>
                                                            <textarea name="twitter_link"
                                                                      id="twitter_link" rows="2" cols="2"
                                                                      placeholder="Enter Twitter Link"
                                                                      class="form-control"><?php echo $edit_data_array[0]['twitter_link']; ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Youtube Link : </label>
                                                            <textarea name="youtube_link"
                                                                      id="youtube_link" rows="2" cols="2"
                                                                      placeholder="Enter Youtube Link"
                                                                      class="form-control"><?php echo $edit_data_array[0]['youtube_link']; ?></textarea>
                                                        </div>
                                                    </div>
                                                
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Skype Link : </label>
                                                            <textarea name="skype_link"
                                                                      id="skype_link" rows="2" cols="2"
                                                                      placeholder="Enter Skype Link"
                                                                      class="form-control"><?php echo $edit_data_array[0]['skype_link']; ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Whatsapp Link: </label>
                                                            <textarea name="whatsapp_link"  id="whatsapp_link" rows="2" cols="2" placeholder="Enter Whatsapp Link" class="form-control"><?php echo $edit_data_array[0]['whatsapp_link']; ?></textarea>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-md-4" style="margin-top:10px;margin-bottom: 15px;">
                                                        <div class="form-group">
                                                            <label>Upload small image :</label>
                                                            <div style="clear:both"></div>
                                                            <p class="text-primary" style="color:primary">Image Size : 360px * 414px, File Size : Max 2 MB   </p>
                                                            <div style="margin-top:10px;margin-bottom: 15px;">
                                                                <?php for ($i = 1; $i <= 1; $i++)
                                                                { ?>
                                                                    <div id="upload<?php echo $i; ?>"
                                                                         style="margin-top: 15px;width:297px;height:170px;border: 1px solid #dedede;float:left;padding: 0px;"
                                                                         class="">
                                                                        <ul class="" id="files<?php echo $i; ?>"
                                                                            style="width: auto;padding: 0px;margin:0px">
                                                                            <?php
                                                                                if ($edit_data_array[0]['product_small_images'] != '')
                                                                                {
                                                                                    ?>
                                                                                    <img src="<?php echo $base_url; ?>uploads/company-images/size_small/<?php echo $edit_data_array[0]['product_small_images']; ?>"
                                                                                         style="margin-bottom:20px;width:295px;height:160px;">
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
                                                                                    <center>
                                                                                        <i class="icon-plus-circle2" style="font-size: 20px;margin-top: 20px;"></i>
                                                                                        <div style="clear:both"></div>
                                                                                        ADD <br/> PHOTOS
                                                                                    </center>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                        </ul>
                                                                        <input type="hidden" name="file_name<?php echo $i; ?>"
                                                                               id="file_name<?php echo $i; ?>" value="<?php echo $edit_data_array[0]['product_small_images']; ?>">
                                                                    </div>
                                                                    <?php
                                                                } ?>
                                                                <div style="clear:both"></div>
                                                                <div id="status"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                <div style="margin-top:25px">
                                                    <div class="text-left">
                                                        <button type="submit" class="btn bg-<?php echo $theme_color; ?>">Submit <i class="icon-arrow-right14 position-right"></i></button>
                                                    </div>
                                                </div>
                                            </form>
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
        <link rel="stylesheet" type="text/css" href="<?php echo $base_url_css_upload; ?>styles.css"/>
        <script type="text/javascript">
        $(document).ready(function ()
        {
            $('#<?php echo $module_name; ?>_form').parsley();
            $('#<?php echo $module_name; ?>_form').on('submit', function (e)
            {
                e.preventDefault();
                var f = $(this);
                f.parsley().validate();
                if (f.parsley().isValid())
                {
                    $.ajax(
                        {
                            url: "<?php echo $base_url; ?><?php echo $module_name; ?>-submit.php",
                            type: "POST",
                            data: $('#<?php echo $module_name; ?>_form').serialize(),
                            dataType: 'json',
                            encode: true,
                            beforeSend: function ()
                            {
                                $.blockUI({message: '<i class="icon-spinner3 spinner position-left" style="font-size:21px"></i>'});
                            },
                            success: function (data)
                            {
                                $.unblockUI();
                                if (data.status == 'success')
                                {

                                    $('#<?php echo $module_name; ?>_form').parsley().destroy();
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

        <?php for($i = 1;$i <= 1;$i++){ ?>
            var file_name;
            $(function ()
            {
                var btnUpload = $('#upload<?php echo $i; ?>');
                var status = $('#status<?php echo $i; ?>');
                new AjaxUpload(btnUpload, {
                    action: '<?php echo $base_url; ?>upload-company-image.php',
                    name: 'uploadfile',
                    onSubmit: function (file, ext)
                    {
                        if (!(ext && /^(jpg|png|jpeg|gif)$/.test(ext)))
                        {
                            $('#status').html('<p style="color:#d05165;margin-left:10px">Only JPG, JPEG, PNG or GIF files are allowed.</p>');
                            $('#files<?php echo $i; ?>').html('<center><i class="icon  icon-add" style="color:#000;font-size: 20px;margin-top: 20px;"></i><div style="clear:both"></div>ADD <br/> PHOTOS </center>');
                            return false;
                        }
                        document.getElementById('files<?php echo $i;?>').innerHTML = '<center><img src="<?php echo $base_url_images?>loading.gif" style="width:30px;margin-top:35px"></center>';
                    },
                    onComplete: function (file, response)
                    {
    //                    debugger;
                        var file_name_split = response.split("$$");
                        file = file_name_split[1];
                        file1 = file_name_split[0];
                        if (file1 === "success")
                        {
                            document.getElementById('file_name<?php echo $i; ?>').value = file;
                            $('<li></li>').add('#files<?php echo $i; ?>').html('<img src="<?php echo $base_url_uploads;?>company-images/size_small/' + file + '" style="margin-bottom:10px;width:290px;height:153px;"  alt="" /><div style="clear:both"></div><a class="" style="cursor:pointor" onclick="delete_upload(<?php echo $i;?>)"><i class="icon icon-subtract"></i><div style="clear:both"></div>DELETE </a>').addClass('success');
                            $('input').attr('title', ' ');
                        }
                        else if (response == 'size_error')
                        {
                            $('#status').html('<p style="color:#d05165;margin-left:10px">Please upload image with max size 2MB.</p>');
                            $('#files<?php echo $i; ?>').html('<center><i class="icon  icon-add" style="color:#000;font-size: 20px;margin-top: 20px;"></i><div style="clear:both"></div>ADD <br/> PHOTOS </center>');
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

            function delete_upload(delete_file_id)
            {
                $('#files' + delete_file_id).html('<center style="margin-top: 20px;"><i class="icon icon-add"></i><div style="clear:both"></div>ADD <br/> PHOTO </center>');
                $('#file_name' + delete_file_id).val("");
            }
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
