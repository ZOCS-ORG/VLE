<?php
session_start();

// Your primary website logout logic
unset($_SESSION["id"]);
unset($_SESSION["name"]);
session_destroy();

// $logout_url = 'http://localhost/moodle/login/logout.php'; 
// $response = file_get_contents($logout_url); 

header("Location: ../../");
?>
