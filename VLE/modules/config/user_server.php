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

if ($count < 1) {
    header("Location: ../functions/base_user/login.php?login=false");
}

$row = mysqli_fetch_array($results);
$userid = $row['userid'];
$username = $row['username'];
$_SESSION['userid'] = $userid;
$_SESSION['username'] = $username;
$_SESSION['password'] = $password;

///?
$_SESSION['img'] = $row['img'];
$name = $_SESSION['name'] = $row['name'];
$id = $_SESSION['id'] = $row['id'];
$role = $_SESSION['role'] = $row['user_role'];

mysqli_query($db, "UPDATE users SET status = 'Online' WHERE id = '$id' ") or die(mysqli_error($db));
//return print_r($_SESSION);
//*** NEW USER REDIRECT FOR ZOCS... COMMENTED OUT GENERIC ONE BELLOW */
if (empty($role)) {
    header("Location: ../functions/base_user/login.php?login=false");
} elseif ($role == 'student') {
    header("Location: ../functions/base_user/login.php?login=false");
} else {
    header("Location: ../functions/" . $role);
}

//return var_dump($username);
// if (empty($role)) {
//     header('Location: ../functions/base_user/login.php?login=false');
// } elseif ($role == "admin") {
//     header('Location: ../functions/admin');
// } elseif ($role == "teacher") {
//     header('Location: ../functions/teacher');
// }elseif ($role == "moe") {
//     header('Location: ../functions/moe');
// } elseif ($role == "manager") {
//     header('Location: ../functions/manager');
// } elseif ($role == "accountant") {
//     header('Location: ../functions/accountant');
// } elseif ($role == "student") {
//     header('Location: ../functions/student');
// } elseif ($role == "parent") {
//     header('Location: ../functions/parent');
// } else {
//     //echo "Working but not admin...\n We only testing admin right now";
// }
