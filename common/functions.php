<?php
date_default_timezone_set("Asia/Kolkata");
function isValidURL($url) 
{
	if(substr($url, 0, 7)!="http://") $url = "http://".$url;
	if(filter_var($url, FILTER_VALIDATE_URL)) 
	{
		return true;
	} 
	else 
	{
		return false;
	}	
}
	
function clean($string) 
{
   return preg_replace('/[^A-Za-z0-9\-\(\) ]/', '', $string); // Removes special chars.
}

function remove_slash($string) 
{
   return str_replace("\n","",str_replace("\\","",str_replace("\\r","\r",str_replace("\\n","\n",$string))));
}

function random_code()
{
	$cod1 = md5(uniqid(rand(), true));
	$cod2 = substr($cod1, 0, 8);
	return $cod2;
}

function random_code_long()
{
	$cod1 = md5(uniqid(rand(), true));
	$cod2 = substr($cod1, 0, 16);
	return $cod1;
}

function random_four_digit_integer()
{
	$x = 3; 
	$min = pow(10,$x);
	$max = pow(10,$x+1)-1;
	$value = rand($min, $max);
	return $value;
}

function random_six_digit_integer()
{
	$x = 6; 
	$min = pow(10,$x);
	$max = pow(10,$x+1)-1;
	$value = 'REFERKAR'.rand($min, $max);
	return $value;
}

function randomDigits($length){
    $numbers = range(0,11);
    shuffle($numbers);
    for($i = 0; $i < $length; $i++){
        global $digits;
        $digits .= $numbers[$i];
    }
    return $digits;
}


function RewriteUrl ($string)
{
	$diacritics_table = array(
        'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj', 'Ž'=>'Z', 'ž'=>'z', 'C'=>'C', 'c'=>'c', 'C'=>'C', 'c'=>'c',
        'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
        'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
        'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
        'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
        'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
        'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
        'ÿ'=>'y', 'R'=>'R', 'r'=>'r', 'c'=>'c', 't'=>'t', 'C'=>'C', 'ö'=>'o', 's'=>'s', 'i'=>'i',
		'g'=>'g', 'ü'=>'u', '?'=>'s', '?'=>'t', 'a'=>'a', 'A'=>'A', '?'=>'S', '?'=>'T', 'G'=>'G', 'I'=>'I', 
		'S'=>'s', 'I'=>'I', 'I'=>'I', 'I'=>'I', 'I'=>'I', 'I'=>'I', 'I'=>'I', 'I'=>'I', 'I'=>'I', 'I'=>'I'
    );

	$string2 = strtr($string, $diacritics_table);
    return strtolower(trim(preg_replace("/[^0-9a-zA-Z]+/", "-", $string2),"-"));
} 

function RewriteLangKey($string)
{
    return strtolower(trim(preg_replace("/[^0-9a-zA-Z]+/", "_", $string),"-"));
}  

function RewriteFile($string)
{
    return strtolower(trim(preg_replace("/[^0-9a-zA-Z.]+/", "-", $string),"-"));
}

function RewriteStopWord($string)
{
    return strtolower(trim(preg_replace("/[^0-9a-zA-Z]+/", "-", $string),"-"));
}  

function Secure($string){
	return trim(mysql_real_escape_string(strip_tags(htmlspecialchars($string))));
}

function Secure1($db_mysqli,$string){
	return trim(mysqli_real_escape_string($db_mysqli,strip_tags(htmlspecialchars($string))));
}

function ScriptDomain()
{
	$domain = $_SERVER['SERVER_NAME'];
	$domain = str_replace("www.", "", $domain);
	return $domain;
}

function Base ($string)
{
	return trim(base64_decode($string));
}

function getTopDomain($url)
{
    if(filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED) === FALSE)
    {
        return false;
    }
    $parts = parse_url($url);
    return $parts['scheme'].'://'.$parts['host'];
}

function getHost($url)
{
	return str_ireplace('www.', '', parse_url($url, PHP_URL_HOST));
}

function get_current_date_time(){
    $timezone = new DateTimeZone("Asia/Kolkata" );
    $date = new DateTime();
    $date->setTimezone($timezone);
    return $date->format('Y-m-d H:i:s');
}

