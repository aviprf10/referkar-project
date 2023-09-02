<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if($admin == 1)
{
	if(isset($_POST))
	{
		$edit_id = Secure1($db_mysqli,$_POST['edit_id']);


		$all_offer_banner_data_array = array();
		$get_offer_banner_query = "select * from offer_banner where id='$edit_id' and is_deleted='0'";
		$result_get_offer_banner_query = mysqli_query($db_mysqli,$get_offer_banner_query);
		while ($row_get_offer_banner_query = mysqli_fetch_assoc($result_get_offer_banner_query))
		{
			$all_offer_banner_data_array[] = $row_get_offer_banner_query;
		}

		if(count($all_offer_banner_data_array) > 0)
		{

			$category_id = Secure1($db_mysqli,$_POST['category_id']);
			$offer_name = Secure1($db_mysqli,$_POST['offer_name']);
			$sequnace_no = Secure1($db_mysqli,$_POST['sequnace_no']);
			$images = Secure1($db_mysqli,$_POST['file_name1']);

			$check_offer_banner_data_array = array();
			$check_offer_banner_query = "select * from offer_banner where category_id='$category_id' and offer_name='$offer_name' AND sequnace_no='$sequnace_no' AND id != '$edit_id' and is_deleted='0'";
			$result_check_offer_banner_query = mysqli_query($db_mysqli,$check_offer_banner_query);
			while ($row_check_offer_banner_query = mysqli_fetch_assoc($result_check_offer_banner_query))
			{
				$check_offer_banner_data_array[] = $row_check_offer_banner_query;
			}

			if (count($check_offer_banner_data_array) > 0)
			{
				$return["html_message"] = 'offer Banner already exist. Try another!';
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
			
			$update_offer_banner_query = "update offer_banner set category_id='$category_id',offer_name='$offer_name',  sequnace_no='$sequnace_no', offer_images='$images', status='$status' where id='$edit_id'";
			$result_update_offer_banner_query = mysqli_query($db_mysqli,$update_offer_banner_query);

			$affected_rows = mysqli_affected_rows($db_mysqli);

			if($result_update_offer_banner_query)
			{
				if ($affected_rows == 0)
				{
					$return["html_message"] = 'Nothing Updated by user.';
					$return["status"] = "success";
					echo json_encode($return);
					exit();
				}
				$return["html_message"] = 'offer Banner Updated Successfully.';
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
			$return["html_message"] = 'offer Banner Does Not Exist.';
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