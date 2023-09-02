<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
    if (isset($_POST))
    {
        //$edit_user_id = Secure($_POST['edit_user_id']);
        $theme_color = Secure1($db_mysqli, $_POST['theme_color']);
        $theme_layout = Secure1($db_mysqli, $_POST['theme_layout']);
        $profile_pic = Secure1($db_mysqli, $_POST['file_name1']);
        $modified_on = get_current_date_time();


        $get_user_query = "SELECT * FROM user WHERE id='$loggedin_user_id'";

        $result_get_user_query = mysqli_query($db_mysqli, $get_user_query);
        $all_user_data_array = array();
        while ($row_get_user_query = mysqli_fetch_assoc($result_get_user_query))
        {
            $all_user_data_array[] = $row_get_user_query;
        }

        if (count($all_user_data_array) > 0)
        {
            $update_user_query = "update user set theme_color='$theme_color', theme_layout='$theme_layout',profile_pic='$profile_pic' ,updated_on='$modified_on' where id='$loggedin_user_id'";

            $result_update_user_query = mysqli_query($db_mysqli, $update_user_query);

            $affected_rows = mysqli_affected_rows($db_mysqli);

            if ($result_update_user_query)
            {
                $_SESSION['theme_color' . $company_name_session] = $theme_color;
                $_SESSION['theme_layout' . $company_name_session] = $theme_layout;
                if($profile_pic)
                {
                    $_SESSION['profile_pic_100'.$company_name_session] = $base_url_uploads . "profile-pic/size_100/" . $profile_pic;
                    $_SESSION['profile_pic_450'.$company_name_session] = $base_url_uploads . "profile-pic/size_450/" . $profile_pic;
                }
                else
                {
                    $_SESSION['profile_pic_100'.$company_name_session] = $base_url_images . "default_profile.jpg";
                    $_SESSION['profile_pic_450'.$company_name_session] = $base_url_images . "default_profile.jpg";
                }
                if ($affected_rows == 0)
                {
                    $return["html_message"] = 'Nothing Updated by user.';
                    $return["status"] = "success";
                    echo json_encode($return);
                    exit();
                }
                else
                {
                    $return["html_message"] = 'Display preferences updated successfully.';
                    $return["status"] = "success";
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
            $return["html_message"] = 'User doesnot exists..!';
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