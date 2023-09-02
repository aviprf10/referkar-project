<?php
include 'common/config.php';
include 'common/check_login.php';
if ($admin == 1 || ($sub_admin == 1 && $is_country_read == 1))
{
    $module_full_name = "Loan Inquiry";
    $module_short_name = "Loan Inquiry";
    $module_name = "loan-inquiry";

    $edit_id = $_GET['id'];

    $loaninquiry_data_array = array();
    $get_loaninquiry_query = "select * from loan_inquery where id='$edit_id' and is_deleted='0'";
    $result_get_loaninquiry_query = mysqli_query($db_mysqli, $get_loaninquiry_query);
    while ($row_get_loaninquiry_query = mysqli_fetch_assoc($result_get_loaninquiry_query))
    {
        $loaninquiry_data_array[] = $row_get_loaninquiry_query;
    }

    if (!empty($loaninquiry_data_array))
    {
        $edit_data = $loaninquiry_data_array[0];
        $service_id = $edit_data['id'];
        $loan_uniquie_key = $edit_data['loan_uniquie_key'];
        $name = $edit_data['name'];
        $email = $edit_data['email'];
        $mobile = $edit_data['mobile'];
        $refer_name = $edit_data['refer_name'];
        $refer_email = $edit_data['refer_email'];
        $refer_mobile = $edit_data['refer_mobile'];
        $loan_type = $edit_data['loan_type'];
        $loan_amount = $edit_data['loan_amount'];
        $loan_status = $edit_data['loan_status'];

    ?> 
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $company_title; ?>  - Edit <?php echo $module_full_name; ?></title>
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
                        <span class="breadcrumb-item active">Edit <?php echo $module_full_name; ?></span>
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
                                        <form id="<?php echo $module_name; ?>_form" method="POST" data-parsley-validate>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Refernace Num : <span class="text-success"><b><?php echo $loan_uniquie_key; ?></b></span></label>
                                                        <input type="hidden" name="edit_id" id="edit_id"
                                                               value="<?php echo $edit_id; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Name : <span class="text-success"><b><?php echo $name; ?></b></span></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Email : <span class="text-success"><b><?php echo $email; ?></b></span></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Mobile : <span class="text-success"><b><?php echo $mobile; ?></b></span></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Refer Name : <span class="text-success"><b><?php echo $refer_name; ?></b></span></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Refer Email : <span class="text-success"><b><?php echo $refer_email; ?></b></span></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Refer Mobile : <span class="text-success"><b><?php echo $refer_mobile; ?></b></span></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Loan Type : <span class="text-success"><b><?php 

                                                        $edit_data_array = array();
                                                        $get_service_query = "select * from sub_service where id='$loan_type' and is_deleted='0'";
                                                        $result_get_service_query = mysqli_query($db_mysqli, $get_service_query);
                                                        while ($row_get_service_query = mysqli_fetch_assoc($result_get_service_query))
                                                        {
                                                            $edit_data_array[] = $row_get_service_query;
                                                        }
                                                        echo $edit_data_array[0]['sub_service_name']; 

                                                        ?></b></span></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Loan Amount : <span class="text-success"><b><?php echo $loan_amount; ?></b></span></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <select class="select-search" name="loan_status" id="loan_status">
                                                            <option value="">Select Loan Status</option>
                                                            <option value="0" <?php  if($loan_status == '0'){ echo 'selected'; }?>>New Inquiry</option>
                                                            <option value="1" <?php  if($loan_status == '1'){ echo 'selected'; }?>>Documents Pending</option>
                                                            <option value="2" <?php  if($loan_status == '2'){ echo 'selected'; }?>>Documents Colleted</option>
                                                            <option value="3" <?php  if($loan_status == '3'){ echo 'selected'; }?>>Loan Under Credit Proposal</option>
                                                            <option value="4" <?php  if($loan_status == '4'){ echo 'selected'; }?>>Loan Sanctioned</option>
                                                            <option value="5" <?php  if($loan_status == '5'){ echo 'selected'; }?>>Loan Disbursed</option>
                                                            <option value="6" <?php  if($loan_status == '6'){ echo 'selected'; }?>>Payout Done</option>
                                                        </select>
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
                    </div>
                </div>
            </div>
            <div id="modal_response_search_modules_div"></div>
            <?php include('common/footer.php'); ?>
        </div>
        <script src="<?php echo $base_url_js; ?>plugins/parsley/parsley.min.js"></script>
        <script type="text/javascript" src="<?php echo $base_url_js; ?>tag/jquery.tagsinput.js"></script>
        <script type="text/javascript" src="<?php echo $base_url_js_upload; ?>ajaxupload.3.5.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo $base_url_css_upload; ?>styles.css"/>
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

            $('#search_keywords').tagsInput({
                width: 'auto', height: '44px'
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
