<?php
include('common/config.php');
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
	
	$service_data_array = array();
	$get_service_query = "SELECT * FROM `sub_service` where service_id='1' and is_deleted='0' and status='1'";
	$result_get_service_query = mysqli_query($db_mysqli, $get_service_query);
	while ($row_get_service_query = mysqli_fetch_assoc($result_get_service_query))
	{
	    $service_data_array[] = $row_get_service_query;
	} 


	$response_service_data_array = array();
	if(count($service_data_array)>0)
	{
		foreach($service_data_array as $service_data)
		{
			$service_array = array();
			$service_array['id'] = $service_data['id'];
			$service_array['sub_service_name'] = $service_data['sub_service_name'];
			$service_array['sub_service_unique_slug'] = $service_data['sub_service_unique_slug'];
			if(!empty($service_data['service_image']))
			{
				$service_array['service_image'] = $base_url_uploads.'services-images/temp_file/'.$service_data['service_image'];
			}
			else 
			{
				$service_array['service_image'] = $base_url_images.'nobanner.jpeg';
			}	
			
			$service_array['sort_description'] = $service_data['sort_description'];
			$service_array['full_description'] = str_replace(array("\n", "\r"), '',strip_tags(html_entity_decode($service_data['full_description'])));
			$service_array['icon'] = $service_data['icon'];
			$service_array['meta_keyword'] = $service_data['meta_keyword'];
			$service_array['meta_title'] = $service_data['meta_title'];
			$service_array['meta_description'] = $service_data['meta_description'];

			
			$response_service_data_array[] = $service_array;
		}	
		

		$return["status"] = "success";
		$return["status_code"] = "200";
		$return["data"] = $response_service_data_array;
		
	}
	else 
	{
		$return["status"] = "error";
		$return["status_code"] = "404";
		$return["data"] = 'No record found!';
	} 
	
	echo json_encode($return);
}
?>