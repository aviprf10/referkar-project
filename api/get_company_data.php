<?php
include('common/config.php');
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
	
	$all_company_data_array = array();
	$all_main_company_data_array = array();
	$all_company_with_id_data_array = array();
	$company_data_array = array();
	$get_company_query = "SELECT * FROM `company_info` where id='1' and is_deleted='0' and status='1'";
	$result_get_company_query = mysqli_query($db_mysqli, $get_company_query);
	while ($row_get_company_query = mysqli_fetch_assoc($result_get_company_query))
	{
	    $company_data_array[] = $row_get_company_query;
	} 


	$response_company_data_array = array();
	if(count($company_data_array)>0)
	{
		
		$company_array['company_description'] = $company_data_array[0]['company_description'];
		$company_array['company_address'] = $company_data_array[0]['company_address'];
		$company_array['company_title'] = $company_data_array[0]['company_title'];
		$company_array['company_email'] = $company_data_array[0]['company_email'];
		$company_array['company_email2'] = $company_data_array[0]['company_email2'];
		$company_array['company_mobile'] = $company_data_array[0]['company_mobile'];
		$company_array['company_mobile2'] = $company_data_array[0]['company_mobile2'];
		$company_array['company_address2'] = $company_data_array[0]['company_address2'];
		$company_array['country'] = $company_data_array[0]['country'];
		$company_array['state'] = $company_data_array[0]['state'];
		$company_array['city'] = $company_data_array[0]['city'];
		$company_array['pincode'] = $company_data_array[0]['pincode'];
		$company_array['facebook_link'] = $company_data_array[0]['facebook_link'];
		$company_array['twitter_link'] = $company_data_array[0]['twitter_link'];
		$company_array['linkedin_link'] = $company_data_array[0]['linkedin_link'];
		$company_array['skype_link'] = $company_data_array[0]['skype_link'];
		$company_array['youtube_link'] = $company_data_array[0]['youtube_link'];
		$company_array['insta_link'] = $company_data_array[0]['insta_link'];
		$company_array['whatsapp_link'] = $company_data_array[0]['whatsapp_link'];
		$company_array['pintrest_link'] = $company_data_array[0]['pintrest_link'];
		$company_array['company_logo'] = $company_data_array[0]['company_logo'];

		
		$response_company_data_array[] = $company_array;

		$return["status"] = "success";
		$return["status_code"] = "200";
		$return["data"] = $response_company_data_array;
		
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