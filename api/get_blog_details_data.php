<?php
include('common/config.php');
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$post_data = json_decode(file_get_contents("php://input"));
	$post_data_array = json_decode(json_encode($post_data), True);
	
	$blog_id = Secure1($db_mysqli,$_POST['blog_id']);
	
	$blogs_data_array = array();
	$get_blogs_query = "SELECT * FROM `blogs`  where id='$blog_id' and is_deleted='0' and status='1'";
	$result_get_blogs_query = mysqli_query($db_mysqli, $get_blogs_query);
	while ($row_get_blogs_query = mysqli_fetch_assoc($result_get_blogs_query))
	{
	    $blogs_data_array[] = $row_get_blogs_query;
	} 


	$response_blogs_data_array = array();
	if(count($blogs_data_array)>0)
	{
		$blogs_array = array();
		$blogs_array['id'] = $blogs_data_array[0]['id'];
		$blogs_array['blog_name'] = $blogs_data_array[0]['blog_name'];
		$blogs_array['blog_url'] = $blogs_data_array[0]['blog_url'];
		if(!empty($blogs_data_array[0]['blog_image']))
		{
			$blogs_array['blog_image'] = $base_url_uploads.'blog-images/temp_file/'.$blogs_data_array[0]['blog_image'];
		}
		else 
		{
			$blogs_array['blog_image'] = $base_url_images.'nobanner.jpeg';
		}	
		
		$blogs_array['sort_description'] = $blogs_data_array[0]['sort_description'];
		$blogs_array['full_description'] = str_replace(array("\n", "\r"), '',strip_tags(html_entity_decode($blogs_data_array[0]['full_description'])));
		$blogs_array['meta_keyword'] = $blogs_data_array[0]['meta_keyword'];
		$blogs_array['meta_title'] = $blogs_data_array[0]['meta_title'];
		$blogs_array['meta_description'] = $blogs_data_array[0]['meta_description'];
		$blogs_array['created_on'] = date('j F, Y', strtotime($blogs_data_array[0]['created_on']));

		
		$response_blogs_data_array[] = $blogs_array;	
		

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