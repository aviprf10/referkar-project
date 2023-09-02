<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($_POST)
{
   
    $disclaimer = 0;
    if(isset($_POST['disclaimer']))
    {
        $disclaimer = Secure1($db_mysqli, $_POST['disclaimer']);
    }    
    
    if($disclaimer == 0)
    {
        $return["html_message"] = 'Please checked Disclaimer checkbox';
        $return["status"] = "error";
        echo json_encode($return);
        exit();
    }

    $name = Secure1($db_mysqli, $_POST['name']);
    $email = Secure1($db_mysqli, $_POST['email']);
    $mobile = Secure1($db_mysqli, $_POST['mobile']);
    $refer_name = Secure1($db_mysqli, $_POST['refer_name']);
    $refer_email = Secure1($db_mysqli, $_POST['refer_email']);
    $refer_mobile = Secure1($db_mysqli, $_POST['refer_mobile']);
    $loan_type = Secure1($db_mysqli, $_POST['loan_type']);
    $loan_amount = Secure1($db_mysqli, $_POST['loan_amount']);
    $mobile_otp = Secure1($db_mysqli,ucfirst($_POST['input_otp']));
    $mobile_verify = 1;
    $email_verify = 1;
    $created_on = get_current_date_time();
    $unique_key=random_six_digit_integer();

    $get_user_query = "select * from  loan_inquery where  mobile='$mobile' or email='$email' and is_deleted = 0";
    $result_get_user_query = mysqli_query($db_mysqli,$get_user_query) or die(mysqli_error($db_mysqli));
    while ($row_get_user_query = mysqli_fetch_assoc($result_get_user_query))
    {
        $all_user_data_array[] = $row_get_user_query;
    }
    
    

    if(!empty($all_user_data_array))
    {
        
        //$insert_loan_inquiry_query = "INSERT INTO loan_inquery (loan_uniquie_key, name, email, mobile, refer_name, refer_email, refer_mobile, loan_type, loan_amount,mobile_otp, mobile_otp_date_time,mobile_verify,email_verify,created_on,status,is_deleted,loan_status)VALUES ('$unique_key','$name','$email', '$mobile', '$refer_name', '$refer_email', '$refer_mobile', '$loan_type', '$loan_amount', '0000','$created_on','$mobile_verify', '$email_verify','$created_on','1', '0','0');";
        //$result_insert_loan_inquiry_query = mysqli_query($db_mysqli, $insert_loan_inquiry_query);

        $result_insert_loan_inquiry_query=1;
        if ($result_insert_loan_inquiry_query)
        {

            $email_array = array();
            $email_array['loan_uniquie_key'] = $unique_key;
            $email_array['email'] = $email;
            $email_array['name'] = $name;
            $email_array['mobile'] = $mobile;
            $email_array['refer_name'] = $refer_name;
            $email_array['refer_email'] = $refer_email;
            $email_array['refer_mobile'] = $refer_mobile;
            $email_array['email_type'] = 3;
            $email_sent_response = send_email($email_array);

            
            $email_array1 = array();
            $email_array1['loan_uniquie_key'] = $unique_key;
            $email_array1['email'] = "admin@referkar.com";
            $email_array1['temail'] = $email;
            $email_array1['name'] = $name;
            $email_array1['mobile'] = $mobile;
            $email_array1['refer_name'] = $refer_name;
            $email_array1['refer_email'] = $refer_email;
            $email_array1['refer_mobile'] = $refer_mobile;
            $email_array1['email_type'] = 4;
            $email_sent_response1 = send_email($email_array1);

            $email_array2 = array();
            $email_array2['loan_uniquie_key'] = $unique_key;
            $email_array2['email'] = "finance@referkar.com";
            $email_array2['temail'] = $email;
            $email_array2['name'] = $name;
            $email_array2['mobile'] = $mobile;
            $email_array2['refer_name'] = $refer_name;
            $email_array2['refer_email'] = $refer_email;
            $email_array2['refer_mobile'] = $refer_mobile;
            $email_array2['email_type'] = 5;
            $email_sent_response2 = send_email($email_array2);

            $email_array3 = array();
            $email_array3['loan_uniquie_key'] = $unique_key;
            $email_array3['email'] = "referkarinfo@gmail.com";
            $email_array3['name'] = $name;
            $email_array3['temail'] = $email;
            $email_array3['mobile'] = $mobile;
            $email_array3['refer_name'] = $refer_name;
            $email_array3['refer_email'] = $refer_email;
            $email_array3['refer_mobile'] = $refer_mobile;
            $email_array3['email_type'] = 6;
            $email_sent_response3 = send_email($email_array3);



            $return["html_message"] = 'Inquiry Send Successfully! i will get back touch you.';
            $return["status"] = "success";
            echo json_encode($return);
            exit();
        }
        else
        {
            $return["html_message"] = 'Some Error Occured While adding Inquiry';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        } 
    }    
    else 
    {
        
        if($_SESSION['otp_verify_status_'.$company_name_session] == 1)
        {
        
            if($mobile_otp == '')
            {
                $return["html_message"] = 'Enter your OTP.';
                $return["status"] = "error";
                echo json_encode($return);
                exit();
            }

            $insert_loan_inquiry_query = "INSERT INTO loan_inquery (loan_uniquie_key, name, email, mobile, refer_name, refer_email, refer_mobile, loan_type, loan_amount,mobile_otp, mobile_otp_date_time,mobile_verify,email_verify,created_on,status,is_deleted,loan_status)VALUES ('$unique_key','$name','$email', '$mobile', '$refer_name', '$refer_email', '$refer_mobile', '$loan_type', '$loan_amount', '$mobile_otp','$created_on','$mobile_verify', '$email_verify','$created_on','1', '0','0');";
            $result_insert_loan_inquiry_query = mysqli_query($db_mysqli, $insert_loan_inquiry_query);

            if ($result_insert_loan_inquiry_query)
            {
                $return["html_message"] = 'Inquiry Send Successfully! i will get back touch you.';
                $return["status"] = "success";
                echo json_encode($return);
                exit();
            }
            else
            {
                $return["html_message"] = 'Some Error Occured While adding Inquiry';
                $return["status"] = "error";
                echo json_encode($return);
                exit();
            } 
        }     
        else
        {
            $return["html_message"] = 'Please Verified mobile number.';
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