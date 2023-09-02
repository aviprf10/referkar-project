<?php

error_reporting(0);
if(!isset($_SESSION))
{
	session_start();
}
$company_name_session = 'l1e2n3n4i5o6t7e8c9h1p2v3t4l5t6d7';
$company_title = 'ReferKar.com | India first referral website';
$noreply_email = "noreply@referkar.com";
$info_email = 'info@referkar.com';
$selected_currency_icon = '₹';
$selected_currency_text = 'Rs. ';
$current_page = basename($_SERVER['PHP_SELF']);
$admin_email_id='noreply@referkar.com';


$host = 'localhost';
$user = 'root';
$password = '';
$database = 'refer_kar';
$db_mysqli = new mysqli($host, $user, $password, $database);

$base_url = 'http://localhost/refer-kar/';
$base_url_common = $base_url.'assets/common/';
$base_url_css = $base_url.'assets/css/';
$base_url_assets = $base_url.'assets/';
$base_url_js = $base_url.'assets/js/';
$base_url_images = $base_url.'assets/images/';
$base_url_uploads = $base_url.'backadmin/uploads/';


$document_root = $_SERVER['DOCUMENT_ROOT'];
$base_path = "/refer-kar/";
$full_path = $document_root.$base_path;
$base_path_common = $base_path.'common/';
$base_path_uploads = $base_path.'uploads/';

include $full_path.'common/functions.php';
include $full_path.'common/email.php';
//require $full_path.'phpmailer/PHPMailerAutoload.php';
include $full_path.'common/mobile_otp.php';
include $full_path.'phpmailer/src/Exception.php';
include $full_path.'phpmailer/src/PHPMailer.php';
include $full_path.'phpmailer/src/SMTP.php';
$user_ip = getUserIP();

$companyinfo_data_array = array();
$get_companyinfo_query = "SELECT * FROM `company_info` where id='1'";
$result_get_companyinfo_query = mysqli_query($db_mysqli, $get_companyinfo_query);
while ($row_get_companyinfo_query = mysqli_fetch_assoc($result_get_companyinfo_query))
{
    $companyinfo_data_array[] = $row_get_companyinfo_query;
} 

$company_description = $companyinfo_data_array[0]['company_description'];
$company_address = $companyinfo_data_array[0]['company_address'];
$company_title = $companyinfo_data_array[0]['company_title'];
$company_email = $companyinfo_data_array[0]['company_email'];
$company_email2 = $companyinfo_data_array[0]['company_email2'];
$company_mobile = $companyinfo_data_array[0]['company_mobile'];
$company_mobile2 = $companyinfo_data_array[0]['company_mobile2'];
$company_address2 = $companyinfo_data_array[0]['company_address2'];
$country = $companyinfo_data_array[0]['country'];
$state = $companyinfo_data_array[0]['state'];
$city = $companyinfo_data_array[0]['city'];
$pincode = $companyinfo_data_array[0]['pincode'];
$facebook_link = $companyinfo_data_array[0]['facebook_link'];
$twitter_link = $companyinfo_data_array[0]['twitter_link'];
$linkedin_link = $companyinfo_data_array[0]['linkedin_link'];
$skype_link = $companyinfo_data_array[0]['skype_link'];
$youtube_link = $companyinfo_data_array[0]['youtube_link'];
$insta_link = $companyinfo_data_array[0]['insta_link'];
$whatsapp_link = $companyinfo_data_array[0]['whatsapp_link'];
$pintrest_link = $companyinfo_data_array[0]['pintrest_link'];
$company_logo = $companyinfo_data_array[0]['company_logo'];

?>