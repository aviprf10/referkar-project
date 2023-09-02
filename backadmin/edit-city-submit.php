<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1 || ($sub_admin == 1 && $is_city_write == 1))
{
	if(isset($_POST))
	{
		$edit_id = Secure1($db_mysqli,$_POST['edit_id']);

		$all_city_data_array = array();
		$get_city_query = "select * from cities where id='$edit_id' and is_deleted='0'";
		$result_get_city_query = mysqli_query($db_mysqli,$get_city_query);
		while ($row_get_city_query = mysqli_fetch_assoc($result_get_city_query))
		{
			$all_city_data_array[] = $row_get_city_query;
		}

		if(count($all_city_data_array) > 0)
		{

			$title = Secure1($db_mysqli,$_POST['city_title']);

			$state_id = $_POST['state_id'];


			$check_city_data_array = array();
			$check_city_query = "select * from cities where state_id='$state_id' AND city_name='$title' AND id!='$edit_id' and is_deleted='0'";
			$result_check_city_query = mysqli_query($db_mysqli,$check_city_query);
			while ($row_check_city_query = mysqli_fetch_assoc($result_check_city_query))
			{
				$check_city_data_array[] = $row_check_city_query;
			}

			if (count($check_city_data_array) > 0)
			{
				$return["html_message"] = 'City already exist in selected country and state.';
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
			
			$update_city_query = "update cities set city_name='$title',state_id='$state_id',status='$status' where id='$edit_id'";
//			$update_state_query = "update state set state_title='$title',status='$status' where id='$edit_id'";
			$result_update_city_query = mysqli_query($db_mysqli,$update_city_query);

			$affected_rows = mysqli_affected_rows($db_mysqli);

			if($result_update_city_query)
			{
				if ($affected_rows == 0)
				{
					$return["html_message"] = 'Nothing Updated by user.';
					$return["status"] = "success";
					echo json_encode($return);
					exit();
				}
				
				$return["html_message"] = 'City Updated Successfully.';
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
			$return["html_message"] = 'City Does Not Exist.';
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