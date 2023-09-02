<?php
error_reporting(-1);
if (!isset($_SESSION))
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

$base_url = 'http://localhost/refer-kar/backadmin/';
$base_url_common = $base_url . 'common/';
$base_url_css = $base_url . 'assets/css/';
$base_url_js = $base_url . 'assets/js/';
$base_url_images = $base_url . 'assets/images/';
$base_url_css_upload = $base_url . 'assets/css-upload/';
$base_url_js_upload = $base_url . 'assets/js-upload/';
$base_url_global_assets = $base_url . 'assets/global_assets/';
$base_url_uploads = $base_url . 'uploads/';

$front_end_url = '/refer-kar/';
$document_root = $_SERVER['DOCUMENT_ROOT'];
$base_path = "/refer-kar/backadmin/";
$full_path = $document_root . $base_path;
$base_path_common = $base_path . 'common/';
$base_path_uploads = $base_path . 'uploads/';
include $full_path . 'common/mobile_otp.php';
include $full_path . 'common/functions.php';
require $full_path . 'common/timeago.inc.php';
// $user_ip = getUserIP();


?>