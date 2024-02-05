<?php

include_once('../../../../config/config.php');
$conn = $db;
if (!$conn) {
  // echo "Database connection error".mysqli_connect_error();
}
