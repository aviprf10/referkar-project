<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1 || ($sub_admin == 1 && $is_menu_write == 1)) {
    if ($_POST) {
        $menu_name = Secure1($db_mysqli, $_POST['menu_name']);
        $area_id = Secure1($db_mysqli, $_POST['area_id']);
        $price = Secure1($db_mysqli, $_POST['price']);
        $created_on = get_current_date_time();
        if (isset($_POST['status'])) {
            $status = 1;
        } else {
            $status = 0;
        }

        $all_menu_data_array = array();
        $get_menu_query = "select * from menu where menu_name='$menu_name' and area_id='$area_id' and is_deleted='0'";
        $result_get_menu_query = mysqli_query($db_mysqli, $get_menu_query);
        while ($row_get_menu_query = mysqli_fetch_assoc($result_get_menu_query)) {
            $all_menu_data_array[] = $row_get_menu_query;
        }

        if (!empty($all_menu_data_array)) {
            $return["html_message"] = 'Menu Already Exist. Try Another!';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        } else {

            $insert_menu_query = "INSERT INTO menu (menu_name,area_id,price,created_on,status) VALUES ('$menu_name','$area_id', '$price','$created_on','$status');";
            $result_insert_menu_query = mysqli_query($db_mysqli, $insert_menu_query);

            if ($result_insert_menu_query) {
                $return["html_message"] = 'Menu Added Successfully.';
                $return["status"] = "success";
                echo json_encode($return);
                exit();
            } else {
                $return["html_message"] = 'Some Error Occured While adding menu';
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