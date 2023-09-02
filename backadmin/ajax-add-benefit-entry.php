<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if($admin == 1)
{
  if (isset($_POST['index_no']) && $_POST['index_no'] != '')
  {
      $index_no = $_POST['index_no'];
      $html_message = '';
      $html_message .= ' 
          <div  class="row" style=" margin-top:10px;" id="benefit_entry_div_'.$index_no .'">
              <div class="col-md-10" id="inputedu">
              <input type="hidden" name="old_benefit_entry_id_'.$index_no .'" id="old_benefit_entry_id_'.$index_no .'" value="">
                <label for="benefit" style="color:#000">Benefit : </label>
                <input type="text" id="benefit_'.$index_no .'" data-parsley-required="false" name="benefit_'.$index_no .'" placeholder="Enter benefit" class="form-control">
             </div>
             <div class="col-md-1"  id="addbotton">
                <a onclick="add_benefit_entry('.$index_no .')" style="cursor: pointer; float:left;">
                    <img src="'.$base_url_images.'plus.png" style="margin-top:32px;">
                </a> &nbsp;&nbsp;&nbsp;
                <a onclick="remove_benefit_entry('.$index_no .')" style="cursor: pointer;">
                    <img src="'.$base_url_images.'minus.png" style="margin-top:32px;">
                </a>
             </div>   
          </div>';
      $return["html_message"] = $html_message;
      $return["status"] = "success";
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
   echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.$base_url.'">';
}  
?>