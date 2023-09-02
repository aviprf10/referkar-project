<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1 || ($sub_admin == 1 && $is_country_write == 1))
{
    if (($_POST))
    {
//        $delete_id = Secure1($db_mysqli, $_POST['delete_id']);
        $delete_id_array = $_POST['delete_id_array'];
        if(is_array($delete_id_array))
        {
            $delete_id_list = implode(',',$delete_id_array);
        }
        else
        {
            $delete_id_list = $delete_id_array;
        }

        $all_country_data_array = array();
        $get_country_query = "select * from country where id IN ($delete_id_list) and is_deleted='0'";
        $result_get_country_query = mysqli_query($db_mysqli, $get_country_query);
        while ($row_get_country_query = mysqli_fetch_assoc($result_get_country_query))
        {
            $all_country_data_array[] = $row_get_country_query;
        }

        if (count($all_country_data_array) > 0)
        {
//            $update_country_query = "update country set is_deleted='1' where id IN ($delete_id_list)";
            $update_country_query = "UPDATE country
                                      LEFT JOIN states ON country.id = states.country_id
                                      LEFT JOIN cities ON states.id = cities.state_id
                                    SET country.is_deleted = 1, states.is_deleted = 1, cities.is_deleted = 1
                                    WHERE country.id IN ($delete_id_list)";
            $result_update_country_query = mysqli_query($db_mysqli, $update_country_query);
            if ($result_update_country_query)
            {
                $return["html_message"] = "Country Removed Successfully.";
                $return["status"] = "success";
                $return["update"] = 1;
                echo json_encode($return);
                exit();
            }
            else
            {
                $return["html_message"] = 'Some Error Occurred! Please try again.';
                $return["status"] = "error";
                echo json_encode($return);
                exit();
            }
        }
        else
        {
            $return["html_message"] = 'Country Does Not Exist.';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        }
    }
    else
    {
        $return["html_message"] = 'Some Error Occurred! Please try again.';
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