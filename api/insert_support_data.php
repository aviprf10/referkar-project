<?php
include('common/config.php');
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	
	$nametext = '';
	$emailtext = '';
	$mobile = '';
	$subjecttext = '';
	$message_text = '';

	$nametext =  Secure1($db_mysqli,$_POST['nametext']);
	$emailtext =  Secure1($db_mysqli,$_POST['emailtext']);
	$mobile =  Secure1($db_mysqli,$_POST['mobile']);
	$subjecttext =  Secure1($db_mysqli,$_POST['subjecttext']);
	$message_text =  Secure1($db_mysqli,$_POST['message_text']);
	
	
	if(($nametext != '') && ($emailtext != '') && ($mobile != '') && ($subjecttext != '') && ($message_text != ''))
	{
		$created_on= date("Y-m-d H:i:s");

		$insert_contact_inquiry_query = "INSERT INTO support_inquiry (name, email, mobile, subject, message, created_on, status, is_deleted) VALUES ('$nametext','$emailtext', '$mobile', '$subjecttext', '$message_text','$created_on','1', '0');";
    	$result_insert_contact_inquiry_query = mysqli_query($db_mysqli, $insert_contact_inquiry_query);
		if($result_insert_contact_inquiry_query)    
		{
			
            $return["message"] = 'Inquiry Submitted Successfully.';
            $return["status"] = "success";
            $return["status_code"] = 200;
            echo json_encode($return);
            exit();
        	
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
	   $return["message"] = 'Some Error Occured! Please try after some time.';
	   $return["status"] = "error";
	   $return["status_code"] = 100;
	   echo json_encode($return);
	   exit();
	}
}
?>