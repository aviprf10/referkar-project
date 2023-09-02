<?php
include('common/config.php');
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$post_data = json_decode(file_get_contents("php://input"));
	$post_data_array = json_decode(json_encode($post_data), True);
	$user=0;
	$mobile_access_token = Secure1($db_mysqli, $post_data_array['mobile_access_token']);
    $temp_cart_data_array = array();
	if($mobile_access_token!='')
	{
		$all_user_data_array = array();
		$get_user_query = "select id from user where mobile_access_token='$mobile_access_token' and is_deleted=0 and status=1";
		$result_get_user_query = mysqli_query($db_mysqli,$get_user_query);
		while ($row_get_user_query = mysqli_fetch_assoc($result_get_user_query))
		{
		  $all_user_data_array[] = $row_get_user_query;
		} 
		if(isset($all_user_data_array) && count($all_user_data_array)>0)
		{
			$loggedin_user_id = $all_user_data_array[0]['id'];
			$user=1;
            $get_temp_cart_query = "select * from user_cart where user_id = '$loggedin_user_id'";
            $result_temp_cart_data = mysqli_query($db_mysqli, $get_temp_cart_query);
            while ($row_temp_cart_data = mysqli_fetch_assoc($result_temp_cart_data))
            {
                $temp_cart_data_array[] = $row_temp_cart_data;
            }
		}


		$all_notification_data_array = array();
		$get_category_query = "select * from notification_master $custom_condition";
		$result_notification_data = mysqli_query($db_mysqli,$get_category_query);
		while ($all_category_temp_data = mysqli_fetch_assoc($result_notification_data))
		{
			$all_notification_data_array[] = $all_category_temp_data;
		}
		$response_notification_data_array = array();
		if(count($all_notification_data_array)>0)
		{	
			foreach($all_notification_data_array as $all_notification_data)
			{
				$notification_array = array();
				$notification_array['id'] = $all_notification_data['id'];
				$notification_array['notification_title'] = htmlspecialchars_decode($all_notification_data['notification_title']);
				$notification_array['notification_sub_title'] = $all_notification_data['notification_sub_title'];
				if($all_notification_data['notification_image'] != '')
				{	
					$notification_array['notification_image'] = $base_url_uploads."notification/".$all_notification_data['notification_image'];
				}
				$response_notification_data_array[] = $notification_array;
			}
		}
		$return["status"] = "success";
		$return["status_code"] = "200";
		$return["notification_count"] = count($temp_cart_data_array);
		$return["data"] = $response_notification_data_array;
		echo json_encode($return);
	}
	else
	{
		$return["status"] = "error";
		$return["status_code"] = 100;
		$return["message"] = "Access Token Not Match.";
		echo json_encode($return);
		exit();	
	}
}
?>