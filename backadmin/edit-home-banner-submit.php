<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if($admin == 1)
{
	if(isset($_POST))
	{
		$edit_id = Secure1($db_mysqli,$_POST['edit_id']);


		$all_home_banner_data_array = array();
		$get_home_banner_query = "select * from home_banner where id='$edit_id' and is_deleted='0'";
		$result_get_home_banner_query = mysqli_query($db_mysqli,$get_home_banner_query);
		while ($row_get_home_banner_query = mysqli_fetch_assoc($result_get_home_banner_query))
		{
			$all_home_banner_data_array[] = $row_get_home_banner_query;
		}

		if(count($all_home_banner_data_array) > 0)
		{

			$title_1      = Secure1($db_mysqli,$_POST['title_1']);
			$title_2      = Secure1($db_mysqli,$_POST['title_2']);
			$images 	  = Secure1($db_mysqli,$_POST['file_name1']);
			$smallimage   = Secure1($db_mysqli,$_POST['file_name2']);
			$redirect_url = Secure1($db_mysqli,$_POST['redirect_url']);
			$created_on   = get_current_date_time();

			$check_home_banner_data_array = array();
			$check_home_banner_query = "select * from home_banner where title_1='$title_1' and title_2='$title_2' AND id != '$edit_id' and is_deleted='0'";
			$result_check_home_banner_query = mysqli_query($db_mysqli,$check_home_banner_query);
			while ($row_check_home_banner_query = mysqli_fetch_assoc($result_check_home_banner_query))
			{
				$check_home_banner_data_array[] = $row_check_home_banner_query;
			}

			if (count($check_home_banner_data_array) > 0)
			{
				$return["html_message"] = 'Home Banner already exist. Try another!';
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
			
			$update_home_banner_query = "update home_banner set title_1='$title_1',title_2='$title_2',  redirect_url='$redirect_url', images='$images', small_images='$smallimage',status='$status', updated_on='$created_on' where id='$edit_id'";
			$result_update_home_banner_query = mysqli_query($db_mysqli,$update_home_banner_query);

			$affected_rows = mysqli_affected_rows($db_mysqli);

			if($result_update_home_banner_query)
			{
				if ($affected_rows == 0)
				{
					$return["html_message"] = 'Nothing Updated by user.';
					$return["status"] = "success";
					echo json_encode($return);
					exit();
				}
				$return["html_message"] = 'Home Banner Updated Successfully.';
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
			$return["html_message"] = 'Home Banner Does Not Exist.';
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