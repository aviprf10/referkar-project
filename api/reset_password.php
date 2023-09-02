<?php
include('common/config.php');
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$post_data = json_decode(file_get_contents("php://input"));
	$post_data_array = json_decode(json_encode($post_data), True);
	
	//$mobile_access_token = '';
	//$mobile_access_token = Secure1($db_mysqli, $post_data_array['mobile_access_token']);
	$new_password = Secure1($db_mysqli, $post_data_array['form_data']['new_password']);
	$re_password = Secure1($db_mysqli, $post_data_array['form_data']['re_password']);
	$unique_key = Secure1($db_mysqli, $post_data_array['form_data']['unique_key']);
	if($new_password != $re_password)
	{
		$return["status"] = "error";
		$return["status_code"] = 100;
		$return["message"] = "New Password and Confirm Password does not match.";
		echo json_encode($return);
		exit();
	}  
	else
	{
		$all_user_data_array = array();
		$get_user_data_query = "select * from user where unique_key_forgot_password='$unique_key' and is_deleted=0";
		$result_user_data_data = mysqli_query($db_mysqli,$get_user_data_query);
		while ($row_user_cart_data = mysqli_fetch_assoc($result_user_data_data))
		{
			$all_user_data_array[] = $row_user_cart_data;
		} 
		if(isset($all_user_data_array) && count($all_user_data_array)>0)
		{
			$user_data = $all_user_data_array[0];
            $update_password = md5($new_password);
            $updated_on = date('Y-m-d H:i:s');
            $forgot_password_date  = date('Y-m-d');
            $update_user_cart_query = "update user set password='$update_password',updated_on='$updated_on' where unique_key_forgot_password='$unique_key' and forgot_password_date='$forgot_password_date'";
            $return_update_user_data = mysqli_query($db_mysqli,$update_user_cart_query);
            if(isset($return_update_user_data))    
            {
				$email_array = array();
				$email_array['email']= $email;
				$email_array['user_name']= $user_name;
				$email_array['email_type']= 5;
				$email_sent_response = send_email($email_array);
				$return["message"] = 'Password Reset Successfully. Now Please try to Login!';
				$return["status"] = "success";
				$return["status_code"] = 200;
				echo json_encode($return);
				exit();
            }
            else
            {
               	$return["message"] = 'Oh snap! This link is Expired.';
               	$return["status"] = "error";
               	$return["status_code"] = 100;
               	echo json_encode($return);
            }
		}
		else
		{
			$return["status"] = "error";
			$return["status_code"] = 100;
			$return["message"] = "Oh snap! This link is Expired.";
			echo json_encode($return);
			exit();
		}
	}
}
?>