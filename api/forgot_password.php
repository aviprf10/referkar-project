<?php
include('common/config.php');
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$post_data = json_decode(file_get_contents("php://input"));
	$post_data_array = json_decode(json_encode($post_data), True);
	

	$email = '';
	$mobile = '';
	$email = Secure1($db_mysqli, strtolower($post_data_array['form_data']['email']));
	$mobile = Secure1($db_mysqli, $post_data_array['form_data']['mobile']);
    $module_type = Secure1($db_mysqli, $post_data_array['form_data']['module_type']);
    $type = Secure1($db_mysqli, $post_data_array['form_data']['type']);

	if($module_type != '')
	{	
		if($module_type==1)
		{
			$check_user_temp_email_data_array = array();
			$check_user_temp_data_array = array();
			$get_user_temp_query = "select * from user_temp where email='$email'";
			$result_get_user_temp_query = mysqli_query($db_mysqli,$get_user_temp_query);
			while ($row_get_user_temp_query = mysqli_fetch_assoc($result_get_user_temp_query))
			{
				$check_user_temp_email_data_array[] = $row_get_user_temp_query;
				$check_user_temp_data_array[] = $row_get_user_temp_query;
			} 

			if(count($check_user_temp_email_data_array)>0)
			{
				$check_user_mobile_data_array = array();
				$get_user_query = "select * from user where mobile='$mobile'  and is_deleted='0'";
				$result_get_user_query = mysqli_query($db_mysqli,$get_user_query);
				while ($row_get_user_query = mysqli_fetch_assoc($result_get_user_query))
				{
					$check_user_mobile_data_array[] = $row_get_user_query;
				} 
				if(count($check_user_mobile_data_array)>0)
				{
					$return["message"] = 'Oh snap! Mobile no already exist....!';
					$return["status"] = "error";
					$return["status_code"] = 100;
					echo json_encode($return);
					exit();
				}
				else
				{
					$check_user_temp_mobile_data_array = array();
					$get_user_temp_query = "select * from user_temp where mobile='$mobile' and email !='$email'";
					$result_get_user_temp_query = mysqli_query($db_mysqli,$get_user_temp_query);
					while ($row_get_user_temp_query = mysqli_fetch_assoc($result_get_user_temp_query))
					{
						$check_user_temp_mobile_data_array[] = $row_get_user_temp_query;
					} 
					if(count($check_user_temp_mobile_data_array)==0)
					{
						$valid_user=1;
						$user_name=$check_user_temp_data_array[0]['user_name'];
						$db_otp = xss_clean($check_user_temp_data_array[0]['otp']);
                		$db_otp_timestamp = date('Y-m-d H:i:s',strtotime($check_user_temp_data_array[0]['otp_date_time']));
					}
					else
					{
						$return["message"] = 'Oh snap! Mobile no already exist....!';
						$return["status"] = "error";
						$return["status_code"] = 100;
						echo json_encode($return);
						exit();
					}
				}
			}
			else
			{
				$return["message"] = 'Oh snap! Email id does not exist...!';
				$return["status"] = "error";
				$return["status_code"] = 100;
				echo json_encode($return);
				exit();
			}
		}
		else
		{
			$all_user_data_array = array();
			$get_user_query = "select * from user where mobile='$mobile' and is_deleted = 0";
			$result_get_user_query = mysqli_query($db_mysqli,$get_user_query);
			while ($row_get_user_query = mysqli_fetch_assoc($result_get_user_query))
			{
			 	$all_user_data_array[] = $row_get_user_query;
			}
			if(count($all_user_data_array)>0)
			{
				$user_data=$all_user_data_array[0];
				$email=$user_data['email'];
				$user_name=$user_data['user_name'];
				$valid_user = 1;
				$db_otp = xss_clean($user_data['otp']);
                $db_otp_timestamp = date('Y-m-d H:i:s',strtotime($user_data['otp_date_time']));
			}
		}


		if($valid_user==1)
		{
			$current_date_time = date('Y-m-d H:i:s');
			if($type == 1)//Send OTP To Registered Email-Id
            {
				$unique_key=md5(uniqid(rand()));
				$current_date = date('Y-m-d');
				$otp_number = random_four_digit_integer();
/*				$email_array = array();
				$email_array['email']      = $email;
				$email_array['mobile_otp'] = $otp_number;
				$email_array['email_type']    = 5;
				$email_sent_response       = send_email($email_array);*/
				/*if($email_sent_response==1)
				{*/
			
                    $otp_array = array();
					$otp_array['mobile_no'] = $mobile;
					$otp_array['mobile_otp'] = $otp_number;
					$otp_array['sms_type'] = 0;
					$sms_sent_response = send_sms($otp_array);
					if($sms_sent_response == 1)
					{
						if($module_type==1)
						{
	                		$update_user_query = "update user_temp set otp='$otp_number',otp_date_time='$current_date_time',updated_on='$current_date_time' where email='$email'";
						}
						else
						{
	                		$update_user_query = "update user set otp='$otp_number',otp_date_time='$current_date_time',updated_on='$current_date_time' where email='$email'";
						}
	                	$result_update_user_query = mysqli_query($db_mysqli,$update_user_query);

						$return["message"] = "Otp sent to your mobile No";
						$return["status"] = "success";
						$return["status_code"] = 200;
						echo json_encode($return);
						exit();
					}
					else
					{
						$return["message"] = 'Some Error Occured While Sending OTP';
						$return["status"] = "error";
						$return["status_code"] = "100";
						echo json_encode($return);
						exit();
					}
				/*}
				else
				{
					$return["message"] = 'Some Error Occured While Sending OTP';
					$return["status"] = "error";
					$return["status_code"] = 100;
					echo json_encode($return);
					exit();
				}*/
            }
            else if($type == 2)//Check OTP Is Same Or Not
            {
                $otp = Secure1($db_mysqli, $post_data_array['form_data']['otp']);
                $difference = strtotime($current_date_time) - strtotime($db_otp_timestamp);
                $difference_minutes = round(($difference / 60));
                if($otp == $db_otp)
                {
                    if($difference_minutes <= 30)
                    {
                    	if($module_type==1)
                    	{
                    		$check_user_temp_data=$check_user_temp_data_array[0];
                    		$user_id = $check_user_temp_data['id'];
							$first_name = $check_user_temp_data['first_name'];
							$last_name = $check_user_temp_data['last_name'];
							$user_name = $first_name.' '.$last_name;
							$user_unique_slug = get_unique_slug1($db_mysqli, $user_name,'user','user_name');
							$email = $check_user_temp_data['email'];
							$password = $check_user_temp_data['password'];
							$gender = $check_user_temp_data['gender'];
							
							$unique_key = md5(uniqid(rand()));
							$ip_address = $_SERVER['REMOTE_ADDR'];
							$created_on= date("Y-m-d H:i:s");
						
		                    $mobile_access_token = random_code_long();
		                    $mobile_token_exp_date =  date('Y-m-d', strtotime('+1 years'));
	                        $result_insert_user = mysqli_query($db_mysqli,"INSERT INTO `user`(`first_name`, `last_name`, `user_name`, `user_unique_slug`, `email`, `password`, `gender`, `mobile`,`mobile_verify`, `user_type`, `status`,`unique_key`,`mobile_access_token`,`mobile_token_exp_date`,`registration_date`,`ip_address`,`is_deleted`)  VALUES ('$first_name', '$last_name', '$user_name', '$user_unique_slug', '$email', '$password', '$gender', '$mobile','1', '2', '1','$unique_key','$mobile_access_token','$mobile_token_exp_date','$created_on','$ip_address','0')");
	                        if($result_insert_user)
	                        {
	                        	$delete_user_temp_data_query = "delete from user_temp where email='$email'";
								$return_delete_user_temp_data = mysqli_query($db_mysqli,$delete_user_temp_data_query);

	                        	$user_data_array=array();
	                        	$user_data_array['first_name']=$first_name;
	                        	$user_data_array['last_name']=$last_name;
	                        	$user_data_array['user_name']=$user_name;
	                        	$user_data_array['email']=$email;
	                        	$user_data_array['mobile']=$mobile;
	                        	$user_data_array['mobile_access_token']=$mobile_access_token;
		                        $return["status"] = "success";
		                    	$return["status_code"] = "200";
		                    	$return["data"] = $user_data_array;
		            			$return["message"] = "Otp is verified";
		            			echo json_encode($return);
		            			exit();
	                        }
	                        else
	                        {
	                        	$return["status"] = "error";
		        				$return["status_code"] = "100";
		        				$return["message"] = "Some Error Occured..Please try after some time..!";
		        				echo json_encode($return);
		        				exit();
	                        }

                    	}
                    	else
                    	{
                    		$update_user_query = "update user set mobile='$mobile',mobile_verify='1',updated_on='$current_date_time' where email='$email'";
		                	$result_update_user_query = mysqli_query($db_mysqli,$update_user_query);
		                    if($result_update_user_query)
		            		{
		        				$return["status"] = "success";
		                    	$return["status_code"] = "200";
		            			$return["message"] = "Otp is verified";
		            			echo json_encode($return);
		            			exit();
		        			}
		        			else
		        			{
		        				$return["status"] = "error";
		        				$return["status_code"] = "100";
		        				$return["message"] = "Some Error Occured..Please try after some time..!";
		        				echo json_encode($return);
		        				exit();
		        			}
                    	}
						
                    }
                    else
                    {
                        $return["status"] = "error";
                		$return["status_code"] = "100";
        				$return["message"] = "Otp is expired";
        				echo json_encode($return);
        				exit();
                    }
                }
                else
                {
                    $return["status"] = "error";
        			$return["status_code"] = "100";
    				$return["message"] = "Otp is not matched";
    				echo json_encode($return);
    				exit();
                }
            }
            else if($type == 3 && $module_type==2)//Save New Password  
            {
                $new_password = md5(Secure1($db_mysqli, $post_data_array['form_data']['new_password']));
                $confirm_password = md5(Secure1($db_mysqli, $post_data_array['form_data']['confirm_password']));
                if($new_password == $confirm_password)
                {
                    $update_user_query = "update user set password='$new_password',updated_on='$current_date_time' where email='$email'";
                	$result_update_user_query = mysqli_query($db_mysqli,$update_user_query);
                    if($result_update_user_query)
            		{
        				$return["user_data"] = $view_module_data;
        				$return["status"] = "success";
        				$return["status_code"] = "200";
        				$return["message"] = "Your password has been changed successfully";
        				echo json_encode($return);
        				exit();
        			}
        			else
        			{
        				$return["status"] = "error";
        				$return["status_code"] = "100";
        				$return["message"] = "Some Error Occured..Please try after some time..!";
        				echo json_encode($return);
        				exit();
        			}
                }
                else
                {
                    $return["status"] = "error";
        			$return["status_code"] = "100";
    				$return["message"] = "New Password and confirm password does not matched";
    				echo json_encode($return);
    				exit();
                }
            }
		}
		else
		{
			$return["status"] = "error";
			$return["status_code"] = "100";
			$return["message"] = "Mobile number does not exist...!";
			echo json_encode($return);
			exit();
		}
	}
	else
	{
		$return["status"] = "error";
		$return["status_code"] = "100";
		$return["message"] = 'Some Error Occured..Please try after some time..!';
		echo json_encode($return);
		exit();
	}
}
?>