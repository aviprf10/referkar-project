<?php
include "common/config.php";
header('Content-type: application/json');
/*include "common/check_login.php";
if($seller == 1)
{*/
if (isset($_POST))
{

    $form_id = $_POST['form_id'];

    $state_id = Secure1($db_mysqli, $_POST['state_id']);
    $get_city_query = "SELECT * from cities WHERE state_id = $state_id";

    $result_get_city_query = mysqli_query($db_mysqli, $get_city_query);

    $all_city_data_array = array();
    while ($row_get_city_query = mysqli_fetch_assoc($result_get_city_query))
    {
        $all_city_data_array[] = $row_get_city_query;
    }


    $html_message = '';
    if (count($all_city_data_array) > 0)
    {
        $html_message = '
                          <div class="form-group">
                             <label>Select City:<span class="text-danger">*</span></label>
                             <select name="' . $form_id . '_city_id" id="' . $form_id . '_city_id" data-placeholder="Select City" class="select" onchange="invalidate_parsley(this.id)" data-parsley-required="true">
                                <optgroup label="All City">
                                <option value="">Select City</option>';
        foreach ($all_city_data_array as $all_city_data)
        {
            $city_id = $all_city_data['id'];
            $city_name = stripslashes($all_city_data['city_name']);
            $html_message .= '
										<option  value="' . $city_id . '">' . $city_name . '</option>';
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