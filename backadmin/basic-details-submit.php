<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
    if (isset($_POST))
    {

        $edit_id = Secure1($db_mysqli, $_POST['edit_user_id']);
        //$edit_user_unique_slug = Secure1($db_mysqli, $_POST['edit_user_unique_slug']);

        $first_name = Secure1($db_mysqli, $_POST['first_name']);
        $last_name = Secure1($db_mysqli, $_POST['last_name']);
        $user_name = $first_name . ' ' . $last_name;
        $user_unique_slug = get_unique_slug_edit1($db_mysqli, $user_name, 'user', 'user_unique_slug', $edit_id);
        $email = Secure1($db_mysqli, $_POST['email']);
        $mobile = Secure1($db_mysqli, $_POST['mobile']);
        $modified_on = get_current_date_time();
        

        $get_user_email_query = "SELECT * FROM user WHERE email='$email' AND id!='$loggedin_user_id'";
        $result_get_user_email_query = mysqli_query($db_mysqli, $get_user_email_query);
        $all_user_email_data_array = array();
        while ($row_get_user_email_query = mysqli_fetch_assoc($result_get_user_email_query))
        {
            $all_user_email_data_array[] = $row_get_user_email_query;
        }


        if (count($all_user_email_data_array) > 0)
        {
            $return["html_message"] = 'User Already Exists With This Email id..!';
            $return["status"] = "error";
            echo json_encode($return);
        }
        else
        {
            $get_user_mobile_query = "SELECT * FROM user WHERE mobile='$mobile' AND id!='$loggedin_user_id'";

            $result_get_user_mobile_query = mysqli_query($db_mysqli, $get_user_mobile_query);
            $all_user_mobile_data_array = array();
            while ($row_get_user_mobile_query = mysqli_fetch_assoc($result_get_user_mobile_query))
            {
                $all_user_mobile_data_array[] = $row_get_user_mobile_query;
            }

            if (count($all_user_mobile_data_array) > 0)
            {
                $return["html_message"] = 'Mobile No. Already Exists..!Try Another.';
                $return["status"] = "error";
                echo json_encode($return);
            }
            else
            {
                $update_user_query = "update user set first_name='$first_name',last_name='$last_name',user_name='$user_name',user_unique_slug='$user_unique_slug',email='$email',mobile='$mobile', updated_on='$modified_on' where id='$edit_id'";

                $result_update_user_query = mysqli_query($db_mysqli, $update_user_query);

                $affected_rows = mysqli_affected_rows($db_mysqli);

                if ($result_update_user_query)
                {
                    if ($affected_rows == 0)
                    {
                        $return["html_message"] = 'Nothing Updated by user.';
                        $return["status"] = "success";
                        echo json_encode($return);
                        exit();
                    }
                    else
                    {
                        $return["html_message"] = 'Basic details updated successfully.';
                        if($status == 0)
                        {
                            $return["is_status"] = "1";
                        }
                        if($is_deleted == 0)
                        {
                            $return["is_deleted"] = "1";
                        }
                        $return["status"] = "success";
                        echo json_encode($return);
                    }
                }
                else
                {
                    $return["html_message"] = 'Some Error Occured! Please try again.';
                    $return["status"] = "error";
                    echo json_encode($return);
                }
            }
        }

    }
    else
    {
        $return["html_message"] = 'Some Error Occured! Please try again.';
        $return["status"] = "error";
        echo json_encode($return);
    }
}
else
{

    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'logout">';
}
?>