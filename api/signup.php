<?php
include('common/config.php');
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$post_data = json_decode(file_get_contents("php://input"));
	$post_data_array = json_decode(json_encode($post_data), True);


	$first_name = '';
	$last_name = '';
	$email = '';
	$gender = 'male';
	$mobile = '';
	$password = '';
	$confirm_password = '';

	$first_name =  Secure1($db_mysqli,$post_data_array['form_data']['first_name']);
	$last_name =  Secure1($db_mysqli,$post_data_array['form_data']['last_name']);
	$email =  Secure1($db_mysqli, strtolower($post_data_array['form_data']['email']));
	$mobile =  Secure1($db_mysqli,$post_data_array['form_data']['mobile']);
	$password =  Secure1($db_mysqli,$post_data_array['form_data']['password']);
	$confirm_password =  Secure1($db_mysqli,$post_data_array['form_data']['confirm_password']);
	//$login_type = $post_data_array['form_data']['login_type'];
	$user_name = $first_name.' '. $last_name;
	$user_unique_slug = get_unique_slug1($db_mysqli,$user_name,'user','user_name');

	if($password != $confirm_password)
	{
		$return["status"] = "error";
		$return["status_code"] = 100;
		$return["message"] = "Password and Confirm Password does not match.";
		echo json_encode($return);
		exit();
	}
	else
	{
		if(($first_name != '') && ($last_name != '') && ($email != '') && ($mobile != '') && ($password != ''))
		{
			$all_user_data_array = array();
			$get_user_query = "select id,email,mobile from user where (email='$email' or mobile='$mobile') and is_deleted = 0";
			$result_get_user_query = mysqli_query($db_mysqli,$get_user_query);
			while ($row_get_user_query = mysqli_fetch_assoc($result_get_user_query))
			{
			 	$all_user_data_array[] = $row_get_user_query;
			}
			if(isset($all_user_data_array) && count($all_user_data_array)==0)
			{
				$user_unique_slug = get_unique_slug1($db_mysqli,$user_name,'user','user_name');
				$created_on= date("Y-m-d H:i:s");
				$unique_key = md5(uniqid(rand()));
				$ip_address = $_SERVER['REMOTE_ADDR'];
				$password =  md5($password);
				
				$all_user_temp_data_array=array();
				$get_user_temp_query = "select * from user_temp where (email='$email' or mobile='$mobile') and status = 0";
				$result_get_user_temp_query = mysqli_query($db_mysqli,$get_user_temp_query);
				while ($row_get_user_temp_query = mysqli_fetch_assoc($result_get_user_temp_query))
				{
				 	$all_user_temp_data_array[] = $row_get_user_temp_query;
				}
				if(isset($all_user_temp_data_array) && count($all_user_temp_data_array)==0)
				{
					$sql_insert_user = "insert into user_temp(`first_name`, `last_name`,`user_name`,`user_unique_slug`, `email`,`password`,`gender`,`mobile`,`user_type`, `unique_key`,`ip_address`,`created_on`,`status` )values('$first_name','$last_name','$user_name','$user_unique_slug','$email','$password','$gender','$mobile','2','$unique_key','$ip_address','$created_on','0')";
					$result_insert_user = mysqli_query($db_mysqli,$sql_insert_user);
					if($result_insert_user)    
					{
						/*
						$email_array = array();
		                $email_array['email'] = $email;
		                $email_array['user_name'] = $user_name;
		                $email_array['unique_key'] = $unique_key;
		                $email_array['email_type'] = 2;
		                $email_array['base_url'] = $base_url;
		                $email_sent_response = send_email($email_array);
		                if ($email_sent_response == 1)
		                {
		                    $email_array = array();
		                    $email_array['email'] = $email;
		                    $email_array['user_name'] =$user_name;
		                    $email_array['unique_key'] = $unique_key;
		                    $email_array['email_type'] = 3;
		                    $email_array['base_url'] = $base_url;
		                    $email_sent_response = send_email($email_array);
						*/
		                    $return["message"] = 'You have completed step1 of signup now verify your account with us..!';
		                    $return["status"] = "success";
		                    $return["status_code"] = 200;
		                    echo json_encode($return);
		                    exit();
		            	/*    
		            	}
		                else
		                {
		                    $return["message"] = 'Some Error Occurred! Please Try Again1.';
		                    $return["status"] = "error";
		                    $return["status_code"] = 100;
		                    echo json_encode($return);
		                    exit();
		                }*/
					}
					else
					{
						$return["status"] = "error";
						$return["status_code"] = 100;
						$return["message"] = "Some Error Occured. Please try after some time.";
						echo json_encode($return);
						exit();
					}
				}
				else
				{

					if($all_user_temp_data_array[0]['email'] == $email)
			        {
			            $return["message"] = 'Email Id already exists..! Please try another.';
			            $return['mobile_verified'] = 0;
			            $return["status"] = "error";
			            $return["status_code"] = 100;
			            echo json_encode($return);
			            exit();
			        }
			        else if($all_user_temp_data_array[0]['mobile'] == $mobile)
			        {
			            $return["message"] = ' Mobile number already exists..! Try Another.';
			            $return['mobile_verified'] = 0;
			            $return["status"] = "error";
			            $return["status_code"] = 100;
			            echo json_encode($return);
			            exit();
			        }
				}
			}
			else
			{
				if($all_user_data_array[0]['email'] == $email)
		        {
		            $return["message"] = 'Email Id already exists..! Please try another.';
		            $return["status"] = "error";
		            $return["status_code"] = 100;
		            echo json_encode($return);
		            exit();
		        }
		        else if($all_user_data_array[0]['mobile'] == $mobile)
		        {
		            $return["message"] = ' Mobile number already exists..! Try Another.';
		            $return["status"] = "error";
		            $return["status_code"] = 100;
		            echo json_encode($return);
		            exit();
		        }
			}
		}
		else 
		{
		   $return["message"] = 'Some Error Occured! Please try after some time.';
		   $return["status"] = "error";
		   $return["status_code"] = 100;
		   echo json_encode($return);
		   exit();
		}
	}
}
?>