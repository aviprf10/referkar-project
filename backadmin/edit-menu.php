<?php
include 'common/config.php';
include 'common/check_login.php';
if ($admin == 1 || ($sub_admin == 1 && $is_menu_write == 1))
{
    if (isset($_GET['id']) && $_GET['id'] > 0)
    {
        $module_full_name = 'Menu';
        $module_short_name = 'Menu';
        $module_name = 'menu';
        $edit_id = $_GET['id'];
        $edit_data_array = array();
        $get_menu_query = "select * from menu where id='$edit_id' and is_deleted='0'";
        $result_get_menu_query = mysqli_query($db_mysqli, $get_menu_query);
        while ($row_get_menu_query = mysqli_fetch_assoc($result_get_menu_query))
        {
            $edit_data_array[] = $row_get_menu_query;
        }
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title><?php echo $company_title; ?> - Edit <?php echo $module_full_name; ?></title>
            <?php include('common/header-css.php'); ?>
            <style>
                table#all-<?php echo $module_name; ?>-table tr td:first-child {
                    display: none;
                }

                table#all-<?php echo $module_name; ?>-table th:first-child {
                    display: none;
                }

                <?php if($page_layout == 1){ ?>
                .page-title {
                    padding: 15px 36px 15px 0;
                }

                .content:first-child {
                    padding-top: 2px;
                }

                .heading-elements > a {
                    padding: 7px 15px;
                }

                <?php } ?>
            </style>
        </head>

        <body class="<?php if ($page_layout == 1)
        { ?>navbar-top-md-md <?php }
        else if ($page_layout == 2)
        { ?> navbar-top pace-done
        <?php
            if ($side_menu_menu == 0)
            {
                ?>
           sidebar-xs
        <?php
            }
        } ?>">
        <div class="<?php if ($page_layout == 1)
        { ?>navbar-fixed-top<?php }
        else if ($page_layout == 2)
        { ?>navbar navbar-inverse navbar-fixed-top bg-danger <?php } ?>">
            <?php include('common/header.php'); ?>
            <?php if ($page_layout == 1)
            { ?>
                <?php include('common/top-menu.php'); ?>
            <?php } ?>
        </div>

        <?php if ($page_layout == 1)
        { ?>
            <div class="page-header">
                <div class="page-header-content">
                    <div class="page-title">
                        <h6><i class="icon-home4 position-left"></i>
					<span class="text-semibold">
						<i class="icon-arrow-right13"></i>
						<a href="<?php echo $base_url; ?>">
                            Dashboard
                        </a>
					</span>
                            <i class="icon-arrow-right13"></i> <?php echo $module_short_name; ?>
                            <i class="icon-arrow-right13"></i> Edit <?php echo $module_short_name; ?>
                        </h6>
                    </div>


                </div>
            </div>
        <?php } ?>

        <div class="page-container"> <!-- Page container start -->

            <div class="page-content"> <!-- Page content start -->

                <?php if ($page_layout == 2)
                { ?>
                    <?php include('common/side-menu.php'); ?>
                <?php } ?>

                <div class="content-wrapper"> <!-- content wrapper start -->

                    <!-- Page header Start -->
                    <?php if ($page_layout == 2)
                    { ?>
                        <div class="page-header page-header-default">
                            <div class="breadcrumb-line">
                                <ul class="breadcrumb">
                                    <li>
                                        <a href="<?php echo $base_url; ?>">
                                            <i class="icon-home2 position-left"></i>
                                            Dashboard
                                        </a>
                                    </li>
                                    <li><?php echo $module_short_name; ?></li>
                                    <li class="active">Edit <?php echo $module_short_name; ?></li>
                                </ul>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- /page header end -->

                    <div class="content"> <!-- content Start -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default"
                                >
                                    <div class="panel-heading">
                                        <h5 class="panel-title">Edit <?php echo $module_short_name; ?></h5>

                                        <div class="heading-elements">
                                            <a href="<?php echo $base_url; ?>view-<?php echo $module_name; ?>">
                                                <button type="button" class="btn bg-<?php echo $theme_color; ?> heading-btn">
                                                    <i class="icon-file-eye position-left"></i> View All <?php echo $module_full_name; ?>
                                                </button>
                                            </a>
                                        </div>

                                    </div>

                                    <div class="panel-body">

                                        <?php if (count($edit_data_array) > 0)
                                        { ?>
                                            <form id="<?php echo $module_name; ?>_form" method="POST" data-parsley-validate>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Select Area : <span
                                                                    class="text-danger">*</span></label>

                                                            <?php
                                                            $all_area_data_array = array();
                                                            $get_area_query = "SELECT * FROM area WHERE is_deleted='0'";
                                                            $result_get_area_query = mysqli_query($db_mysqli, $get_area_query);
                                                            while ($row_get_area_query = mysqli_fetch_assoc($result_get_area_query))
                                                            {
                                                                $all_area_data_array[] = $row_get_area_query;
                                                            }

                                                            ?>
                                                            <select class="select-search form-control" id="area_id"
                                                                    name="area_id">
                                                                <!-- <option value=""> select area</option>-->
                                                                <?php foreach ($all_area_data_array as $all_area_data)
                                                                { ?>
                                                                    <option
                                                                        value="<?php echo $all_area_data['id']; ?>"
                                                                        <?php if ($all_area_data['id'] == $edit_data_array[0]['area_id'])
                                                                        {
                                                                            echo " selected='selected'";
                                                                        } ?>>
                                                                        <?php echo $all_area_data['name']; ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Name : <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="menu_name"
                                                                   name="menu_name"
                                                                   value="<?php echo $edit_data_array[0]['menu_name']; ?>"
                                                                   placeholder="Enter <?php echo $module_full_name; ?>"
                                                                   data-parsley-required="true">

                                                            <input type="hidden" name="edit_id" id="edit_id"
                                                                   value="<?php echo $edit_id; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Price : <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="price"
                                                                   name="price"
                                                                   value="<?php echo $edit_data_array[0]['price']; ?>"
                                                                   placeholder="Enter Price"
                                                                   data-parsley-required="true">

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

                        <?php include('common/footer.php'); ?>
                    </div> <!-- content ent -->

                </div>  <!-- content wrapper end -->

            </div> <!-- Page content end -->

        </div> <!-- Page container end -->


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