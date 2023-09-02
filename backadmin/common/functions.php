<?php
date_default_timezone_set("Asia/Kolkata");
function isValidURL($url)
{
    if (substr($url, 0, 7) != "http://") $url = "http://" . $url;
    if (filter_var($url, FILTER_VALIDATE_URL))
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
    return str_replace("\n", "", str_replace("\\", "", str_replace("\\r", "\r", str_replace("\\n", "\n", $string))));
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
    $x = 16; 
    $min = pow(10,$x);
    $max = pow(10,$x+1)-1;
    $value = rand($min, $max);
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


function RewriteUrl($string)
{
    $diacritics_table = array(
        '?' => 'S', '?' => 's', '?' => 'Dj', '?' => 'Z', '?' => 'z', 'C' => 'C', 'c' => 'c', 'C' => 'C', 'c' => 'c',
        '?' => 'A', '?' => 'A', '?' => 'A', '?' => 'A', '?' => 'A', '?' => 'A', '?' => 'A', '?' => 'C', '?' => 'E', '?' => 'E',
        '?' => 'E', '?' => 'E', '?' => 'I', '?' => 'I', '?' => 'I', '?' => 'I', '?' => 'N', '?' => 'O', '?' => 'O', '?' => 'O',
        '?' => 'O', '?' => 'O', '?' => 'O', '?' => 'U', '?' => 'U', '?' => 'U', '?' => 'U', '?' => 'Y', '?' => 'B', '?' => 'Ss',
        '?' => 'a', '?' => 'a', '?' => 'a', '?' => 'a', '?' => 'a', '?' => 'a', '?' => 'a', '?' => 'c', '?' => 'e', '?' => 'e',
        '?' => 'e', '?' => 'e', '?' => 'i', '?' => 'i', '?' => 'i', '?' => 'i', '?' => 'o', '?' => 'n', '?' => 'o', '?' => 'o',
        '?' => 'o', '?' => 'o', '?' => 'o', '?' => 'o', '?' => 'u', '?' => 'u', '?' => 'u', '?' => 'y', '?' => 'y', '?' => 'b',
        '?' => 'y', 'R' => 'R', 'r' => 'r', 'c' => 'c', 't' => 't', 'C' => 'C', '?' => 'o', 's' => 's', 'i' => 'i',
        'g' => 'g', '?' => 'u', '?' => 's', '?' => 't', 'a' => 'a', 'A' => 'A', '?' => 'S', '?' => 'T', 'G' => 'G', 'I' => 'I',
        'S' => 's', 'I' => 'I', 'I' => 'I', 'I' => 'I', 'I' => 'I', 'I' => 'I', 'I' => 'I', 'I' => 'I', 'I' => 'I', 'I' => 'I'
    );

    $string2 = strtr($string, $diacritics_table);
    return strtolower(trim(preg_replace("/[^0-9a-zA-Z]+/", "-", $string2), "-"));
}

function RewriteLangKey($string)
{
    return strtolower(trim(preg_replace("/[^0-9a-zA-Z]+/", "_", $string), "-"));
}

function RewriteFile($string)
{
    return strtolower(trim(preg_replace("/[^0-9a-zA-Z.]+/", "-", $string), "-"));
}

function RewriteStopWord($string)
{
    return strtolower(trim(preg_replace("/[^0-9a-zA-Z]+/", "-", $string), "-"));
}

function Secure($string)
{
    return trim(mysql_real_escape_string(strip_tags(htmlspecialchars($string))));
}

function Secure1($db_mysqli, $string)
{
    return trim(mysqli_real_escape_string($db_mysqli, strip_tags(htmlspecialchars($string))));
}

function ScriptDomain()
{
    $domain = $_SERVER['SERVER_NAME'];
    $domain = str_replace("www.", "", $domain);
    return $domain;
}

function Base($string)
{
    return trim(base64_decode($string));
}

function getTopDomain($url)
{
    if (filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED) === FALSE)
    {
        return false;
    }
    $parts = parse_url($url);
    return $parts['scheme'] . '://' . $parts['host'];
}

function getHost($url)
{
    return str_ireplace('www.', '', parse_url($url, PHP_URL_HOST));
}

function get_current_date_time()
{
    $timezone = new DateTimeZone("Asia/Kolkata");
    $date = new DateTime();
    $date->setTimezone($timezone);
    return $date->format('Y-m-d H:i:s');
}

function _get_current_date()
{
    $timezone = new DateTimeZone("Asia/Kolkata");
    $date = new DateTime();
    $date->setTimezone($timezone);
    return $date->format('Y-m-d');
}

function _get_current_time()
{
    $timezone = new DateTimeZone("Asia/Kolkata");
    $date = new DateTime();
    $date->setTimezone($timezone);
    return $date->format('H:i:s');
}

