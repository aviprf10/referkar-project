<?php
include('common/config.php');
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
	
	$all_about_data_array = array();
	$all_main_about_data_array = array();
	$all_about_with_id_data_array = array();
	$about_data_array = array();
	$get_about_query = "SELECT * FROM `cms_page` where id='1' and is_deleted='0' and status='1'";
	$result_get_about_query = mysqli_query($db_mysqli, $get_about_query);
	while ($row_get_about_query = mysqli_fetch_assoc($result_get_about_query))
	{
	    $about_data_array[] = $row_get_about_query;
	} 


	$response_about_data_array = array();
	if(count($about_data_array)>0)
	{
		
		$about_array['main_title'] = $about_data_array[0]['main_title'];
		$about_array['page_content'] = str_replace(array("\n", "\r"), '',strip_tags(html_entity_decode($about_data_array[0]['page_content'])));
		$about_array['search_keywords'] = $about_data_array[0]['search_keywords'];
		$about_array['meta_title'] = $about_data_array[0]['meta_title'];
		$about_array['meta_description'] = $about_data_array[0]['meta_description'];

		
		$response_about_data_array[] = $about_array;

		$return["status"] = "success";
		$return["status_code"] = "200";
		$return["data"] = $response_about_data_array;
		
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