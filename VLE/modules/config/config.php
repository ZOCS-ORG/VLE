<?php

ini_set('display_errors', 0);
ini_set('log_errors', 0);
ini_set('display_startup_errors', 0);
// ini_set('error_reporting', E_ALL);  

$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "zocs2";

$db = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