function _get_current_date(){
    $timezone = new DateTimeZone("Asia/Kolkata" );
    $date = new DateTime();
    $date->setTimezone($timezone);
    return $date->format('Y-m-d');
}

function _get_current_time(){
    $timezone = new DateTimeZone("Asia/Kolkata" );
    $date = new DateTime();
    $date->setTimezone($timezone);
    return $date->format('H:i:s');
}

function get_unique_slug($title,$table_name,$field_name){
    $slug = preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "-", strtolower($title)));

    $query = "SELECT COUNT(*) AS NumHits FROM $table_name WHERE  $field_name  LIKE '$slug%'";
    $result = mysql_query($query) or die(mysql_error());
    if(mysql_num_rows($result) > 0)
	{
        while($data[] = mysql_fetch_assoc($result)){}
        $numHits = $data[0]['NumHits'];
		$final_slug = $slug . '-' . $numHits;
		
		if($numHits == 0)
		{
			return $slug;
		}
		else
		{
			$query1 = "SELECT COUNT(*) AS NumHits1 FROM $table_name WHERE  $field_name  = '$final_slug'";
			$result1 = mysql_query($query1) or die(mysql_error());
			if(mysql_num_rows($result1) > 0)
			{
				$query2 = "SELECT $field_name  FROM $table_name WHERE  $field_name  LIKE '$slug%'";
				$result2 = mysql_query($query2) or die(mysql_error());
				$NumHits3 = 0;
				while($row_result2 = mysql_fetch_array($result2))
				{
					$slug_array = array();
					$slug_array = explode("-",$row_result2[$field_name]);
					$total_element = count($slug_array);
					$slug_array[$total_element-1];
					if($total_element >1)
					{
						if($NumHits3 < $slug_array[$total_element-1])
						{
							$NumHits3 = $slug_array[$total_element-1];
						}
					}
				}
				$numHits = $NumHits3+1;
				$final_slug = $slug . '-' . $numHits;
				
			}
		
			return ($numHits > 0) ? ($final_slug) : $slug;
		}
		
    }
	else
	{
        return $slug;
    }
}

function get_unique_slug1($db_mysqli,$title,$table_name,$field_name){
    $slug = preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "-", strtolower($title)));

    $query = "SELECT COUNT(*) AS NumHits FROM $table_name WHERE  $field_name  LIKE '$slug%'";
    $result = mysqli_query($db_mysqli,$query) or die(mysqli_error());
    if(mysqli_num_rows($result) > 0)
	{
        while($data[] = mysqli_fetch_assoc($result)){}
        $numHits = $data[0]['NumHits'];
		$final_slug = $slug . '-' . $numHits;
		
		if($numHits == 0)
		{
			return $slug;
		}
		else
		{
			$query1 = "SELECT COUNT(*) AS NumHits1 FROM $table_name WHERE  $field_name  = '$final_slug'";
			$result1 = mysqli_query($db_mysqli,$query1) or die(mysqli_error());
			if(mysqli_num_rows($result1) > 0)
			{
				$query2 = "SELECT $field_name  FROM $table_name WHERE  $field_name  LIKE '$slug%'";
				$result2 = mysqli_query($db_mysqli,$query2) or die(mysqli_error());
				$NumHits3 = 0;
				while($row_result2 = mysqli_fetch_array($result2))
				{
					$slug_array = array();
					$slug_array = explode("-",$row_result2[$field_name]);
					$total_element = count($slug_array);
					$slug_array[$total_element-1];
					if($total_element >1)
					{
						if($NumHits3 < $slug_array[$total_element-1])
						{
							$NumHits3 = $slug_array[$total_element-1];
						}
					}
				}
				$numHits = $NumHits3+1;
				$final_slug = $slug . '-' . $numHits;
				
			}
		
			return ($numHits > 0) ? ($final_slug) : $slug;
		}
		
    }
	else
	{
        return $slug;
    }
}


