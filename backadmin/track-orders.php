<?php
include('common/config.php');
include('common/check_login.php');
if ($admin == 1)
{
    $module_full_name = 'Track Orders';
    $module_short_name = 'Track Orders';
    $module_name = 'track-orders';

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
            /*table tr td:first-child {
                display: none;
            }

            table th:first-child {
                display: none;
            }*/

            #all-in-transit-order-table tr td:first-child {
                display: none;
            }

            #all-in-transit-order-table th:first-child {
                display: none;
            }

            #all-delivered-order-table tr td:first-child {
                display: none;
            }

            #all-delivered-order-table th:first-child {
                display: none;
            }

            table th {
                width: 100px !important;
            }

            .<?php echo $module_name; ?>-search-input {
                width: 100%;
                height: <?php echo $search_input_height; ?>;
            }

            .<?php echo $module_name; ?>-search-button {
                width: 100%;
            }

            .daterangepicker.dropdown-menu {
                max-width: 50px;
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
                <div class="page-title" style="float: left">
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

                <div style="float: right; margin-top: 10px">
                    <div class="row">
                        <div class="col-md-4" style="margin-top: 5px">
                            <input type="text" id="export_start_date" name="export_start_date"
                                   class="<?php echo $module_name; ?>-search-input form-control" placeholder="From">

                        </div>
                        <div class="col-md-4" style="margin-top: 5px">
                            <input type="text" id="export_end_date" name="export_end_date"
                                   class="<?php echo $module_name; ?>-search-input form-control" placeholder="To">
                        </div>
                        <div class="col-md-4">
                            <button type="button" style="margin: 2px" onclick="export_excel()"
                                    class="btn bg-<?php echo $theme_color; ?> heading-btn">
                                <i class="icon-transmission position-left"></i>
                                Export
                            </button>
                        </div>
                    </div>
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
                            <ul class="breadcrumb" style="float: left;">
                                <li>
                                    <a href="<?php echo $base_url; ?>">
                                        <i class="icon-home2 position-left"></i>
                                        Dashboard
                                    </a>
                                </li>
                                <li><?php echo $module_short_name; ?></li>
                                <li class="active"> <?php echo $module_short_name; ?></li>
                            </ul>

                            <div style="float: right;">
                                <div class="row">
                                    <div class="col-md-4" style="margin-top: 7px">
                                        <input type="text" id="export_start_date" name="export_start_date"
                                               class="<?php echo $module_name; ?>-search-input form-control" placeholder="From">

                                    </div>
                                    <div class="col-md-4" style="margin-top: 7px">
                                        <input type="text" id="export_end_date" name="export_end_date"
                                               class="<?php echo $module_name; ?>-search-input form-control" placeholder="To">
                                    </div>
                                    <div class="col-md-4" style="margin-top: 5px">
                                        <button type="button" style="margin: 2px" onclick="export_excel()"
                                                class="btn bg-<?php echo $theme_color; ?> heading-btn">
                                            <i class="icon-transmission position-left"></i>
                                            Export
                                        </button>
                                    </div>
                                </div>
                            </div>
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
                                        <a href="<?php echo $base_url; ?>new-orders">
                                            <button type="button" style="margin: 2px"
                                                    class="btn bg-<?php echo $theme_color; ?> heading-btn">
                                                <i class="icon-cart-add position-left"></i>
                                                New Orders
                                            </button>
                                        </a>
                                        <a href="<?php echo $base_url; ?>return-orders">
                                            <button type="button" style="margin: 2px"
                                                    class="btn bg-<?php echo $theme_color; ?> heading-btn">
                                                <i class="icon-undo position-left"></i>
                                                Returned Orders
                                            </button>
                                        </a>
                                        <a href="<?php echo $base_url; ?>cancelled-orders">
                                            <button type="button" style="margin: 2px"
                                                    class="btn bg-<?php echo $theme_color; ?> heading-btn">
                                                <i class="icon-cancel-square position-left"></i>
                                                Cancelled Orders
                                            </button>
                                        </a>
                                    </div>

                                </div>

                                <div class="panel-body">
                                    <input type="hidden" name="current_order_status" id="current_order_status" value="<?php echo OrderStatus::IN_TRANSIT?>">
                                    <div class="table-responsive">
                                        <div class="tabbable">
                                            <ul class="nav nav-tabs nav-tabs-highlight" id="my_order_tab">
                                                <li class="active" id="in_transit_order_li"><a onclick="load_data(4,1);"
                                                                                               data-toggle="tab" data-target="#in_transit_order_tab"
                                                                                               data-response="#in-transit-order-table"
                                                                                               data-loader="#in_transit_order_loader"
                                                                                               data-tab-name="in_transit_order"><i
                                                                class="icon-checkmark-circle2 position-left"></i> In-Transit</a></li>
                                                <li class="" id="delivered_order_li"><a onclick="load_data(6,1);"
                                                                                        data-toggle="tab" data-target="#delivered_order_tab"
                                                                                        data-response="#delivered-order-table"
                                                                                        data-loader="#delivered_order_loader"
                                                                                        data-tab-name="delivered_order"><i
                                                                class="icon-circle-down2 position-left"></i> Delivered</a></li>
                                            </ul>

                                            <div class="tab-content" style="min-height:400px">
                                                <div class="tab-pane active" id="in_transit_order_tab">
                                                    <table class="table  table-striped table-hover table-checkable dataTable no-footer" id="all-in-transit-order-table">
                                                        <thead>
                                                        <tr>
                                                            <th data-hide="phone">id</th>
                                                            <th data-hide="phone">Image</th>
                                                            <th data-toggle="true">Product Summary</th>
                                                            <th data-hide="phone">Total Quantity</th>
                                                            <th data-hide="phone,tablet">Buyer details</th>
                                                            <th data-hide="phone,tablet">Order Status</th>
                                                            <th data-hide="phone,tablet">Order Summary</th>
                                                            <th class="text-center" style="width: 30px;">Actions</th>
                                                        </tr>
                                                        </thead>
                                                        <thead style="background: #fff">
                                                        <tr>
                                                            <td><input type="text" id="search_id_in_transit_order" name="search_id_in_transit_order"
                                                                       class="<?php echo $module_name; ?>-search-input form-control">
                                                            </td>
                                                            <td></td>
                                                            <td><input type="text" id="search_product_summary_in_transit_order" name="search_product_summary_in_transit_order"
                                                                       class="<?php echo $module_name; ?>-search-input form-control" placeholder="order id">
                                                            </td>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-md-12" style="padding: 5px">
                                                                        <input type="text" id="search_total_qty_from_in_transit_order" name="search_total_qty_from_in_transit_order"
                                                                               class="<?php echo $module_name; ?>-search-input form-control" placeholder="Min quantity"
                                                                               onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12" style="padding: 5px">
                                                                        <input type="text" id="search_total_qty_to_in_transit_order" name="search_total_qty_to_in_transit_order"
                                                                               class="<?php echo $module_name; ?>-search-input form-control" placeholder="Max quantity"
                                                                               onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td><input type="text" id="search_buyer_details_in_transit_order" name="search_buyer_details_in_transit_order"
                                                                       class="<?php echo $module_name; ?>-search-input form-control">
                                                            </td>
                                                            <td></td>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-md-12" style="padding: 5px">
                                                                        <input type="text" id="search_price_from_in_transit_order" name="search_price_from_in_transit_order"
                                                                               class="<?php echo $module_name; ?>-search-input form-control" placeholder="Min price"
                                                                               onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12" style="padding: 5px">
                                                                        <input type="text" id="search_price_to_in_transit_order" name="search_price_to_in_transit_order"
                                                                               class="<?php echo $module_name; ?>-search-input form-control" placeholder="Max price"
                                                                               onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-md-12" style="margin-bottom: 10px;">
                                                                        <button type="button"
                                                                                class="btn bg-<?php echo $theme_color; ?> heading-btn legitRipple <?php echo $module_name; ?>-search-button"
                                                                                onclick="load_data(4,0)">
                                                                            <i class="icon-search4 position-left"></i> Search
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <button type="reset"
                                                                                class="btn bg-warning heading-btn legitRipple <?php echo $module_name; ?>-search-button"
                                                                                onclick="load_data(4,1)" id="reset_filter">
                                                                            <i class=" icon-undo position-left"></i> Reset
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="upcoming-order-table">
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="tab-pane" id="delivered_order_tab">
                                                    <table class="table  table-striped table-hover table-checkable dataTable no-footer" id="all-delivered-order-table">
                                                        <thead>
                                                        <tr>
                                                            <th data-hide="phone">id</th>
                                                            <th data-hide="phone">Image</th>
                                                            <th data-toggle="true">Product Summary</th>
                                                            <th data-hide="phone">Total Quantity</th>
                                                            <th data-hide="phone,tablet">Buyer details</th>
                                                            <th data-hide="phone,tablet">Order Status</th>
                                                            <th data-hide="phone,tablet">Order Summary</th>
                                                            <th class="text-center" style="width: 30px;">Actions</i></th>
                                                        </tr>
                                                        </thead>
                                                        <thead style="background: #fff">

                                                        <tr>
                                                            <td><input type="text" id="search_id_delivered_order" name="search_id_delivered_order"
                                                                       class="<?php echo $module_name; ?>-search-input form-control">
                                                            </td>
                                                            <td></td>
                                                            <td><input type="text" id="search_product_summary_delivered_order" name="search_product_summary_delivered_order"
                                                                       class="<?php echo $module_name; ?>-search-input form-control" placeholder="order id">
                                                            </td>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-md-12" style="padding: 5px">
                                                                        <input type="text" id="search_total_qty_from_delivered_order" name="search_total_qty_from_delivered_order"
                                                                               class="<?php echo $module_name; ?>-search-input form-control" placeholder="Min quantity"
                                                                               onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12" style="padding: 5px">
                                                                        <input type="text" id="search_total_qty_to_delivered_order" name="search_total_qty_to_delivered_order"
                                                                               class="<?php echo $module_name; ?>-search-input form-control" placeholder="Max quantity"
                                                                               onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td><input type="text" id="search_buyer_details_delivered_order" name="search_buyer_details_delivered_order"
                                                                       class="<?php echo $module_name; ?>-search-input form-control">
                                                            </td>
                                                            <td></td>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-md-12" style="padding: 5px">
                                                                        <input type="text" id="search_price_from_delivered_order" name="search_price_from_delivered_order"
                                                                               class="<?php echo $module_name; ?>-search-input form-control" placeholder="Min price"
                                                                               onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12" style="padding: 5px">
                                                                        <input type="text" id="search_price_to_delivered_order" name="search_price_to_delivered_order"
                                                                               class="<?php echo $module_name; ?>-search-input form-control" placeholder="Max price"
                                                                               onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-md-12" style="margin-bottom: 10px;">
                                                                        <button type="button"
                                                                                class="btn bg-<?php echo $theme_color; ?> heading-btn legitRipple <?php echo $module_name; ?>-search-button"
                                                                                onclick="load_data(6,0)">
                                                                            <i class="icon-search4 position-left"></i> Search
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <button type="reset"
                                                                                class="btn bg-warning heading-btn legitRipple <?php echo $module_name; ?>-search-button"
                                                                                onclick="load_data(6,1)" id="reset_filter">
                                                                            <i class=" icon-undo position-left"></i> Reset
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="delivered-order-table">
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <?php include('common/footer.php'); ?>
                </div> <!-- content ent -->

                <div id="view_order_all_product_modal_div"></div>


            </div>  <!-- content wrapper end -->

        </div> <!-- Page content end -->

    </div> <!-- Page container end -->


    <script src="<?php echo $base_url_js; ?>plugins/parsley/parsley.min.js"></script>
    <script type="text/javascript" src="<?php echo $base_url_js; ?>plugins/media/fancybox.min.js"></script>
    <script type="text/javascript" src="<?php echo $base_url_js; ?>pages/gallery_library.js"></script>
    <script type="text/javascript" src="<?php echo $base_url_js; ?>plugins/tables/datatables/datatables.js"></script>
    <script type="text/javascript">
        $(document).ready(function ()
        {
            $("#all-<?php echo $module_name; ?>-table_filter").css("display", "none");  // hiding global search box
            load_data(4, 0);
        });


        $("#search_product_summary_in_transit_order,#search_total_qty_from_in_transit_order,#search_total_qty_to_in_transit_order,#search_buyer_details_in_transit_order,#search_price_from_in_transit_order,#search_price_to_in_transit_order").on("keydown", function (e)
        {
            if (e.keyCode === 13)
            {  //checks whether the pressed key is "Enter"
                load_data(4);
            }
        });
        $("#search_product_summary_delivered_order,#search_total_qty_from_delivered_order,#search_total_qty_to_delivered_order,#search_buyer_details_delivered_order,#search_price_from_delivered_order,#search_price_to_delivered_order").on("keydown", function (e)
        {
            if (e.keyCode === 13)
            {  //checks whether the pressed key is "Enter"
                load_data(6);
            }
        });

        function load_data(order_type_status, reset_flag = 0)
        {
            var table_id = '';
            var form_data = '';
            $('#current_order_status').val(order_type_status);

            if (order_type_status == 4)
            {
                table_id = '#all-in-transit-order-table';
                if (reset_flag == 0)            //call to load_data() when on first table load or when search button is clicked
                {
                    form_data =
                        {
                            "search_product_summary_in_transit_order": $('#search_product_summary_in_transit_order').val(),
                            "search_total_qty_from_in_transit_order": $('#search_total_qty_from_in_transit_order').val(),
                            "search_total_qty_to_in_transit_order": $('#search_total_qty_to_in_transit_order').val(),
                            "search_buyer_details_in_transit_order": $('#search_buyer_details_in_transit_order').val(),
                            "search_price_from_in_transit_order": $('#search_price_from_in_transit_order').val(),
                            "search_price_to_in_transit_order": $('#search_price_to_in_transit_order').val(),
                            "order_type_status": order_type_status
                        };
                }
                else if (reset_flag == 1)           //call to load_data() when reset button is clicked
                {
                    $('#search_product_summary_in_transit_order').val('');
                    $('#search_total_qty_from_in_transit_order').val('');
                    $('#search_total_qty_to_in_transit_order').val('');
                    $('#search_buyer_details_in_transit_order').val('');
                    $('#search_price_from_in_transit_order').val('');
                    $('#search_price_to_in_transit_order').val('');
                    form_data =
                        {
                            "search_product_summary_in_transit_order": '',
                            "search_total_qty_from_in_transit_order": '',
                            "search_total_qty_to_in_transit_order": '',
                            "search_buyer_details_in_transit_order": '',
                            "search_price_from_in_transit_order": '',
                            "search_price_to_in_transit_order": '',
                            "order_type_status": order_type_status
                        }
                }
            }
            else if (order_type_status == 6)
            {
                table_id = '#all-delivered-order-table';
                if (reset_flag == 0)            //call to load_data() when on first table load or when search button is clicked
                {
                    form_data =
                        {
                            "search_product_summary_delivered_order": $('#search_product_summary_delivered_order').val(),
                            "search_total_qty_from_delivered_order": $('#search_total_qty_from_delivered_order').val(),
                            "search_total_qty_to_delivered_order": $('#search_total_qty_to_delivered_order').val(),
                            "search_buyer_details_delivered_order": $('#search_buyer_details_delivered_order').val(),
                            "search_price_from_delivered_order": $('#search_price_from_delivered_order').val(),
                            "search_price_to_delivered_order": $('#search_price_to_delivered_order').val(),
                            "order_type_status": order_type_status
                        };
                }
                else if (reset_flag == 1)           //call to load_data() when reset button is clicked
                {
                    $('#search_product_summary_delivered_order').val('');
                    $('#search_total_qty_from_delivered_order').val('');
                    $('#search_total_qty_to_delivered_order').val('');
                    $('#search_buyer_details_delivered_order').val('');
                    $('#search_price_from_delivered_order').val('');
                    $('#search_price_to_delivered_order').val('');
                    form_data =
                        {
                            "search_product_summary_delivered_order": '',
                            "search_total_qty_from_delivered_order": '',
                            "search_total_qty_to_delivered_order": '',
                            "search_buyer_details_delivered_order": '',
                            "search_price_from_delivered_order": '',
                            "search_price_to_delivered_order": '',
                            "order_type_status": order_type_status
                        }
                }
            }

            var dataTable = $(table_id).DataTable(
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


        function view_order_all_product(order_id, order_status, return_status=0)
        {
            if (order_id != '')
            {
                var formData =
                    {
                        'order_id': order_id,
                        'order_status': order_status,
                    };
                $.ajax({
                    url: "<?php echo $base_url;?>view-order-all-product-modal-data.php",
                    type: "POST",
                    data: formData,
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
                            $('#view_order_all_product_modal_div').html(data.html_message);
                            $('#view_order_all_product_modal').modal('show');
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
                $.notifyBar({cssClass: "error", html: "Some Error Occured! Please try again."});
            }
        }
        function order_update_action(order_id, update_order_status, order_total_product)
        {
            if (order_id != '' && update_order_status != '' && (order_total_product > 0))
            {
                var formData =
                    {
                        'order_id': order_id,
                        'update_order_status': update_order_status,
                        'order_total_product': order_total_product,
                    };
                $.ajax({
                    url: "<?php echo $base_url;?>order-update-submit.php",
                    type: "POST",
                    data: formData,
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
                            if (data.update == '1')
                            {
                                $('#row_' + order_id + '').remove();
                            }
                            $.notifyBar({cssClass: "success", html: data.html_message});
                            if (update_order_status == <?php echo OrderStatus::DELIVERED?>)
                            {
                                $("#in_transit_order_li").removeClass("active");
                                $("#in_transit_order_tab").removeClass("active");
                                $("#delivered_order_li").addClass("active");
                                $("#delivered_order_tab").addClass("active");
                                load_data(update_order_status);
                            }
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
                $.notifyBar({cssClass: "error", html: "Some Error Occured! Please try again."});
            }
        }


        function export_excel()
        {
            var form_data =
                {
                    "current_order_status": $('#current_order_status').val(),
                    "export_start_date": $('#export_start_date').val(),
                    "export_end_date": $('#export_end_date').val()
                };
            $.ajax({
                type: "POST",
                data: form_data,
                url: "export-orders-log.php",
                dataType: 'json',
                encode: true,
                success: function (data)
                {
                    if (data.file == '')
                    {
                        $.notifyBar({cssClass: "error", html: "No Records To Export!"});
                    }
                }
            }).done(function (data)
            {
                if (data.file != '')
                {
                    var $a = $("<a>");
                    $a.attr("href", data.file);
                    $("body").append($a);
                    var file_name = data.file_name;
                    $a.attr("download", file_name);
                    $a[0].click();
                    $a.remove();
                }
            });
        }

        $('#export_start_date,#export_end_date').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'DD-MM-YYYY'
            }
        }).val('');



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
