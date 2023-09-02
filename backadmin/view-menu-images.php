<?php
include 'common/config.php';
include 'common/check_login.php';
if ($admin == 1)
{
    $module_full_name = 'Menu Images';
    $module_short_name = 'Menu Images';
    $module_name = 'menu-images';
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
                <div class="content"> <!-- content Start -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title"> <?php echo $module_short_name; ?></h5>
                                    <div class="heading-elements">
                                        <a id="delete_button_div">
                                            <button type="button" style="margin-right: 2px;" id="delete_button"
                                                    class="btn bg-danger heading-btn">
                                                <i class="icon-trash position-left"></i>
                                                Delete
                                            </button>
                                        </a>
                                        <a href="<?php echo $base_url; ?>add-<?php echo $module_name; ?>">
                                            <button type="button"
                                                    class="btn bg-<?php echo $theme_color; ?> heading-btn">
                                                <i class="icon-file-plus position-left"></i>
                                                Add <?php echo $module_full_name; ?>
                                            </button>
                                        </a>
                                    </div>

                                </div>

                                <div class="panel-body">

                                    <div class="table-responsive">
                                        <table
                                                class="table table-striped table-hover table-checkable dataTable no-footer "
                                                id="all-<?php echo $module_name; ?>-table">
                                            <thead>
                                            <tr>
                                                <!--<th>id</th>-->
                                                <th><input name="select_all" value="1" id="example-select-all" type="checkbox"></th>
                                                <th>Menu</th>
                                                <th>Image</th>
                                                <th>Status</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                            </thead>
                                            <thead style="background: #fff">
                                            <tr>
                                                <td></td>
                                                <td><input type="text" id="search_title1" name="search_title1"
                                                           class="<?php echo $module_name; ?>-search-input form-control">
                                                </td>
                                                <td></td>
                                                <td>
                                                    <select class="form-control select" id="search_status" name="search_status">
                                                        <option value="2">-</option>
                                                        <option value="1">Active</option>
                                                        <option value="0">Inactive</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-6" style="margin-bottom: 10px;">
                                                            <button type="button"
                                                                    class="btn bg-<?php echo $theme_color; ?> heading-btn legitRipple <?php echo $module_name; ?>-search-button"
                                                                    onclick="load_data()">
                                                                <i class="icon-search4 position-left"></i> Search
                                                            </button>
                                                        </div>
                                                        <div class="col-md-6">
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
                    <div id="modal_response_search_modules_div"></div>
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


        $("#delete_button").click(function ()
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
                bootbox.alert("Please select company vision!");
            }
            else
            {
                delete_rows(arrayOfIds);
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
                form_data =
                {
                    "search_title1": $('#search_title1').val(),
                    "search_status": search_status
                };
            }
            else if (reset_flag == 1)           //call to load_data() when reset button is clicked
            {
                $('#search_title1').val('');
                form_data =
                    {
                        "search_title1": '',
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
                                $.notifyBar({cssClass: "error", html: "Error Occurred!"});
                            }
                        });
                }

            });

        }

        function delete_rows(delete_id_array)
        {
            bootbox.confirm("Continue Delete?", function (result)
            {
                if (result == true)
                {
                    var formData =
                        {
                            'delete_id_array': delete_id_array
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
                                    /*for (var i = 0; i < delete_id_array.count; i++)
                                     {
                                     $('#row_' + delete_id_array[$i]).remove();
                                     }*/
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

        $("#reset_filter").click(function ()
        {
            $('#search_status').select2('val', '2');
        });

        $("#search_title").on("keydown", function (e)
        {
            if (e.keyCode === 13)
            {  //checks whether the pressed key is "Enter"
                load_data();
            }
        });


        // Handle click on "Select all" control
        $('#example-select-all').on('click', function ()
        {
            // Check/uncheck all checkboxes in the table
            var rows = $('#all-<?php echo $module_name; ?>-table').DataTable().rows({'search': 'applied'}).nodes();
            $(' input[type="checkbox"]', rows).prop('checked', this.checked);
//            $('.checker span').toggleClass("checked");
//            $('.checker span').prop("indeterminate", true)
        });


        //        // Handle click on checkbox to set state of "Select all" control
        $('#all-<?php echo $module_name; ?>-table tbody').on('change', 'input[type="checkbox"]', function ()
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
