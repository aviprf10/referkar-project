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
		$country_id = Secure1($db_mysqli, $post_data_array['id']);
	}
	

	$temp_country_data_array = array();
	$get_country_query = "select id,country_name from country where status='1' and is_deleted='0'";
	$result_country_data = mysqli_query($db_mysqli,$get_country_query);
	while ($row_country_data = mysqli_fetch_assoc($result_country_data))
	{
		$temp_country_data_array[] = $row_country_data;
	} 


	$final_response_country_data_array = array();
	$final_response_country_data_array['country'] = $temp_country_data_array;
	$return["status"] = "success";
	$return["status_code"] = "200";
	$return["data"] = $final_response_country_data_array;
	echo json_encode($return);
}
?>