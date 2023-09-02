<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if($admin == 1)
{
   if(($_POST))
   {
      $delete_id = Secure1($db_mysqli,$_POST['delete_id']);

      $all_category_data_array = array();
      $get_category_query = "select * from category where id='$delete_id' and is_deleted='0'";
      $result_get_category_query = mysqli_query($db_mysqli,$get_category_query);
      while ($row_get_category_query = mysqli_fetch_assoc($result_get_category_query))
      {
         $all_category_data_array[] = $row_get_category_query;
      }

      if(count($all_category_data_array) > 0)
      {

         $update_category_query = "update category set is_deleted='1' where id='$delete_id'";
         $result_update_category_query = mysqli_query($db_mysqli,$update_category_query);
         if($result_update_category_query)
         {
            $return["html_message"] = 'Category Removed Successfully.';
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
         $return["html_message"] = 'Category Does Not Exist.';
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