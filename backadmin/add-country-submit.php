<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if($admin == 1 || ($sub_admin == 1 && $is_country_write == 1))
{
	
	if($_POST)
	{
		$title = Secure1($db_mysqli,$_POST['title']);
		if(isset($_POST['status']))
		{
			$status = 1;
		}
		else
		{
			$status = 0;
		}
		
		$all_country_data_array = array();
		$get_country_query = "select * from country where country_name='$title' and is_deleted='0'";
		$result_get_country_query = mysqli_query($db_mysqli,$get_country_query);
		while ($row_get_country_query = mysqli_fetch_assoc($result_get_country_query))
		{
			$all_country_data_array[] = $row_get_country_query;
		}

		if(!empty($all_country_data_array))
		{
			$return["html_message"] = 'Country Already Exist. Try Another!';
			$return["status"] = "error";
			echo json_encode($return);
			exit();
		}
		else
		{
			
			$insert_country_query = "insert into country(`country_name`,`status`, `is_deleted`) VALUES ('$title', '$status', 0)";
			$result_insert_country_query = mysqli_query($db_mysqli,$insert_country_query);
			
			if($result_insert_country_query)   
			{ 
				$return["html_message"] = 'Country Added Successfully.';
				$return["status"] = "success";
				echo json_encode($return); 
				exit();
			}
			else 
			{
				$return["html_message"] = 'Some Error Occured While adding Country';
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