function get_unique_slug_edit($title,$table_name,$field_name,$edit_id){
    $slug = preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "-", strtolower($title)));

    $query = "SELECT COUNT(*) AS NumHits FROM $table_name WHERE  $field_name  LIKE '$slug%' and id!= $edit_id";
    $result = mysql_query($query) or die(mysql_error());
    if(mysql_num_rows($result) > 0)
	{
        while($data[] = mysql_fetch_assoc($result)){}
		
        $numHits = $data[0]['NumHits'];
		$final_slug = $slug . '-' . $numHits;
		
		if($numHits == 0)
		{
			return $slug;
		}
		else
		{
			$query1 = "SELECT COUNT(*) AS NumHits1 FROM $table_name WHERE  $field_name  = '$final_slug' and id!= $edit_id";
			$result1 = mysql_query($query1) or die(mysql_error());
			if(mysql_num_rows($result1) > 0)
			{
				$query2 = "SELECT $field_name  FROM $table_name WHERE  $field_name  LIKE '$slug%' and id!= $edit_id";
				$result2 = mysql_query($query2) or die(mysql_error());
				$NumHits3 = 0;
				while($row_result2 = mysql_fetch_array($result2))
				{
					$slug_array = array();
					$slug_array = explode("-",$row_result2[$field_name]);
					$total_element = count($slug_array);
					$slug_array[$total_element-1];
					
					if($total_element >1)
					{
						if($NumHits3 < $slug_array[$total_element-1])
						{
							$NumHits3 = $slug_array[$total_element-1];
						}
					} 
				}
				$numHits = $NumHits3+1;
				$final_slug = $slug . '-' . $numHits;
				
			}
		
			return ($numHits > 0) ? ($final_slug) : $slug;
		}
		
    }
	else
	{
        return $slug;
    }
    
}

function curPageURL() {
 $pageURL = 'http';
 if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

function compareDeepValue($val1, $val2)
{
   return strcmp($val1['uid'], $val2['uid']);
}

function filter(&$value) {
  $value = stripslashes(htmlspecialchars($value, ENT_QUOTES, 'UTF-8'));
}

function time_elapsed_B($secs){

//    date_default_timezone_set('Asia/Kolkata');
//    $time = time() - $secs; // to get the time since that moment
//
//    $tokens = array (
//        31536000 => 'year',
//        2592000 => 'month',
//        604800 => 'week',
//        86400 => 'day',
//        3600 => 'hour',
//        60 => 'minute',
//        1 => 'second'
//    );
//
//    foreach ($tokens as $unit => $text) {
//        if ($time < $unit) continue;
//        $numberOfUnits = floor($time / $unit);
//        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
//    }

$cur_time 	= strtotime(get_current_date_time());
$time_elapsed 	= $cur_time - $secs;
$seconds 	= $time_elapsed ;
$minutes 	= round($time_elapsed / 60 );
$hours 		= round($time_elapsed / 3600);
$days 		= round($time_elapsed / 86400 );
$weeks 		= round($time_elapsed / 604800);
$months 	= round($time_elapsed / 2600640 );
$years 		= round($time_elapsed / 31207680 );
// Seconds
if($seconds <= 60){
	return "$seconds seconds ago";
}
//Minutes
else if($minutes <=60){
	if($minutes==1){
		return "one minute ago";
	}
	else{
		return "$minutes minutes ago";
	}
}
//Hours
else if($hours <=24){
	if($hours==1){
		return "an hour ago";
	}else{
		return "$hours hours ago";
	}
}
//Days
else if($days <= 7){
	if($days==1){
		return "yesterday";
	}else{
		return "$days days ago";
	}
}
//Weeks
else if($weeks <= 4.3){
	if($weeks==1){
		return "a week ago";
	}else{
		return "$weeks weeks ago";
	}
}
//Months
else if($months <=12){
	if($months==1){
		return "a month ago";
	}else{
		return "$months months ago";
	}
}
//Years
else{
	if($years==1){
		return "one year ago";
	}else{
		return "$years years ago";
	}
}

}

function getUserIP()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}

function xss_clean($data)
{
	// Fix &entity\n;
	$data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
	$data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
	$data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
	$data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

	// Remove any attribute starting with "on" or xmlns
	$data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

	// Remove javascript: and vbscript: protocols
	$data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
	$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
	$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

	// Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
	$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
	$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
	$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

	// Remove namespaced elements (we do not need them)
	$data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

	do
	{
	   // Remove really unwanted tags
	   $old_data = $data;
	   $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
	}
	while ($old_data !== $data);

	// we are done...
	return $data;
}

function email_validation($str) {
    return (!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $str))
        ? FALSE : TRUE;
}

?>