<?php

$service_data_array = array();
$get_service_query = "SELECT * FROM `sub_service` where service_id='1' and is_deleted='0' and status='1'";
$result_get_service_query = mysqli_query($db_mysqli, $get_service_query);
while ($row_get_service_query = mysqli_fetch_assoc($result_get_service_query))
{
    $service_data_array[] = $row_get_service_query;
} 

$blogs_data_array = array();
$get_blogs_query = "SELECT * FROM `blogs` where is_deleted='0' and status='1'";
$result_get_blogs_query = mysqli_query($db_mysqli, $get_blogs_query);
while ($row_get_blogs_query = mysqli_fetch_assoc($result_get_blogs_query))
{
    $blogs_data_array[] = $row_get_blogs_query;
} 

if($current_page == 'index.php' || $current_page == 'about-us.php' || $current_page == 'privacy-policy.php' || $current_page == 'disclaimer.php' || $current_page == 'terms-and-conditions.php')
{
    if($current_page == 'about-us.php')
    {
        $id='1';
    } 
    else if($current_page == 'privacy-policy.php')
    {
        $id='2';
    } 
    else if($current_page == 'disclaimer.php')
    {
        $id='3';
    } 
    else if($current_page == 'terms-and-conditions.php')
    {
        $id='4';
    } 
    else if($current_page == 'index.php')
    {
        $id='5';
    } 

    $cmspage_data_array = array();
    $get_cmspage_query = "SELECT * FROM `cms_page` where id='$id' and is_deleted='0' and status='1'";
    $result_get_cmspage_query = mysqli_query($db_mysqli, $get_cmspage_query);
    while ($row_get_cmspage_query = mysqli_fetch_assoc($result_get_cmspage_query))
    {
        $cmspage_data_array[] = $row_get_cmspage_query;
    } 

    $main_title = $cmspage_data_array[0]['main_title'];
    $image_name = $cmspage_data_array[0]['image_name'];
    $image_link = $cmspage_data_array[0]['image_link'];
    $page_content = $cmspage_data_array[0]['page_content'];
    $meta_title = $cmspage_data_array[0]['meta_title'];
    $meta_description = $cmspage_data_array[0]['meta_description'];
    $search_keywords = $cmspage_data_array[0]['search_keywords'];


}
?>