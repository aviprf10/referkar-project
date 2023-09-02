<?php
include('common/config.php');
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$mobile    = Secure1($db_mysqli,$_POST['mobile']);
	$email 	   = Secure1($db_mysqli,$_POST['emailtext']);
	$input_otp = Secure1($db_mysqli,$_POST['input_otp']);
	$all_user_data_array = array();
  	$get_user_query = "select * from  loan_inquery where  mobile='$mobile' or email='$email' and is_deleted = 0";
 	$result_get_user_query = mysqli_query($db_mysqli, $get_user_query);
  	while ($row_get_user_query = mysqli_fetch_assoc($result_get_user_query))
  	{
     	$all_user_data_array[] = $row_get_user_query;
  	}
  	if($input_otp == '')
  	{
  		$return["status"] = "error";
		$return["status_code"] = 100;
		$return["message"] = "Please enter OTP.";
		echo json_encode($return);
		exit();
  	}	
  	if(isset($all_user_data_array) && count($all_user_data_array)==0)
  	{
		$return["status"] = "success";
		$return["status_code"] = 200;
		echo json_encode($return);
		exit();
	}
	else
    {
        
        $return["message"] = ' Mobile number already exists..! Try Another.';
        $return["status_code"] = 100;
        $return["status"] = "error";
        echo json_encode($return);
        exit();
        
    }
}
else 
{
	$return["message"] = 'Some Error Occured! Please try again.';
	$return["status_code"] = 100;
	$return["status"] = "error";
	echo json_encode($return);
	exit();
}


?>