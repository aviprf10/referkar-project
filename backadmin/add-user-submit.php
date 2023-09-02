<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
    if ($_POST)
    {
        $user_type  = Secure1($db_mysqli, $_POST['user_type']);
        $first_name = Secure1($db_mysqli, $_POST['first_name']);
        $last_name  = Secure1($db_mysqli, $_POST['last_name']);
        $email      = Secure1($db_mysqli, $_POST['email']);
        $gender     = Secure1($db_mysqli, $_POST['gender']);
        $mobile     = Secure1($db_mysqli, $_POST['mobile']);
        $password   = md5(Secure1($db_mysqli, $_POST['password']));
        $adhaar_number   = Secure1($db_mysqli, $_POST['adhaar_number']);
        $pan_number   = Secure1($db_mysqli, $_POST['pan_number']);
        $department_id   = Secure1($db_mysqli, $_POST['department_id']);
        $designation_id   = Secure1($db_mysqli, $_POST['designation_id']);
        $perant_id       = Secure1($db_mysqli, $_POST['perant_id']);
        $country_id       = Secure1($db_mysqli, $_POST['country_id']);
        $state_id       = Secure1($db_mysqli, $_POST['state_id']);
        $city_id       = Secure1($db_mysqli, $_POST['city_id']);
        $area_id       = Secure1($db_mysqli, $_POST['area_id']);
        $pincode       = Secure1($db_mysqli, $_POST['pincode']);
        $address_1       = Secure1($db_mysqli, $_POST['address_1']);
        $user_name       = $first_name.' '. $last_name;
        $created_on   = get_current_date_time();

        if (isset($_POST['status']))
        {
            $status = 1;
        }
        else
        {
            $status = 0;
        }

        $check_user_email_data_array = array();
        $check_user_email_query = "select * from user where email='$email' and is_deleted='0'";
        $result_check_user_email_query = mysqli_query($db_mysqli, $check_user_email_query);
        while ($row_check_user_email_query = mysqli_fetch_assoc($result_check_user_email_query))
        {
            $check_user_email_data_array[] = $row_check_user_email_query;
        }

        if (count($check_user_email_data_array) > 0)
        {
            $return["html_message"] = 'Email Already Exist. Try Another!';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        }

        $check_user_mobile_data_array = array();
        $check_user_mobile_query = "select * from user where mobile='$mobile' and is_deleted='0'";
        $result_check_user_mobile_query = mysqli_query($db_mysqli, $check_user_mobile_query);
        while ($row_check_user_mobile_query = mysqli_fetch_assoc($result_check_user_mobile_query))
        {
            $check_user_mobile_data_array[] = $row_check_user_mobile_query;
        }

        if (count($check_user_mobile_data_array) > 0)
        {
            $return["html_message"] = 'Mobile Number Already Exist. Try Another!';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        }

        $user_unique_slug = '';
        $user_unique_slug = get_unique_slug1($db_mysqli, $user_name, 'user', 'user_name');
        $created_on = date("Y-m-d H:i:s");
        $unique_key = md5(uniqid(rand()));
        $ip_address = getUserIP();
        $mobile_verify     =  1;
        $email_verify      =  1;
        $usercode          = randomDigits(16); 
        $status            = 1;
           
        $insert_user_query = "insert into user (`usercode`,`first_name`, `last_name`,`user_name`,`user_unique_slug`, `email`,`password`,`gender`,`mobile`,`user_type`, `unique_key`,`ip_address`,`created_on`,`status` ,`mobile_verify`, `email_verify`, `registration_date`, `pan_number`, `adhaar_number`,`department_id`,`designation_id`, `perant_id`) values('$usercode','$first_name','$last_name','$user_name','$user_unique_slug','$email','$password','$gender','$mobile','$user_type','$unique_key','$ip_address','$created_on','$status', '$mobile_verify', '$email_verify', '$created_on', '$pan_number', '$adhaar_number', '$department_id', '$designation_id', '$perant_id')";
        $result_insert_user_query = mysqli_query($db_mysqli, $insert_user_query);

        if ($result_insert_user_query)
        {
            $user_id = mysqli_insert_id($db_mysqli);
            $insert_user_detail_query = "insert into user_details (user_id,address_1,pincode, country_id, state_id, city_id,  area_id,created_on, status, is_deleted) values('$user_id' ,'$address_1', '$pincode', '$country_id', '$state_id', '$city_id',  '$area_id', '$created_on', '1', '0')"; 
            $result_insert_user_detail_query = mysqli_query($db_mysqli, $insert_user_detail_query);

            $success_message = '';
            if($user_type == 1)
            {
                $success_message = 'Super Admin Added Successfully!';
            }
            elseif ($user_type == 2)
            {
                $success_message = 'BDM Added Successfully!';
            }
            elseif ($user_type == 3)
            {
                $success_message = 'Admin Added Successfully!';
            }
            elseif ($user_type == 4)
            {
                $success_message = 'Sub-Admin Added Successfully!';
            }
            elseif ($user_type == 5)
            {
                $success_message = 'Relationship Manager Added Successfully!';
            }
            elseif ($user_type == 6)
            {
                $success_message = 'Tele-Caller Added Successfully!';
            }
            elseif ($user_type == 7)
            {
                $success_message = 'Data collector Added Successfully!';
            }
            $return["html_message"] = $success_message;
            $return["status"] = "success";
            echo json_encode($return);
            exit();
        }
        else
        {
            $return["html_message"] = 'Some Error Occured While adding User address';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        }
//        }
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