<?php
session_start();
include_once("../google_lib/Google_Client.php");
include_once("../google_lib/contrib/Google_Oauth2Service.php");
######### edit details ##########
$clientId = '375937012898-f4qpuq56l94bilplj289p38rml5ukkef.apps.googleusercontent.com'; //Google CLIENT ID
$clientSecret = 'Gs3gjYzhggLEyk8jk40yvoMx'; //Google CLIENT SECRET
$redirectUrl = 'http://depasserinfotech.in/ecom-demo2/login/';  //return url (url to script)
$homeUrl = 'http://depasserinfotech.in/ecom-demo2';  //return to home

##################################

$gClient = new Google_Client();
$gClient->setApplicationName('Mor4sure');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectUrl);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>