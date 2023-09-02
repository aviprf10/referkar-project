<?php
if(($_SESSION[$company_name_session.'_loggedin'] == 1)  && ($_SESSION['domain_link_'.$company_name_session] == $company_name_session))
{
	$admin 									= 1;
	$user 									= 0;
	$_SESSION['next_url']					= '';
	$loggedin_user_id 						= $_SESSION['user_id_'.$company_name_session];
	$loggedin_user_first_name 				= $_SESSION['first_name_'.$company_name_session];
	$loggedin_user_last_name 				= $_SESSION['last_name_'.$company_name_session];
	$loggedin_user_email 					= $_SESSION['user_email_'.$company_name_session];
	$loggedin_user_name_link 				= $_SESSION['user_name_link_'.$company_name_session];
	$loggedin_user_name 					= $_SESSION['user_name_'.$company_name_session];
	$loggedin_user_mobile 					= $_SESSION['mobile_'.$company_name_session];
	$loggedin_user_type 					= $_SESSION['user_type_'.$company_name_session];
	$loggedin_user_profile_pic_100  		= $_SESSION['profile_pic_100'.$company_name_session];
	$loggedin_user_profile_pic_450  		= $_SESSION['profile_pic_450'.$company_name_session];
    $page_layout 			                = 2;
    $theme_color 			                = $_SESSION['theme_color'.$company_name_session];
    $side_menu_state 			            = $_SESSION['side_menu_state'.$company_name_session];
}
else if(($_SESSION[$company_name_session.'_loggedin'] == 2)  && ($_SESSION['domain_link_'.$company_name_session] == $company_name_session))
{
	$_SESSION['next_url']='';
	$admin = 0;
	$user = 1;
	$loggedin_user_id 						= $_SESSION['user_id_'.$company_name_session];
	$loggedin_user_email 					= $_SESSION['user_email_'.$company_name_session];
	$loggedin_user_first_name 				= $_SESSION['first_name_'.$company_name_session];
	$loggedin_user_last_name 				= $_SESSION['last_name_'.$company_name_session];
	$loggedin_user_name 					= $_SESSION['user_name_'.$company_name_session];
	$loggedin_user_name_link 				= $_SESSION['user_name_link_'.$company_name_session];
	$loggedin_user_type 					= $_SESSION['user_type_'.$company_name_session];
	$loggedin_user_mobile 					= $_SESSION['mobile_'.$company_name_session];
	$loggedin_user_profile_pic_100 			= $_SESSION['profile_pic_100'.$company_name_session];
	$loggedin_user_profile_pic_450 			= $_SESSION['profile_pic_450'.$company_name_session];
	$page_layout 			                = 2;
    $theme_color 			                = $_SESSION['theme_color'.$company_name_session];
	$side_menu_state 			            = $_SESSION['side_menu_state'.$company_name_session];
	$loggedin_user_mobile_access_token 	= $_SESSION['mobile_access_token_'.$company_name_session];

}
else
{
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.$base_url.'logout.php">';
}
?>