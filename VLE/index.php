<?php
session_start();
$username = $_SESSION['username'];
include 'modules/config/config.php';
?>
<html>

<body>
    <style>
        body {
            background-color: red;
            font-family: helvetica;
        }
    </style>


    <?php
    // fresh_installations_checker();
    // Check if the db has no users to detamine if it's a fresh intall...

    $query = mysqli_query($db, "SELECT * FROM users ") or die("
                        Cant check for freshness" . mysqli_error($db));

    $count = mysqli_num_rows($query);
    if (mysqli_num_rows($query) > 0) {
        // We good!!
    } else {
        //    register_brand_new_admin();
        header('Location: modules/functions/base_user/register.php');
        return;
    }

    if (empty($username)) {
        login();
    } elseif (isset($username)) {
        // return var_dump($username);
        mini_router();
    }

    function login()
    {
        header('Location: modules/functions/base_user/login.php');
    }

    function mini_router()
    {
        global $username, $db;

        $query = "SELECT * FROM users WHERE username='$username' ";

        $results = mysqli_query($db, $query) or die("An error occured: " . mysqli_error($db));
        $count = mysqli_num_rows($results);
        $row = mysqli_fetch_array($results);
        $role = $row['user_role'] = $_SESSION['role'];

        ///?
        $_SESSION['img'] = $row['img'];
        $_SESSION['name'] = $row['name'] ;
        $_SESSION['id'] = $row['id'];


        //*** NEW USER REDIRECT FOR ZOCS... COMMENTED OUT GENERIC ONE BELLOW */
        if (empty($role)) {
            header("Location: ../functions/base_user/login.php?login=false");
        } else {
            header("Location: modules/functions/" . $role);
        }

        if ($count != 1 || empty($role)) {
            echo "<h1 style='padding: 24%; '> Cannot find any registered users</h1>";
        } elseif ($role == "admin") {
            header('Location: modules/functions/admin');
        } elseif ($role == "teacher") {
            header('Location: modules/functions/teacher');
        } elseif ($role == "manager") {
            header('Location: modules/functions/manager');
        } elseif ($role == "accountant") {
            header('Location: modules/functions/accountant');
        } elseif ($role == "student") {
            header('Location: modules/functions/student');
        } elseif ($role == "parent") {
            header('Location: modules/functions/parent');
        }
    }
    ?>