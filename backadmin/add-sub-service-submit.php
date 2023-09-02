<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
    if (isset($_POST))
    {
        $service_id = Secure1($db_mysqli, $_POST['service_id']);
        $sub_service_name   = Secure1($db_mysqli, $_POST['sub_service_name']);
        $sort_description   = Secure1($db_mysqli, $_POST['sort_description']);
        $services_image         = Secure1($db_mysqli, $_POST['file_name1']);
        $full_description        = htmlentities($_POST['editor1']);
        $icon = Secure1($db_mysqli, $_POST['icon']);
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


        $get_service_title_query = "select * from sub_service where sub_service_name='$sub_service_name' and service_id='$service_id' and is_deleted='0'";
        $result_get_service_title_query = mysqli_query($db_mysqli, $get_service_title_query);
        while ($row_get_service_title_query = mysqli_fetch_assoc($result_get_service_title_query))
        {
            $check_service_title_data_array[] = $row_get_service_title_query;
        }

        if (!empty($check_service_title_data_array))
        {
            $return["html_message"] = 'Sub service title already exist. Try Another!';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        }
        
        $sub_service_unique_slug = '';
        $sub_service_unique_slug = get_unique_slug1($db_mysqli, $sub_service_name, 'sub_service', 'sub_service_name');

        $insert_service_query = "INSERT INTO sub_service (service_id,sub_service_name, sub_service_unique_slug, service_image, sort_description, full_description, icon, meta_title, meta_keyword, meta_description, created_on, status, is_deleted) 
                                              VALUES ('$service_id','$sub_service_name','$sub_service_unique_slug','$services_image', '$sort_description', '$full_description', '$icon','$meta_title','$search_keywords','$meta_description', '$created_on','$status', '0');";
        $result_insert_service_query = mysqli_query($db_mysqli, $insert_service_query);

        if ($result_insert_service_query)
        {
            $return["html_message"] = 'Sub service added successfully.';
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