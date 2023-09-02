<?php
include('common/config.php');
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$post_data = json_decode(file_get_contents("php://input"));
	$post_data_array = json_decode(json_encode($post_data), True);
	$country_id = 0;

	if((isset($post_data_array['id'])) && ($post_data_array['id']>0))
	{	
		$state_id = Secure1($db_mysqli, $post_data_array['id']);
	}
	
	if((isset($post_data_array['country_id'])) && ($post_data_array['country_id']>0))
	{	
		$country_id = Secure1($db_mysqli, $post_data_array['country_id']);
	}
	if($country_id > 0 || $state_id > 0)
	{	
		$temp_state_data_array = array();
		$get_state_query = "select id,state_name from states where country_id='$country_id' and status='1' and is_deleted='0'";
		$result_state_data = mysqli_query($db_mysqli,$get_state_query);
		while ($row_state_data = mysqli_fetch_assoc($result_state_data))
		{
			$temp_state_data_array[] = $row_state_data;
		} 

		$final_state_data_array = array();
		$final_state_data_array['state'] = $temp_state_data_array;
		$return["status"] = "success";
		$return["status_code"] = "200";
		$return["data"] = $final_state_data_array;
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