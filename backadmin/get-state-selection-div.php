<?php
include "common/config.php";
header('Content-type: application/json');
/*include "common/check_login.php";
if($seller == 1)
{*/
if (isset($_POST))
{
    $form_id = $_POST['form_id'];

    $country_id = Secure1($db_mysqli, $_POST['country_id']);
    $get_state_query = "SELECT * from states WHERE country_id = $country_id";

    $result_get_state_query = mysqli_query($db_mysqli, $get_state_query);

    $all_state_data_array = array();
    while ($row_get_state_query = mysqli_fetch_assoc($result_get_state_query))
    {
        $all_state_data_array[] = $row_get_state_query;
    }

    $html_message = '';
    if (count($all_state_data_array) > 0)
    {


        $html_message = '
                          <div class="form-group">
                             <label>Select State:<span class="text-danger">*</span></label>
                             <select name="' . $form_id . '_state_id" id="' . $form_id . '_state_id" data-placeholder="Select State" class="select" data-parsley-required="true" onchange="get_city_selection(this.value,\'' . $form_id . '\');invalidate_parsley(this.id)">
                                <optgroup label="All State">
                                <option value="">Select State</option>';
        foreach ($all_state_data_array as $all_state_data)
        {
            $state_id = $all_state_data['id'];
            $state_name = stripslashes($all_state_data['state_name']);
            $html_message .= '
										<option  value="' . $state_id . '">' . $state_name . '</option>';
        }
        $html_message .= '</optgroup>
                             </select>
                          </div>
                       ';
    }
    $return["html_message"] = $html_message;
    $return["status"] = "success";
    echo json_encode($return);
}
else
{
    $return["status"] = "error";
    echo json_encode($return);
}
/*}
else
{
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=logout.php">';
}*/
?>