<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if($_POST) 
{
	$mobile = Secure1($db_mysqli,$_POST['mobile']);
	$email = Secure1($db_mysqli,$_POST['email']);
	$all_user_data_array = array();
    
    if ($email == '')
    {
         $return["html_message"] = ' Email id required';
         $return["status"] = "error";
         echo json_encode($return);
         exit();
    }

    $get_user_query = "select * from  loan_inquery where  mobile='$mobile' or email='$email' and is_deleted = 0";
    $result_get_user_query = mysqli_query($db_mysqli,$get_user_query) or die(mysqli_error($db_mysqli));
    while ($row_get_user_query = mysqli_fetch_assoc($result_get_user_query))
    {
        $all_user_data_array[] = $row_get_user_query;
    }

    if(count($all_user_data_array)>0)
    { 
       
        if ($all_user_data_array[0]['mobile'] == $mobile)
        {
             $return["html_message"] = ' Mobile number already Verfied! Please submit all details';
             $return["status"] = "error";
             echo json_encode($return);
             exit();
        }
    }
    else
    {
    	$digits = 4;
        $generate_otp = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
		$_SESSION['mobile_'.$company_name_session] = $mobile;
		$_SESSION['otp_'.$company_name_session] = $generate_otp;
		$_SESSION['temp_otp_'.$company_name_session] = $generate_otp;
		$_SESSION['temp_otp_time_stamp_'.$company_name_session] = time();
		$_SESSION['otp_verify_status_'.$company_name_session]="0";
		
		// $otp_array = array();
		// $otp_array['mobile_no'] = $mobile;
		// $otp_array['mobile_otp'] = $generate_otp;
		// $otp_array['sms_type'] = 0;
		// $mobile_otp_status = send_sms($otp_array);

		$email_array = array();
		$email_array['email'] = $email;
		$email_array['user_name'] = 'user';
		$email_array['email_type'] = '1';
		$email_array['mobile'] = $mobile;
		$email_array['generate_otp'] = $generate_otp;
		$email_sent_response = send_email($email_array);

		if($email_sent_response)
		{
		    $return["html_message"] = 'OTP has been sent to your email id';
			$return["status"] = "success";
			echo json_encode($return);
			exit();
		}
		else
		{
			$return["html_message"] = 'Error sending email OTP. Please try again.'; 
			$return["status"] = "error";
			echo json_encode($return);
			exit();
		}
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