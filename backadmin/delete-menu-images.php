<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if($admin == 1)
{
	if(($_POST))
	{
//		$delete_id = Secure1($db_mysqli,$_POST['delete_id']);
        $delete_id_array = $_POST['delete_id_array'];
        if(is_array($delete_id_array))
        {
            $delete_id_list = implode(',',$delete_id_array);
        }
        else
        {
            $delete_id_list = $delete_id_array;
        }

		$all_product_images_data_array = array();
		$get_product_images_query = "select * from product_images where id IN ($delete_id_list) and is_deleted='0'";
		$result_get_product_images_query = mysqli_query($db_mysqli,$get_product_images_query);
		while ($row_get_product_images_query = mysqli_fetch_assoc($result_get_product_images_query))
		{
			$all_product_images_data_array[] = $row_get_product_images_query;
		}

		if(count($all_product_images_data_array) > 0)
		{
			
			$update_product_images_query = "update product_images set is_deleted='1' WHERE id IN ($delete_id_list)";
			$result_update_product_images_query = mysqli_query($db_mysqli,$update_product_images_query);
			if($result_update_product_images_query)
			{  
				$return["html_message"] = 'Product Images Removed Successfully.';
				$return["status"] = "success";
				$return["update"] = 1;
				echo json_encode($return);
				exit();
			}
			else 
			{
				$return["html_message"] = 'Some Error Occurred! Please try again.';
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
		$return["html_message"] = 'Some Error Occurred! Please try again.';
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