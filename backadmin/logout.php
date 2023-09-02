<?php
include ('common/config.php');
//session_start();
session_destroy();
echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.$base_url.'login">';
?>