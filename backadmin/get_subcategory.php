<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
    if ($_POST)
    {
        $category_id = Secure1($db_mysqli, $_POST['category_id']);
        
        $get_sub_category_query = "SELECT * from sub_category WHERE category_id = $category_id and is_deleted=0";

        $result_get_sub_category_query = mysqli_query($db_mysqli, $get_sub_category_query);

        $all_sub_category_data_array = array();
        while ($row_get_sub_category_query = mysqli_fetch_assoc($result_get_sub_category_query))
        {
            $all_sub_category_data_array[] = $row_get_sub_category_query;
        }

        $html_message = ' <div class="form-group">
            <label>Select Sub Category : <span class="text-danger">*</span></label>
                <select class="select-search form-control" id="sub_category_id" name="sub_category_id[]" multiple="multiple" data-placeholder="Select a Sub Category..." >
                    <option></option>';
        foreach ($all_sub_category_data_array as $all_sub_category_data)
        {
            $html_message .= '<option value="' . $all_sub_category_data['id'] . '">' . $all_sub_category_data['sub_category_name'] . '</option>';
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