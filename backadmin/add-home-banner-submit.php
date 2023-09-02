<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if($admin == 1)
{
	if($_POST)
	{
		$title_1 = Secure1($db_mysqli,$_POST['title_1']);
		$title_2 = Secure1($db_mysqli,$_POST['title_2']);
		$title_3 = Secure1($db_mysqli,$_POST['title_3']);
		$redirect_url = Secure1($db_mysqli,$_POST['redirect_url']);
		$images = Secure1($db_mysqli,$_POST['file_name1']);
		$smallimages = Secure1($db_mysqli,$_POST['file_name2']);
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
		
		$all_home_banner_data_array = array();
		$get_home_banner_query = "select * from home_banner where title_1='$title_1' and title_2='$title_2' and  is_deleted='0'";
		$result_get_home_banner_query = mysqli_query($db_mysqli,$get_home_banner_query);
		while ($row_get_home_banner_query = mysqli_fetch_assoc($result_get_home_banner_query))
		{
			$all_home_banner_data_array[] = $row_get_home_banner_query;
		}

		if(count($all_home_banner_data_array)>0)
		{
			$return["html_message"] = 'Home Banner Already Exist. Try Another!';
			$return["status"] = "error";
			echo json_encode($return);
			exit();
		}
		else
		{
			
			$insert_home_banner_query = "INSERT INTO home_banner (title_2,title_1, redirect_url,images,small_images,created_on,status, is_deleted) VALUES ('$title_2','$title_1', '$smallimages','$redirect_url','$images', '$created_on', '$status','0');";
			$result_insert_home_banner_query = mysqli_query($db_mysqli,$insert_home_banner_query);
			
			if($result_insert_home_banner_query)   
			{ 
				$return["html_message"] = 'Home Banner Added Successfully.';
				$return["status"] = "success";
				echo json_encode($return); 
				exit();
			}
			else 
			{
				$return["html_message"] = 'Some Error Occured While adding Home Banner';
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