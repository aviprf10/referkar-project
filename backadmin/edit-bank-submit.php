<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
    if (isset($_POST))
    {
        $edit_id = Secure1($db_mysqli, $_POST['edit_id']);
        $bank_name = Secure1($db_mysqli, $_POST['bank_name']);
        $updated_on = get_current_date_time();
        if (isset($_POST['status']))
        {
            $status = 1;
        }
        else
        {
            $status = 0;
        }

        
        $all_bank_data_array = array();
        $get_bank_query = "select * from bank where id='$edit_id' and is_deleted='0'";
        $result_get_bank_query = mysqli_query($db_mysqli, $get_bank_query);
        while ($row_get_bank_query = mysqli_fetch_assoc($result_get_bank_query))
        {
            $all_bank_data_array[] = $row_get_bank_query;
        }
        
        if (!empty($all_bank_data_array))
        {
            if (isset($_POST['status']))
            {
                $status = 1;
            }
            else
            {
                $status = 0;
            }
            
            $all_bank_title_data_array = array();
            $get_bank_title_query = "select * from bank where bank_name='$bank_name' AND id!='$edit_id' and is_deleted='0'";
            $result_get_bank_title_query = mysqli_query($db_mysqli, $get_bank_title_query);
            while ($row_get_bank_title_query = mysqli_fetch_assoc($result_get_bank_title_query))
            {
                $all_bank_title_data_array[] = $row_get_bank_title_query;
            }
            
            if (!empty($all_bank_title_data_array))
            {
                $return["html_message"] = 'Bank title already exist. Try Another!';
                $return["status"] = "error";
                echo json_encode($return);
                exit();
            }

            
            
            $update_bank_query = "update bank set bank_name='$bank_name', updated_on='$updated_on', status='$status' where id='$edit_id'";
            $result_update_bank_query = mysqli_query($db_mysqli, $update_bank_query);
            $affected_rows = mysqli_affected_rows($db_mysqli);

            if ($result_update_bank_query)
            {
                if ($affected_rows == 0)
                {
                    $return["html_message"] = 'Nothing Updated by user.';
                    $return["status"] = "success";
                    echo json_encode($return);
                    exit();
                }
                $return["html_message"] = 'Bank Updated Successfully.';
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
            $return["html_message"] = 'Bank Does Not Exist.';
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