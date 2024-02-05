<?php
session_start();

//? go ofline
require_once('../config/config.php');

// change user online status to Ofline
$userid = $_SESSION['id'];

// echo "UPDATE users SET status = 'Offline' WHERE userid = '$userid' ";
mysqli_query($db, "UPDATE users SET status = 'Offline' WHERE userid = '$userid' ") or die(mysqli_error($db));

unset($_SESSION["id"]);
unset($_SESSION["name"]);
session_destroy();
header("Location: ../../");
?>
