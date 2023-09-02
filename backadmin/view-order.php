<?php
include 'common/config.php';
include 'common/check_login.php';
if ($admin == 1)
{
    if (isset($_GET['id']))
    {
        $module_full_name = "View Orders";
        $module_short_name = "View Orders";
        $module_name = "new-orders";

         $edit_id = $_GET['id'];

        $edit_data_array = array();
        $get_user_order_query = "select uo.id, uo.price,uo.quantity,uo.order_id, uo.order_date, uo.order_status,p.product_name, u.user_name, u.mobile, pim.product_small_images from user_order uo  LEFT JOIN product p on uo.product_id = p.id  LEFT JOIN product_images pim on pim.product_id = p.id LEFT JOIN user u on uo.user_id = u.id where uo.order_id='$edit_id' and uo.is_deleted='0'";
        $result_get_user_order_query = mysqli_query($db_mysqli, $get_user_order_query);
        while ($row_get_user_order_query = mysqli_fetch_assoc($result_get_user_order_query))
        {
            $edit_data_array[] = $row_get_user_order_query;
        }
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title><?php echo $company_title; ?> - Update <?php echo $module_full_name; ?></title>
            <?php include('common/header-css.php'); ?>
            <link rel="stylesheet" type="text/css" href="<?php echo $base_url_css; ?>tag/jquery.tagsinput.css"/>
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
            <style>
      table {
         border-collapse: separate;
         border-spacing: 0;
         min-width: 350px;
         }
         table tr th,
         table tr td {
         border-right: 1px solid #bbb;
         border-bottom: 1px solid #bbb;
         padding: 5px;
         }

         table tr th:first-child,
         table tr td:first-child {
         border-left: 1px solid #bbb;
         }
         table tr th:first-child,
         table tr td:first-child {
         border-left: 1px solid #bbb;
         }
         table tr th {
         background: #eee;
         text-align: left;
         border-top: solid 1px #bbb;
         }

         /* top-left border-radius */
         table tr:first-child th:first-child {
         border-top-left-radius: 6px;
         }

         /* top-right border-radius */
         table tr:first-child th:last-child {
         border-top-right-radius: 6px;
         }

         /* bottom-left border-radius */
         table tr:last-child td:first-child {
         border-bottom-left-radius: 6px;
         }

         /* bottom-right border-radius */
         table tr:last-child td:last-child {
         border-bottom-right-radius: 6px;
         }
    </style> 
            <script src="<?php echo $base_url; ?>ckeditor/ckeditor.js"></script>
        </head>

        <body class="<?php if ($page_layout == 1)
        { ?>navbar-top-md-md <?php }
        else if ($page_layout == 2)
        { ?> navbar-top pace-done
    <?php
            if ($side_menu_sub_category == 0)
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
                            <i class="icon-arrow-right13"></i> Update <?php echo $module_short_name; ?>
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
                                    <li class="active"> <?php echo $module_short_name; ?></li>
                                </ul>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- /page header end -->

                    <div class="content"> <!-- content Start -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="panel-title"> <?php echo $module_short_name; ?></h5>
                                        <div class="heading-elements">
                                            <a href="<?php echo $base_url; ?><?php echo $module_name; ?>">
                                                <button type="button" class="btn bg-<?php echo $theme_color; ?> heading-btn">
                                                    <i class="icon-file-eye position-left"></i> View All <?php echo $module_full_name; ?>
                                                </button>
                                            </a>
                                        </div>

                                    </div>
                                    <div class="panel-body">
                                            <form id="view_order_form" method="POST" data-parsley-validate>
                                                <div class="row">
                                                    <table width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th style="text-align:center; padding:5px;">Sr. No.</th>
                                                                <th style="text-align:center; padding:5px;">Product Images</th>
                                                                <th style="text-align:center; padding:5px;">Product</th>
                                                                <th style="text-align:center; padding:5px;">Price</th>
                                                                <th style="text-align:center; padding:5px;">Quantity</th>
                                                                <th style="text-align:center; padding:5px;">Order No.</th>
                                                                <th style="text-align:center; padding:5px;">Order Date</th>
                                                                <th style="text-align:center; padding:5px;">User</th>
                                                                <th style="text-align:center; padding:5px;">Mobile</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $i = 1;
                                                            foreach($edit_data_array as $ordervalue)
                                                            { 
                                                            ?>
                                                            <tr>
                                                                <td style="text-align:center; padding:5px;"><?php echo $i; ?></td>
                                                                <td style="text-align:center; padding:5px;"><img src="<?php echo $base_url_uploads; ?>/product-small-images/temp_file/<?php echo $ordervalue['product_small_images']; ?>" style="width:75px; height:75px;"></td>
                                                                <td style="text-align:center; padding:5px;"><?php echo $ordervalue['product_name']; ?></td>
                                                                <td style="text-align:center; padding:5px;"><?php echo $ordervalue['price']; ?></td>
                                                                <td style="text-align:center; padding:5px;"><?php echo $ordervalue['quantity']; ?></td>
                                                                <td style="text-align:center; padding:5px;"><?php echo $ordervalue['order_id']; ?></td>
                                                                <td style="text-align:center; padding:5px;"><?php echo date('d-m-Y', strtotime($ordervalue['order_date'])); ?></td>
                                                                <td style="text-align:center; padding:5px;"><?php echo $ordervalue['user_name']; ?></td>
                                                                <td style="text-align:center; padding:5px;"><?php echo $ordervalue['mobile']; ?></td>
                                                            </tr>
                                                            <?php  $i++; } ?>
                                                        </tbody>
                                                    </table>
                                                </div> 
                                                <div class="row"><br><br><br>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Select Order Status : <span class="text-danger">*</span></label>  
                                                            <select class="select-search form-control" id="order_status" name="order_status" data-parsley-required="true">
                                                                   <option value="">Select Status</option> 
                                                                   <option value="0" <?php if($ordervalue['order_status'] == 0){ echo 'selected'; } ?>>New order</option> 
                                                                   <!-- <option value="1" <?php if($ordervalue['order_status'] == 1){ echo 'selected'; } ?>>To-be-Picked</option>  -->
                                                                   <option value="2" <?php if($ordervalue['order_status'] == 2){ echo 'selected'; } ?>>Dispatch</option> 
                                                                   <!-- <option value="3" <?php if($ordervalue['order_status'] == 3){ echo 'selected'; } ?>>To handover</option> 
                                                                   <option value="4" <?php if($ordervalue['order_status'] == 4){ echo 'selected'; } ?>>In-Transit</option> 
                                                                   <option value="5" <?php if($ordervalue['order_status'] == 5){ echo 'selected'; } ?>>Manual</option>  -->
                                                                   <option value="6" <?php if($ordervalue['order_status'] == 6){ echo 'selected'; } ?>>Delivered</option> 
                                                                   <option value="7" <?php if($ordervalue['order_status'] == 7){ echo 'selected'; } ?>>Return</option> 
                                                                   <option value="8" <?php if($ordervalue['order_status'] == 8){ echo 'selected'; } ?>>Rejected</option> 
                                                                   <option value="9" <?php if($ordervalue['order_status'] == 9){ echo 'selected'; } ?>>Cancel by Buyer</option> 
                                                                   <!-- <option value="10" <?php if($ordervalue['order_status'] == 10){ echo 'selected'; } ?>>Undelivered</option>  -->
                                                            </select>  
                                                            <input type="hidden" name="order_id" value="<?php echo $edit_id; ?>">  
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

                        <?php include('common/footer.php'); ?>
                    </div> <!-- content ent -->

                </div>  <!-- content wrapper end -->

            </div> <!-- Page content end -->

        </div> <!-- Page container end -->


        <script src="<?php echo $base_url_js; ?>plugins/parsley/parsley.min.js"></script>
        <script type="text/javascript" src="<?php echo $base_url_js; ?>tag/jquery.tagsinput.js"></script>
        <script type="text/javascript">
            $(document).ready(function ()
            {
                $('#view_order_form').parsley();
                $('#view_order_form').on('submit', function (e)
                {
                    e.preventDefault();
                    var f = $(this);
                    f.parsley().validate();
                    if (f.parsley().isValid())
                    {
                        
                        $.ajax(
                            {
                                url: "<?php echo $base_url; ?>update-order-submit.php",
                                type: "POST",
                                data: $('#view_order_form').serialize(),
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
