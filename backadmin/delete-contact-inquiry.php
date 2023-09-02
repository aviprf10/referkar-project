<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if($admin == 1)
{
   if(($_POST))
   {
      $delete_id = Secure1($db_mysqli,$_POST['delete_id']);

      $all_contact_inquiry_data_array = array();
      $get_contact_inquiry_query = "select * from contact_inquiry where id='$delete_id' and is_deleted='0'";
      $result_get_contact_inquiry_query = mysqli_query($db_mysqli,$get_contact_inquiry_query);
      while ($row_get_contact_inquiry_query = mysqli_fetch_assoc($result_get_contact_inquiry_query))
      {
         $all_contact_inquiry_data_array[] = $row_get_contact_inquiry_query;
      }

      if(count($all_contact_inquiry_data_array) > 0)
      {

         $update_contact_inquiry_query = "update contact_inquiry set is_deleted='1' where id='$delete_id'";
         $result_update_contact_inquiry_query = mysqli_query($db_mysqli,$update_contact_inquiry_query);
         if($result_update_contact_inquiry_query)
         {
            $return["html_message"] = 'Inquiry Removed Successfully.';
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
         $return["html_message"] = 'inquiry Does Not Exist.';
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