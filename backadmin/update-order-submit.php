<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
	if(isset($_POST))
	{
		$order_id = Secure1($db_mysqli,$_POST['order_id']);
        $order_status = Secure1($db_mysqli,$_POST['order_status']);
        $updated_on = get_current_date_time();
        
        $update_user_order_query = "update user_order set order_status='$order_status',modified_on='$updated_on' where order_id='$order_id'";
        $result_update_user_order_query = mysqli_query($db_mysqli,$update_user_order_query);
        $affected_rows = mysqli_affected_rows($db_mysqli);
        
        if($result_update_user_order_query)
        {
            if ($affected_rows == 0)
            {
                $return["html_message"] = 'Nothing Updated by user.';
                $return["status"] = "success";
                echo json_encode($return);
                exit();
            }
            $return["html_message"] = 'Order Updated Successfully.';
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