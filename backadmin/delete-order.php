<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if($admin == 1)
{
   if(($_POST))
   {
      $delete_id = Secure1($db_mysqli,$_POST['delete_id']);

      $all_user_order_data_array = array();
      $get_user_order_query = "select * from user_order where id='$delete_id' and is_deleted='0'";
      $result_get_user_order_query = mysqli_query($db_mysqli,$get_user_order_query);
      while ($row_get_user_order_query = mysqli_fetch_assoc($result_get_user_order_query))
      {
         $all_user_order_data_array[] = $row_get_user_order_query;
      }

      $order_id = $all_user_order_data_array[0]['order_id'];
      if(count($all_user_order_data_array) > 0)
      {

         $update_user_order_query = "update user_order set order_status='8' where order_id='$order_id'";
         $result_update_user_order_query = mysqli_query($db_mysqli,$update_user_order_query);
         if($result_update_user_order_query)
         {
            $return["html_message"] = 'Order Rejected Successfully.';
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
         $return["html_message"] = 'user_order Does Not Exist.';
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