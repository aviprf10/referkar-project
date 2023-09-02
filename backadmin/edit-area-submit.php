<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1 || ($sub_admin == 1 && $is_area_write == 1))
{
	if(isset($_POST))
	{
		$edit_id = Secure1($db_mysqli,$_POST['edit_id']);

		$all_area_data_array = array();
		$get_area_query = "select * from area where id='$edit_id' and is_deleted='0'";
		$result_get_area_query = mysqli_query($db_mysqli,$get_area_query);
		while ($row_get_area_query = mysqli_fetch_assoc($result_get_area_query))
		{
			$all_area_data_array[] = $row_get_area_query;
		}

		if(count($all_area_data_array) > 0)
		{

			$name = Secure1($db_mysqli,$_POST['name']);
			$pincode = Secure1($db_mysqli,$_POST['pincode']);
			$city_id = $_POST['city_id'];

			$check_area_data_array = array();
			$check_area_query = "select * from area where city_id='$city_id' AND name='$name' AND id!='$edit_id' and is_deleted='0'";
			$result_check_area_query = mysqli_query($db_mysqli,$check_area_query);
			while ($row_check_area_query = mysqli_fetch_assoc($result_check_area_query))
			{
				$check_area_data_array[] = $row_check_area_query;
			}

			if (count($check_area_data_array) > 0)
			{
				$return["html_message"] = 'Area already exist in selected cities.';
				$return["status"] = "error";
				echo json_encode($return);
				exit();
			}

			if(isset($_POST['status']))
			{
				$status = 1;
			}
			else
			{
				$status = 0;
			}
			
			$update_area_query = "update area set name='$name',city_id='$city_id',pincode='$pincode',status='$status' where id='$edit_id'";
			$result_update_area_query = mysqli_query($db_mysqli,$update_area_query);
			$affected_rows = mysqli_affected_rows($db_mysqli);
			
			if($result_update_area_query)
			{
				if ($affected_rows == 0)
				{
					$return["html_message"] = 'Nothing Updated by user.';
					$return["status"] = "success";
					echo json_encode($return);
					exit();
				}
				$return["html_message"] = 'Area Updated Successfully.';
				$return["status"] = "success";
				$return["update"] = 1;
				echo json_encode($return);
				exit();
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
			$return["html_message"] = 'Area Does Not Exist.';
			$return["status"] = "error";
			echo json_encode($return);
			exit();
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