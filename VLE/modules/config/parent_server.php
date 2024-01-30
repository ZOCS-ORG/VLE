
<?php
include_once('config.php');

//Update Parent
if(!empty($_POST['update_parent'])){
    $id = $_POST['id'];
    if(!empty($_POST['password']) ) { $pw = $_POST['password'];
    $password = md5($pw); }
    $username = $_POST['username'];
    $email = $_POST['email'];
    $fathername = $_POST['fathername'];
    $mothername = $_POST['mothername'];
    $fatherphone = $_POST['fatherphone'];
    $motherphone = $_POST['motherphone'];
    $address = $_POST['address'];

    $sql = "UPDATE parents SET";
    //Check to see that value is not empty so we don't replace already existing value with null😋..
    if(!empty($username)) { $sql .= " username = '$username',"; }
    if(!empty($email)) { $sql .= " email = '$email',"; }
    if(!empty($password)) { $sql .= " password = '$password',"; }
    if(!empty($fathername)) { $sql .= " fathername = '$fathername',"; }
    if(!empty($mothername)) { $sql .= " mothername = '$mothername',"; }
    if(!empty($fatherphone)) { $sql .= " fatherphone = '$fatherphone',"; }
    if(!empty($motherphone)) { $sql .= " motherphone = '$motherphone',"; }
    if(!empty($address)) { $sql .= " address = '$address',"; }

    $sql = substr($sql, 0, strlen($sql) -1) . " WHERE `id` = '$id' ";
    $success = mysqli_query($db, $sql)or die('Error: Could not Update data: '.mysqli_error($db));
    // Update users table too
    $userid = "pa_".$id;
    $sql_user = "UPDATE users SET";
    if(!empty($password)) { $sql_user .= " password = '$password',"; }
    if(!empty($mothername)) { $sql_user .= " name = '$mothername',"; }
    if(!empty($username)) { $sql_user .= " username = '$username',"; }
    $sql_user = substr($sql_user, 0, strlen($sql_user) ) . " userid = '$userid', user_role = 'parent' WHERE `userid` = '$userid' ";
    $success = mysqli_query($db, $sql_user)or die('Error: Could not Update data: '.mysqli_error($db));

    header('Location: ../parents/view_parent.php?id='.$id."&".$updated=true);
}