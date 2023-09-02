<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
    if (isset($_POST))
    {
        $edit_id = Secure1($db_mysqli, $_POST['edit_id']);

        $all_company_info_data_array = array();
        $get_company_info_query = "select * from company_info where id='$edit_id'";
        $result_get_company_info_query = mysqli_query($db_mysqli, $get_company_info_query);
        while ($row_get_company_info_query = mysqli_fetch_assoc($result_get_company_info_query))
        {
            $all_company_info_data_array[] = $row_get_company_info_query;
        }

        if (count($all_company_info_data_array) > 0)
        {
            $company_title = Secure1($db_mysqli, $_POST['company_title']);
            $company_logo = Secure1($db_mysqli, $_POST['file_name1']);
            $company_description = Secure1($db_mysqli, $_POST['company_description']);
            $company_address = Secure1($db_mysqli, $_POST['company_address']);
            $company_address2 = Secure1($db_mysqli, $_POST['company_address2']);
            $country = Secure1($db_mysqli, $_POST['country']);
            $state = Secure1($db_mysqli, $_POST['state']);
            $city = Secure1($db_mysqli, $_POST['city']);
            $pincode = Secure1($db_mysqli, $_POST['pincode']);
            $company_mobile = Secure1($db_mysqli, $_POST['company_mobile']);
            $company_mobile2 = Secure1($db_mysqli, $_POST['company_mobile2']);
            $company_email = Secure1($db_mysqli, $_POST['company_email']);
            $company_email2 = Secure1($db_mysqli, $_POST['company_email2']);
            $facebook_link = Secure1($db_mysqli, $_POST['facebook_link']);
            $google_link = Secure1($db_mysqli, $_POST['google_link']);
            $insta_link = Secure1($db_mysqli, $_POST['insta_link']);
            $youtube_link = Secure1($db_mysqli, $_POST['youtube_link']);
            $pintrest_link = Secure1($db_mysqli, $_POST['pintrest_link']);
            $twitter_link = Secure1($db_mysqli, $_POST['twitter_link']);
            $skype_link = Secure1($db_mysqli, $_POST['skype_link']);
            $whatsapp_link = Secure1($db_mysqli, $_POST['whatsapp_link']);
            $linkedin_link = Secure1($db_mysqli, $_POST['linkedin_link']);
            $updated_on =  get_current_date_time();
            $update_company_info_query = "UPDATE company_info
                                SET company_title = '$company_title', company_description='$company_description',company_address = '$company_address', company_email = '$company_email', company_email2 = '$company_email2',
                                  company_mobile  = '$company_mobile',  company_mobile2 = '$company_mobile2', company_address2 = '$company_address2', country = '$country', state = '$state',
                                  city   = '$city', pincode = '$pincode',
                                  facebook_link  = '$facebook_link', twitter_link = '$twitter_link',
                                  google_link  = '$google_link', linkedin_link = '$linkedin_link', skype_link = '$skype_link', youtube_link='$youtube_link', insta_link='$insta_link', whatsapp_link='$whatsapp_link', linkedin_link='$linkedin_link', pintrest_link='$pintrest_link', company_logo='$company_logo' ,updated_on='$updated_on'
                                WHERE id = '$edit_id';";
            $result_update_company_info_query = mysqli_query($db_mysqli, $update_company_info_query);

            $affected_rows = mysqli_affected_rows($db_mysqli);

            if ($result_update_company_info_query)
            {
                if ($affected_rows == 0)
                {
                    $return["html_message"] = 'Nothing Updated by user.';
                    $return["status"] = "success";
                    echo json_encode($return);
                    exit();
                }
                $return["html_message"] = 'Company Information Updated Successfully.';
                $return["status"] = "success";
                $return["update"] = 1;
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
            $return["html_message"] = 'Company Information Does Not Exist.';
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
    $return["html_message"] = 'Please login.';
    $return["status"] = "error";
    echo json_encode($return);
    exit();
}
?>