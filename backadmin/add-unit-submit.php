<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
    if (isset($_POST))
    {
//        print_r( $_POST);
//        exit();
        $unit_name       = Secure1($db_mysqli, $_POST['unit_name']);
        if (isset($_POST['status']))
        {
            $status = 1;
        }
        else
        {
            $status = 0;
        }

        
        $get_unit_title_query = "select * from unit_type where unit_name='$unit_name' and is_deleted='0'";
        $result_get_unit_title_query = mysqli_query($db_mysqli, $get_unit_title_query);
        while ($row_get_unit_title_query = mysqli_fetch_assoc($result_get_unit_title_query))
        {
            $check_unit_title_data_array[] = $row_get_unit_title_query;
        }
        
        if (!empty($check_unit_title_data_array))
        {
            $return["html_message"] = 'unit title already exist. Try Another!';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        }
        
        $insert_unit_query = "INSERT INTO unit_type (unit_name, status, is_deleted) 
        VALUES ('$unit_name','$status', '0')";
        $result_insert_unit_query = mysqli_query($db_mysqli, $insert_unit_query);

        if ($result_insert_unit_query)
        {
            $return["html_message"] = 'unit added successfully.';
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
        $return["html_message"] = 'Some Error Occured! Please try again.';
        $return["status"] = "error";
        echo json_encode($return);
        exit();
    }
}
else
{
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'logout">';
}
?>