<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1 || ($sub_admin == 1 && $is_state_write == 1)) {
    if ($_POST) {
        $state_title = Secure1($db_mysqli, $_POST['title']);
        $country_id = Secure1($db_mysqli, $_POST['country_id']);

        if (isset($_POST['status'])) {
            $status = 1;
        } else {
            $status = 0;
        }

        $all_state_data_array = array();
        $get_state_query = "select * from states where state_name='$state_title' and is_deleted='0'";
        $result_get_state_query = mysqli_query($db_mysqli, $get_state_query);
        while ($row_get_state_query = mysqli_fetch_assoc($result_get_state_query)) {
            $all_state_data_array[] = $row_get_state_query;
        }

        if (!empty($all_state_data_array)) {
            $return["html_message"] = 'State Already Exist. Try Another!';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        } else {

            $insert_state_query = "INSERT INTO states (state_name,country_id,status, is_deleted) VALUES ('$state_title',$country_id, $status, 0);";
            $result_insert_state_query = mysqli_query($db_mysqli, $insert_state_query);

            if ($result_insert_state_query) {
                $return["html_message"] = 'State Added Successfully.';
                $return["status"] = "success";
                echo json_encode($return);
                exit();
            } else {
                $return["html_message"] = 'Some Error Occured While adding State';
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