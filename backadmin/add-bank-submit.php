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
        $bank_name           = Secure1($db_mysqli, $_POST['bank_name']);
        $created_on = get_current_date_time();
        if (isset($_POST['status']))
        {
            $status = 1;
        }
        else
        {
            $status = 0;
        }

        
        $get_bank_title_query = "select * from bank where bank_name='$bank_name' and is_deleted='0'";
        $result_get_bank_title_query = mysqli_query($db_mysqli, $get_bank_title_query);
        while ($row_get_bank_title_query = mysqli_fetch_assoc($result_get_bank_title_query))
        {
            $check_bank_title_data_array[] = $row_get_bank_title_query;
        }
        
        if (!empty($check_bank_title_data_array))
        {
            $return["html_message"] = 'Bank already exist. Try Another!';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        }
        
         $insert_bank_query = "INSERT INTO bank (bank_name, created_on, status, is_deleted) 
        VALUES ('$bank_name','$created_on','$status', '0')";
        $result_insert_bank_query = mysqli_query($db_mysqli, $insert_bank_query);

        if ($result_insert_bank_query)
        {
            $return["html_message"] = 'Bank added successfully.';
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