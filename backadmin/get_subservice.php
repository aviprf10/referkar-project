<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
    if ($_POST)
    {
        $service_id = Secure1($db_mysqli, $_POST['service_id']);
        
        $get_sub_service_query = "SELECT * from sub_service WHERE service_id = $service_id and is_deleted=0";

        $result_get_sub_service_query = mysqli_query($db_mysqli, $get_sub_service_query);

        $all_sub_service_data_array = array();
        while ($row_get_sub_service_query = mysqli_fetch_assoc($result_get_sub_service_query))
        {
            $all_sub_service_data_array[] = $row_get_sub_service_query;
        }

        $html_message = ' <div class="form-group">
            <label>Select Sub Service : <span class="text-danger">*</span></label>
                <select class="select-search form-control" id="sub_service_id" name="sub_service_id[]" multiple="multiple" data-placeholder="Select a Sub service..." >
                    <option></option>';
        foreach ($all_sub_service_data_array as $all_sub_service_data)
        {
            $html_message .= '<option value="' . $all_sub_service_data['id'] . '">' . $all_sub_service_data['sub_service_name'] . '</option>';
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