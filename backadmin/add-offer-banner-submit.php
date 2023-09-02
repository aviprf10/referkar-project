<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if($admin == 1)
{
	if($_POST)
	{
		$category_id = Secure1($db_mysqli,$_POST['category_id']);
		$offer_name = Secure1($db_mysqli,$_POST['offer_name']);
		$sequnace_no = Secure1($db_mysqli,$_POST['sequnace_no']);
		$images = Secure1($db_mysqli,$_POST['file_name1']);
		// $title_3 = Secure1($db_mysqli,$_POST['file_name2']);
		$created_on = get_current_date_time();
		if(isset($_POST['status']))
		{
			$status = 1;
		}
		else
		{
			$status = 0;
		}
		
		$all_offer_banner_data_array = array();
		$get_offer_banner_query = "select * from offer_banner where category_id='$category_id' and offer_name='$offer_name' and sequnace_no='$sequnace_no' and  is_deleted='0'";
		$result_get_offer_banner_query = mysqli_query($db_mysqli,$get_offer_banner_query);
		while ($row_get_offer_banner_query = mysqli_fetch_assoc($result_get_offer_banner_query))
		{
			$all_offer_banner_data_array[] = $row_get_offer_banner_query;
		}

		if(count($all_offer_banner_data_array)>0)
		{
			$return["html_message"] = 'offer Banner Already Exist. Try Another!';
			$return["status"] = "error";
			echo json_encode($return);
			exit();
		}
		else
		{
			
			$insert_offer_banner_query = "INSERT INTO offer_banner (category_id,offer_name, sequnace_no,offer_images, status, is_deleted) VALUES ('$category_id ','$offer_name', '$sequnace_no','$images', '$status','0');";
			$result_insert_offer_banner_query = mysqli_query($db_mysqli,$insert_offer_banner_query);
			
			if($result_insert_offer_banner_query)   
			{ 
				$return["html_message"] = 'Offer Banner Added Successfully.';
				$return["status"] = "success";
				echo json_encode($return); 
				exit();
			}
			else 
			{
				$return["html_message"] = 'Some Error Occured While adding offer Banner';
				$return["status"] = "error";
				echo json_encode($return);
				exit();
			} 
		}
	}
	else 
	{
		$return["html_message"] = 'Some Error Occured! Please try again.';
		$return["status"] = "error";
		echo json_encode($return);
		exit();
	}
}
else
{
	$return["html_message"] = 'Please login.';
	$return["status"] = "error";
	echo json_encode($return);
	exit();
}
?>