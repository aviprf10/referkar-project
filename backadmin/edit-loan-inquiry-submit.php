<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
    if (isset($_POST))
    {
        $edit_id            = Secure1($db_mysqli, $_POST['edit_id']);
        $loan_status        = Secure1($db_mysqli, $_POST['loan_status']);
        
        $update_service_query = "update loan_inquery set loan_status='$loan_status' where id='$edit_id'";
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
            $return["html_message"] = 'Status Updated Successfully.';
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