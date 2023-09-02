<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1 || ($sub_admin == 1 && $is_state_write == 1))
{
    if ($_POST)
    {
        $country_id = Secure1($db_mysqli, $_POST['country_id']);
        $edit_flag = isset($_POST['edit_flag']) ? Secure1($db_mysqli, $_POST['edit_flag']) : 0;

        $get_state_query = "SELECT * from states WHERE country_id = $country_id";

        $result_get_state_query = mysqli_query($db_mysqli, $get_state_query);

        $all_state_data_array = array();
        while ($row_get_state_query = mysqli_fetch_assoc($result_get_state_query))
        {
            $all_state_data_array[] = $row_get_state_query;
        }

        $html_message = ' <div class="form-group">
            <label>Select State : <span class="text-danger">*</span></label>
                <select class="select-search form-control" id="state_id" name="state_id" data-placeholder="Select a State..." onchange="get_city(this.value);">
                    <option></option>';
        foreach ($all_state_data_array as $all_state_data)
        {
            $html_message .= '<option value="' . $all_state_data['id'] . '">' . $all_state_data['state_name'] . '</option>';
        }

        $html_message .= '
                 </select>
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
    $return["html_message"] = 'Please login.';
    $return["status"] = "error";
    echo json_encode($return);
    exit();
}
?>