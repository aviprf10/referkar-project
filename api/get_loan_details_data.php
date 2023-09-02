<?php
include('common/config.php');
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$post_data = json_decode(file_get_contents("php://input"));
	$post_data_array = json_decode(json_encode($post_data), True);
	
	$loan_id = Secure1($db_mysqli,$_POST['loan_id']);
	
	$loans_data_array = array();
	$get_loans_query = "SELECT * FROM `sub_service`  where id='$loan_id' and is_deleted='0' and status='1'";
	$result_get_loans_query = mysqli_query($db_mysqli, $get_loans_query);
	while ($row_get_loans_query = mysqli_fetch_assoc($result_get_loans_query))
	{
	    $loans_data_array[] = $row_get_loans_query;
	} 


	$response_loans_data_array = array();
	if(count($loans_data_array)>0)
	{
		$loans_array = array();
		$loans_array['id'] = $loans_data_array[0]['id'];
		$loans_array['sub_service_name'] = $loans_data_array[0]['sub_service_name'];
		if(!empty($loans_data_array[0]['service_image']))
		{
			$loans_array['service_image'] = $base_url_uploads.'services-images/temp_file/'.$loans_data_array[0]['service_image'];
		}
		else 
		{
			$loans_array['service_image'] = $base_url_images.'nobanner.jpeg';
		}	
		
		$loans_array['sort_description'] = $loans_data_array[0]['sort_description'];
		$loans_array['full_description'] = str_replace(array("\n", "\r"), '',strip_tags(html_entity_decode($loans_data_array[0]['full_description'])));
		$loans_array['meta_keyword'] = $loans_data_array[0]['meta_keyword'];
		$loans_array['meta_title'] = $loans_data_array[0]['meta_title'];
		$loans_array['meta_description'] = $loans_data_array[0]['meta_description'];
		$loans_array['created_on'] = date('j F, Y', strtotime($loans_data_array[0]['created_on']));

		
		$response_loans_data_array[] = $loans_array;	
		

		$return["status"] = "success";
		$return["status_code"] = "200";
		$return["data"] = $response_loans_data_array;
		
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