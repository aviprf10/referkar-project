<?php
include 'common/config.php';
include 'common/check_login.php';
if ($admin == 1 || ($sub_admin == 1 && $is_country_read == 1))
{
    $module_full_name = "Category";
    $module_short_name = "Category";
    $module_name = "category";
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

            
            .dataTable {
                margin-bottom: 15px;
                max-width: none;
            }
            .dataTables_info {
                float: left;
                padding: 10px;
                margin-bottom: 1.25rem;
            }

            .dataTables_length {
                float: right;
                display: inline-block;
                margin: 0px 11px 1.25rem 1.25rem;
            }
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
                        <span class="breadcrumb-item active"><?php echo $module_full_name; ?></span>
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
                                </a><br><br>
                            </div>
                            <?php }?>
                        </div>

                        <div class="panel-body">
                            <div class="table-responsive">
                                <div class="card">
                                    <table
                                        class="table table-striped table-hover table-checkable dataTable no-footer "
                                        id="all-<?php echo $module_name; ?>-table">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Category Title</th>
                                            <th>Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        </thead>
                                        <thead style="background: #fff">
                                        <tr>
                                            <td><input type="text" id="search_id" name="search_id"
                                                       class="<?php echo $module_name; ?>-search-input form-control">
                                            </td>
                                            <td><input type="text" id="search_category_title" name="search_category_title"
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
                                                    <div class="col-md-6" style="margin-bottom: 10px;">
                                                        <button type="submit"
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
            </div>
            <div id="modal_response_search_modules_div"></div>
            <?php include('common/footer.php'); ?>
        </div>
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
                        "search_category_title": $('#search_category_title').val(),
                        "search_category_code": $('#search_category_code').val(),
                        "search_status": search_status
                    };
                }
                else if (reset_flag == 1)           //call to load_data() when reset button is clicked
                {
                    $('#search_category_title').val('');
                    $('#search_category_code').val('');

                    form_data =
                    {
                        "search_category_title": '',
                        "search_category_code": '',
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
            });

            $("#").on("keydown", function (e) {
                if (e.keyCode === 13) {  //checks whether the pressed key is "Enter"
                    validate(e);
                }
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

            $("#search_category_title,#search_category_code").on("keydown", function (e) {
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
