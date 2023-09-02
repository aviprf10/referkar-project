<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
    if (isset($_POST))
    {
        $get_user_query = "SELECT * FROM user WHERE id='$loggedin_user_id'";

        $result_get_user_query = mysqli_query($db_mysqli, $get_user_query);
        $all_user_data_array = array();
        while ($row_get_user_query = mysqli_fetch_assoc($result_get_user_query))
        {
            $all_user_data_array[] = $row_get_user_query;
        }
        $old_password = $all_user_data_array[0]['password'];
//		$first_name = Secure1($db_mysqli, $_POST['']);
//		$last_name = Secure1($db_mysqli, $_POST['last_name']);

        if (count($all_user_data_array) > 0)
        {
            if ($old_password == md5($_POST['old_password']))
            {
                if ($_POST['new_password'] == $_POST['repeat_password'])
                {
                    $password = md5($_POST['new_password']);

                    if($old_password == $password)
                    {
                        $return["html_message"] = 'New password cannot be same as old password';
                        $return["status"] = "error";
                        echo json_encode($return);
                        exit();
                    }

                    $modified_on = get_current_date_time();

                    $update_user_query = "update user set password='$password',updated_on='$modified_on' where id='$loggedin_user_id'";

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
                            $return["html_message"] = 'Password details updated successfully.';
                            $return["status"] = "success";
                            echo json_encode($return);
                        }
                    }
                    else if (isset($user_data['update']) && $user_data['update'] == 0)
                    {
                        $return["html_message"] = 'Nothing to update';
                        $return["status"] = "success";
                        echo json_encode($return);
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
                    $return["html_message"] = 'New password & repeat password does not match.';
                    $return["status"] = "error";
                    echo json_encode($return);
                }
            }
            else
            {
                $return["html_message"] = 'Current password does not match.';
                $return["status"] = "error";
                echo json_encode($return);
            }
        }
        else
        {
            $return["html_message"] = 'No user found.';
            $return["status"] = "error";
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
else
{
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'logout">';
}
?>