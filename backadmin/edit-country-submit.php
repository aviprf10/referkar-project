<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1 || ($sub_admin == 1 && $is_country_write == 1))
{
	if(isset($_POST))
	{
		$edit_id = Secure1($db_mysqli,$_POST['edit_id']);


		$all_country_data_array = array();
		$get_country_query = "select * from country where id='$edit_id' and is_deleted='0'";
		$result_get_country_query = mysqli_query($db_mysqli,$get_country_query);
		while ($row_get_country_query = mysqli_fetch_assoc($result_get_country_query))
		{
			$all_country_data_array[] = $row_get_country_query;
		}

		if(count($all_country_data_array) > 0)
		{

			$title = Secure1($db_mysqli,$_POST['title']);

			$check_country_data_array = array();
			$check_country_query = "select * from country where country_name='$title' AND id != '$edit_id' and is_deleted='0'";
			$result_check_country_query = mysqli_query($db_mysqli,$check_country_query);
			while ($row_check_country_query = mysqli_fetch_assoc($result_check_country_query))
			{
				$check_country_data_array[] = $row_check_country_query;
			}

			if (!empty($check_country_data_array))
			{
				$return["html_message"] = 'Country already exist. Try another!';
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
			
			$update_country_query = "update country set country_name='$title',status='$status' where id='$edit_id'";
			$result_update_country_query = mysqli_query($db_mysqli,$update_country_query);

			$affected_rows = mysqli_affected_rows($db_mysqli);

			if($result_update_country_query)
			{
				if ($affected_rows == 0)
				{
					$return["html_message"] = 'Nothing Updated by user.';
					$return["status"] = "success";
					echo json_encode($return);
					exit();
				}
				$return["html_message"] = 'Country Updated Successfully.';
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
			$return["html_message"] = 'Country Does Not Exist.';
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