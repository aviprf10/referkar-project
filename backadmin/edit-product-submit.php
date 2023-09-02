<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{

    if (isset($_POST))
    {
        $edit_id 			 = Secure1($db_mysqli, $_POST['edit_id']);
        $category_id         = Secure1($db_mysqli, $_POST['category_id']);
        $product_name        = Secure1($db_mysqli, $_POST['product_name']);
        $sort_description        = Secure1($db_mysqli, $_POST['sort_description']);
        $product_price           = Secure1($db_mysqli, $_POST['product_price']);
        $product_spacial_price   = Secure1($db_mysqli, $_POST['product_spacial_price']);
        $full_description    = htmlentities($_POST['full_description']);
        $meta_title          = Secure1($db_mysqli, $_POST['meta_title']);
        $arr_search_keywords = $_POST['search_keywords'];
        $search_keywords     = implode(',', $arr_search_keywords);
        $meta_description    = Secure1($db_mysqli, $_POST['meta_description']);
        $sequence_no         = Secure1($db_mysqli, $_POST['sequence_no']);
        $unit_type_id        = Secure1($db_mysqli, $_POST['unit_type_id']);
        $unit                = Secure1($db_mysqli, $_POST['unit']);
        $product_qty         = Secure1($db_mysqli, $_POST['product_qty']);
        $sku_code            = Secure1($db_mysqli, $_POST['sku_code']);
        $discount_type       = Secure1($db_mysqli, $_POST['discount_type']);
        $discount            = Secure1($db_mysqli, $_POST['discount']);
        $updated_on          = get_current_date_time();
        if (isset($_POST['status']))
        {
            $status = 1;
        }
        else
        {
            $status = 0;
        }

        if (isset($_POST['show_in_home']))
        {
            $show_in_home = 1;
        }
        else
        {
            $show_in_home = 0;
        }

        if (isset($_POST['sub_category_id']))
        {
            $sub_category_id         = Secure1($db_mysqli, $_POST['sub_category_id']);
        }
        else
        {
            $sub_category_id = 0;
        }

        if (isset($_POST['sub_sub_category_id']))
        {
            $sub_sub_category_id = Secure1($db_mysqli, $_POST['sub_sub_category_id']);
        }
        else
        {
            $sub_sub_category_id = 0;
        }

        $all_product_data_array = array();
        $get_product_query = "select * from product where product_name='$product_name'  and category_id='$category_id' and sub_category_id='$sub_category_id' and sub_sub_category_id='$sub_sub_category_id' AND id!='$edit_id' and is_deleted='0'"; 
        $result_get_product_query = mysqli_query($db_mysqli, $get_product_query);
        while ($row_get_product_query = mysqli_fetch_assoc($result_get_product_query))
        {
            $all_product_data_array[] = $row_get_product_query;
        }

        if (!empty($all_product_data_array))
        {
            $return["html_message"] = 'Producte already exist. Try Another!';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        }


       
        $update_product_query = "update product set 
        product_name='$product_name', product_price='$product_price', category_id='$category_id', 
        sub_category_id='$sub_category_id', sub_sub_category_id='$sub_sub_category_id',sort_description='$sort_description', full_description='$full_description', 
        product_spacial_price='$product_spacial_price', sequence_no='$sequence_no', meta_title='$meta_title', meta_keyword='$search_keywords',
         meta_description='$meta_description', sku_code='$sku_code', discount_type='$discount_type', discount='$discount', product_qty='$product_qty' ,show_in_home='$show_in_home', unit_type_id='$unit_type_id', unit='$unit',updated_on='$updated_on', status='$status' 
         where id='$edit_id'";
        $result_update_product_query = mysqli_query($db_mysqli, $update_product_query);
        $affected_rows = mysqli_affected_rows($db_mysqli);

        if($result_update_product_query)
        {
            if(!empty($_POST['product_id']))
            {
                $product_id          = $_POST['product_id'];
                $search_products     = implode(',', $product_id);

                $update_relatedproduct_query = "update relation_product_list set product_id='$edit_id', related_product_list='$search_products', updated_on='$updated_on', status='$status' 
                where id='$edit_id'";
                $result_update_relatedproduct_query = mysqli_query($db_mysqli, $update_relatedproduct_query);

            }
            
            $return["html_message"] = 'Product Updated Successfully.';
            $return["status"] = "success";
            $return["update"] = 1;
            echo json_encode($return);
            exit();
        }
        else
        {
            $return["html_message"] = 'Some Error Occured! Please try again.';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        }
    }
    else
    {
        $return["html_message"] = 'Some Error Occured! Please try again.';
        $return["status"] = "error";
        echo json_encode($return);
        exit();
    }
}
else
{
    $return["html_message"] = 'Please login.';
    $return["status"] = "error";
    echo json_encode($return);
    exit();
}
?>