<?php

//session_start();
include_once('config.php');

/**
 *  @TODO WORK ON IMAGE UPLOADING VALIDATION FOR ALL 
 *  UPLOADS AND UPDATES
 */
/**
 * Get user type and call funk accord
 * 
 */

$uid = "";

if (isset($_POST['user_role'])) {
    $role = $_POST['user_role'];

    switch ($role) {
        case 'lecturer':
            create_lecturer();
            break;
        case 'accountant':
            create_accountant();
            break;
        case 'manager':
            create_manager();
            break;
        case 'librarian':
            create_librarian();
            break;
        case 'admin':
            create_admin();
            break;
        case 'other':
            create_other();
            break;
        default:
            create_user();
            break;
    }
}



/**
 *  Lecturer Server
 * 
 */
// Init Vars...
$teaName = $teaPhone = $teaEmail = $teaGender = $teaHireDate = $teaSalary = $teaDOB = $teaAddress = "";

function create_user() {
    global $db, $emails;
    if (!empty($_FILES))
        if (!empty($_POST['add_staff'])) {
            //$emails = new email();
            $teaId = $_POST['id'];
            $teaName = $_POST['name'];
            $username = $_POST['username'];
            $teaPassword = md5($_POST['password']);
            $teaPhone = $_POST['phone'];
            $teaEmail = $_POST['email'];
            $teaGender = $_POST['gender'];
            $teaDOB = $_POST['dob'];
            $teaHireDate = $_POST['hiredate'];
            $teaAddress = $_POST['address'];
            $teaSalary = $_POST['salary'];
            $user_type = $role = $_POST['user_role'];
            //$filename = $_FILES['file']['name'];
            $filetmp = $_FILES['file']['tmp_name'];
            $img = $teaName . "_" . rand(100, 1000000) . ".jpg";
            move_uploaded_file($filetmp, "../../../utils/images/lecturers/" . $img);

            $sql = "INSERT INTO teachers (`id`, `name`, `username`, `password`, `phone`, `email`, `address`, `sex`, `dob`, `hiredate`, `salary`, `img`,`user_type`)
        VALUES('$teaId','$teaName','$username','$teaPassword','$teaPhone','$teaEmail','$teaAddress','$teaGender','$teaDOB','$teaHireDate','$teaSalary', '$img','$user_type' )";

            $success = mysqli_query($db, $sql) or die('Could not enter data: ' . mysqli_error($db));
            $teaId = mysqli_insert_id($db);

            $message = "Dear " . $teaName . ", Welcome to the Virtual Learning Platform, your username is  " . $username . " and your password is " . $_POST['password'] . ""
                    . "<br> Kind Regards";

            //  $mail->send_mail($teaEmail, $message, "WELCOME TO THE VLE");

            $userid = "tea_" . $teaId;
            $sql_user = "INSERT INTO users (`userid`, `name`, `username`, `password`, `user_role`) 
                VALUES('$userid', '$teaName','$username', '$teaPassword','$user_type')";
            $success = mysqli_query($db, $sql_user) or die('Could not enter data: ' . mysqli_error($db));
            if ($success) {
                header('Location: ../users/view.php?id=' . $teaId . "&created=true");
            }
        }
}

// Create Lecturer/Teacher
function create_lecturer() {
    global $db;
    if (!empty($_FILES))
        if (!empty($_POST['add_staff'])) {
            $teaId = $_POST['id'];
            $teaName = $_POST['name'];
            $username = $_POST['username'];
            $teaPassword = md5($_POST['password']);
            $teaPhone = $_POST['phone'];
            $teaEmail = $_POST['email'];
            $teaGender = $_POST['gender'];
            $teaDOB = $_POST['dob'];
            $teaHireDate = $_POST['hiredate'];
            $teaAddress = $_POST['address'];
            $teaSalary = $_POST['salary'];
            //$filename = $_FILES['file']['name'];
            $filetmp = $_FILES['file']['tmp_name'];
            $img = $teaName . "_" . rand(100, 1000000) . ".jpg";
            move_uploaded_file($filetmp, "../../../utils/images/lecturers/" . $img);

            $sql = "INSERT INTO teachers (`id`, `name`, `username`, `password`, `phone`, `email`, `address`, `sex`, `dob`, `hiredate`, `salary`, `img`)
        VALUES('$teaId','$teaName','$username','$teaPassword','$teaPhone','$teaEmail','$teaAddress','$teaGender','$teaDOB','$teaHireDate','$teaSalary', '$img' )";

            $success = mysqli_query($db, $sql) or die('Could not enter data: ' . mysqli_error($db));
            $teaId = mysqli_insert_id($db);

            $userid = "tea_" . $teaId;
            $sql_user = "INSERT INTO users (`userid`, `name`, `username`, `password`, `user_role`) 
                VALUES('$userid', '$teaName','$username', '$teaPassword','teacher')";
            $success = mysqli_query($db, $sql_user) or die('Could not enter data: ' . mysqli_error($db));
            if ($success) {
                header('Location: ../lecturers/view_lecturer.php?id=' . $teaId . "&created=true");
            }
        }
}

