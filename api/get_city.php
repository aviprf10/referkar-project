<?php
include('common/config.php');
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$post_data = json_decode(file_get_contents("php://input"));
	$post_data_array = json_decode(json_encode($post_data), True);
	$state_id = 0;
	
	if((isset($post_data_array['id'])) && ($post_data_array['id']>0))
	{	
		$city_id = Secure1($db_mysqli, $post_data_array['id']);
	}
	if((isset($post_data_array['state_id'])) && ($post_data_array['state_id']>0))
	{	
		$state_id = Secure1($db_mysqli, $post_data_array['state_id']);
	}
	if($state_id > 0 || $city_id > 0)
	{	
		$temp_city_data_array = array();
		$get_city_query = "select id,city_name from cities where state_id='$state_id' and status='1' and is_deleted='0'";
		$result_city_data = mysqli_query($db_mysqli,$get_city_query);
		while ($row_city_data = mysqli_fetch_assoc($result_city_data))
		{
			$temp_city_data_array[] = $row_city_data;
		} 

		$final_city_data_array = array();
		$final_city_data_array['city'] = $temp_city_data_array;
		$return["status"] = "success";
		$return["status_code"] = "200";
		$return["data"] = $final_city_data_array;
		echo json_encode($return);
	}
	else
	{
		$return["html_message"] = 'Some Error Occured..! Please Try Again.';
		$return["status"] = "error";
		$return["status_code"] = 100;
		echo json_encode($return);
		exit();
	}
}
?>