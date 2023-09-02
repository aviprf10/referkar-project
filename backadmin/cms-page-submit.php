<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
    if (isset($_POST))
    {
         $status = 1;
        /*if (isset($_POST['status']))
        {
            $status = 1;
        }
        else
        {
            $status = 0;
        }*/

        $page_content = htmlentities($_POST['editor1']);

        $cms_page_id = Secure1($db_mysqli, $_POST['cms_page_id']);
        $search_keywords = '';
        $arr_search_keywords = $_POST['search_keywords'];
        $search_keywords = implode(',', $arr_search_keywords);

        $meta_description = Secure1($db_mysqli, $_POST['meta_description']);
        $meta_title = Secure1($db_mysqli, $_POST['meta_title']);
        $main_title = Secure1($db_mysqli, $_POST['main_title']);
        $image_name = Secure1($db_mysqli, $_POST['file_name1']);

        $all_cms_page_data_array = array();
        $get_cms_page_query = "select id from cms_page where id='$cms_page_id' AND status=1 and is_deleted='0'";
        $result_get_cms_page_query = mysqli_query($db_mysqli, $get_cms_page_query);
        while ($row_get_cms_page_query = mysqli_fetch_assoc($result_get_cms_page_query))
        {
            $all_cms_page_data_array[] = $row_get_cms_page_query;
        }


        if (count($all_cms_page_data_array) > 0)
        {
            $update_application_request_query = "UPDATE cms_page
                                                    SET main_title='$main_title', page_content = '$page_content', meta_title='$meta_title', image_name= '$image_name', meta_description = '$meta_description', search_keywords = '$search_keywords', status = '$status'
                                                    WHERE id = '$cms_page_id';";
            $result_update_application_request_query = mysqli_query($db_mysqli, $update_application_request_query);
            $affected_rows = mysqli_affected_rows($db_mysqli);

            if ($result_update_application_request_query)
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
                    $return["html_message"] = 'CMS Page Updated Successfully.';
                    $return["status"] = "success";
                    $return["update"] = 1;
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
            $return["html_message"] = 'Page Does not Exists..!';
            $return["status"] = "error";
            echo json_encode($return);
        }
    }
    else
    {
        $return["html_message"] = 'Some Error Occurred! Please try again.';
        $return["status"] = "error";
        echo json_encode($return);
    }
}
else
{
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'logout">';
}
?>