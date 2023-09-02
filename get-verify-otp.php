<?php
include "common/config.php";
header('Content-type: application/json');

	if($_POST)
	{
		$mobile = Secure1($db_mysqli,$_POST['mobile']);
		$email = Secure1($db_mysqli,$_POST['email']);
		$input_otp=Secure1($db_mysqli,$_POST['input_otp']);
		$all_user_data_array = array();
      	$get_user_query = "select * from  loan_inquery where  mobile='$mobile' or email='$email' and is_deleted = 0";
     	$result_get_user_query = mysqli_query($db_mysqli, $get_user_query);
      	while ($row_get_user_query = mysqli_fetch_assoc($result_get_user_query))
      	{
         	$all_user_data_array[] = $row_get_user_query;
      	}
      	if($input_otp == '')
      	{
      		$return["html_message"] = 'Please enter OTP.';
			$return["status"] = "error";
			echo json_encode($return);
			exit();
      	}	
      	if(isset($all_user_data_array) && count($all_user_data_array)==0)
      	{

			if($mobile==$_SESSION['mobile_'.$company_name_session])
			{	
				//print_r($_SESSION['temp_otp_'.$company_name_session]); exit;
				$current_time_stamp = time();
			    $temp_otp_time_stamp = $_SESSION['temp_otp_time_stamp_'.$company_name_session];
				$difference_in_timestamp = $current_time_stamp - $temp_otp_time_stamp;
				
				if($input_otp==$_SESSION['temp_otp_'.$company_name_session] && $difference_in_timestamp > 1800)
				{ 
					$return["html_message"] = 'OTP is Expired. Please click on Resend OTP button for new OTP';
					$return["status"] = "error";
					$return["mobile_verification_status"] = "Not Verified";
					echo json_encode($return);
					exit();
				}
				else
				{	
					if($input_otp==$_SESSION['otp_'.$company_name_session])
					{
						$_SESSION['otp_verify_status_'.$company_name_session]="1";
						$return["html_message"] = 'Mobile Number Verified Successfully!';
						$return["status"] = "success";
						$return["mobile_verification_status"] = "<i class='fa fa-check' aria-hidden='true' style='margin-top: 23px; margin-left: 10px;'></i> Verified";
						echo json_encode($return);
						exit();
					}
					else
					{
						$return["html_message"] = 'OTP is not matched';
						$return["status"] = "error";
						$return["mobile_verification_status"] = "Not Verified";
						echo json_encode($return);
						exit();
					}
				}
			}
			else
			{
			$return["html_message"] = 'You may be Changed Mobile Number';
			$return["status"] = "error";
			$return["mobile_verification_status"] = "Not Verified";
			echo json_encode($return);
			exit();
			}
		}
		else
	    {
	        
            $return["html_message"] = ' Mobile number already exists..! Try Another.';
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


?>