<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1 || ($sub_admin == 1 && $is_area_write == 1)) {
    if ($_POST) {
        $name = Secure1($db_mysqli, $_POST['name']);
        $city_id = Secure1($db_mysqli, $_POST['city_id']);
        $pincode = Secure1($db_mysqli, $_POST['pincode']);
        $created_on = get_current_date_time();
        if (isset($_POST['status'])) {
            $status = 1;
        } else {
            $status = 0;
        }

        $all_area_data_array = array();
        $get_area_query = "select * from area where name='$name' and is_deleted='0'";
        $result_get_area_query = mysqli_query($db_mysqli, $get_area_query);
        while ($row_get_area_query = mysqli_fetch_assoc($result_get_area_query)) {
            $all_area_data_array[] = $row_get_area_query;
        }

        if (!empty($all_area_data_array)) {
            $return["html_message"] = 'Area Already Exist. Try Another!';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        } else {

            $insert_area_query = "INSERT INTO area (name,city_id,pincode,created_on,status) VALUES ('$name','$city_id', '$pincode','$created_on','$status');";
            $result_insert_area_query = mysqli_query($db_mysqli, $insert_area_query);

            if ($result_insert_area_query) {
                $return["html_message"] = 'Area Added Successfully.';
                $return["status"] = "success";
                echo json_encode($return);
                exit();
            } else {
                $return["html_message"] = 'Some Error Occured While adding Area';
                $return["status"] = "error";
                echo json_encode($return);
                exit();
            }
        }
    } else {
        $return["html_message"] = 'Some Error Occured! Please try again.';
        $return["status"] = "error";
        echo json_encode($return);
        exit();
    }
} else {
    $return["html_message"] = 'Please login.';
    $return["status"] = "error";
    echo json_encode($return);
    exit();
}
?>