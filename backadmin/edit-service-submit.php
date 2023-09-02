<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
    if (isset($_POST))
    {
        $edit_id             = Secure1($db_mysqli, $_POST['edit_id']);
        $service_name        = Secure1($db_mysqli, $_POST['service_name']);
        $description         = Secure1($db_mysqli, $_POST['description']);
        $meta_title          = Secure1($db_mysqli, $_POST['meta_title']);
        $arr_search_keywords = $_POST['search_keywords'];
        $search_keywords     = implode(',', $arr_search_keywords);
        $meta_description    = Secure1($db_mysqli, $_POST['meta_description']);
        $updated_on = get_current_date_time();
        if (isset($_POST['status']))
        {
            $status = 1;
        }
        else
        {
            $status = 0;
        }

        
        $all_service_data_array = array();
        $get_service_query = "select * from service where id='$edit_id' and is_deleted='0'";
        $result_get_service_query = mysqli_query($db_mysqli, $get_service_query);
        while ($row_get_service_query = mysqli_fetch_assoc($result_get_service_query))
        {
            $all_service_data_array[] = $row_get_service_query;
        }
        
        if (!empty($all_service_data_array))
        {
            if (isset($_POST['status']))
            {
                $status = 1;
            }
            else
            {
                $status = 0;
            }
            
            $all_service_title_data_array = array();
            $get_service_title_query = "select * from service where service_name='$service_name' AND id!='$edit_id' and is_deleted='0'";
            $result_get_service_title_query = mysqli_query($db_mysqli, $get_service_title_query);
            while ($row_get_service_title_query = mysqli_fetch_assoc($result_get_service_title_query))
            {
                $all_service_title_data_array[] = $row_get_service_title_query;
            }
            
            if (!empty($all_service_title_data_array))
            {
                $return["html_message"] = 'service title already exist. Try Another!';
                $return["status"] = "error";
                echo json_encode($return);
                exit();
            }

            
            
            $update_service_query = "update service set service_name='$service_name', description='$description', updated_on='$updated_on', meta_title='$meta_title', meta_keyword='$search_keywords', meta_description='$meta_description',
                              status='$status' where id='$edit_id'";
            $result_update_service_query = mysqli_query($db_mysqli, $update_service_query);
            $affected_rows = mysqli_affected_rows($db_mysqli);

            if ($result_update_service_query)
            {
                if ($affected_rows == 0)
                {
                    $return["html_message"] = 'Nothing Updated by user.';
                    $return["status"] = "success";
                    echo json_encode($return);
                    exit();
                }
                $return["html_message"] = 'service Updated Successfully.';
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
            $return["html_message"] = 'service Does Not Exist.';
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