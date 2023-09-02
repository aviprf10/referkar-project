<?php
include 'common/config.php';
include 'common/check_login.php';
if ($admin == 1 || ($sub_admin == 1 && $is_country_read == 1))
{
    if (isset($_GET['id']))
    {
        $module_full_name = "Sub Service";
        $module_short_name = "Sub Service";
        $module_name = "sub-service";

         $edit_id = $_GET['id'];

        $edit_data_array = array();
        $get_service_query = "select * from sub_service where id='$edit_id' and is_deleted='0'";
        $result_get_service_query = mysqli_query($db_mysqli, $get_service_query);
        while ($row_get_service_query = mysqli_fetch_assoc($result_get_service_query))
        {
            $edit_data_array[] = $row_get_service_query;
        }

         if (count($edit_data_array) > 0)
        {
            $edit_data = $edit_data_array[0];
            $service_id = $edit_data['service_id'];
            $sub_service_name = $edit_data['sub_service_name'];
            $description = $edit_data['description'];
            $icon = $edit_data['icon'];
            $service_image = $edit_data['service_image'];
            $sort_description = $edit_data['sort_description'];
            $full_description = $edit_data['full_description'];
            $meta_title = $edit_data['meta_title'];
            $meta_keyword = $edit_data['meta_keyword'];
            $meta_description = $edit_data['meta_description'];
            $status = $edit_data['status'];

    ?> 
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $company_title; ?>  - Edit <?php echo $module_full_name; ?></title>
        <?php include('common/header-css.php'); ?>
        <script src="<?php echo $base_url; ?>ckeditor/ckeditor.js"></script>
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
                        <span class="breadcrumb-item active">Edit <?php echo $module_full_name; ?></span>
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
                                 <a href="<?php echo $base_url; ?>view-<?php echo $module_name; ?>">
                                    <button type="button"
                                            class="btn bg-<?php echo $theme_color; ?> heading-btn">
                                        <i class="icon-file-plus position-left"></i>
                                        View <?php echo $module_full_name; ?>
                                    </button>
                                </a><br><br>
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
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Select service : <span class="text-danger">*</span></label>

                                                        <?php
                                                        $all_service_data_array = array();
                                                        $get_service_query = "SELECT * FROM service WHERE is_deleted='0'";
                                                        $result_get_service_query = mysqli_query($db_mysqli, $get_service_query);
                                                        while ($row_get_service_query = mysqli_fetch_assoc($result_get_service_query))
                                                        {
                                                            $all_service_data_array[] = $row_get_service_query;
                                                        }

                                                        $service_id = $edit_data_array[0]['service_id'];


                                                        ?>
                                                        <select class="select-search form-control" id="service_id"
                                                                name="service_id">
                                                            <!--                                                                <option value=""> select service</option>-->
                                                            <?php foreach ($all_service_data_array as $all_service_data)
                                                            { ?>
                                                                <option
                                                                    value="<?php echo $all_service_data['id']; ?>"
                                                                    <?php if ($all_service_data['id'] == $edit_data_array[0]['service_id'])
                                                                    {
                                                                        echo " selected='selected'";
                                                                    } ?>>
                                                                    <?php echo $all_service_data['service_name']; ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><?php echo $module_full_name; ?> Title : <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="sub_service_name"
                                                               id="sub_service_name"
                                                               placeholder="<?php echo $module_full_name; ?> Title"
                                                               value="<?php echo $sub_service_name; ?>"
                                                               data-parsley-required="true">

                                                        <input type="hidden" name="edit_id" id="edit_id"
                                                               value="<?php echo $edit_id; ?>">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Sort Description : <span
                                                                class="text-danger">*</span></label>
                                                    <textarea type="text" class="form-control"id="sort_description" name="sort_description" data-parsley-required="true"
                                                           placeholder="Enter Sort Description "> <?php echo $sort_description; ?>  </textarea>                                             
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Full Description: </label>
                                                    <textarea rows="6" id="editor1" name="editor1"
                                                              class="form-control"><?php echo $full_description; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                 <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Meta Title :</label>
                                                        <input type="text" class="form-control"id="meta_title" name="meta_title"
                                                               placeholder="Enter Meta Title " value="<?php echo $meta_title; ?>">                                                
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                 <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Meta Description :</label>
                                                        <textarea type="text" class="form-control"id="meta_description" name="meta_description"
                                                               placeholder="Enter Meta Description "> <?php echo $meta_description; ?>  </textarea>                                             
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="row">
                                                 <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Meta Keywords :</label>
                                                        <input id="search_keywords" name="search_keywords[]" type="text"
                                                                   class="form-control tags" 
                                                                   placeholder="Enter Search Terms" value="<?php echo $meta_keyword; ?>" />
                                                        <span class="help-block">Note:Help someone to find your products - Use the 13 tags to optimize your listings.</span>
                                                        <div id="tag_error_div">
                                                        </div>                                             
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                 <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Icon Code :</label>
                                                        <input type="text" class="form-control"id="icon" value="<?php echo $icon; ?>" name="icon"
                                                               placeholder="Enter Icon Code ">                                                
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4" style="margin-top:10px;margin-bottom: 15px;">
                                                    <div class="form-group">
                                                        <label>Upload logo image :</label>
                                                        <div style="clear:both"></div>
                                                         <p class="text-primary" style="color:primary">Image Size : 570px * 330px, File Size : Max 2 MB   </p>
                                                        <div style="margin-top:10px;margin-bottom: 15px;">
                                                            <?php for ($i = 1; $i <= 1; $i++)
                                                            { ?>
                                                                <div id="upload<?php echo $i; ?>"
                                                                     style="margin-top: 15px;width:297px;height:170px;border: 1px solid #dedede;float:left;padding: 0px;"
                                                                     class="">
                                                                    <ul class="" id="files<?php echo $i; ?>"
                                                                        style="width: auto;padding: 0px;margin:0px">
                                                                        <?php
                                                                            if ($service_image != '')
                                                                            {
                                                                                ?>
                                                                                <img src="<?php echo $base_url; ?>uploads/services-images/size_small/<?php echo $service_image; ?>"
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
                                                                    <input type="hidden" name="file_name<?php echo $i; ?>" id="file_name<?php echo $i; ?>" value="<?php echo $service_image; ?>">
                                                                </div>
                                                                <?php
                                                            } ?>
                                                            <div style="clear:both"></div>
                                                            <div id="status"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">

                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="status" class="styled" id="status" value="1" <?php if ($edit_data_array[0]['status'] == 1)
                                                                {
                                                                    echo "checked";
                                                                } ?>>
                                                                Active
                                                            </label>
                                                        </div>
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
        <script type="text/javascript" src="<?php echo $base_url_js; ?>tag/jquery.tagsinput.js"></script>
        <script type="text/javascript" src="<?php echo $base_url_js_upload; ?>ajaxupload.3.5.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo $base_url_css_upload; ?>styles.css"/>
        <script type="text/javascript">
            $(document).ready(function ()
            {
                var page_content = CKEDITOR.instances['editor1'].getData();
                $('#<?php echo $module_name; ?>_form').parsley();
                $('#<?php echo $module_name; ?>_form').on('submit', function (e)
                {
                    e.preventDefault();
                    var f = $(this);
                    f.parsley().validate();
                    if (f.parsley().isValid())
                    {
                        for (instance in CKEDITOR.instances)
                        {
                            CKEDITOR.instances[instance].updateElement();
                        }
                        $.ajax(
                            {
                                url: "<?php echo $base_url; ?>edit-<?php echo $module_name; ?>-submit.php",
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
            CKEDITOR.replace('editor1');

            $('#search_keywords').tagsInput({
                width: 'auto', height: '44px'
            });

            <?php for($i = 1;$i <= 1;$i++){ ?>
            var file_name;
            $(function ()
            {
                var btnUpload = $('#upload<?php echo $i; ?>');
                var status = $('#status<?php echo $i; ?>');
                new AjaxUpload(btnUpload, {
                    action: '<?php echo $base_url; ?>upload-services-image.php',
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
                            $('<li></li>').add('#files<?php echo $i; ?>').html('<img src="<?php echo $base_url_uploads;?>services-images/size_small/' + file + '" style="margin-bottom:10px;width:292px;height:156px;"  alt="" /><div style="clear:both"></div><a class="" style="cursor:pointor" onclick="delete_upload(<?php echo $i;?>)"><i class="icon icon-subtract"></i><div style="clear:both"></div>DELETE </a>').addClass('success');
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
}
else
{
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'logout">';
}
?>
