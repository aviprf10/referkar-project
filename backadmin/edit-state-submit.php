<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1 || ($sub_admin == 1 && $is_state_write == 1))
{
	if(isset($_POST))
	{
		$edit_id = Secure1($db_mysqli,$_POST['edit_id']);

		$all_state_data_array = array();
		$get_state_query = "select * from states where id='$edit_id' and is_deleted='0'";
		$result_get_state_query = mysqli_query($db_mysqli,$get_state_query);
		while ($row_get_state_query = mysqli_fetch_assoc($result_get_state_query))
		{
			$all_state_data_array[] = $row_get_state_query;
		}

		if(!empty($all_state_data_array))
		{

			$title = Secure1($db_mysqli,$_POST['state_title']);

			$country_id = $_POST['country_id'];

			$check_state_data_array = array();
			$check_state_query = "select * from states where country_id='$country_id' AND state_name='$title' AND id!='$edit_id' and is_deleted='0'";
			$result_check_state_query = mysqli_query($db_mysqli,$check_state_query);
			while ($row_check_state_query = mysqli_fetch_assoc($result_check_state_query))
			{
				$check_state_data_array[] = $row_check_state_query;
			}

			if (count($check_state_data_array) > 0)
			{
				$return["html_message"] = 'State already exist in selected country.';
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
			
			$update_state_query = "update states set state_name='$title',country_id='$country_id',status='$status' where id='$edit_id'";

			$result_update_state_query = mysqli_query($db_mysqli,$update_state_query);

			$affected_rows = mysqli_affected_rows($db_mysqli);

			
			if($result_update_state_query)
			{
				if ($affected_rows == 0)
				{
					$return["html_message"] = 'Nothing Updated by user.';
					$return["status"] = "success";
					echo json_encode($return);
					exit();
				}
				$return["html_message"] = 'State Updated Successfully.';
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
			$return["html_message"] = 'State Does Not Exist.';
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