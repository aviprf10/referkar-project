<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($_POST)
{ 
   
    $name = Secure1($db_mysqli, $_POST['textname']);
    $email = Secure1($db_mysqli, $_POST['textemail']);
    $message = Secure1($db_mysqli, $_POST['textmessage']);
    $rating_stars = Secure1($db_mysqli, $_POST['rating_stars']);
    $created_on = get_current_date_time();
    

    $insert_comment_query = "INSERT INTO blog_comment(name, email, message, rating_stars,created_on, status, is_deleted) VALUES ('$name','$email', '$message', '$rating_stars', '$created_on','1', '0');";
    $result_insert_comment_query = mysqli_query($db_mysqli, $insert_comment_query);

    if ($result_insert_comment_query)
    {
        $return["html_message"] = 'Comment Added Successfully.';
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