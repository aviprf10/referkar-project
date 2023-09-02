<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($_POST)
{
   
    $name = Secure1($db_mysqli, $_POST['nametext']);
    $email = Secure1($db_mysqli, $_POST['emailtext']);
    $mobile = Secure1($db_mysqli, $_POST['mobile']);
    $subject = Secure1($db_mysqli, $_POST['subjecttext']);
    $description = Secure1($db_mysqli, $_POST['message_text']);
    $created_on = get_current_date_time();
    

    $insert_contact_inquiry_query = "INSERT INTO support_inquiry (name, email, mobile, subject, message, created_on, status, is_deleted) VALUES ('$name','$email', '$mobile', '$subject', '$description','$created_on','1', '0');";
    $result_insert_contact_inquiry_query = mysqli_query($db_mysqli, $insert_contact_inquiry_query);

    if ($result_insert_contact_inquiry_query)
    {
        $return["html_message"] = 'Inquiry Send Successfully.';
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
    $return["html_message"] = 'Some Error Occured! Please try again.';
    $return["status"] = "error";
    echo json_encode($return);
    exit();
}
?>