<?php
include 'common/config.php';
include 'common/check_login.php';
if ($admin == 1 || ($sub_admin == 1 && $is_country_read == 1))
{
    $module_full_name = 'City';
    $module_short_name = 'City';
    $module_name = 'city';
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
                                        <form  id="<?php echo $module_name; ?>_form" method="POST" data-parsley-validate>
                                            <div class="form-group">
                                                <label>Select Country : <span class="text-danger">*</span></label>
                                                <?php
                                                    $all_country_data_array = array();
                                                    $get_country_query = "SELECT * FROM country WHERE  is_deleted='0' and id='101'";
                                                    $result_get_country_query = mysqli_query($db_mysqli, $get_country_query);
                                                    while ($row_get_country_query = mysqli_fetch_assoc($result_get_country_query))
                                                    {
                                                        $all_country_data_array[] = $row_get_country_query;
                                                    }

                                                    ?>
                                                    <select class="select-search form-control" id="country_id"
                                                            name="country_id"
                                                            data-placeholder="Select a Country..."
                                                            onchange="get_state(this.value, 0)"
                                                            data-parsley-required="true">
                                                        <option></option>
                                                        <?php foreach ($all_country_data_array as $all_country_data)
                                                        { ?>
                                                            <option value="<?php echo $all_country_data['id']; ?>"><?php echo $all_country_data['country_name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                            </div>
                                            <div class="form-group" id="state_div"></div>
                                            <div class="form-group">
                                                <label>City : <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="city_title" name="city_title" placeholder="Enter <?php echo $module_full_name; ?>"  data-parsley-required="true">
                                            </div>
                                            <div class="form-group">
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" name="status" class="styled" id="status" value="1" checked="checked">
                                                    Active
                                                </label>
                                            </div>

                                            <div class="d-flex justify-content-start align-items-center">
                                                <button type="reset" class="btn btn-light">Reset</button>
                                                <button type="submit" class="btn bg-blue ml-3">Submit <i class="icon-paperplane ml-2"></i></button>
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
                                url: "<?php echo $base_url; ?>add-<?php echo $module_name; ?>-submit.php",
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
                                        $('#<?php echo $module_name; ?>_form').trigger("reset");
                                        $('select').select2('val', ' ');
                                        $('#<?php echo $module_name; ?>_form').parsley().destroy();
                                        $.notifyBar({cssClass: "success", html: data.html_message});
                                        setTimeout(function ()
                                        {
                                            window.top.location="<?php echo $base_url; ?>view-city";
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

            $("#city_reset").click(function ()
            {
    //            debugger;
                $('select').select2('val', ' ');
                $('#<?php echo $module_name; ?>_form').parsley().destroy();
            });

            function get_state(country_id, edit_flag=0)
            {
                $('#<?php echo $module_name; ?>_form').parsley().destroy();
                var formData =
                {
                    'country_id': country_id,
                    'edit_flag': edit_flag
                };
                $.ajax(
                    {
                        url: "<?php echo $base_url; ?>get_state.php",
                        type: "POST",
                        data: formData,
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
                                $('#state_div').html(data.html_message);

    //                            if ($('#state_id').size() > 0)
    //                            {
    //                                $('#<?php //echo $module_name; ?>//_form').parsley('addItem', '#state_id');
    //                                $('#state_id').parsley('addConstraint', {
    //                                    required: true
    //                                });
    //                            }
                                $('#state_id').attr('data-parsley-required', 'true').select2();
                                //$.notifyBar({cssClass: "success", html: data.html_message});
                                //dataTable.ajax.reload();
                            }
                            else
                            {
                                $.notifyBar({cssClass: "error", html: data.html_message});
                                //dataTable.ajax.reload();
                            }
                        }
                    });
                $('#<?php echo $module_name; ?>_form').parsley();
            }

            function get_city()
            {
                
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
?>