function get_unique_slug($title, $table_name, $field_name)
{
    $slug = preg_replace("/-$/", "", preg_replace('/[^a-z0-9]+/i', "-", strtolower($title)));

    $query = "SELECT COUNT(*) AS NumHits FROM $table_name WHERE  $field_name  LIKE '$slug%'";
    $result = mysql_query($query) or die(mysql_error());
    if (mysql_num_rows($result) > 0)
    {
        while ($data[] = mysql_fetch_assoc($result))
        {
        }
        $numHits = $data[0]['NumHits'];
        $final_slug = $slug . '-' . $numHits;

        if ($numHits == 0)
        {
            return $slug;
        }
        else
        {
            $query1 = "SELECT COUNT(*) AS NumHits1 FROM $table_name WHERE  $field_name  = '$final_slug'";
            $result1 = mysql_query($query1) or die(mysql_error());
            if (mysql_num_rows($result1) > 0)
            {
                $query2 = "SELECT $field_name  FROM $table_name WHERE  $field_name  LIKE '$slug%'";
                $result2 = mysql_query($query2) or die(mysql_error());
                $NumHits3 = 0;
                while ($row_result2 = mysql_fetch_array($result2))
                {
                    $slug_array = array();
                    $slug_array = explode("-", $row_result2[$field_name]);
                    $total_element = count($slug_array);
                    $slug_array[$total_element - 1];
                    if ($total_element > 1)
                    {
                        if ($NumHits3 < $slug_array[$total_element - 1])
                        {
                            $NumHits3 = $slug_array[$total_element - 1];
                        }
                    }
                }
                $numHits = $NumHits3 + 1;
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

function get_unique_slug1($db_mysqli, $title, $table_name, $field_name)
{
    $slug = preg_replace("/-$/", "", preg_replace('/[^a-z0-9]+/i', "-", strtolower($title)));

    $query = "SELECT COUNT(*) AS NumHits FROM $table_name WHERE  $field_name  LIKE '$slug%'";
    $result = mysqli_query($db_mysqli, $query);
    if (mysqli_num_rows($result) > 0)
    {
        while ($data[] = mysqli_fetch_assoc($result))
        {
        }
        $numHits = $data[0]['NumHits'];
        $final_slug = $slug . '-' . $numHits;

        if ($numHits == 0)
        {
            return $slug;
        }
        else
        {
            $query1 = "SELECT COUNT(*) AS NumHits1 FROM $table_name WHERE  $field_name  = '$final_slug'";
            $result1 = mysqli_query($db_mysqli, $query1) or die(mysqli_error($db_mysqli));
            if (mysqli_num_rows($result1) > 0)
            {
                $query2 = "SELECT $field_name  FROM $table_name WHERE  $field_name  LIKE '$slug%'";
                $result2 = mysqli_query($db_mysqli, $query2) or die(mysqli_error($db_mysqli));
                $NumHits3 = 0;
                while ($row_result2 = mysqli_fetch_array($result2))
                {
                    $slug_array = array();
                    $slug_array = explode("-", $row_result2[$field_name]);
                    $total_element = count($slug_array);
                    $slug_array[$total_element - 1];
                    if ($total_element > 1)
                    {
                        if ($NumHits3 < $slug_array[$total_element - 1])
                        {
                            $NumHits3 = $slug_array[$total_element - 1];
                        }
                    }
                }
                $numHits = $NumHits3 + 1;
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

function get_unique_slug_edit($title, $table_name, $field_name, $edit_id)
{
    $slug = preg_replace("/-$/", "", preg_replace('/[^a-z0-9]+/i', "-", strtolower($title)));

    $query = "SELECT COUNT(*) AS NumHits FROM $table_name WHERE  $field_name  LIKE '$slug%' and id!= $edit_id";
    $result = mysql_query($query) or die(mysql_error());
    if (mysql_num_rows($result) > 0)
    {
        while ($data[] = mysql_fetch_assoc($result))
        {
        }

        $numHits = $data[0]['NumHits'];
        $final_slug = $slug . '-' . $numHits;

        if ($numHits == 0)
        {
            return $slug;
        }
        else
        {
            $query1 = "SELECT COUNT(*) AS NumHits1 FROM $table_name WHERE  $field_name  = '$final_slug' and id!= $edit_id";
            $result1 = mysql_query($query1) or die(mysql_error());
            if (mysql_num_rows($result1) > 0)
            {
                $query2 = "SELECT $field_name  FROM $table_name WHERE  $field_name  LIKE '$slug%' and id!= $edit_id";
                $result2 = mysql_query($query2) or die(mysql_error());
                $NumHits3 = 0;
                while ($row_result2 = mysql_fetch_array($result2))
                {
                    $slug_array = array();
                    $slug_array = explode("-", $row_result2[$field_name]);
                    $total_element = count($slug_array);
                    $slug_array[$total_element - 1];

                    if ($total_element > 1)
                    {
                        if ($NumHits3 < $slug_array[$total_element - 1])
                        {
                            $NumHits3 = $slug_array[$total_element - 1];
                        }
                    }
                }
                $numHits = $NumHits3 + 1;
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

function get_unique_slug_edit1($db_mysqli, $title, $table_name, $field_name, $edit_id)
{
    $slug = preg_replace("/-$/", "", preg_replace('/[^a-z0-9]+/i', "-", strtolower($title)));

    $query = "SELECT COUNT(*) AS NumHits FROM $table_name WHERE  $field_name  LIKE '$slug%' and id!= $edit_id";
    $result = mysqli_query($db_mysqli,$query) or die(mysqli_error($db_mysqli));
    if (mysqli_num_rows($result) > 0)
    {
        while ($data[] = mysqli_fetch_assoc($result))
        {
        }

        $numHits = $data[0]['NumHits'];
        $final_slug = $slug . '-' . $numHits;

        if ($numHits == 0)
        {
            return $slug;
        }
        else
        {
            $query1 = "SELECT COUNT(*) AS NumHits1 FROM $table_name WHERE  $field_name  = '$final_slug' and id!= $edit_id";
            $result1 = mysqli_query($db_mysqli,$query1) or die(mysqli_error($db_mysqli));
            if (mysqli_num_rows($result1) > 0)
            {
                $query2 = "SELECT $field_name  FROM $table_name WHERE  $field_name  LIKE '$slug%' and id!= $edit_id";
                $result2 = mysqli_query($db_mysqli, $query2) or die(mysqli_error($db_mysqli));
                $NumHits3 = 0;
                while ($row_result2 = mysqli_fetch_array($result2))
                {
                    $slug_array = array();
                    $slug_array = explode("-", $row_result2[$field_name]);
                    $total_element = count($slug_array);
                    $slug_array[$total_element - 1];

                    if ($total_element > 1)
                    {
                        if ($NumHits3 < $slug_array[$total_element - 1])
                        {
                            $NumHits3 = $slug_array[$total_element - 1];
                        }
                    }
                }
                $numHits = $NumHits3 + 1;
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

function curPageURL()
{
    $pageURL = 'http';
    if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on")
    {
        $pageURL .= "s";
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80")
    {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    }
    else
    {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

function compareDeepValue($val1, $val2)
{
    return strcmp($val1['uid'], $val2['uid']);
}

function filter(&$value)
{
    $value = stripslashes(htmlspecialchars($value, ENT_QUOTES, 'UTF-8'));
}

function time_elapsed_B($secs)
{

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

    $cur_time = strtotime(get_current_date_time());
    $time_elapsed = $cur_time - $secs;
    $seconds = $time_elapsed;
    $minutes = round($time_elapsed / 60);
    $hours = round($time_elapsed / 3600);
    $days = round($time_elapsed / 86400);
    $weeks = round($time_elapsed / 604800);
    $months = round($time_elapsed / 2600640);
    $years = round($time_elapsed / 31207680);
// Seconds
    if ($seconds <= 60)
    {
        return "$seconds seconds ago";
    }
//Minutes
    else if ($minutes <= 60)
    {
        if ($minutes == 1)
        {
            return "one minute ago";
        }
        else
        {
            return "$minutes minutes ago";
        }
    }
//Hours
    else if ($hours <= 24)
    {
        if ($hours == 1)
        {
            return "an hour ago";
        }
        else
        {
            return "$hours hours ago";
        }
    }
//Days
    else if ($days <= 7)
    {
        if ($days == 1)
        {
            return "yesterday";
        }
        else
        {
            return "$days days ago";
        }
    }
//Weeks
    else if ($weeks <= 4.3)
    {
        if ($weeks == 1)
        {
            return "a week ago";
        }
        else
        {
            return "$weeks weeks ago";
        }
    }
//Months
    else if ($months <= 12)
    {
        if ($months == 1)
        {
            return "a month ago";
        }
        else
        {
            return "$months months ago";
        }
    }
//Years
    else
    {
        if ($years == 1)
        {
            return "one year ago";
        }
        else
        {
            return "$years years ago";
        }
    }

}

function getUserIP()
{
    $client = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote = $_SERVER['REMOTE_ADDR'];

    if (filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif (filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}

function moneyFormatIndia($num)
{
    $nums = explode(".", $num);
    if (count($nums) > 2)
    {
        return "0";
    }
    else
    {
        if (count($nums) == 1)
        {
            $nums[1] = "00";
        }
        $num = $nums[0];
        $explrestunits = "";
        if (strlen($num) > 3)
        {
            $lastthree = substr($num, strlen($num) - 3, strlen($num));
            $restunits = substr($num, 0, strlen($num) - 3);
            $restunits = (strlen($restunits) % 2 == 1) ? "0" . $restunits : $restunits;
            $expunit = str_split($restunits, 2);
            for ($i = 0; $i < sizeof($expunit); $i++)
            {

                if ($i == 0)
                {
                    $explrestunits .= (int)$expunit[$i] . ",";
                }
                else
                {
                    $explrestunits .= $expunit[$i] . ",";
                }
            }
            $thecash = $explrestunits . $lastthree;
        }
        else
        {
            $thecash = $num;
        }
        return $thecash . "." . $nums[1];
    }
}


?>