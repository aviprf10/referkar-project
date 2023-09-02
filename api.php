<?php

header("Access-Control-Allow-Origin: *");
$base_path = 'api/';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
$request_parts = explode('/', $_GET['url']); // http://sastipasti.com/api/user/login.json
$file_type = $_GET['type'];
$output = array();
switch ($request_parts[0])
{
    
    case 'home':
        switch ($request_parts[1])
        {
            case 'get':
                switch ($file_type)
                {
                    case 'json':
                        include($base_path . "get_home_data.php");
                        break;
                    case 'xml':
                        //echo xml_encode($output);
                        break;
                    default:
                        echo json_encode($output);
                }
                break;
            default:
                echo json_encode($output);
        }
        break;
    case 'service':
        switch ($request_parts[1])
        {

            case 'get':
               switch ($file_type)
                {
                    case 'json':
                        include($base_path . "get_services_data.php");
                        break;
                    case 'xml':
                        //echo xml_encode($output);
                        break;
                    default:
                        echo json_encode($output);
                }
                break;
            default:
                echo json_encode($output);
        }
        break; 
    case 'about':
        switch ($request_parts[1])
        {

            case 'get':
               switch ($file_type)
                {
                    case 'json':
                        include($base_path . "get_about_data.php");
                        break;
                    case 'xml':
                        //echo xml_encode($output);
                        break;
                    default:
                        echo json_encode($output);
                }
                break;
            default:
                echo json_encode($output);
        }
        break; 
    case 'company':
        switch ($request_parts[1])
        {

            case 'get':
               switch ($file_type)
                {
                    case 'json':
                        include($base_path . "get_company_data.php");
                        break;
                    case 'xml':
                        //echo xml_encode($output);
                        break;
                    default:
                        echo json_encode($output);
                }
                break;
            default:
                echo json_encode($output);
        }
        break; 
    case 'support':
        switch ($file_type)
        {
            case 'json':
                include($base_path . "insert_support_data.php");
                break;
            case 'xml':
                //echo xml_encode($output);
                break;
            default:
                echo json_encode($output);
        }
        break;               
    case 'blogs':
        switch ($request_parts[1])
        {

            case 'get':
               switch ($file_type)
                {
                    case 'json':
                        include($base_path . "get_blogs_data.php");
                        break;
                    case 'xml':
                        //echo xml_encode($output);
                        break;
                    default:
                        echo json_encode($output);
                }
                break;
            default:
                echo json_encode($output);
        }
        break;
    case 'blog-details':
        switch ($file_type)
        {
            case 'json':
                include($base_path . "get_blog_details_data.php");
                break;
            case 'xml':
                //echo xml_encode($output);
                break;
            default:
                echo json_encode($output);
        }
        break; 
    case 'loan-details':
        switch ($file_type)
        {
            case 'json':
                include($base_path . "get_loan_details_data.php");
                break;
            case 'xml':
                //echo xml_encode($output);
                break;
            default:
                echo json_encode($output);
        }
        break; 

    case 'generate-otp':
        switch ($file_type)
        {
            case 'json':
                include($base_path . "get_generate_otp.php");
                break;
            case 'xml':
                //echo xml_encode($output);
                break;
            default:
                echo json_encode($output);
        }
        break; 

    case 'verify-otp':
        switch ($file_type)
        {
            case 'json':
                include($base_path . "get_verify_otp.php");
                break;
            case 'xml':
                //echo xml_encode($output);
                break;
            default:
                echo json_encode($output);
        }
        break; 

    case 'submit-loan':
        switch ($file_type)
        {
            case 'json':
                include($base_path . "insert_loan_inquiry.php");
                break;
            case 'xml':
                //echo xml_encode($output);
                break;
            default:
                echo json_encode($output);
        }
        break;                 

    default:
        echo json_encode($output);
}

?>