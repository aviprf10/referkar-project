<?php
include('common/config.php');
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
	
	$blogs_data_array = array();
	$get_blogs_query = "SELECT b.*, s.service_name FROM `blogs` b left join service s on b.service_id=s.id where b.is_deleted='0' and b.status='1'";
	$result_get_blogs_query = mysqli_query($db_mysqli, $get_blogs_query);
	while ($row_get_blogs_query = mysqli_fetch_assoc($result_get_blogs_query))
	{
	    $blogs_data_array[] = $row_get_blogs_query;
	} 


	$response_blogs_data_array = array();
	if(count($blogs_data_array)>0)
	{
		foreach($blogs_data_array as $blogs_data)
		{
			$blogs_array = array();
			$blogs_array['id'] = $blogs_data['id'];
			$blogs_array['blog_name'] = $blogs_data['blog_name'];
			$blogs_array['service_name'] = $blogs_data['service_name'];
			$blogs_array['blog_url'] = $blogs_data['blog_url'];
			if(!empty($blogs_data['blog_image']))
			{
				$blogs_array['blog_image'] = $base_url_uploads.'blog-images/temp_file/'.$blogs_data['blog_image'];
			}
			else 
			{
				$blogs_array['blog_image'] = $base_url_images.'nobanner.jpeg';
			}	
			
			$blogs_array['sort_description'] = $blogs_data['sort_description'];
			$blogs_array['full_description'] = str_replace(array("\n", "\r"), '',strip_tags(html_entity_decode($blogs_data['full_description'])));
			$blogs_array['meta_keyword'] = $blogs_data['meta_keyword'];
			$blogs_array['meta_title'] = $blogs_data['meta_title'];
			$blogs_array['meta_description'] = $blogs_data['meta_description'];
			$blogs_array['created_on'] = date('j F, Y', strtotime($blogs_data['created_on']));

			
			$response_blogs_data_array[] = $blogs_array;
		}	
		

		$return["status"] = "success";
		$return["status_code"] = "200";
		$return["data"] = $response_blogs_data_array;
		
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