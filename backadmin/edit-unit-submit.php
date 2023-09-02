<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
    if (isset($_POST))
    {
        $edit_id = Secure1($db_mysqli, $_POST['edit_id']);
        $unit_name = Secure1($db_mysqli, $_POST['unit_name']);
        if (isset($_POST['status']))
        {
            $status = 1;
        }
        else
        {
            $status = 0;
        }

        
        $all_unit_data_array = array();
        $get_unit_query = "select * from unit_type where id='$edit_id' and is_deleted='0'";
        $result_get_unit_query = mysqli_query($db_mysqli, $get_unit_query);
        while ($row_get_unit_query = mysqli_fetch_assoc($result_get_unit_query))
        {
            $all_unit_data_array[] = $row_get_unit_query;
        }
        
        if (!empty($all_unit_data_array))
        {
            if (isset($_POST['status']))
            {
                $status = 1;
            }
            else
            {
                $status = 0;
            }
            
            $all_unit_title_data_array = array();
            $get_unit_title_query = "select * from unit_type where unit_name='$unit_name' AND id!='$edit_id' and is_deleted='0'";
            $result_get_unit_title_query = mysqli_query($db_mysqli, $get_unit_title_query);
            while ($row_get_unit_title_query = mysqli_fetch_assoc($result_get_unit_title_query))
            {
                $all_unit_title_data_array[] = $row_get_unit_title_query;
            }
            
            if (!empty($all_unit_title_data_array))
            {
                $return["html_message"] = 'Unit title already exist. Try Another!';
                $return["status"] = "error";
                echo json_encode($return);
                exit();
            }

            
            
            $update_unit_query = "update unit_type set unit_name='$unit_name', status='$status' where id='$edit_id'";
            $result_update_unit_query = mysqli_query($db_mysqli, $update_unit_query);
            $affected_rows = mysqli_affected_rows($db_mysqli);

            if ($result_update_unit_query)
            {
                if ($affected_rows == 0)
                {
                    $return["html_message"] = 'Nothing Updated by user.';
                    $return["status"] = "success";
                    echo json_encode($return);
                    exit();
                }
                $return["html_message"] = 'Unit Updated Successfully.';
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
            $return["html_message"] = 'unit Does Not Exist.';
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