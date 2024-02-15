
<?php
//include('server.php');
//include('../../utils/vars.php');
include('../../config/config.php');
include_once('../../../PHPmailer/sendmail.php');
$emails = new email();
$login_code = true;

$login_code = isset($_REQUEST['login']);

// echo $login_code;
// var_dump($login_code);

if (isset($_POST['reset'])) {

    $email = $_POST['email'];

    // check the record.

    $query = "SELECT * FROM teachers WHERE email='$email' ";

    $results = mysqli_query($db, $query) or die("An error occured: " . mysqli_error($db));
    $count = mysqli_num_rows($results);

    if ($count > 0) {
        $row = mysqli_fetch_array($results);
        $newPass = rand(100, 1000000). "@123";
        $username = $row['username'];
        $teaName = $row['name'];
        $encrypted = md5($newPass);

        $query_update = "update teachers set password='$encrypted' WHERE email='$email' ";
        $results = mysqli_query($db, $query_update) or die("An error occured: " . mysqli_error($db));

        // update users..
        $query_update_users = "update  users set password='$encrypted' WHERE username='$username' ";
        $results = mysqli_query($db, $query_update_users) or die("An error occured: " . mysqli_error($db));

        $message = "Dear " . $teaName . ", your password has been reset, your username is  " . $username . " and your password is " . $newPass . ""
                . "<br> Kind Regards <br>" . ' <img src="vle-removebg-preview.png" height="100px" width="200px">';

        $emails->send_mail($email, $message, "PASSWORD RESET");

        $login_message = "<h2 style='color:green;'>Your password has been updated, please check your email for a new password. !<h2>";
    } else {
        $login_message = "<h2 style='color:red;'>Email Provided coud not be found !<h2>";
    }
} else {
    $login_message = "Please Enter your Email !";
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

            <?php //var_dump($login_code);       ?>

            <div id="formContent">

                <!-- Tabs Titles -->

                <div> <?php echo $login_message; ?> </div>

                <!-- Login Form -->
                <form  method="post" action="">      
                    <input type="text" id="login" class="fadeIn second" name="email" placeholder="Enter your Registered Email">

                    <input type="submit" class="fadeIn fourth" name="reset" value="Reset Password">
                </form>

                <div id="formFooter">
                    <a class="underlineHover" href="login.php">Back to Login</a>
                </div>


            </div>
        </div>
        <!-- partial -->

    </body>
</html>
