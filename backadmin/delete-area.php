<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1 || ($sub_admin == 1 && $is_area_write == 1))
{
    if (($_POST))
    {
        //		$delete_id = Secure1($db_mysqli,$_POST['delete_id']);

        $delete_id_array = $_POST['delete_id_array'];
        if (is_array($delete_id_array))
        {
            $delete_id_list = implode(',', $delete_id_array);
        }
        else
        {
            $delete_id_list = $delete_id_array;
        }

        $all_area_data_array = array();
        $get_area_query = "select * from area where id IN ($delete_id_list) and is_deleted='0'";
        $result_get_area_query = mysqli_query($db_mysqli, $get_area_query);
        while ($row_get_area_query = mysqli_fetch_assoc($result_get_area_query))
        {
            $all_area_data_array[] = $row_get_area_query;
        }

        if (count($all_area_data_array) > 0)
        {
            $update_area_query = "UPDATE area
                                    SET is_deleted = '1'
                                    WHERE id IN ($delete_id_list)";
            $result_update_area_query = mysqli_query($db_mysqli, $update_area_query);
            if ($result_update_area_query)
            {
                $return["html_message"] = 'Area Removed Successfully.';
                $return["status"] = "success";
                $return["update"] = 1;
                echo json_encode($return);
                exit();
            }
            else
            {
                $return["html_message"] = 'Some Error Occurred! Please try again.';
                $return["status"] = "error";
                echo json_encode($return);
                exit();
            }
        }
        else
        {
            $return["html_message"] = 'Area Does Not Exist.';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        }
    }
    else
    {
        $return["html_message"] = 'Some Error Occurred! Please try again.';
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