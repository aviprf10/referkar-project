<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if($admin == 1)
{
   if(($_POST))
   {
      $delete_id = Secure1($db_mysqli,$_POST['delete_id']);

      $all_customer_feedback_data_array = array();
      $get_customer_feedback_query = "select * from customer_feedback where id='$delete_id' and is_deleted='0'";
      $result_get_customer_feedback_query = mysqli_query($db_mysqli,$get_customer_feedback_query);
      while ($row_get_customer_feedback_query = mysqli_fetch_assoc($result_get_customer_feedback_query))
      {
         $all_customer_feedback_data_array[] = $row_get_customer_feedback_query;
      }

      if(count($all_customer_feedback_data_array) > 0)
      {

         $update_customer_feedback_query = "update customer_feedback set is_deleted='1' where id='$delete_id'";
         $result_update_customer_feedback_query = mysqli_query($db_mysqli,$update_customer_feedback_query);
         if($result_update_customer_feedback_query)
         {
            $return["html_message"] = 'Customer Removed Successfully.';
            $return["status"] = "success";
            $return["update"] = 1;
            echo json_encode($return);
            exit();
         }
         else
         {
            $return["html_message"] = 'Some Error Occured! Please try again.';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
         }
      }
      else
      {
         $return["html_message"] = 'Customer Does Not Exist.';
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
}
else
{
   $return["html_message"] = 'Please login.';
   $return["status"] = "error";
   echo json_encode($return);
   exit();
}
?>