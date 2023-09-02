<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1 || ($sub_admin == 1 && $is_city_write == 1))
{
    if ($_POST)
    {
        $state_id = Secure1($db_mysqli, $_POST['state_id']);
        $get_city_query = "SELECT * from cities WHERE state_id = $state_id";

        $result_get_city_query = mysqli_query($db_mysqli, $get_city_query);

        $all_city_data_array = array();
        while ($row_get_city_query = mysqli_fetch_assoc($result_get_city_query))
        {
            $all_city_data_array[] = $row_get_city_query;
        }


        $html_message = ' <div class="form-group">
            <label>Select City : <span class="text-danger">*</span></label>
                <select class="select form-control" id="city_id" name="city_id" data-parsley-required="true" data-placeholder="Select a City...">
                <option></option>';

        foreach ($all_city_data_array as $all_city_data)
        {
            $html_message .= '<option value="' . $all_city_data['id'] . '">' . $all_city_data['city_name'] . '</option>';
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