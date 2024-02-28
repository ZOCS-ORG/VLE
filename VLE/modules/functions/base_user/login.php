<?php
//include('server.php');
//include('../../utils/vars.php');

$login_code = true;

$login_code = isset($_REQUEST['login']);

// echo $login_code;
// var_dump($login_code);


if ($login_code) {
    if ($login_code == false) {
        echo $login_code;
        var_dump($login_code);
    }
    $login_message = "<h2 style='color:red;'>Wrong Credentials !<h2>";
} else {
    $login_message = "Please Login !";
    $color = "green";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome to ZOCS E-Learning Platform</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
 /* Add this CSS to your existing style.css file or include it within a <style> tag in your HTML */


    </style>

</head>

<body>
    <!-- partial:index.partial.html -->
    <div class="wrapper fadeInDown" >


        <div id="formContent">
            <img src="vle-removebg-preview.png" height="150px"></img>
            <h3>Welcome to ZOCS E-Learning Platform </h3>
            <!-- Tabs Titles -->
            <h2 class="active"> Log In </h2>
            <div> <?php echo $login_message; ?> </div>

            <!-- Login Form -->
            <form method="post" action="../../config/user_server.php">
                <input type="text" id="login" class="fadeIn second" name="username" placeholder="Username" required>

                <input class="btn btn-sm btn-success" type="password" id="password" class="fadeIn third" name="password" placeholder="password" required>

                <input type="submit" class="btn btn-sm btn-success" name="login_user" value="Log In">
            </form>
            <a href='../../../../index.php' style="color:#008000"> Back To Home</a>

            <div id="formFooter">
                <a class="underlineHover" href="reset-password.php">Forgot Password?</a>
            </div>
        </div>
    </div>
    <!-- partial -->

</body>

</html>