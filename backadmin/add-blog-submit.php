<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
    if (isset($_POST))
    {
        $blog_name          = Secure1($db_mysqli, $_POST['blog_name']);
        $sort_description   = Secure1($db_mysqli, $_POST['sort_description']);
        $blog_image         = Secure1($db_mysqli, $_POST['file_name1']);
        $full_description        = htmlentities($_POST['editor1']);
        $meta_title          = Secure1($db_mysqli, $_POST['meta_title']);
        $arr_search_keywords = $_POST['search_keywords'];
        $search_keywords     = implode(',', $arr_search_keywords);
        $meta_description    = Secure1($db_mysqli, $_POST['meta_description']);
        $created_on = get_current_date_time();
        $category_id = 0;
        $sub_category_id =0;
        // if(!empty($_POST['category_id']))
        // {
        //     $cate_data = '';
        //     foreach($_POST['category_id'] as $catvalue)
        //     {
        //         $cate_data .=$catvalue.',';
        //     }
        //     $category_id = substr($cate_data, 0,-1);
        // }
        // if(!empty($_POST['sub_category_id']))
        // {
        //     $subcate_data = '';
        //     foreach($_POST['sub_category_id'] as $scatvalue)
        //     {
        //         $subcate_data .=$scatvalue.',';
        //     }
        //     $sub_category_id = substr($subcate_data, 0,-1);
        // }
        if(!empty($_POST['service_id']))
        {
            $serv_data = '';
            foreach($_POST['service_id'] as $servvalue)
            {
                $serve_data .=$servvalue.',';
            }
            $service_id = substr($serve_data, 0,-1);
        }
        if(!empty($_POST['sub_service_id']))
        {
            $subserv_data = '';
            foreach($_POST['sub_service_id'] as $sservvalue)
            {
                $subserv_data .=$sservvalue.',';
            }
            $sub_service_id = substr($subserv_data, 0,-1);
        }
        if (isset($_POST['status']))
        {
            $status = 1;
        }
        else
        {
            $status = 0;
        }


        $get_blog_name_query = "select * from blogs where blog_name='$blog_name' and is_deleted='0'";
        $result_get_blog_name_query = mysqli_query($db_mysqli, $get_blog_name_query);
        while ($row_get_blog_name_query = mysqli_fetch_assoc($result_get_blog_name_query))
        {
            $check_blog_name_data_array[] = $row_get_blog_name_query;
        }

        if (!empty($check_blog_name_data_array))
        {
            $return["html_message"] = 'Blog title already exist. Try Another!';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        }
        
        $blogs_unique_slug = '';
        $blog_unique_slug = get_unique_slug1($db_mysqli, $blog_name, 'blogs', 'blog_name');

        $insert_blog_query = "INSERT INTO blogs (category_id,subcategory_id, service_id,service_sub_id, blog_name,blog_url,blog_image, sort_description, full_description, meta_title, meta_keyword, meta_description, created_on, status, is_deleted) 
                                              VALUES ('$category_id','$sub_category_id','$service_id', '$sub_service_id','$blog_name','$blog_unique_slug','$blog_image', '$sort_description', '$full_description','$meta_title','$search_keywords','$meta_description', '$created_on','$status', '0');";
        $result_insert_blog_query = mysqli_query($db_mysqli, $insert_blog_query);

        if ($result_insert_blog_query)
        {
            $return["html_message"] = 'Blog added successfully.';
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