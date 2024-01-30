
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
<html lang="en" >
    <head>
        <meta charset="UTF-8">
        <title>Welcome to ZOCS E-Learning Platform</title>
        <link rel="stylesheet" href="style.css">

    </head>
    <body>
        <!-- partial:index.partial.html -->
        <div class="wrapper fadeInDown">
            <img src="vle-removebg-preview.png" height="150px" ></img>
            <h3>Welcome to ZOCS E-Learning Platform </h3>


            <?php //var_dump($login_code);  ?>

            <div id="formContent">

                <!-- Tabs Titles -->
                <h2 class="active"> Log In </h2>
                <div> <?php echo $login_message; ?> </div>

                <!-- Login Form -->
                <form  method="post" action="../../config/user_server.php">      
                    <input type="text" id="login" class="fadeIn second" name="username" placeholder="Username">

                    <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">

                    <input type="submit" class="fadeIn fourth" name="login_user" value="Log In">
                </form>
              
                <div id="formFooter">
                  <a class="underlineHover" href="#">Forgot Password?</a>
                </div>
                

            </div>
        </div>
        <!-- partial -->

    </body>
</html>
