<?php

//This file gets user-inputed data and checks for user types/roles and then
//sends user to desired dashboard.
//It also starts a session so as to send data to other files
session_start();
include('config.php');

$username = mysqli_real_escape_string($db, $_POST['username']);
$password = mysqli_real_escape_string($db, $_POST['password']);
$pass = md5($password); //'d41d8cd98f00b204e9800998ecf8427e';


/**
 * TODO do some error handling on the data here! 
 */
$query = "SELECT * FROM users WHERE username='$username' AND password='$pass' ";

$results = mysqli_query($db, $query) or die("An error occured: " . mysqli_error($db));
$count = mysqli_num_rows($results);
$row = mysqli_fetch_array($results);
$id = $row['userid'];
$username = $row['username'];
$role = $row['user_role'];
$_SESSION['id'] = $id;
$_SESSION['username'] = $username;
// return var_dump($query);
//return var_dump($username);
if (empty($role)) {
    header('Location: ../functions/base_user/login.php?login=false');
} elseif ($role == "admin") {
    header('Location: ../functions/admin');
} elseif ($role == "teacher") {
    header('Location: ../functions/teacher');
}elseif ($role == "MOE") {
    header('Location: ../functions/moe');
} elseif ($role == "manager") {
    header('Location: ../functions/manager');
} elseif ($role == "accountant") {
    header('Location: ../functions/accountant');
} elseif ($role == "student") {
    header('Location: ../functions/student');
} elseif ($role == "parent") {
    header('Location: ../functions/parents');
} else {
    //echo "Working but not admin...\n We only testing admin right now";
}
