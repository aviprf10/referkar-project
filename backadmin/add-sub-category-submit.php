<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
    if (isset($_POST))
    {
        $category_id = Secure1($db_mysqli, $_POST['category_id']);
        $sub_category_name   = Secure1($db_mysqli, $_POST['sub_category_name']);
        $meta_title          = Secure1($db_mysqli, $_POST['meta_title']);
        $arr_search_keywords = $_POST['search_keywords'];
        $search_keywords     = implode(',', $arr_search_keywords);
        $meta_description    = Secure1($db_mysqli, $_POST['meta_description']);
        $created_on = get_current_date_time();
        if (isset($_POST['status']))
        {
            $status = 1;
        }
        else
        {
            $status = 0;
        }


        $get_category_title_query = "select * from sub_category where sub_category_name='$sub_category_name' and category_id='$category_id' and is_deleted='0'";
        $result_get_category_title_query = mysqli_query($db_mysqli, $get_category_title_query);
        while ($row_get_category_title_query = mysqli_fetch_assoc($result_get_category_title_query))
        {
            $check_category_title_data_array[] = $row_get_category_title_query;
        }

        if (!empty($check_category_title_data_array))
        {
            $return["html_message"] = 'Sub Category title already exist. Try Another!';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        }
        
        $sub_category_unique_slug = '';
        $sub_category_unique_slug = get_unique_slug1($db_mysqli, $sub_category_name, 'sub_category', 'sub_category_name');

        $insert_category_query = "INSERT INTO sub_category (category_id,sub_category_name, sub_category_unique_slug, meta_title, meta_keyword, meta_description, created_on, status, is_deleted) 
                                              VALUES ('$category_id','$sub_category_name','$sub_category_unique_slug','$meta_title','$search_keywords','$meta_description', '$created_on','$status', '0');";
        $result_insert_category_query = mysqli_query($db_mysqli, $insert_category_query);

        if ($result_insert_category_query)
        {
            $return["html_message"] = 'Sub Category added successfully.';
            $return["status"] = "success";
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
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'logout">';
}
?>