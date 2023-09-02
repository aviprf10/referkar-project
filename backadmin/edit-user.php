<?php
include 'common/config.php';
include 'common/check_login.php';

if ($admin == 1)
{
    if (isset($_GET['id']))
    {
        $module_name = 'user';
        $edit_id = $_GET['id'];

        $edit_data_array = array();
        $get_user_query = "select * from user where id='$edit_id' and is_deleted='0'";
        $result_get_user_query = mysqli_query($db_mysqli, $get_user_query);
        while ($row_get_user_query = mysqli_fetch_assoc($result_get_user_query))
        {
            $edit_data_array[] = $row_get_user_query;
        }

        $userdetails_data_array = array();
        $get_userdetails_query = "select * from  user_address where user_id='$edit_id' and is_deleted='0'";
        $result_get_userdetails_query = mysqli_query($db_mysqli, $get_userdetails_query);
        while ($row_get_userdetails_query = mysqli_fetch_assoc($result_get_userdetails_query))
        {
            $userdetails_data_array[] = $row_get_userdetails_query;
        }

        $all_country_data_array = array();
        $get_country_query = "SELECT * FROM country WHERE status='1' and is_deleted='0'";
        $result_get_country_query = mysqli_query($db_mysqli, $get_country_query);
        while ($row_get_country_query = mysqli_fetch_assoc($result_get_country_query))
        {
            $all_country_data_array[] = $row_get_country_query;
        }
        $country_id = $userdetails_data_array[0]['country_id'];

        $all_state_data_array = array();
        $get_state_query = "select * from states where country_id=$country_id and is_deleted='0'";
        $result_get_state_query = mysqli_query($db_mysqli, $get_state_query);
        while ($row_get_state_query = mysqli_fetch_assoc($result_get_state_query))
        {
            $all_state_data_array[] = $row_get_state_query;
        }

        $state_id = $userdetails_data_array[0]['state_id'];

        $all_city_data_array = array();
        $get_city_query = "select * from cities where state_id=$state_id and is_deleted='0'";
        $result_get_city_query = mysqli_query($db_mysqli, $get_city_query);
        while ($row_get_city_query = mysqli_fetch_assoc($result_get_city_query))
        {
            $all_city_data_array[] = $row_get_city_query;
        }

        $city_id = $userdetails_data_array[0]['city_id'];

        $all_area_data_array = array();
        $get_area_query = "select * from area where city_id=$city_id and is_deleted='0'";
        $result_get_area_query = mysqli_query($db_mysqli, $get_area_query);
        while ($row_get_area_query = mysqli_fetch_assoc($result_get_area_query))
        {
            $all_area_data_array[] = $row_get_area_query;
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
                                <div class="panel panel-default">
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
                                        <form id="<?php echo $module_name; ?>_form" method="POST" data-parsley-validate>
                                               <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>First name : <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="first_name"
                                                                   name="first_name"
                                                                   value="<?php echo $edit_data_array[0]['first_name']; ?>"
                                                                   placeholder="Enter first name"
                                                                   data-parsley-required="true">

                                                            <input type="hidden" name="edit_id" id="edit_id"
                                                                   value="<?php echo $edit_id; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Last name : <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="last_name"
                                                                   name="last_name"
                                                                   value="<?php echo $edit_data_array[0]['last_name']; ?>"
                                                                   placeholder="Enter last name"
                                                                   data-parsley-required="true">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4" id="city_div">
                                                        <div class="form-group">
                                                            <label>Email : <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="email"
                                                                   name="email"
                                                                   value="<?php echo $edit_data_array[0]['email']; ?>"
                                                                   data-type="email"
                                                                   placeholder="Enter email"
                                                                   data-parsley-required="true">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Gender : <span
                                                                    class="text-danger">*</span></label>
                                                            <select class="select form-control" id="gender"
                                                                    name="gender">
                                                                <option
                                                                    value="male" <?php if ("male" == $edit_data_array[0]['gender'])
                                                                {
                                                                    echo " selected='selected'";
                                                                } ?>>Male
                                                                </option>
                                                                <option
                                                                    value="female" <?php if ("female" == $edit_data_array[0]['gender'])
                                                                {
                                                                    echo " selected='selected'";
                                                                } ?>>Female
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Mobile : <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="mobile"
                                                                   name="mobile"
                                                                   value="<?php echo $edit_data_array[0]['mobile']; ?>"
                                                                   placeholder="Enter mobile"
                                                                   data-parsley-required="true"
                                                                   pattern="^(\+\d{1,3}[- ]?)?\d{10}$"
                                                                   onkeypress = "return event.charCode >= 48 && event.charCode <= 57"
                                                                   maxlength="10">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Country : <span class="text-danger">*</span></label>
                                                        <select class="select-search form-control" id="country_id" name="country_id" onchange="get_state(this.value)" data-parsley-required="true">
                                                            <option value=""> Select country</option>
                                                            <?php foreach ($all_country_data_array as $all_country_data) { ?>
                                                                <option value="<?php echo $all_country_data['id']; ?>" <?php  if ($all_country_data['id'] == $country_id){ echo 'selected';} ?>>
                                                                    <?php echo $all_country_data['country_name']; ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">                    
                                                <div class="col-md-4" id="state_div">
                                                    <div class="form-group">
                                                        <label>State : <span class="text-danger">*</span></label>
                                                        <select class="select-search form-control" id="state_id" name="state_id" onchange="get_city(this.value)" data-parsley-required="true">
                                                        <option value=""> Select state</option>
                                                        <?php foreach ($all_state_data_array as $all_state_data) { ?>
                                                                <option value="<?php echo $all_state_data['id']; ?>" <?php  if($all_state_data['id'] == $state_id){ echo 'selected';} ?>>
                                                                    <?php echo $all_state_data['state_name']; ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>    
                                                    </div>
                                                </div>

                                                <div class="col-md-4" id="city_div">
                                                    <div class="form-group">
                                                        <label>City : <span class="text-danger">*</span></label>
                                                         <select class="select-search form-control" id="city_id" name="city_id" data-parsley-required="true" onchange="get_area(this.value);">
                                                            <option value=""> Select city</option>
                                                            <?php foreach ($all_city_data_array as $all_city_data) { ?>
                                                                <option value="<?php echo $all_city_data['id']; ?>" <?php  if ($all_city_data['id'] == $city_id){ echo 'selected';} ?>>
                                                                    <?php echo $all_city_data['city_name']; ?>
                                                                </option>
                                                            <?php } ?>
                                                         </select>   
                                                    </div>
                                                </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                        <label>Pincode</label>
                                                        <input type="text" name="pincode" id="pincode" class="form-control" placeholder="Enter Pincode" data-parsley-required="true" value="<?php echo $userdetails_data_array[0]['pincode']; ?>">
                                                      </div>
                                                    </div>
                                                </div> 
                                                <div class="row">
                                                    <div class="col-md-6">
                                                      <div class="form-group">
                                                        <label>Address1</label>
                                                        <textarea type="text" name="address_1" id="address_1" class="form-control" placeholder="Address" data-parsley-required="true" rows="5"><?php echo $userdetails_data_array[0]['address1']; ?></textarea>
                                                      </div>
                                                  </div>
                                                    <div class="col-md-6">
                                                      <div class="form-group">
                                                        <label>Address2</label>
                                                        <textarea type="text" name="address2" id="address2" class="form-control" placeholder="Address" data-parsley-required="true" rows="5"><?php echo $userdetails_data_array[0]['address2']; ?></textarea>
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

            function get_designation(department_id)
            {
                
                $.ajax(
                    {
                        url: "<?php echo $base_url; ?>get_designation.php",
                        type: "POST",
                        data: {'department_id':department_id},
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
                                $('#designation_div').html(data.html_message);
                                $('#designation_id').attr('data-parsley-required', 'true').select2();
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

            function get_state(country_id) {
            var formData =
            {
                'country_id': country_id
            };
            $.ajax(
                {
                    url: "<?php echo $base_url; ?>get_state.php",
                    type: "POST",
                    data: formData,
                    dataType: 'json',
                    encode: true,
                    beforeSend: function () {
                        $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url_images;?>loading.gif" alt="Loading.."/>'});
                    },
                    success: function (data) {
                        $.unblockUI();

                        if (data.status == 'success') {
                            $('#state_div').html(data.html_message);
                            $('#state_id').attr('data-parsley-required', 'true').select2();
                            //$.notifyBar({cssClass: "success", html: data.html_message});
                            //dataTable.ajax.reload();
                        }
                        else {
                            $.notifyBar({cssClass: "error", html: data.html_message});
                            //dataTable.ajax.reload();
                        }
                    }
                });
        }

        function get_city(state_id) {
            var formData =
            {
                'state_id': state_id
            };
            $.ajax(
                {
                    url: "<?php echo $base_url; ?>get_city.php",
                    type: "POST",
                    data: formData,
                    dataType: 'json',
                    encode: true,
                    beforeSend: function () {
                        $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url_images;?>loading.gif" alt="Loading.."/>'});
                    },
                    success: function (data) {
                        $.unblockUI();

                        if (data.status == 'success') {
                            $('#city_div').html(data.html_message);
                            $('#city_id').attr('data-parsley-required', 'true').select2();
                            //$.notifyBar({cssClass: "success", html: data.html_message});
                            //dataTable.ajax.reload();
                        }
                        else {
                            $.notifyBar({cssClass: "error", html: data.html_message});
                            //dataTable.ajax.reload();
                        }
                    }
                });
        }

        function get_area(city_id) 
        {
            var formData =
            {
                'city_id': city_id
            };
            $.ajax(
                {
                    url: "<?php echo $base_url; ?>get_area.php",
                    type: "POST",
                    data: formData,
                    dataType: 'json',
                    encode: true,
                    beforeSend: function () {
                        $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url_images;?>loading.gif" alt="Loading.."/>'});
                    },
                    success: function (data) {
                        $.unblockUI();

                        if (data.status == 'success') {
                            $('#area_div').html(data.html_message);
                            $('#area_id').attr('data-parsley-required', 'true').select2();
                            //$.notifyBar({cssClass: "success", html: data.html_message});
                            //dataTable.ajax.reload();
                        }
                        else {
                            $.notifyBar({cssClass: "error", html: data.html_message});
                            //dataTable.ajax.reload();
                        }
                    }
                });
        }

        function get_pincode(area_id) 
        {
            var formData =
            {
                'area_id': area_id
            };
            $.ajax(
                {
                    url: "<?php echo $base_url; ?>get_pincode.php",
                    type: "POST",
                    data: formData,
                    dataType: 'json',
                    encode: true,
                    beforeSend: function () {
                        $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url_images;?>loading.gif" alt="Loading.."/>'});
                    },
                    success: function (data) {
                        $.unblockUI();

                        if (data.status == 'success') {
                            $('#pincode_div').html(data.html_message);
                            $('#pincode_id').attr('data-parsley-required', 'true').select2();
                            //$.notifyBar({cssClass: "success", html: data.html_message});
                            //dataTable.ajax.reload();
                        }
                        else {
                            $.notifyBar({cssClass: "error", html: data.html_message});
                            //dataTable.ajax.reload();
                        }
                    }
                });
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