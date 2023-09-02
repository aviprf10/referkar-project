<?php
include 'common/config.php';
include 'common/check_login.php';
if ($admin == 1)
{
    if (isset($_GET['id']))
    {
        $module_full_name = "Product";
        $module_short_name = "Product";
        $module_name = "product";

         $edit_id = $_GET['id'];

        $edit_data_array = array();
        $get_product_query = "select * from product where id='$edit_id' and is_deleted='0'";
        $result_get_product_query = mysqli_query($db_mysqli, $get_product_query);
        while ($row_get_product_query = mysqli_fetch_assoc($result_get_product_query))
        {
            $edit_data_array[] = $row_get_product_query;
        }

        if (count($edit_data_array) > 0)
        {
            $edit_data    = $edit_data_array[0];
            $category_id  = $edit_data['category_id'];
            $sub_category_id = $edit_data['sub_category_id'];
            $sub_sub_category_id = $edit_data['sub_sub_category_id'];
            $product_name = $edit_data['product_name'];
            $product_price = $edit_data['product_price'];
            $product_spacial_price = $edit_data['product_spacial_price'];
            $sort_description = $edit_data['sort_description'];
            $full_description = $edit_data['full_description'];
            $meta_title = $edit_data['meta_title'];
            $meta_keyword = $edit_data['meta_keyword'];
            $meta_description = $edit_data['meta_description'];
            $sequence_no = $edit_data['sequence_no'];
            $show_in_home = $edit_data['show_in_home'];
            $unit_type_id = $edit_data['unit_type_id'];
            $unit = $edit_data['unit'];
            $status       = $edit_data['status'];
            $product_qty = $edit_data['product_qty'];
            $sku_code = $edit_data['sku_code'];
            $discount_type = $edit_data['discount_type'];
            $discount = $edit_data['discount'];

            $all_productlist_data_array = array();
            $edit_related_product_list_array = array();
            $get_productlist_query = "SELECT * FROM relation_product_list WHERE  is_deleted='0' and product_id ='$edit_id'";
            $result_get_productlist_query = mysqli_query($db_mysqli, $get_productlist_query);
            while ($row_get_productlist_query = mysqli_fetch_assoc($result_get_productlist_query))
            {
                $all_productlist_data_array[] = $row_get_productlist_query;
            }

            $related_product_list_array = $all_productlist_data_array[0]['related_product_list'];
            $edit_related_product_list_array = explode(',', $related_product_list_array);

            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title><?php echo $company_title; ?> - Edit <?php echo $module_full_name; ?></title>
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

                                            <?php if (count($edit_data_array) > 0)
                                            { ?>
                                                <form id="<?php echo $module_name; ?>_form" method="POST" data-parsley-validate>

                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Select Category : <span class="text-danger">*</span></label>

                                                                <?php
                                                                $all_category_data_array = array();
                                                                $get_category_query = "SELECT * FROM category WHERE is_deleted='0'";
                                                                $result_get_category_query = mysqli_query($db_mysqli, $get_category_query);
                                                                while ($row_get_category_query = mysqli_fetch_assoc($result_get_category_query))
                                                                {
                                                                    $all_category_data_array[] = $row_get_category_query;
                                                                }
                                                                ?>
                                                                <select class="select-search form-control" id="category_id"
                                                                        name="category_id" onchange="get_subcategory(this.value);">
                                                                    <!--                                                                <option value=""> select category</option>-->
                                                                    <?php foreach ($all_category_data_array as $all_category_data)
                                                                    { ?>
                                                                        <option
                                                                            value="<?php echo $all_category_data['id']; ?>"
                                                                            <?php if ($all_category_data['id'] == $edit_data_array[0]['category_id'])
                                                                            {
                                                                                echo " selected='selected'";
                                                                            } ?>>
                                                                            <?php echo $all_category_data['category_name']; ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3" id="subcategory_div">
                                                            <div class="form-group">
                                                                <label>Select Subcategory : <span
                                                                        class="text-danger">*</span></label>
                                                                <?php
                                                                $all_sub_category_data_array = array();
                                                                $get_sub_category_query = "select * from sub_category where id='$sub_category_id' and is_deleted='0'";
                                                                $result_get_sub_category_query = mysqli_query($db_mysqli, $get_sub_category_query);
                                                                while ($row_get_sub_category_query = mysqli_fetch_assoc($result_get_sub_category_query))
                                                                {
                                                                    $all_sub_category_data_array[] = $row_get_sub_category_query;
                                                                }

                                                            
                                                                ?>
                                                                <select class="select-search form-control" id="sub_category_id"
                                                                        name="sub_category_id">
                                                                <?php foreach ($all_sub_category_data_array as $all_sub_category_data)
                                                                { ?>
                                                                    <option
                                                                        value="<?php echo $all_sub_category_data['id']; ?>"
                                                                        <?php if ($all_sub_category_data['id'] == $sub_category_id)
                                                                        {
                                                                            echo " selected='selected'";
                                                                        } ?>>
                                                                        <?php echo $all_sub_category_data['sub_category_name']; ?>
                                                                    </option>
                                                                <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3" id="subsubcategory_div">
                                                            <div class="form-group">
                                                                <label>Select Sub Subcategory : <span
                                                                        class="text-danger">*</span></label>
                                                                <?php
                                                                $get_sub_sub_category_query = "select * from sub_sub_category where id='$sub_sub_category_id' and is_deleted='0'";
                                                                $result_get_sub_sub_category_query = mysqli_query($db_mysqli, $get_sub_sub_category_query);
                                                                while ($row_get_sub_sub_category_query = mysqli_fetch_assoc($result_get_sub_sub_category_query))
                                                                {
                                                                    $all_sub_sub_category_data_array[] = $row_get_sub_sub_category_query;
                                                                }

                                                            
                                                                ?>
                                                                <select class="select-search form-control" id="sub_sub_category_id"
                                                                        name="sub_sub_category_id">
                                                                <?php foreach ($all_sub_sub_category_data_array as $all_sub_sub_category_data)
                                                                { ?>
                                                                    <option
                                                                        value="<?php echo $all_sub_sub_category_data['id']; ?>"
                                                                        <?php if ($all_sub_sub_category_data['id'] == $sub_sub_category_id)
                                                                        {
                                                                            echo " selected='selected'";
                                                                        } ?>>
                                                                        <?php echo $all_sub_sub_category_data['sub_sub_category_name']; ?>
                                                                    </option>
                                                                <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                               <label><?php echo $module_full_name; ?> Name : <span
                                                                class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" id="product_name"
                                                                       name="product_name"
                                                                       placeholder="Enter <?php echo $module_full_name; ?> Name"
                                                                       data-parsley-required="true" value="<?php echo $product_name; ?>">

                                                                <input type="hidden" name="edit_id" id="edit_id"
                                                                       value="<?php echo $edit_id; ?>">
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">    
                                                         <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Product Price : <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" id="product_price" name="product_price" placeholder="Enter Product Price" data-parsley-required="true" value="<?php echo $product_price; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Product Spacial Price : <span  class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" id="product_spacial_price" name="product_spacial_price" placeholder="Enter Product Spacial Price" data-parsley-required="true" value="<?php echo $product_spacial_price; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Select Unit Type : <span class="text-danger">*</span></label>
                                                            <?php
                                                                $all_unit_type_data_array = array();
                                                                $get_unit_type_query = "SELECT * FROM unit_type WHERE is_deleted='0'";
                                                                $result_get_unit_type_query = mysqli_query($db_mysqli, $get_unit_type_query);
                                                                while ($row_get_unit_type_query = mysqli_fetch_assoc($result_get_unit_type_query))
                                                                {
                                                                    $all_unit_type_data_array[] = $row_get_unit_type_query;
                                                                }
                                                                ?>
                                                                <select class="select-search form-control" id="unit_type_id"
                                                                        name="unit_type_id">
                                                                    <option value=""> Select Unit Type</option>
                                                                    <?php foreach ($all_unit_type_data_array as $all_unit_type_data)
                                                                    { ?>
                                                                        <option
                                                                            value="<?php echo $all_unit_type_data['id']; ?>"
                                                                            <?php if ($all_unit_type_data['id'] == $edit_data_array[0]['unit_type_id'])
                                                                            {
                                                                                echo " selected='selected'";
                                                                            } ?>>
                                                                            <?php echo $all_unit_type_data['unit_name']; ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Unit : <span  class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" id="unit" name="unit" placeholder="Enter Unit" data-parsley-required="true" value="<?php echo $unit; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                         <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Sort Description : <span class="text-danger">*</span></label>
                                                                <textarea type="text" class="form-control" id="sort_description" name="sort_description"
                                                                       placeholder="Enter Description "
                                                                        maxlength="300"><?php echo $sort_description; ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>SKU Code : <span  class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" id="sku_code" name="sku_code" value="<?php echo $sku_code; ?>" placeholder="Enter SKU Code" data-parsley-required="true">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Disocunt Type : <span  class="text-danger">*</span></label>
                                                                <select class="form-control" id="discount_type" name="discount_type" >
                                                                    <option value=""> Select Document Type</option>
                                                                    <option value="price" <?php if($discount_type == 'price'){ echo 'selected'; } ?>>Price</option>
                                                                    <option value="percentage" <?php if($discount_type == 'percentage'){ echo 'selected'; } ?>>Percentage</option>
                                                                </select>    
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Discount</label>
                                                                <input type="text" class="form-control" id="discount" name="discount" value="<?php echo $discount; ?>" placeholder="Enter Discount">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>FUll Description : <span class="text-danger">*</span></label>
                                                                <textarea type="text" class="form-control" id="editor1" name="full_description"
                                                                    placeholder="Enter Full Description "><?php echo $full_description; ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    <div class="row">
                                                         <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Meta Title :</label>
                                                                <input type="text" class="form-control"id="meta_title" name="meta_title"
                                                                       placeholder="Enter Meta Title " value="<?php echo $meta_title; ?>">                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Add Product Stock Quantity :</label>
                                                                <input type="text" class="form-control" id="product_qty" value="<?php echo $product_qty; ?>" name="product_qty" placeholder="Enter Stock Quantity" data-parsley-required="true">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                         <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Meta Description :</label>
                                                                <textarea type="text" class="form-control"id="meta_description" name="meta_description"
                                                                       placeholder="Enter Meta Description "> <?php echo $meta_description; ?>  </textarea>                                             
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <div class="row">
                                                         <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Meta Keywords :</label>
                                                                <input id="search_keywords" name="search_keywords[]" type="text"
                                                                           class="form-control tags" 
                                                                           placeholder="Enter Search Terms" value="<?php echo $meta_keyword; ?>" />
                                                                <span class="help-block">Note:Help someone to find your products - Use the 13 tags to optimize your listings.</span>
                                                                <div id="tag_error_div">
                                                                </div>                                             
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-2">
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
                                                        <div class="col-md-2">
                                                            <br>
                                                            <div class="form-group">
                                                                <label class="checkbox-inline">
                                                                    <input type="checkbox" name="show_in_home" class="styled" id="show_in_home" value="1" <?php if ($show_in_home == 1)
                                                                        {
                                                                            echo "checked";
                                                                        } ?> >
                                                                    Show in Home Page
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <br>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control"id="sequence_no" name="sequence_no" value="<?php echo $sequence_no; ?>"
                                                                    placeholder="Enter Sequence No">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Select Related Product</label>
                                                                <?php
                                                                $all_product_data_array = array();
                                                                $get_product_query = "SELECT * FROM product WHERE  is_deleted='0' and id !='$edit_id'";
                                                                $result_get_product_query = mysqli_query($db_mysqli, $get_product_query);
                                                                while ($row_get_product_query = mysqli_fetch_assoc($result_get_product_query))
                                                                {
                                                                    $all_product_data_array[] = $row_get_product_query;
                                                                }


                                                                ?>
                                                                <select class="select-search form-control" id="product_id"  multiple
                                                                        name="product_id[]" data-placeholder="Select a product...">
                                                                    <option></option>
                                                                    <?php foreach ($all_product_data_array as $all_product_data)
                                                                    {
                                                                            
                                                                        ?>
                                                                        <option value="<?php echo $all_product_data['id']; ?>" <?php if(in_array($all_product_data['id'],$edit_related_product_list_array)){ echo 'selected';} ?>><?php echo $all_product_data['product_name']; ?></option>
                                                                    <?php } ?>
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
            <script type="text/javascript" src="<?php echo $base_url_js; ?>tag/jquery.tagsinput.js"></script>
            <script type="text/javascript">
                $(document).ready(function ()
                {
                    $('#<?php echo $module_name; ?>_form').parsley();
                    $('#<?php echo $module_name; ?>_form').on('submit', function (e)
                    {
                        var page_content = CKEDITOR.instances['editor1'].getData();
                        e.preventDefault();
                        var f = $(this);
                        f.parsley().validate();
                        if (f.parsley().isValid())
                        {
                            for (instance in CKEDITOR.instances)
                            {
                                CKEDITOR.instances[instance].updateElement();
                            }
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
                CKEDITOR.replace('editor1');
                 $('#search_keywords').tagsInput({
                    width: 'auto', height: '44px'
                });

                
                function get_subcategory(category_id)
                {
                    $('#<?php echo $module_name; ?>_form').parsley().destroy();
                    $.ajax(
                        {
                            url: "<?php echo $base_url; ?>get_subcategory.php",
                            type: "POST",
                            data: {'category_id':category_id},
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
                                    $('#subcategory_div').html(data.html_message);
                                    $('#sub_category_id').attr('data-parsley-required', 'true').select2();
                                    
                                }
                                else
                                {
                                    $.notifyBar({cssClass: "error", html: data.html_message});
                                }
                            }
                        });
                    $('#<?php echo $module_name; ?>_form').parsley();
                }

                function get_subsubcategory(sub_category_id)
                {
                    $('#<?php echo $module_name; ?>_form').parsley().destroy();
                    $.ajax(
                        {
                            url: "<?php echo $base_url; ?>get_subsubcategory.php",
                            type: "POST",
                            data: {'sub_category_id':sub_category_id},
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
                                    $('#subsubcategory_div').html(data.html_message);
                                    $('#sub_sub_category_id').attr('data-parsley-required', 'true').select2();
                                    
                                }
                                else
                                {
                                    $.notifyBar({cssClass: "error", html: data.html_message});
                                }
                            }
                        });
                    $('#<?php echo $module_name; ?>_form').parsley();
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
}
else
{
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'logout">';
}
?>