//Update Lecturer
if (!empty($_POST['update_lecturer'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    if (!empty($_POST['password'])) {
        $pw = $_POST['password'];
        $password = md5($pw);
    }
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    //$dob = $_POST['dob'];
    //$hiredate = $_POST['hiredate'];
    $address = $_POST['address'];
    $salary = $_POST['salary'];
    $filetmp = $_FILES['file']['tmp_name'];
    if (isset($filetmp) && !empty($filetmp)) {
        $dir = "../../../utils/images/lecturers/";
        $img = "_" . rand(100, 1000000) . ".jpg";

        // unlink($dir.$img);
        move_uploaded_file($filetmp, $dir . $img);
    } else {
        $img = "";
    }

    $sql = "UPDATE teachers SET";
    //Check to see that value is not empty so we don't replace already existing value with null😋..
    if (!empty($password)) {
        $sql .= " password = '$password',";
    }
    if (!empty($name)) {
        $sql .= " name = '$name',";
    }
    if (!empty($phone)) {
        $sql .= " phone = '$phone',";
    }
    if (!empty($email)) {
        $sql .= " email = '$email',";
    }
    if (!empty($username)) {
        $sql .= " username = '$username',";
    }
    // if(!empty($dob)) { $sql .= " dob = '$dob',"; }
    if (!empty($img)) {
        $sql .= " img = '$img',";
    }
    if (!empty($salary)) {
        $sql .= " salary = '$salary',";
    }
    if (!empty($address)) {
        $sql .= " address = '$address'";
    }

    echo $sql . " WHERE `id` = '$id' ";

    $sql = $sql . " WHERE `id` = '$id' ";
    $success = mysqli_query($db, $sql) or die('Error: Could not Update data - T: ' . mysqli_error($db));

    header('Location: ../users/view.php?id=' . $id . "&updated=true");
}
// Delete Lecturer
if (isset($_GET['id']) && isset($_GET['delete_lecturer'])) {
    if ($_GET['delete_lecturer'] == true) {
        $id = $_GET['id'];
        $sql = "DELETE FROM teachers WHERE id = '$id';";
        $success = mysqli_query($db, $sql);
        $userid = "tea_" . $id;
        $sql = "DELETE FROM users WHERE userid = '$userid';";
        $success = mysqli_query($db, $sql);
        if (!$success) {
            die('Could not Delete data: ' . mysqli_error($db));
        }
        //unlink('../images/'.$id.'.jpg');  // @TODO: Figure out routing.. Check TD list
        header("Location: ../functions/admin/staff/all_staff.php?deleted=true");
    }
}



/**
 *  Accountant💲💲 Server💰
 */
/// INITIALIZE SOME VARIABLES...
$accId = $accAddress = $accDOB = $accGender = $accHireDate = $accSalary = $accName = $accPhone = $accEmail = "";

// Create Accaountant🤑🤑
function create_accountant() {
    global $db;
    if (!empty($_FILES))
        if (!empty($_POST['add_staff'])) {
            $accId = $_POST['id'];
            $accName = $_POST['name'];
            $username = $_POST['username'];
            $accPassword = md5($_POST['password']);
            $accPhone = $_POST['phone'];
            $accEmail = $_POST['email'];
            $accGender = $_POST['gender'];
            $accDOB = $_POST['dob'];
            $accHireDate = $_POST['hiredate'];
            $accAddress = $_POST['address'];
            $accSalary = $_POST['salary'];
            //$filename = $_FILES['file']['name'];
            $filetmp = $_FILES['file']['tmp_name'];
            $img = $accName . "_" . rand(100, 1000000) . ".jpg";
            move_uploaded_file($filetmp, "../../../utils/images/accountants/" . $img);
            $sql = "INSERT INTO accountants VALUES('$accId','$accName','$username','$accPassword','$accPhone','$accEmail','$accAddress','$accGender','$accDOB','$accHireDate','$accSalary', '$img')";
            $success = mysqli_query($db, $sql);

            $id = mysqli_insert_id($db);
            $userid = "acc_" . $id;
            $sql = "INSERT INTO users (`userid`, `name`, `username`, `password`, `user_role`)
                    VALUES('$userid', '$accName', '$username', '$accPassword','accountant')";
            $success = mysqli_query($db, $sql);
            if (!$success) {
                die('Could not enter data: ' . mysqli_error($db));
            }
            if ($success) {
                header('Location: ../accountants/view_accountant.php?id=' . $id . "&created=true");
            }
        }
}

//Update Accountants 💸💸
if (!empty($_POST['update_accountant'])) {
    $accId = $_POST['id'];
    $name = $_POST['name'];
    if (!empty($_POST['password'])) {
        $pw = $_POST['password'];
        $password = md5($pw);
    }
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    //$dob = $_POST['dob'];
    //$hiredate = $_POST['hiredate'];
    $address = $_POST['address'];
    $salary = $_POST['salary'];
    $filetmp = $_FILES['file']['tmp_name'];
    if (isset($filetmp) && !empty($filetmp)) {
        $dir = "../../../utils/images/accountants/";
        $img = $name . "_" . rand(100, 1000000) . ".jpg";
        // // unlink($dir.$img.".jpg");
        move_uploaded_file($filetmp, $dir . $img);
    } else {
        $img = "";
    }

    $sql = "UPDATE accountants SET";
    //Check to see that value is not empty so we don't replace already existing value with null😋..
    if (!empty($accId)) {
        $sql .= " id = '$accId',";
    }
    if (!empty($password)) {
        $sql .= " password = '$password',";
    }
    if (!empty($name)) {
        $sql .= " name = '$name',";
    }
    if (!empty($phone)) {
        $sql .= " phone = '$phone',";
    }
    if (!empty($email)) {
        $sql .= " email = '$email',";
    }
    if (!empty($username)) {
        $sql .= " username = '$username',";
    }
    if (!empty($dob)) {
        $sql .= " dob = '$dob',";
    }
    if (!empty($hiredate)) {
        $sql .= " hiredate = '$hiredate',";
    }
    if (!empty($salary)) {
        $sql .= " salary = '$salary',";
    }
    if (!empty($address)) {
        $sql .= " address = '$address',";
    }

    $sql = substr($sql, 0, strlen($sql) - 1) . " WHERE `id` = '$accId' ";
    $success = mysqli_query($db, $sql);

    // Update users table too
    $userid = "acc_" . $accId;
    $sql_user = "UPDATE users SET";
    if (!empty($password)) {
        $sql_user .= " password = '$password',";
    }
    if (!empty($name)) {
        $sql_user .= " name = '$name',";
    }
    if (!empty($username)) {
        $sql_user .= " username = '$username',";
    }

    $sql_user = substr($sql_user, 0, strlen($sql_user)) . "  user_role = 'accountant' WHERE `userid` = '$userid' ";
    // return var_dump($sql_user);
    $success = mysqli_query($db, $sql_user) or die('Error: Could not Update data: ' . mysqli_error($db));

    header('Location: ../accountants/view_accountant.php?id=' . $accId . "&updated=true");
}
// Delete Accountants
if (isset($_GET['id']) && isset($_GET['delete_accountant'])) {
    if ($_GET['delete_accountant'] == true) {
        $id = $_GET['id'];
        $sql = "DELETE FROM accountants WHERE id = '$id';";
        $success = mysqli_query($db, $sql);
        $userid = "acc_" . $id;
        $sql = "DELETE FROM users WHERE userid = '$userid';";
        $success = mysqli_query($db, $sql);
        if (!$success) {
            die('Could not Delete data: ' . mysqli_error($db));
        }
        //unlink('../images/'.$id.'.jpg');  // @TODO: Figure out routing.. Check TD list
        header("Location: ../functions/admin/accountants/all_accountants.php?deleted=true");
    }
}


/**
 *  School Admin/Manager Server
 * 
 */
// Init vars....
$address = $name = $phone = $role = $salary = $patreon = $email = $gender = "";

// Create Manager
function create_manager() {
    global $db;
    if (!empty($_FILES))
        if (!empty($_POST['add_staff'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $gender = $_POST['gender'];
            $dob = $_POST['dob'];
            $hireDate = $_POST['hiredate'];
            $address = $_POST['address'];
            //$filename = $_FILES['file']['name'];
            $filetmp = $_FILES['file']['tmp_name'];
            $img = $name . "_" . rand(100, 1000000) . ".jpg";
            move_uploaded_file($filetmp, "../../../utils/images/school_manager/" . $img);
            $sql = "INSERT INTO managers VALUES('$id','$name','$username','$password','$phone','$email','$address','$gender','$dob','$hireDate', '$img')";
            $success = mysqli_query($db, $sql);
            $id = mysqli_insert_id($db);
            $userid = "man_" . $id;
            $sql = "INSERT INTO users (`userid`, `name`, `username`, `password`, `user_role`)
                VALUES('$userid','$name','$username','$password','manager')";
            $success = mysqli_query($db, $sql);
            if (!$success) {
                die('Could not enter data: ' . mysqli_error($db));
            }
            if ($success) {
                header('Location: ../school_manager/view_manager.php?id=' . $id . "&created=true");
            }
        }
}

//Update Manager
if (!empty($_POST['update_manager'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    if (!empty($_POST['password'])) {
        $pw = $_POST['password'];
        $password = md5($pw);
    }
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    //$dob = $_POST['dob'];
    $hiredate = $_POST['hiredate'];
    $address = $_POST['address'];
    $filetmp = $_FILES['file']['tmp_name'];
    if (isset($filetmp) && !empty($filetmp)) {
        $dir = "../../../utils/images/school_manager/";
        $img = $name . "_" . rand(100, 1000000) . ".jpg";
        // unlink($dir.$img.".jpg");
        move_uploaded_file($filetmp, $dir . $img);
    } else {
        $img = "";
    }
    $sql = "UPDATE managers SET";
    //Check to see that value is not empty so we don't replace already existing value with null😋..
    if (!empty($id)) {
        $sql .= " id = '$id',";
    }
    if (!empty($password)) {
        $sql .= " password = '$password',";
    }
    if (!empty($name)) {
        $sql .= " name = '$name',";
    }
    if (!empty($phone)) {
        $sql .= " phone = '$phone',";
    }
    if (!empty($email)) {
        $sql .= " email = '$email',";
    }
    if (!empty($username)) {
        $sql .= " username = '$username',";
    }
    if (!empty($dob)) {
        $sql .= " dob = '$dob',";
    }
    if (!empty($hiredate)) {
        $sql .= " hiredate = '$hiredate',";
    }
    if (!empty($address)) {
        $sql .= " address = '$address',";
    }
    if (!empty($img)) {
        $sql .= " img = '$img',";
    }

    $sql = substr($sql, 0, strlen($sql) - 1) . " WHERE `id` = '$id' ";
    $success = mysqli_query($db, $sql);
    // Update users table too
    $userid = "man_" . $id;
    $sql_user = "UPDATE users SET";
    if (!empty($password)) {
        $sql_user .= " password = '$password',";
    }
    if (!empty($name)) {
        $sql_user .= " name = '$name',";
    }
    if (!empty($username)) {
        $sql_user .= " username = '$username',";
    }
    $sql_user = substr($sql_user, 0, strlen($sql_user)) . "  user_role = 'manager' WHERE `userid` = '$userid' ";
    $success = mysqli_query($db, $sql_user) or die('Error: Could not Update data: ' . mysqli_error($db));

    header('Location: ../school_manager/view_manager.php?id=' . $id . "&updated=true");
}
// Delete Manager
if (isset($_GET['id']) && isset($_GET['delete_manager'])) {
    if ($_GET['delete_manager'] == true) {
        $id = $_GET['id'];
        $sql = "DELETE FROM managers WHERE id = '$id';";
        $success = mysqli_query($db, $sql);
        $userid = "man_" . $id;
        $sql = "DELETE FROM users WHERE userid = '$userid';";
        $success = mysqli_query($db, $sql);
        if (!$success) {
            die('Could not Delete data: ' . mysqli_error($db));
        }
        header("Location: ../functions/admin/school_manager/all_managers.php?deleted=true");
    }
}


/**
 *  Librarian Server  
 * 
 */
// Init Vars..
$address = $name = $phone = $role = $salary = $patreon = $email = $gender = $hireDate = "";

// Create Librarian
function create_librarian() {
    global $db;
    if (!empty($_FILES))
        if (!empty($_POST['add_staff'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $gender = $_POST['gender'];
            $dob = $_POST['dob'];
            $hireDate = $_POST['hiredate'];
            $address = $_POST['address'];
            $salary = $_POST['salary'];
            //$filename = $_FILES['file']['name'];
            $filetmp = $_FILES['file']['tmp_name'];
            $img = $name . "_" . rand(100, 1000000) . ".jpg";
            move_uploaded_file($filetmp, "../../../utils/images/librarians/" . $img);
            $sql = "INSERT INTO librarians VALUES('$id','$name','$username','$password','$phone','$email','$address','$gender','$dob','$hireDate','$salary', '$img')";
            $success = mysqli_query($db, $sql);
            $id = mysqli_insert_id($db);
            $userid = "lib_" . $id;
            $sql = "INSERT INTO  users (`userid`, `name`, `username`, `password`, `user_role`)
                VALUES('$userid','$name','$username','$password','manager')";
            $success = mysqli_query($db, $sql);
            if (!$success) {
                die('Could not enter data: ' . mysqli_error($db));
            }
            if ($success) {
                header('Location: ../library/view_librarian.php?id=' . $id . "&created=true");
            }
        }
}

//Update Librarians
if (!empty($_POST['update_librarian'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    if (!empty($_POST['password'])) {
        $pw = $_POST['password'];
        $password = md5($pw);
    }
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    //$dob = $_POST['dob'];
    $hiredate = $_POST['hiredate'];
    $address = $_POST['address'];
    $salary = $_POST['salary'];
    $filetmp = $_FILES['file']['tmp_name'];
    if (isset($filetmp) && !empty($filetmp)) {
        $dir = "../../../utils/images/librarians/";
        $img = $name . "_" . rand(100, 1000000) . ".jpg";
        // unlink($dir.$img.".jpg");
        move_uploaded_file($filetmp, "../../../utils/images/librarians/" . $img);
    } else {
        $img = "";
    }

    $sql = "UPDATE librarians SET";
    //Check to see that value is not empty so we don't replace already existing value with null😋..
    if (!empty($id)) {
        $sql .= " id = '$id',";
    }
    if (!empty($password)) {
        $sql .= " password = '$password',";
    }
    if (!empty($name)) {
        $sql .= " name = '$name',";
    }
    if (!empty($phone)) {
        $sql .= " phone = '$phone',";
    }
    if (!empty($email)) {
        $sql .= " email = '$email',";
    }
    if (!empty($username)) {
        $sql .= " username = '$username',";
    }
    if (!empty($dob)) {
        $sql .= " dob = '$dob',";
    }
    if (!empty($hiredate)) {
        $sql .= " hiredate = '$hiredate',";
    }
    if (!empty($salary)) {
        $sql .= " salary = '$salary',";
    }
    if (!empty($address)) {
        $sql .= " address = '$address',";
    }
    if (!empty($img)) {
        $sql .= " img = '$img',";
    }

    $sql = substr($sql, 0, strlen($sql) - 1) . " WHERE `id` = '$id' ";
    $success = mysqli_query($db, $sql);

    // Update users table too
    $userid = "lib_" . $id;
    $sql_user = "UPDATE users SET";
    if (!empty($password)) {
        $sql_user .= " password = '$password',";
    }
    if (!empty($name)) {
        $sql_user .= " name = '$name',";
    }
    if (!empty($username)) {
        $sql_user .= " username = '$username',";
    }

    $sql_user = substr($sql_user, 0, strlen($sql_user)) . "  user_role = 'librarian' WHERE `userid` = '$userid' ";
    $success = mysqli_query($db, $sql_user) or die('Error: Could not Update data: ' . mysqli_error($db));

    header('Location: ../library/view_librarian.php?id=' . $id . "&updated=true");
}
// Delete Librarians
if (isset($_GET['id']) && isset($_GET['delete_librarian'])) {
    if ($_GET['delete_librarian'] == true) {
        $id = $_GET['id'];
        $sql = "DELETE FROM librarians WHERE id = '$id';";
        $success = mysqli_query($db, $sql);
        $userid = "lib_" . $id;
        $sql = "DELETE FROM users WHERE userid = '$userid';";
        $success = mysqli_query($db, $sql);
        if (!$success) {
            die('Could not Delete data: ' . mysqli_error($db));
        }
        //unlink('../images/'.$id.'.jpg');  // @TODO: Figure out routing.. Check TD list
        header("Location: ../functions/admin/library/all_librarians.php?deleted=true");
    }
}

/**
 * ADMIN OWN USER SERVER..
 * 
 */
// Create Admin
function create_admin() {
    global $db;
    if (!empty($_FILES))
        if (!empty($_POST['add_staff'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $gender = $_POST['gender'];
            $dob = $_POST['dob'];
            $hireDate = $_POST['hiredate'];
            $address = $_POST['address'];
            $filetmp = $_FILES['file']['tmp_name'];
            $img = $name . "_" . rand(100, 1000000) . ".jpg";
            move_uploaded_file($filetmp, "../../../utils/images/admin/" . $img);
            $sql = "INSERT INTO `admin`(`name`, `username`, `password`, `phone`, `email`, `dob`, `hiredate`, `address`, `sex`, `img`)
            VALUES('$name','$username','$password','$phone','$email','$dob','$hireDate','$address','$gender', '$img')";
            $success = mysqli_query($db, $sql);
            $id = mysqli_insert_id($db);
            $userid = "ad_" . $id;
            $sql_user = "INSERT INTO users (`userid`, `name`, `username`, `password`, `user_role`)
                VALUES('$userid','$name','$username','$password','admin')";
            $success = mysqli_query($db, $sql_user) or die('Could not enter data: ' . mysqli_error($db));

            header('Location: ../account/index.php?id=' . $id . "&created=true");
        }
}

//Update Admin
if (!empty($_POST['update_admin'])) {
    $addId = $_POST['id'];
    //return var_dump($addId);
    $name = $_POST['name'];
    if (!empty($_POST['password'])) {
        $pw = $_POST['password'];
        $password = md5($pw);
    }
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    //$gender = $_POST['gender'];
    //$dob = $_POST['dob'];
    //$hiredate = $_POST['hiredate'];
    $address = $_POST['address'];
    $salary = $_POST['salary'];
    $filetmp = $_POST['file'];
    $dir = "../../utils/images/admin/";
    $img = $name . "_" . rand(100, 1000000) . ".jpg";
    // unlink($dir.$img);
    move_uploaded_file($filetmp, $dir . $img);
    $sql = "UPDATE admin SET";
    //Check to see that value is not empty so we don't replace already existing value with null😋..
    if (!empty($addId)) {
        $sql .= " id = '$addId',";
    }
    if (!empty($password)) {
        $sql .= " password = '$password',";
    }
    if (!empty($name)) {
        $sql .= " name = '$name',";
    }
    if (!empty($phone)) {
        $sql .= " phone = '$phone',";
    }
    if (!empty($email)) {
        $sql .= " email = '$email',";
    }
    // if(!empty($gender)) { $sql .= " sex = '$gender',"; }
    // if(!empty($dob)) { $sql .= " dob = '$dob',"; }
    if (!empty($img)) {
        $sql .= " img = '$img',";
    }
    if (!empty($salary)) {
        $sql .= " salary = '$salary',";
    }
    if (!empty($address)) {
        $sql .= " address = '$address',";
    }

    $sql = substr($sql, 0, strlen($sql) - 1) . " WHERE `id` = '$addId' ";
    $success = mysqli_query($db, $sql);

    // Update users table too
    $userid = "ad_" . $addId;
    $sql_user = "UPDATE users SET";
    if (!empty($password)) {
        $sql_user .= " password = '$password',";
    }
    if (!empty($name)) {
        $sql_user .= " name = '$name',";
    }
    if (!empty($username)) {
        $sql_user .= " username = '$username',";
    }

    $sql_user = substr($sql_user, 0, strlen($sql_user)) . "  user_role = 'admin' WHERE `userid` = '$userid' ";
    $success = mysqli_query($db, $sql_user) or die('Error: Could not Update data: ' . mysqli_error($db));

    header('Location: index.php?id=' . $addId . "&updated=true");
}


/**
 *  Other Staff
 * 
 */
// Init vars....
$address = $name = $phone = $role = $salary = $patreon = $email = $gender = "";

// Create staff
function create_other() {
    global $db;
    if (!empty($_FILES))
        if (!empty($_POST['add_staff'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $gender = $_POST['gender'];
            $dob = $_POST['dob'];
            $hireDate = $_POST['hiredate'];
            $address = $_POST['address'];
            //$filename = $_FILES['file']['name'];
            $filetmp = $_FILES['file']['tmp_name'];
            $img = $name . "_" . rand(100, 1000000) . ".jpg";
            move_uploaded_file($filetmp, "../../../utils/images/school_manager/" . $img);
            $sql = "INSERT INTO other_staff VALUES('$id','$name','$username','$password','$phone','$email','$address','$gender','$dob','$hireDate', '$img')";
            $success = mysqli_query($db, $sql);
            $id = mysqli_insert_id($db);
            $userid = "man_" . $id;
            $sql = "INSERT INTO users (`userid`, `name`, `username`, `password`, `user_role`)
                VALUES('$userid','$name','$username','$password','other')";
            $success = mysqli_query($db, $sql);
            if (!$success) {
                die('Could not enter data: ' . mysqli_error($db));
            }
            if ($success) {
                header('Location: ../staff/view_staff.php?id=' . $id . "&created=true");
            }
        }
}

//Update Staff
if (!empty($_POST['update_staff'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    if (!empty($_POST['password'])) {
        $pw = $_POST['password'];
        $password = md5($pw);
    }
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    //$dob = $_POST['dob'];
    $hiredate = $_POST['hiredate'];
    $address = $_POST['address'];
    $filetmp = $_FILES['file']['tmp_name'];
    if (isset($filetmp) && !empty($filetmp)) {
        $dir = "../../../utils/images/school_manager/";
        $img = $name . "_" . rand(100, 1000000) . ".jpg";
        // unlink($dir.$img.".jpg");
        move_uploaded_file($filetmp, $dir . $img);
    } else {
        $img = "";
    }
    $sql = "UPDATE other_staff SET";
    //Check to see that value is not empty so we don't replace already existing value with null😋..
    if (!empty($id)) {
        $sql .= " id = '$id',";
    }
    if (!empty($password)) {
        $sql .= " password = '$password',";
    }
    if (!empty($name)) {
        $sql .= " name = '$name',";
    }
    if (!empty($phone)) {
        $sql .= " phone = '$phone',";
    }
    if (!empty($email)) {
        $sql .= " email = '$email',";
    }
    if (!empty($username)) {
        $sql .= " username = '$username',";
    }
    if (!empty($dob)) {
        $sql .= " dob = '$dob',";
    }
    if (!empty($hiredate)) {
        $sql .= " hiredate = '$hiredate',";
    }
    if (!empty($address)) {
        $sql .= " address = '$address',";
    }
    if (!empty($img)) {
        $sql .= " img = '$img',";
    }

    $sql = substr($sql, 0, strlen($sql) - 1) . " WHERE `id` = '$id' ";
    $success = mysqli_query($db, $sql);
    // Update users table too
    $userid = "man_" . $id;
    $sql_user = "UPDATE users SET";
    if (!empty($password)) {
        $sql_user .= " password = '$password',";
    }
    if (!empty($name)) {
        $sql_user .= " name = '$name',";
    }
    if (!empty($username)) {
        $sql_user .= " username = '$username',";
    }
    $sql_user = substr($sql_user, 0, strlen($sql_user)) . "  user_role = 'other' WHERE `userid` = '$userid' ";
    $success = mysqli_query($db, $sql_user) or die('Error: Could not Update data: ' . mysqli_error($db));

    header('Location: ../staff/view_staff.php?id=' . $id . "&updated=true");
}
// Delete OTHER STAFF
if (isset($_GET['id']) && isset($_GET['delete_staff'])) {
    if ($_GET['delete_staff'] == true) {
        $id = $_GET['id'];
        $sql = "DELETE FROM other_staff WHERE id = '$id';";
        $success = mysqli_query($db, $sql);
        $userid = "man_" . $id;
        $sql = "DELETE FROM users WHERE userid = '$userid';";
        $success = mysqli_query($db, $sql);
        if (!$success) {
            die('Could not Delete data: ' . mysqli_error($db));
        }
        header("Location: ../functions/admin/staff/all_staff.php?deleted=true");
    }
}



/**
 * Student server
 * Some vars used here.
 */
$path = "../../../utils/images/students/";
$stuName = $username = $stuPhone = $stuEmail = $stuGender = $stuAddmissionDate = $stuParentId = $stuDOB = $stuAddress = $class_id = "";
// Create student...
if (isset($_POST['create_student'])) {
    $stuId = $_POST['studentId'];
    $stuName = $_POST['studentName'];
    $username = $_POST['username'];
    $stuPassword = md5($_POST['studentPassword']);
    $stuPhone = $_POST['studentPhone'];
    $stuEmail = $_POST['studentEmail'];
    $stugender = $_POST['gender'];
    $stuDOB = $_POST['stuDOB'];
    $stuAddmissionDate = $_POST['studentAddmissionDate'];
    $stuAddress = $_POST['studentAddress'];
    $stuParentId = $_POST['parentid'];
    $class_id = $_POST['class_id'];
    $filetmp = $_FILES['file']['tmp_name'];
    if (isset($filetmp) && !empty($filetmp)) {
        $dir = "../../../utils/images/students/";
        $img = $stuName . "_" . rand(100, 1000000) . ".jpg";
        // unlink($dir.$img.".jpg");
        move_uploaded_file($filetmp, $dir . $img);
    } else {
        $img = "";
    }
    $subjects = $_POST['subjects'];

    $sql = "INSERT INTO students (`name`, `username`, `password`, `phone`, `email`, `sex`, `dob`, `addmissiondate`, `address`, `parentid`, `class_id`, `img`)
         VALUES('$stuName','$username','$stuPassword','$stuPhone','$stuEmail','$stugender','$stuDOB','$stuAddmissionDate','$stuAddress','$stuParentId','$class_id', '$img')";
    $success = mysqli_query($db, $sql) or die('Could not enter data: ' . mysqli_error($db));
    $id = mysqli_insert_id($db);
    $userid = "stu_" . $id;
    $sql = "INSERT INTO users (`userid`, `name`, `username`, `password`, `user_role`)
            VALUES('$userid','$stuName','$username','$stuPassword','student')";

    $success = mysqli_query($db, $sql) or die('Could not enter data to users: ' . mysqli_error($db));
    /** Assign subjects👇🏽...👇🏽 */
    foreach ($subjects as $key => $value) {
        $subject = $subjects[$key];
        $query = "INSERT INTO student_subjects VALUES(' ', '$id', '$subject' )";
        $result = mysqli_query($db, $query) or die('Error saving to mapping table: ' . mysqli_error($db));
    }
    header('Location: ../students/view_student.php?id=' . $id . "&created=true");
}
/// UPDATE STUDENT
if (!empty($_POST['update_student'])) {
    $stuId = $_POST['studentId'];
    $stuName = $_POST['name'];
    if (!empty($_POST['password'])) {
        $pw = $_POST['password'];
        $stuPassword = md5($pw);
    }
    $stuPhone = $_POST['phone'];
    $stuEmail = $_POST['email'];
    $username = $_POST['username'];
    // $stuDOB = $_POST['dob'];
    $stuAddmissionDate = $_POST['startDate'];
    $stuAddress = $_POST['address'];
    $stuParentId = $_POST['parentid'];
    $class_id = $_POST['class_id'];
    $filetmp = $_FILES['file']['tmp_name'];

    //return var_dump($stuAddmissionDate);

    if (isset($filetmp) && !empty($filetmp)) {
        $img = $name . "_" . rand(100, 1000000) . ".jpg";

        // unlink($dir.$img.".jpg");
        move_uploaded_file($filetmp, "../../../utils/images/students/" . $img);
    } else {
        $img = "";
    }
    $sql = "UPDATE students SET";
    //Check for data imputed before proceeding to proccessing it.
    if (!empty($stuName)) {
        $sql .= " name='$stuName',";
    }
    if (!empty($stuPassword)) {
        $sql .= " password = '$stuPassword',";
    }
    if (!empty($stuPhone)) {
        $sql .= " phone = '$stuPhone',";
    }
    if (!empty($stuEmail)) {
        $sql .= " email = '$stuEmail',";
    }
    if (!empty($img)) {
        $sql .= " img='$img',";
    }
    if (!empty($username)) {
        $sql .= " username = '$username',";
    }
    if (!empty($stuAddmissionDate)) {
        $sql .= " addmissiondate = '$stuAddmissionDate',";
    }
    if (!empty($stuAddress)) {
        $sql .= " address = '$stuAddress',";
    }
    if (!empty($stuParentId)) {
        $sql .= " parentid = '$stuParentId',";
    }
    if (!empty($class_id)) {
        $sql .= " class_id = '$class_id',";
    }
    $sql = substr($sql, 0, strlen($sql) - 1) . " WHERE id = '$stuId' ";
    $success = mysqli_query($db, $sql);

    $sql = substr($sql, 0, strlen($sql) - 1) . " WHERE `id` = '$stuId' ";
    $success = mysqli_query($db, $sql);
    // Update users table too
    $userid = "stu_" . $stuId;
    $sql_user = "UPDATE users SET";
    if (!empty($stuPassword)) {
        $sql_user .= " password = '$stuPassword',";
    }
    if (!empty($stuName)) {
        $sql_user .= " name = '$stuName',";
    }
    if (!empty($username)) {
        $sql_user .= " username = '$username',";
    }
    $sql_user = substr($sql_user, 0, strlen($sql_user)) . "  user_role = 'student' WHERE `userid` = '$userid' ";
    $success = mysqli_query($db, $sql_user) or die('Error: Could not Update data: ' . mysqli_error($db));

    if (isset($_POST['subjects'])) {
        $subjects = $_POST['subjects'];
        // EMPTY RECORDS FROM 'student_subjects' FOR CLASS...
        $delete = mysqli_query($db, "DELETE FROM student_subjects WHERE student_id ='$stuId' ") or die('An error occured : ' . mysqli_error($db));
        // NOW ADD NEW RECORDEDS WITH UPDATED DATA...
        $stuId = $_POST['studentId'];
        foreach ($subjects as $key => $value) {
            $subject = $subjects[$key];
            $query = "INSERT INTO student_subjects VALUES(' ', '$stuId', '$subject' )";
            $result = mysqli_query($db, $query) or die('Error saving to mapping table: ' . mysqli_error($db));
        }
    }
    header('Location: view_student.php?id=' . $stuId . '&updated=true');
}

//DELETE Student...
if (isset($_GET['id']) && isset($_GET['delete_student'])) {
    if ($_GET['delete_student'] == true) {
        $id = $_GET['id'];
        $sql = "DELETE FROM students WHERE id = '$id';";
        $success = mysqli_query($db, $sql);
        $userid = "stu_" . $id;
        $sql = "DELETE FROM users WHERE userid = '$userid';";
        $success = mysqli_query($db, $sql);
        if (!$success) {
            die('Could not Delete data: ' . mysqli_error($db));
        }
        //unlink('../images/'.$id.'.jpg');  // @TODO: Figure out routing.. Check TD list
        header("Location: ../functions/admin/students/all_students.php?deleted=true");
    }
}

if (isset($_GET['id']) && isset($_GET['delete_school'])) {
    if ($_GET['delete_school'] == true) {

        $id = $_GET['id'];
        $sql = "DELETE FROM schools WHERE school_id = '$id';";
        $success = mysqli_query($db, $sql);
        if (!$success) {
            die('Could not Delete data: ' . mysqli_error($db));
        }
        //unlink('../images/'.$id.'.jpg');  // @TODO: Figure out routing.. Check TD list
        header("Location: ../functions/admin/school/all_schools.php?deleted=true");
    }
}

/**
 * Parent Server!!!
 */
// Create Parent
if (isset($_POST['submit_parent'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $fathername = $_POST['fathername'];
    $mothername = $_POST['mothername'];
    $fatherphone = $_POST['fatherphone'];
    $motherphone = $_POST['motherphone'];
    $address = $_POST['address'];
    $sql = "INSERT INTO
            `parents`(`username`, `email`, `password`, `fathername`, `mothername`, `fatherphone`, `motherphone`, `address`) 
            VALUES('$username','$email','$password','$fathername','$mothername','$fatherphone','$motherphone','$address')";
    $success = mysqli_query($db, $sql) or die('Could not enter data: ' . mysqli_error($db));
    $id = mysqli_insert_id($db);
    $userid = "pa_" . $id;
    $sql_user = "INSERT INTO users (`userid`, `name`, `username`, `password`, `user_role`)
                    VALUES('$userid','$mothername','$username','$password','parent')";
    $success = mysqli_query($db, $sql_user) or die('Could not enter data: ' . mysqli_error($db));
    ;
    if ($success) {
        header('Location: ../parents/view_parent.php?id=' . $id . "&created=true");
    }
}
//Update Parent
if (!empty($_POST['update_parent'])) {
    $id = $_POST['id'];
    if (!empty($_POST['password'])) {
        $pw = $_POST['password'];
        $password = md5($pw);
    }
    $username = $_POST['username'];
    $email = $_POST['email'];
    $fathername = $_POST['fathername'];
    $mothername = $_POST['mothername'];
    $fatherphone = $_POST['fatherphone'];
    $motherphone = $_POST['motherphone'];
    $address = $_POST['address'];

    $sql = "UPDATE parents SET";
    //Check to see that value is not empty so we don't replace already existing value with null😋..
    if (!empty($username)) {
        $sql .= " username = '$username',";
    }
    if (!empty($email)) {
        $sql .= " email = '$email',";
    }
    if (!empty($password)) {
        $sql .= " password = '$password',";
    }
    if (!empty($fathername)) {
        $sql .= " fathername = '$fathername',";
    }
    if (!empty($mothername)) {
        $sql .= " mothername = '$mothername',";
    }
    if (!empty($fatherphone)) {
        $sql .= " fatherphone = '$fatherphone',";
    }
    if (!empty($motherphone)) {
        $sql .= " motherphone = '$motherphone',";
    }
    if (!empty($address)) {
        $sql .= " address = '$address',";
    }

    $sql = substr($sql, 0, strlen($sql) - 1) . " WHERE `id` = '$id' ";
    $success = mysqli_query($db, $sql) or die('Error: Could not Update data: ' . mysqli_error($db));
    // Update users table too
    $userid = "pa_" . $id;
    $sql_user = "UPDATE users SET";
    if (!empty($password)) {
        $sql_user .= " password = '$password',";
    }
    if (!empty($mothername)) {
        $sql_user .= " name = '$mothername',";
    }
    if (!empty($username)) {
        $sql_user .= " username = '$username',";
    }
    $sql_user = substr($sql_user, 0, strlen($sql_user)) . " userid = '$userid', user_role = 'parent' WHERE `userid` = '$userid' ";
    $success = mysqli_query($db, $sql_user) or die('Error: Could not Update data: ' . mysqli_error($db));

    header('Location: ../parents/view_parent.php?id=' . $id . "&" . $updated = true);
}
// Delete Parent
if (isset($_GET['id']) && isset($_GET['delete_parent'])) {
    if ($_GET['delete_parent'] == true) {
        $id = $_GET['id'];
        $sql = "DELETE FROM parents WHERE id = '$id';";
        $success = mysqli_query($db, $sql);
        $userid = "pa_" . $id;
        $sql = "DELETE FROM users WHERE userid = '$userid';";
        $success = mysqli_query($db, $sql);
        if (!$success) {
            die('Could not Delete data: ' . mysqli_error($db));
        }
        //unlink('../images/'.$id.'.jpg');  // @TODO: Figure out routing.. Check TD list
        header("Location: ../functions/admin/parents/all_parents.php?deleted=true");
    }
}



/**
 * Hostels Server!!!
 */
// Create Hostel
if (isset($_POST['add_hostel'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $beds = $_POST['beds'];
    $patreon = $_POST['patreon'];
    $sql = "INSERT INTO hostels VALUES('$id','$name','$beds','$patreon')";
    $success = mysqli_query($db, $sql);
    if (!$success) {
        die('Could not enter data: ' . mysqli_error($db));
    } else {
        $id = mysqli_insert_id($db);
        header('Location: ../hostels/view_hostel.php?id=' . $id . "&created=true");
    }
}
// Update Hostel
if (!empty($_POST['update_hostel'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $beds = $_POST['beds'];
    $patreon = $_POST['patreon'];

    $sql = "UPDATE hostels SET";
    //Check to see that value is not empty so we don't replace already existing value with null😋..
    if (!empty($name)) {
        $sql .= " name = '$name',";
    }
    if (!empty($beds)) {
        $sql .= " beds = '$beds',";
    }
    if (!empty($patreon)) {
        $sql .= " patreon = '$patreon',";
    }

    $sql = substr($sql, 0, strlen($sql) - 1) . " WHERE `id` = '$id' ";
    $success = mysqli_query($db, $sql);
    if (!$success) {
        die('Could not Update data: ' . mysqli_error($db));
    } else {
        header('Location: ../hostels/view_hostel.php?id=' . $id . "&" . $updated = true);
    }
}
// Delete Hostel
if (isset($_GET['id']) && isset($_GET['delete_hostel'])) {
    if ($_GET['delete_hostel'] == true) {
        $id = $_GET['id'];
        $sql = "DELETE FROM hostels WHERE id = '$id';";
        $success = mysqli_query($db, $sql);
        if (!$success) {
            die('Could not Delete data: ' . mysqli_error($db));
        }
        header("Location: ../functions/admin/hostels/all_hostels.php?deleted=true");
    }
}



/**
 * 
 *      ACCADEMICS... 
 */
// Create FACULTY...
if (isset($_POST['create_faculty'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $dean = $_POST['dean'];

    $sql = "INSERT INTO faculties VALUES('$id','$name','$dean')";
    $success = mysqli_query($db, $sql) or die('Could not enter data: ' . mysqli_error($db));
    if ($success) {
        $id = mysqli_insert_id($db);
        header('Location: ../faculties/index.php?id=' . $id . "&created=true");
    }
}
/// UPDATE Faculty
if (!empty($_POST['update_faculty'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $dean = $_POST['dean'];
    $sql = "UPDATE faculties SET";
    //Check for data imputed before proceeding to proccessing it.
    if (!empty($name)) {
        $sql .= " name='$name',";
    }
    if (!empty($dean)) {
        $sql .= " dean_id = '$dean',";
    }

    $sql = substr($sql, 0, strlen($sql) - 1) . " WHERE id = '$id' ";
    $success = mysqli_query($db, $sql);

    if (!$success) {
        die('An error occured : ' . mysqli_error($db));
    } elseif (isset($success)) {
        header('Location: index.php?id=' . $id . "&updated=true");
    }
}

//DELETE SCHOOL...
if (isset($_GET['id']) && isset($_GET['delete_faculty'])) {
    if ($_GET['delete_faculty'] == true) {
        $id = $_GET['id'];
        $sql = "DELETE FROM faculties WHERE id = '$id';";
        $success = mysqli_query($db, $sql);
        if (!$success) {
            die('Could not Delete data: ' . mysqli_error($db));
        }
        header("Location: ../functions/admin/");
    }
}


/**
 * 
 *      ACCADEMICS... 
 */
// Create SUBJECT...
if (isset($_POST['create_program'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];

    $sql = "INSERT INTO subjects VALUES('$id','$name')";
    $success = mysqli_query($db, $sql) or die('Could not enter data: ' . mysqli_error($db));
    if ($success) {
        $_SESSION['created'] = "Added successfully";
        $id = mysqli_insert_id($db);
        header('Location: ../subjects/index.php?created=true');
    }
}
/// UPDATE SUBJECT
if (!empty($_POST['update_subject'])) {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $sql = "UPDATE subjects SET";

    $sql .= " name='$name'";

    $sql .= " WHERE id = '$id' ";

    echo $name;
    $success = mysqli_query($db, $sql);

    if (!$success) {
        die('An error occured : ' . mysqli_error($db));
    } elseif (isset($success)) {
        header('Location: index.php?id=' . $id . '&updated=true');
    }
}

//DELETE SUBJECT...
if (isset($_GET['id']) && isset($_GET['delete_subject'])) {
    if ($_GET['delete_subject'] == true) {
        $id = $_GET['id'];
        $sql = "DELETE FROM subjects WHERE id = '$id';";
        $success = mysqli_query($db, $sql);
        if (!$success) {
            die('Could not Delete data: ' . mysqli_error($db));
        }
        header("Location: ../functions/admin/subjects/");
    }
}


/**
 * 
 *      ACCADEMICS... 
 */
// Create CLASS...
if (isset($_POST['create_class'])) {
    $room = "";
    $id = $_POST['id'];
    $name = $_POST['name'];
    $teacher = $_POST['teacher'];
    $room = $_POST['room'];

    $sql = "INSERT INTO  `classes`(`name`, `teacher_id`, `room`) 
                        VALUES('$name','$teacher', '$room')";
    $success = mysqli_query($db, $sql) or die('Could not enter data: ' . mysqli_error($db));

    $class_id = mysqli_insert_id($db);

    $_SESSION['created'] = "Added successfully";
    header('Location: ../classes/index.php?created=true');
}
/// UPDATE CLASS
if (!empty($_POST['update_class'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $teacher = $_POST['teacher'];
    $room = $_POST['room'];

    $sql = "UPDATE classes SET";
    if (!empty($name)) {
        $sql .= " name='$name',";
    }
    if (!empty($teacher)) {
        $sql .= " teacher_id ='$teacher',";
    }
    if (!empty($monitor)) {
        $sql .= " monitor_id = '$monitor',";
    }
    if (!empty($room)) {
        $sql .= " room = '$room',";
    }

    $sql = substr($sql, 0, strlen($sql) - 1) . " WHERE id = '$id' ";
    $success = mysqli_query($db, $sql) or die('An error occured : ' . mysqli_error($db));

    $_SESSION['edited'] = "Edited successfully";
    header('Location: index.php?id=' . $id . '&updated=true');
}

//DELETE CLASS...
if (isset($_GET['id']) && isset($_GET['delete_class'])) {
    if ($_GET['delete_class'] == true) {
        $id = $_GET['id'];
        $sql = "DELETE FROM classes WHERE id = '$id';";
        $success = mysqli_query($db, $sql);
        if (!$success) {
            die('Could not Delete data: ' . mysqli_error($db));
        }
        $_SESSION['deleted'] = "Deleted successfully";
        header("Location: ../functions/admin/classes/");
    }
}


/**
 * 
 *      ASSIGN SUBJECT AND CLASS TO TEACHER... 
 */
// Assign...
if (isset($_POST['assign_subject'])) {
    $id = $_POST['id'];
    $teacher_id = $_POST['teacher'];
    $subject_id = $_POST['subject'];

    $classes = $_POST['classes'];

    foreach ($classes as $key => $value) {
        $class_id = $classes[$key];
        $query = "INSERT INTO teacher_subject_class VALUES(' ', '$teacher_id', '$subject_id', '$class_id' )";
        $result = mysqli_query($db, $query) or die('Error saving to mapping table: ' . mysqli_error($db));
    }
    $_SESSION['created'] = "Added successfully";
    header('Location: ../subjects/view_assigned.php?created=true');
}



/**
 *   ACCADEMICS... GRADES SERVER
 */
// Create GRADE...
if (isset($_POST['create_grade'])) {
    $id = "";
    $name = $_POST['name'];
    $min = $_POST['min'];
    $max = $_POST['max'];

    $sql = "INSERT INTO grades (`name`,`min_value`,`max_value`) VALUES('$name','$min','$max')";
    $success = mysqli_query($db, $sql) or die('Could not enter data: ' . mysqli_error($db));
    if ($success) {
        header('Location: ../grades/index.php?created=true');
    }
}
/// UPDATE GRADE
if (!empty($_POST['update_grade'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $min = $_POST['min'];
    $max = $_POST['max'];

    $sql = "UPDATE grades SET";
    if (!empty($name)) {
        $sql .= " name='$name',";
    }
    if (!empty($min)) {
        $sql .= " min_value='$min',";
    }
    if (!empty($max)) {
        $sql .= " max_value='$max',";
    }

    $sql = substr($sql, 0, strlen($sql) - 1) . " WHERE id = '$id' ";
    $success = mysqli_query($db, $sql) or die('An error occured : ' . mysqli_error($db));
    header('Location: index.php?id=' . $id . '&updated=true');
}

//DELETE GRADE...
if (isset($_GET['id']) && isset($_GET['delete_grade'])) {
    if ($_GET['delete_grade'] == true) {
        $id = $_GET['id'];
        $sql = "DELETE FROM grades WHERE id = '$id';";
        $success = mysqli_query($db, $sql);
        if (!$success) {
            die('Could not Delete data: ' . mysqli_error($db));
        }
        header("Location: ../functions/admin/grades/index.php?deleted=true");
    }
}




/**
 * 
 * SCHOOL INFO SERVER
 */
// Create SCHOOL...
if (isset($_POST['create_school'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $dn = $_POST['dn'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $tag = $_POST['tag'];
    $est = $_POST['est'];
    $location = $_POST['location'];
    $address = $_POST['address'];
    $filetmp = $_FILES['file']['tmp_name'];
    if (isset($filetmp) && !empty($filetmp)) {
        $dir = "../../../utils/images/school_info/";
        $img = "logo_" . rand(100, 1000000) . ".jpg";

        move_uploaded_file($filetmp, $dir . $img);
    } else {
        $img = "";
    }

    if ($dn == trim($dn) && strpos($dn, ' ') !== false) {
        $dn_error = "Error. Display Name Must Have No Spaces";
        return;
    }

    $sql = "INSERT INTO `school_info`(`id`, `name`, `tag`, `dn`, `logo`, `location`, `address`, `phone`, `email`, `est`) 
                                VALUES('$id','$name','$tag', '$dn','$img','$location','$address','$phone','$email','$est')";
    $success = mysqli_query($db, $sql) or die('Could not enter data: ' . mysqli_error($db));
    if ($success) {
        $id = mysqli_insert_id($db);
        header('Location: ../school_info/index.php?id=' . $id . "&created=true");
    }
}
/// UPDATE SCHOOL
if (!empty($_POST['update_school'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $dn = $_POST['dn'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $tag = $_POST['tag'];
    $est = $_POST['est'];
    $location = $_POST['location'];
    $address = $_POST['address'];
    $filetmp = $_FILES['file']['tmp_name'];
    if (isset($filetmp) && !empty($filetmp)) {
        $dir = "../../../utils/images/school_info/";
        $img = "logo_" . rand(100, 1000000) . ".jpg";

        move_uploaded_file($filetmp, $dir . $img);
    } else {
        $img = "";
    }

    if ($dn == trim($dn) && strpos($dn, ' ') !== false) {
        $dn_error = "Error. Display Name Must Have No Spaces";
        return;
    }

    $sql = "UPDATE school_info SET";
    //Check for data imputed before proceeding to proccessing it.
    if (!empty($name)) {
        $sql .= " name='$name',";
    }
    if (!empty($phone)) {
        $sql .= " phone = '$phone',";
    }
    if (!empty($email)) {
        $sql .= " email = '$email',";
    }
    if (!empty($tag)) {
        $sql .= " tag = '$tag',";
    }
    if (!empty($dn)) {
        $sql .= " dn = '$dn',";
    }
    if (!empty($est)) {
        $sql .= " est='$est',";
    }
    if (!empty($location)) {
        $sql .= " location = '$location',";
    }
    if (!empty($address)) {
        $sql .= " address = '$address',";
    }
    if (!empty($img)) {
        $sql .= " logo = '$img',";
    }
    $sql = substr($sql, 0, strlen($sql) - 1) . " WHERE id = '$id' ";
    $success = mysqli_query($db, $sql);

    if (!$success) {
        die('An error occured : ' . mysqli_error($db));
    } elseif (isset($success)) {
        header('Location: index.php?id=' . $id . "&updated=true");
    }
}

//DELETE SCHOOL...      Deleting school is NOT allowed at the moment...
if (isset($_GET['id']) && isset($_GET['delete_school'])) {
    if ($_GET['delete_student'] == true) {
        $id = $_GET['id'];
        $sql = "DELETE FROM school_info WHERE id = '$id';";
        $success = mysqli_query($db, $sql);
        if (!$success) {
            die('Could not Delete data: ' . mysqli_error($db));
        }
        //unlink('../images/'.$id.'.jpg');  // @TODO: Figure out routing.. Check TD list
        header("Location: ../functions/admin/");
    }
}





/**
 * 
 * SCHOOL SETTINGS
 */
// Create SETTINGS...
if (isset($_POST['create_settings'])) {
    $total_term_fees = $_POST['total_term_fees'];
    $currency = $_POST['currency'];

    $date_due_1_day = $_POST['date_due_1_day'];
    $date_due_1_month = $_POST['date_due_1_month'];
    $date_due_1 = $date_due_1_month . "-" . $date_due_1_day;

    $date_due_2_day = $_POST['date_due_2_day'];
    $date_due_2_month = $_POST['date_due_2_month'];
    $date_due_2 = $date_due_2_month . "-" . $date_due_2_day;

    $date_due_3_day = $_POST['date_due_3_day'];
    $date_due_3_month = $_POST['date_due_3_month'];
    $date_due_3 = $date_due_3_month . "-" . $date_due_3_day;

    $sql = "INSERT INTO `settings`(`total_term_fees`, `date_due_1`, `date_due_2`, `date_due_3`, `currency`)
                        VALUES('$total_term_fees','$date_due_1','$date_due_2','$date_due_3','$currency' )";
    //return var_dump($sql);

    $success = mysqli_query($db, $sql) or die('Could not enter data: ' . mysqli_error($db));
    $id = mysqli_insert_id($db);
    header('Location: ../settings/index.php?id=' . $id . '&created=true');
}
/// UPDATE SETTINGS
if (!empty($_POST['update_seetings'])) {
    $id = $_POST['id'];
    $total_term_fees = $_POST['total_term_fees'];
    $currency = $_POST['currency'];

    $date_due_1_day = $_POST['date_due_1_day'];
    $date_due_1_month = $_POST['date_due_1_month'];
    $date_due_1 = $date_due_1_month . "-" . $date_due_1_day;

    $date_due_2_day = $_POST['date_due_2_day'];
    $date_due_2_month = $_POST['date_due_2_month'];
    $date_due_2 = $date_due_2_month . "-" . $date_due_2_day;

    $date_due_3_day = $_POST['date_due_3_day'];
    $date_due_3_month = $_POST['date_due_3_month'];
    $date_due_3 = $date_due_3_month . "-" . $date_due_3_day;

    $sql = "UPDATE settings SET";
    //Check for data imputed before proceeding to proccessing it.
    if (!empty($total_term_fees)) {
        $sql .= " total_term_fees='$total_term_fees',";
    }
    if (!empty($currency)) {
        $sql .= " currency = '$currency',";
    }
    if (!empty($date_due_1)) {
        $sql .= " date_due_1 = '$date_due_1',";
    }
    if (!empty($date_due_2)) {
        $sql .= " date_due_2 = '$date_due_2',";
    }
    if (!empty($date_due_3)) {
        $sql .= " date_due_3='$date_due_3',";
    }

    $sql = substr($sql, 0, strlen($sql) - 1) . " WHERE id = '$id' ";
    $success = mysqli_query($db, $sql) or die('Could not update data: ' . mysqli_error($db));

    header('Location: index.php?id=' . $id . '&updated=true');
}

//DELETE SETTINGS...      Deleting SETTINGS is NOT allowed at the moment...
if (isset($_GET['id']) && isset($_GET['delete_settings'])) {
    if ($_GET['delete_student'] == true) {
        $id = $_GET['id'];
        $sql = "DELETE FROM school_info WHERE id = '$id';";
        $success = mysqli_query($db, $sql);
        if (!$success) {
            die('Could not Delete data: ' . mysqli_error($db));
        }
        //unlink('../images/'.$id.'.jpg');  // @TODO: Figure out routing.. Check TD list
        header("Location: ../functions/admin/");
    }
}
