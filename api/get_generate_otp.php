<?php
include('common/config.php');
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$mobile = Secure1($db_mysqli,$_POST['mobile']);
	$email = Secure1($db_mysqli,$_POST['emailtext']);
	$all_user_data_array = array();
    
    
    if ($email == '' && $email == null || $email == 'null' || $email == NULL)
    {
        $return["status"] = "error";
		$return["status_code"] = 100;
		$return["message"] = "Email id required.";
		echo json_encode($return);
		exit();
    }

    if ($mobile == '' && $mobile == null || $mobile == 'null' || $mobile == NULL)
    {
        $return["status"] = "error";
		$return["status_code"] = 100;
		$return["message"] = "Mobile required.";
		echo json_encode($return);
		exit();
    }

    

	if(!email_validation($email)) {
	    $return["status"] = "error";
		$return["status_code"] = 100;
		$return["message"] = "Email not valid please try an other.";
		echo json_encode($return);
		exit();
	}

	
	if(!preg_match("/^[7-9]{1}[0-9]{9}$/i", $mobile) ) { 
		$return["status"] = "error";
		$return["status_code"] = 100;
		$return["message"] = "Mobile not valid please try an other.";
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
            
            $return["status"] = "error";
			$return["status_code"] = 100;
			$return["message"] = "Mobile number already Verfied! Please submit all details.";
			echo json_encode($return);
			exit();
        }
    }
    else
    {
    	
    	$digits = 4;
        $generate_otp = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
		
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
		    $return["message"] = 'OTP has been sent to your email id';
            $return["status"] = "success";
            $return['otp'] = $generate_otp;
            $return['temp_otp'] = $generate_otp;
            $return['temp_otp_time_stamp'] = time();
            $return['otp_verify_status'] = 0;
            $return["status_code"] = 200;
            echo json_encode($return);
            exit();
		}
		else
		{
			$return["message"] = 'Error sending email OTP. Please try again.';
            $return["status"] = "error";
            $return["status_code"] = 100;
            echo json_encode($return);
            exit();
		}
    }
}
else 
{
	$return["message"] = 'Some Error Occured! Please try again.';
    $return["status"] = "error";
    $return["status_code"] = 100;
    echo json_encode($return);
    exit();
}
?>