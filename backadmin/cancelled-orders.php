<?php
include 'common/config.php';
include 'common/check_login.php';
if ($admin == 1)
{
    $module_full_name = "Cancelled/Rejected Order";
    $module_short_name = "Cancelled/Rejected Order";
    $module_name = "cancelled-order";
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $company_title; ?> - <?php echo $module_full_name; ?></title>
        <?php include('common/header-css.php'); ?>
        <style>
            table#all-<?php echo $module_name; ?>-table tr td:first-child {
                display: none;
            }

            table#all-<?php echo $module_name; ?>-table th:first-child {
                display: none;
            }

            table#all-<?php echo $module_name; ?>-table th {
                width: 100px !important;
            }

            .<?php echo $module_name; ?>-search-input {
                width: 100%;
                height: <?php echo $search_input_height; ?>;
            }

            .<?php echo $module_name; ?>-search-button {
                width: 100%;
            }

            <?php if($page_layout == 1){ ?>
            .page-title {
                padding: 15px 36px 15px 0;
            }

            .content:first-child {
                padding-top: 2px;
            }

            .heading-elements > a {
                padding: 7px 15px 7px 0px;
            }

            <?php } ?>
        </style>
    </head>

    <body class="<?php if ($page_layout == 1)
    { ?>navbar-top-md-md <?php }
    else if ($page_layout == 2)
    { ?> navbar-top pace-done
        <?php
        if ($side_menu_state == 0)
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
                        <i class="icon-arrow-right13"></i> View <?php echo $module_short_name; ?>
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
                                <li class="active">View <?php echo $module_short_name; ?></li>
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


                                </div>

                                <div class="panel-body">

                                    <div class="table-responsive">
                                        <table
                                            class="table table-striped table-hover table-checkable dataTable no-footer "
                                            id="all-<?php echo $module_name; ?>-table">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Order No.</th>
                                                    <th>Order Date</th>
                                                    <th>User</th>
                                                    <th>Mobile</th>
                                                    <th>Product</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Status</th>
                                                    <th class="text-center">Actions</th>
                                                </tr>
                                            </thead>
                                            <thead style="background: #fff">
                                            <tr>
                                                <td><input type="text" id="search_id" name="search_id"
                                                           class="<?php echo $module_name; ?>-search-input form-control">
                                                </td>
                                                <td><input type="text" id="search_order_id" name="search_order_id"
                                                           class="<?php echo $module_name; ?>-search-input form-control">
                                                </td>
                                                <td><input type="date" id="search_order_date" name="search_order_date"
                                                           class="<?php echo $module_name; ?>-search-input form-control">
                                                </td>
                                                <td><input type="text" id="search_user" name="search_user"
                                                           class="<?php echo $module_name; ?>-search-input form-control">
                                                </td>
                                                <td><input type="text" id="search_user_mobile" name="search_user_mobile"
                                                           class="<?php echo $module_name; ?>-search-input form-control">
                                                </td>
                                                <td><input type="text" id="search_product_name" name="search_product_name"
                                                           class="<?php echo $module_name; ?>-search-input form-control">
                                                </td>
                                                <td><input type="text" id="search_product_price" name="search_product_price"
                                                           class="<?php echo $module_name; ?>-search-input form-control">
                                                </td>
                                                <td> </td>
                                                <td>
                                                    
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-12" style="margin-bottom: 10px;">
                                                            <button type="submit"
                                                                    class="btn bg-<?php echo $theme_color; ?> heading-btn legitRipple <?php echo $module_name; ?>-search-button"
                                                                    onclick="load_data()">
                                                                <i class="icon-search4 position-left"></i> Search
                                                            </button>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <button type="reset"
                                                                    class="btn bg-warning heading-btn legitRipple <?php echo $module_name; ?>-search-button"
                                                                    onclick="load_data(1)" id="reset_filter">
                                                                <i class=" icon-undo position-left"></i> Reset
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>

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
    <script type="text/javascript" src="<?php echo $base_url_js; ?>plugins/tables/datatables/datatables.js"></script>
    <script type="text/javascript">
        $(document).ready(function ()
        {
            $("#all-<?php echo $module_name; ?>-table_filter").css("display", "none");  // hiding global search box
            load_data();
        });

        function load_data(reset_flag = 0)
        {
            var form_data;

            if (reset_flag == 0)//call to load_data() when on first table load or when search button is clicked
            {
                var search_status = $('#search_status').val();
                if (search_status == '2')
                {
                    search_status = '';
                }
                form_data =
                {
                    "search_order_id": $('#search_order_id').val(),
                    "search_order_date": $('#search_order_date').val(),
                    "search_user": $('#search_user').val(),
                    "search_product_name": $('#search_product_name').val(),
                    "search_user_mobile": $('#search_user_mobile').val(),
                    "search_product_price": $('#search_product_price').val(),
                    "search_status": search_status,
                    "current_order_status": 'rejected_order',
                };
            }
            else if (reset_flag == 1)           //call to load_data() when reset button is clicked
            {
                $('#search_order_id').val('');
                $('#search_order_date').val('');
                $('#search_user').val('');
                $('#search_user_mobile').val('');
                $('#search_product_name').val('');
                $('#search_product_price').val('');

                form_data =
                {
                    "search_order_id": '',
                    "search_order_date": '',
                    "search_user":'',
                    "search_product_name": '',
                    "search_user_mobile": '',
                    "search_product_price": '',
                    "search_status": ''
                }
            }

            var dataTable = $('#all-<?php echo $module_name; ?>-table').DataTable(
                {
                    "processing": true,
                    "serverSide": true,
                    "bDestroy": true,
                    "bAutoWidth": false,
                    "bFilter": false,
                    "aaSorting": [0, "desc"],
                    "sDom": 'Rfrtlip',
                    "fnDrawCallback": function ()
                    {
                        $('.tooltip_class').tooltip();
                    },
                    "oLanguage": {
                        "sProcessing": '<i class="icon-spinner3 spinner position-left" style="font-size:21px"></i>'
                    },
                    "ajax": {
                        "type": "POST",
                        "url": "<?php echo $base_url; ?>all-order-table-data.php",
                        "dataType": "json",
                        "data": form_data,
                        "dataSrc": function (json)
                        {
                            console.log(json);
                            return json.data;

                        },
                        error: function ()
                        {
                            $.notifyBar({cssClass: "error", html: "Error loading data from server."});
                        }
                    }
                });
        }

        $("#reset_filter").click(function ()
        {
            $('#search_status').select2('val', '2');
        });

        $("#").on("keydown", function (e) {
            if (e.keyCode === 13) {  //checks whether the pressed key is "Enter"
                validate(e);
            }
        });

        function delete_row(delete_id)
        {
            alert(delete_id);
            bootbox.confirm("Are you sure this order Rejected now?", function (result)
            {
                if (result == true)
                {
                    var formData =
                    {
                        'delete_id': delete_id,
                    };
                    $.ajax(
                        {
                            url: "<?php echo $base_url;?>delete-order.php",
                            type: "POST",
                            data: formData,
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
                                    $('#row_' + delete_id).remove();
                                    $.notifyBar({cssClass: "success", html: data.html_message});
                                    load_data();
                                }
                                else
                                {
                                    $.notifyBar({cssClass: "error", html: data.html_message});
                                }
                            },
                            error: function (data, errorThrown)
                            {
                                $.unblockUI();
                                $.notifyBar({cssClass: "error", html: "Error occured!"});
                            }
                        });
                }

            });

        }

        $("#search_category_title,#search_subcategory_title").on("keydown", function (e) {
            if (e.keyCode === 13) {  //checks whether the pressed key is "Enter"
                load_data();
            }
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
?>
