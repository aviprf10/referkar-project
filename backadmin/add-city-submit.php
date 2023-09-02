<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1 || ($sub_admin == 1 && $is_city_write == 1))
{
    if ($_POST)
    {
        $city_title = Secure1($db_mysqli, $_POST['city_title']);
        $state_id = Secure1($db_mysqli, $_POST['state_id']);
//        $country_id = Secure1($db_mysqli, $_POST['country_id']);

        if (isset($_POST['status']))
        {
            $status = 1;
        }
        else
        {
            $status = 0;
        }

        $all_city_data_array = array();
        $get_city_query = "select * from cities where state_id='$state_id' AND city_name='$city_title' and is_deleted='0'";
        $result_get_city_query = mysqli_query($db_mysqli, $get_city_query);
        while ($row_get_city_query = mysqli_fetch_assoc($result_get_city_query))
        {
            $all_city_data_array[] = $row_get_city_query;
        }

        if (!empty($all_city_data_array))
        {
            $return["html_message"] = 'City Already Exist. Try Another!';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        }
        else
        {

            $insert_city_query = "INSERT INTO cities (city_name,state_id,status, is_deleted) VALUES ('$city_title','$state_id', '$status', 0);";
            $result_insert_city_query = mysqli_query($db_mysqli, $insert_city_query);

            if ($result_insert_city_query)
            {
                $return["html_message"] = 'City Added Successfully.';
                $return["status"] = "success";
                echo json_encode($return);
                exit();
            }
            else
            {
                $return["html_message"] = 'Some Error Occured While adding City';
                $return["status"] = "error";
                echo json_encode($return);
                exit();
            }
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
    $return["html_message"] = 'Please login.';
    $return["status"] = "error";
    echo json_encode($return);
    exit();
}
?>