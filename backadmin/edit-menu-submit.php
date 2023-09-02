<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1 || ($sub_admin == 1 && $is_menu_write == 1))
{
	if(isset($_POST))
	{
		$edit_id = Secure1($db_mysqli,$_POST['edit_id']);

		$all_menu_data_array = array();
		$get_menu_query = "select * from menu where id='$edit_id' and is_deleted='0'";
		$result_get_menu_query = mysqli_query($db_mysqli,$get_menu_query);
		while ($row_get_menu_query = mysqli_fetch_assoc($result_get_menu_query))
		{
			$all_menu_data_array[] = $row_get_menu_query;
		}

		if(count($all_menu_data_array) > 0)
		{

			$menu_name = Secure1($db_mysqli,$_POST['menu_name']);
			$price = Secure1($db_mysqli,$_POST['price']);
			$area_id = $_POST['area_id'];
			$updated_on = get_current_date_time();

			$check_menu_data_array = array();
			$check_menu_query = "select * from menu where area_id='$area_id' AND menu_name='$menu_name' AND id!='$edit_id' and is_deleted='0'";
			$result_check_menu_query = mysqli_query($db_mysqli,$check_menu_query);
			while ($row_check_menu_query = mysqli_fetch_assoc($result_check_menu_query))
			{
				$check_menu_data_array[] = $row_check_menu_query;
			}

			if (count($check_menu_data_array) > 0)
			{
				$return["html_message"] = 'Menu already exist in selected cities.';
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
			
			 $update_menu_query = "update menu set menu_name='$menu_name',area_id='$area_id',price='$price',status='$status', updated_on='$updated_on' where id='$edit_id'";
			$result_update_menu_query = mysqli_query($db_mysqli,$update_menu_query);
			$affected_rows = mysqli_affected_rows($db_mysqli);
			
			if($result_update_menu_query)
			{
				if ($affected_rows == 0)
				{
					$return["html_message"] = 'Nothing Updated by user.';
					$return["status"] = "success";
					echo json_encode($return);
					exit();
				}
				$return["html_message"] = 'Menu Updated Successfully.';
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
			$return["html_message"] = 'menu Does Not Exist.';
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