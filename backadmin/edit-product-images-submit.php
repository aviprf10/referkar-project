<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if($admin == 1)
{
	if(isset($_POST))
	{
		$edit_id 				= Secure1($db_mysqli,$_POST['edit_id']);
		$product_small_images 	= Secure1($db_mysqli,$_POST['file_name1']);
		$product_images 	    = Secure1($db_mysqli,$_POST['file_name2']);
		$product_id   			= Secure1($db_mysqli,$_POST['product_id']);
		$images_name   			= Secure1($db_mysqli,$_POST['images_name']);
		$created_on   			= get_current_date_time();

		if(isset($_POST['status']))
		{
			$status = 1;
		}
		else
		{
			$status = 0;
		}
		
		$update_product_images_query = "update product_images set product_small_images='$product_small_images',product_images='$product_images', product_id='$product_id', images_name='$images_name', status='$status', updated_on='$created_on' where id='$edit_id'";
		$result_update_product_images_query = mysqli_query($db_mysqli,$update_product_images_query);

		$affected_rows = mysqli_affected_rows($db_mysqli);

		if($result_update_product_images_query)
		{
			if ($affected_rows == 0)
			{
				$return["html_message"] = 'Nothing Updated by user.';
				$return["status"] = "success";
				echo json_encode($return);
				exit();
			}
			$return["html_message"] = 'Product Images Updated Successfully.';
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