<?php
include 'common/config.php';
include 'common/check_login.php';
if ($admin == 1)
{
     $module_name = 'user';
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $company_title; ?> - Add <?php echo $module_full_name; ?></title>
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
                        <i class="icon-arrow-right13"></i> Add <?php echo $module_short_name; ?>
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
                                <li class="active">Add <?php echo $module_short_name; ?></li>
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
                                    <h5 class="panel-title">Add <?php echo $module_short_name; ?></h5>

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
                                                    <label>User Type : <span class="text-danger">*</span></label>
                                                    <select class="select form-control" id="user_type" name="user_type" data-parsley-required="true">
                                                        <option value="">Seelct User Type</option>
                                                        <option value="1">Super Admin</option>
                                                        <!--<option value="2">BDM</option>-->
                                                        <option value="3">Admin</option>
                                                        <option value="4">Sub-Admin</option>
                                                        <option value="5">Relationship Manager</option>
                                                        <option value="6">Tele-Caller</option>
                                                        <option value="7">Data collector</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>First name : <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter first name"  data-parsley-required="true">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Last name : <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                                           placeholder="Enter last name" data-parsley-required="true">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Email : <span
                                                                class="text-danger">*</span></label>
                                                    <input type="email" class="form-control" id="email"
                                                           name="email"
                                                           placeholder="Enter email"
                                                           data-type="email"
                                                           data-parsley-required="true">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Password : <span
                                                                class="text-danger">*</span></label>
                                                    <input type="password" class="form-control" id="password"
                                                           name="password"
                                                           placeholder="Enter password"
                                                           data-parsley-required="true">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Gender : <span
                                                                class="text-danger">*</span></label>
                                                    <select class="select form-control" id="gender"
                                                            name="gender">
                                                        <option value="male" selected='selected'>Male</option>
                                                        <option value="female">Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Mobile : <span
                                                                class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="mobile"
                                                           name="mobile"
                                                           placeholder="Enter mobile"
                                                           data-parsley-required="true"
                                                           onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                           maxlength="10"
                                                           minlength="10">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                  <div class="form-group">
                                                    <label>Adhaar Card</label>
                                                    <input type="text" name="adhaar_number" id="adhaar_number" data-type="adhaar-number" placeholder="Adhaar Card" class="form-control" data-parsley-required="true" maxLength="19">
                                                    <span id="span"></span>
                                                  </div>
                                              </div>
                                            <div class="col-md-4">
                                                  <div class="form-group">
                                                    <label>Pan Card</label>
                                                    <input type="text" name="pan_number" id="pan_number" class="form-control" placeholder="Pan Card" data-parsley-required="true"  maxlength="12">
                                                  </div>
                                              </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                 <div class="form-group">
                                                    <label>Report To : <span class="text-danger">*</span></label>
                                                    <?php
                                                        $get_user_data_array = array();
                                                        $get_user_query = "select * from user where is_deleted='0'";
                                                        $result_get_user_query = mysqli_query($db_mysqli, $get_user_query);
                                                        while ($row_get_user_query = mysqli_fetch_assoc($result_get_user_query))
                                                        {
                                                            $get_user_data_array[] = $row_get_user_query;
                                                        }
                                                    ?>
                                                    <select class="select-search form-control" name="perant_id" data-parsley-required="true" >
                                                        <option value="">Select Report To</option>
                                                        <?php
                                                            foreach ($get_user_data_array as $value) 
                                                            {
                                                        ?>
                                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['user_name']; ?></option>
                                                    <?php } ?>
                                                    </select>
                                                </div>  
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Department : <span class="text-danger">*</span></label>
                                                    <?php
                                                        $get_department_data_array = array();
                                                        $get_department_query = "select * from department where is_deleted='0'";
                                                        $result_get_department_query = mysqli_query($db_mysqli, $get_department_query);
                                                        while ($row_get_department_query = mysqli_fetch_assoc($result_get_department_query))
                                                        {
                                                            $get_department_data_array[] = $row_get_department_query;
                                                        }
                                                    ?>
                                                    <select class="select-search form-control" name="department_id" data-parsley-required="true" onchange="get_designation(this.value);">
                                                        <option value="">Select Department</option>
                                                        <?php
                                                            foreach ($get_department_data_array as $value) 
                                                            {
                                                        ?>
                                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['department_name']; ?></option>
                                                    <?php } ?>
                                                    </select>
                                                </div>  
                                            </div> 
                                            <div class="col-md-4" id="designation_div">
                                            </div>
                                        </div> 
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Country : <span class="text-danger">*</span></label>
                                                    <?php
                                                        $all_country_data_array = array();
                                                        $get_country_query = "SELECT * FROM country WHERE status='1' and is_deleted='0'";
                                                        $result_get_country_query = mysqli_query($db_mysqli, $get_country_query);
                                                        while ($row_get_country_query = mysqli_fetch_assoc($result_get_country_query))
                                                        {
                                                            $all_country_data_array[] = $row_get_country_query;
                                                        }
                                                    ?>
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

                                            <div class="col-md-4" id="state_div">
                                                
                                            </div>

                                            <div class="col-md-4" id="city_div">
                                                
                                            </div>
                                            <div class="col-md-4" id="area_div">
                                                
                                            </div>
                                            <div class="col-md-4" id="pincode_div">
                                                
                                            </div>
                                        </div> 
                                        <div class="row">
                                            <div class="col-md-12">
                                              <div class="form-group">
                                                <label>Address</label>
                                                <textarea type="text" name="address_1" id="address_1" class="form-control" placeholder="Address" data-parsley-required="true" rows="5"></textarea>
                                              </div>
                                          </div>
                                        </div>  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="status" class="styled" id="status" value="1" checked="checked">
                                                        Active
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="margin-top:25px">
                                            <div class="text-left">
                                                <button type="reset" class="btn btn-default" id="user_reset"><i class=" icon-undo position-left"></i> Reset</button>
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
         $('[data-type="adhaar-number"]').keyup(function() {
              var value = $(this).val();
              value = value.replace(/\D/g, "").split(/(?:([\d]{4}))/g).filter(s => s.length > 0).join("-");
              $(this).val(value);
            });

            $('[data-type="adhaar-number"]').on("change, blur", function() {
              var value = $(this).val();
              var maxLength = $(this).attr("maxLength");
              if (value.length != maxLength) {
                $('#span').html('Please Valid Adhaar Card Number');
              } else {
                $('#span').css('display', 'none');
              }
            });
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
                                    $('#<?php echo $module_name; ?>_form').parsley().destroy();
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
                else
                {
                    e.preventDefault();
                }
            });
        });

        $("#user_reset").click(function ()
        {
            $('#<?php echo $module_name; ?>_form').parsley().destroy();
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
?>
