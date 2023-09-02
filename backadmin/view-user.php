<?php
include 'common/config.php';
include 'common/check_login.php';
if ($admin == 1)
{
    $module_full_name = 'User';
    $module_short_name = 'User';
    $module_name = 'user';

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
            table#all-modal-user-cart-table-data tr td:first-child {
                display: none;
            }

            table#all-modal-user-cart-table-data th:first-child {
                display: none;
            }

            table#all-modal-user-cart-table-data th {
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

                                    <!-- <div class="heading-elements">
                                        <a href="<?php echo $base_url; ?>add-<?php echo $module_name; ?>/<?php echo $user_type; ?>">
                                            <button type="button"
                                                    class="btn bg-<?php echo $theme_color; ?> heading-btn">
                                                <i class="icon-file-plus position-left"></i>
                                                Add <?php echo $module_full_name; ?>
                                            </button>
                                        </a>
                                    </div> -->

                                </div>

                                <div class="panel-body">

                                    <div class="table-responsive">
                                        <table
                                                class="table table-striped table-hover table-checkable dataTable no-footer "
                                                id="all-<?php echo $module_name; ?>-table">
                                            <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>User name</th>
                                                <th>Email</th>
                                                <th>Gender</th>
                                                <th>Mobile</th>
                                                <th>Status</th>
                                                <th class="text-center" width="200px">Actions</th>
                                            </tr>
                                            </thead>
                                            <thead style="background: #fff">
                                            <tr>
                                                <td><input type="text" id="search_id" name="search_id"
                                                           class="<?php echo $module_name; ?>-search-input form-control">
                                                </td>
                                                <td><input type="text" id="search_user_name" name="search_user_name"
                                                           class="<?php echo $module_name; ?>-search-input form-control">
                                                </td>
                                                <td><input type="text" id="search_email" name="search_email"
                                                           class="<?php echo $module_name; ?>-search-input form-control">
                                                </td>
                                                <td>
                                                    <select class="form-control select" id="search_gender"
                                                            name="search_gender">
                                                        <option value="2">-</option>
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" id="search_mobile" name="search_mobile"
                                                           class="<?php echo $module_name; ?>-search-input form-control">
                                                </td>
                                                <td>
                                                    <select class="form-control select" id="search_status"
                                                            name="search_status">
                                                        <option value="2">-</option>
                                                        <option value="1">Active</option>
                                                        <option value="0">Inactive</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-12" style="margin-bottom: 10px;">
                                                            <button type="button"
                                                                    class="btn bg-<?php echo $theme_color; ?> heading-btn legitRipple <?php echo $module_name; ?>-search-button"
                                                                    onclick="load_data()">
                                                                <i class="icon-search4 position-left"></i> Search
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="row">
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

                    <div id="modal_response_user_address_div"></div>
                    <div id="modal_response_user_add_address_div"></div>
                    <div id="modal_response_user_edit_address_div"></div>

                    <div id="modal_response_user_cart_div"></div>

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

        $("#search_user_name,#search_email,#search_mobile").on("keydown", function (e)
        {
            if (e.keyCode === 13)
            {  //checks whether the pressed key is "Enter"
                load_data();
            }
        });

        function load_data(reset_flag = 0)
        {
            var form_data;

//            debugger;
            if (reset_flag == 0)            //call to load_data() when on first table load or when search button is clicked
            {
                var search_status = $('#search_status').val();
                if (search_status == '2')
                {
                    search_status = '';
                }
                var search_gender = $('#search_gender').val();
                if (search_gender == '2')
                {
                    search_gender = '';
                }
                form_data =
                    {
                        "search_user_name": $('#search_user_name').val(),
                        "search_usercode": $('#search_usercode').val(),
                        "search_email": $('#search_email').val(),
                        "search_mobile": $('#search_mobile').val(),
                        "search_refrralcode": $('#search_refrralcode').val(),
                        "search_refrralname": $('#search_refrralname').val(),
                        "search_gender": search_gender,
                        "search_status": search_status
                    };
            }
            else if (reset_flag == 1)           //call to load_data() when reset button is clicked
            {
                $('#search_user_name').val('');
                $('#search_usercode').val('');
                $('#search_email').val('');
                $('#search_mobile').val('');
                $('#search_refrralcode').val('');
                $('#search_refrralname').val('');

                form_data =
                    {
                        "search_user_name": '',
                        "search_usercode": '',
                        "search_email": '',
                        "search_mobile": '',
                        "search_refrralcode": '',
                        "search_refrralname": '',
                        "search_gender": '',
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
                        "url": "<?php echo $base_url; ?>all-<?php echo $module_name; ?>-table-data.php",
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
            $('#search_gender').select2('val', '2');
        });


        function delete_row(delete_id)
        {
            bootbox.confirm("Continue Delete?", function (result)
            {
                if (result == true)
                {
                    var formData =
                        {
                            'delete_id': delete_id,
                        };
                    $.ajax(
                        {
                            url: "<?php echo $base_url;?>delete-<?php echo $module_name; ?>.php",
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

        function modal_address_delete_row(delete_id)
        {
            bootbox.confirm("Continue Delete?", function (result)
            {
                if (result == true)
                {
                    var formData =
                        {
                            'delete_id': delete_id
                        };
                    $.ajax({
                        url: "<?php echo $base_url;?>delete-user-address.php",
                        type: "POST",
                        data: formData,
                        dataType: 'json',
                        encode: true,
                        beforeSend: function ()
                        {
//                            $.blockUI({message: '<i class="icon-spinner3 spinner position-left" style="font-size:21px"></i>'});
                        },
                        success: function (data)
                        {
                            if (data.status == 'success')
                            {
                                //new PNotify({title: 'Success',text: data.html_message,  icon: 'icon-checkmark3', type: 'success'});
                                $('#row_user_address_' + delete_id).remove();
                                $.notifyBar({cssClass: "success", html: data.html_message});
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

        function modal_user_address(user_id)
        {
            $.ajax({
                url: "<?php echo $base_url;?>modal-<?php echo $module_name; ?>-address.php",
                type: "POST",
                data: {user_id: user_id},
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
                        $('#modal_response_user_address_div').html(data.html_message);
                        $("#modal_user_address").modal("show");
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

        function modal_user_add_address(user_id)
        {
            $.ajax({
                url: "<?php echo $base_url;?>modal-user-add-address.php",
                type: "POST",
                data: {user_id: user_id},
                dataType: 'json',
                encode: true,
                success: function (data)
                {
                    if (data.status == 'success')
                    {
                        $('#modal_response_user_add_address_div').html(data.html_message);
                        $("#modal_user_address").modal("hide");
                        $("#modal_user_add_address").modal("show");
//                        $('#status').addClass('styled');
                        $.getScript("<?php echo $base_url_js;?>pages/form_checkboxes_radios.js");
                        $.getScript("<?php echo $base_url_common;?>common.js");
                        $('#country_id').select2();

                        $('#address_reset').on('click', function ()
                        {
//                            debugger;
                            $('#modal_add_user_address_form').parsley().destroy();
                            $('#modal_add_user_address_form_state_selection_div').empty();
                            $('#modal_add_user_address_form_city_selection_div').empty();
                            $('#country_id').select2('val', ' ');
                        });

                        $('#modal_add_user_address_form').parsley();
                        $('#modal_add_user_address_form').on('submit', function (e)
                        {
                            e.preventDefault();
                            var f = $(this);
                            f.parsley().validate();
                            if (f.parsley().isValid())
                            {
                                $.ajax(
                                    {
                                        url: "<?php echo $base_url; ?>modal-user-add-address-submit.php",
                                        type: "POST",
                                        data: $('#modal_add_user_address_form').serialize(),
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
                                                $('#<?php echo $module_name; ?>_form').trigger("reset");
                                                $.notifyBar({cssClass: "success", html: data.html_message});
                                                $("#modal_user_add_address").modal("hide");
                                            }
                                            else
                                            {
                                                $.notifyBar({cssClass: "error", html: data.html_message});
                                                //dataTable.ajax.reload();
                                            }
                                        }
                                    });
                            }
                            else
                            {
                                e.preventDefault();
                            }
                        });

                    }
                    else
                    {
                        $.notifyBar({cssClass: "error", html: data.html_message});
                    }
                }
            });
        }

        function modal_user_edit_address(user_address_id)
        {
            $.ajax({
                url: "<?php echo $base_url;?>modal-<?php echo $module_name; ?>-edit-address.php",
                type: "POST",
                data: {user_address_id: user_address_id},
                dataType: 'json',
                encode: true,
                success: function (data)
                {
                    $.unblockUI();
                    if (data.status == 'success')
                    {
                        $('#modal_response_user_edit_address_div').html(data.html_message);
                        $("#modal_user_address").modal("hide");
                        $("#modal_user_edit_address").modal("show");
                        $.getScript("<?php echo $base_url_js;?>pages/form_checkboxes_radios.js");
                        $('#country_id').select2();
                        $('#modal_edit_user_address_form_state_id').select2();
                        $('#modal_edit_user_address_form_city_id').select2();

                        $('#modal_edit_user_address_form').parsley();
                        $('#modal_edit_user_address_form').on('submit', function (e)
                        {
                            e.preventDefault();
                            var f = $(this);
                            f.parsley().validate();
                            if (f.parsley().isValid())
                            {
                                $.ajax(
                                    {
                                        url: "<?php echo $base_url; ?>modal-user-edit-address-submit.php",
                                        type: "POST",
                                        data: $('#modal_edit_user_address_form').serialize(),
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
                                                $.notifyBar({cssClass: "success", html: data.html_message});
                                                $("#modal_user_edit_address").modal("hide");
                                            }
                                            else
                                            {
                                                $.notifyBar({cssClass: "error", html: data.html_message});
                                                //dataTable.ajax.reload();
                                            }
                                        }
                                    });
                            }
                            else
                            {
                                e.preventDefault();
                            }
                        });


                    }
                    else
                    {
                        $.notifyBar({cssClass: "error", html: data.html_message});
                    }
                }
            });
        }

        var form_id = '';
        function get_state_selection(country_id, form_id)
        {
            $('#all-<?php echo $module_name; ?>-table').parsley().destroy();

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

                $('#all-<?php echo $module_name; ?>-table').parsley().destroy();

                if ($('#' + form_id + '_state_id').size() > 0)
                {
                    $('#' + form_id + '_state_id').attr('data-parsley-required', 'false');
                }
                if ($('#' + form_id + '_city_id').size() > 0)
                {
                    $('#' + form_id + '_city_id').attr('data-parsley-required', 'false');
                }
            }
            $('#all-<?php echo $module_name; ?>-table').parsley();
        }

        function get_city_selection(state_id, form_id)
        {
            $('#all-<?php echo $module_name; ?>-table').parsley().destroy();
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

            $('#all-<?php echo $module_name; ?>-table').parsley();
        }


        function modal_user_cart(user_id)
        {
            $.ajax({
                url: "<?php echo $base_url;?>modal-user-cart.php",
                type: "POST",
                data: {
                    user_id: user_id
                },
                dataType: 'json',
                encode: true,
                success: function (data)
                {
                    if (data.status == 'success')
                    {
                        $('#modal_response_user_cart_div').html(data.html_message);
                        $("#modal_user_cart").modal("show");

                        $('#coupon_id').select2();
                        load_cart_data(user_id);

                        //  stop and start background body scroll when modal is open

                        $("body").css("overflow-y", "hidden");
                        $('#modal_user_cart').on('hidden.bs.modal', function ()
                        {
                            $("body").css("overflow-y", "scroll");
                        });

                        // Handle click on "Select all" control
                        $('#example-select-all').on('click', function ()
                        {
                            // Check/uncheck all checkboxes in the table
                            var rows = $('#all-modal-user-cart-table-data').DataTable().rows({'search': 'applied'}).nodes();
                            $(' input[type="checkbox"]', rows).prop('checked', this.checked);
                        });


                        //        // Handle click on checkbox to set state of "Select all" control
                        $('#all-modal-user-cart-table-data tbody').on('change', 'input[type="checkbox"]', function ()
                        {
                            // If checkbox is not checked
                            if (!this.checked)
                            {
                                var el = $('#example-select-all').get(0);
                                // If "Select all" control is checked and has 'indeterminate' property
                                if (el && el.checked && ('indeterminate' in el))
                                {
                                    // Set visual state of "Select all" control
                                    // as 'indeterminate'
                                    el.indeterminate = true;
                                }
                            }
                        });

                        $("#notify_user").click(function ()
                        {
                            var i = 0;
                            var arrayOfIds = $.map($(".single_select"), function (n, i)
                            {
                                if (n.checked)
                                    return n.value;
                            });
//            console.log(arrayOfIds);
                            if (arrayOfIds == '')
                            {
                                bootbox.alert("Please select products!");
                            }
                            else
                            {
                                var coupon_id = $('#coupon_id').val();
                                $.ajax({
                                    url: "<?php echo $base_url;?>ajax-notify-user.php",
                                    type: "POST",
                                    data: {
                                        user_cart_id_array: arrayOfIds,
                                        user_id: user_id,
                                        coupon_id: coupon_id
                                    },
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
                                            $("#modal_user_cart").modal("hide");
                                            $.notifyBar({cssClass: "success", html: data.html_message});
                                        }
                                        else
                                        {
                                            $.notifyBar({cssClass: "error", html: data.html_message});
                                        }
                                    }
                                });
                            }
                        });

                    }
                    else
                    {
                        $.notifyBar({cssClass: "error", html: data.html_message});
                    }
                }
            });
        }


        function load_cart_data(user_id)
        {
            var dataTable = $('#all-modal-user-cart-table-data').DataTable(
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
                        "url": "<?php echo $base_url; ?>all-modal-user-cart-table-data.php",
                        "dataType": "json",
                        "data": {user_id: user_id},
                        "dataSrc": function (json)
                        {
                            console.log(json);
                            return json.data;
                        },
                        error: function ()
                        {
                            $.notifyBar({cssClass: "error", html: "Error loading data from server."});
                        }
                    },
                    'columnDefs': [{
                        'targets': 0,
                        'searchable': false,
                        'orderable': false,
                        'className': 'dt-body-center',
                        'render': function (data, type, full, meta)
                        {
                            if (data)
                            {
//                                console.log(data);
                                return '<input type="checkbox" class="single_select" name="id[]" value="' + $('<div/>').text(data).html() + '">';
                            }
                            else
                            {
                                return '';
                            }
                        }
                    }]
                });
        }

        $("#address_reset").click(function ()
        {
            $('select').select2('val', '');
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
