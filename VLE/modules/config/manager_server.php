<?php
include_once('config.php');



//Update Manager
if(!empty($_POST['update_manager'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $password = md5($_POST['password']);
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    //$dob = $_POST['dob'];
    $hiredate = $_POST['hiredate'];
    $address = $_POST['address'];
    $filetmp =$_FILES['file']['tmp_name'];
    if(isset($filetmp) && !empty($filetmp)){
        $dir = "../../../utils/images/school_manager/";
        $img = $name."_".rand(100,1000000).".jpg";
        // unlink($dir.$img.".jpg");
        move_uploaded_file($filetmp, $dir.$img);  
    }else{
        $img = "";
    }
    $sql = "UPDATE managers SET";
    //Check to see that value is not empty so we don't replace already existing value with null😋..
    if(!empty($id)) { $sql .= " id = '$id',"; }
    if(!empty($password)) { $sql .= " password = '$password',"; }
    if(!empty($name)) { $sql .= " name = '$name',"; }
    if(!empty($phone)) { $sql .= " phone = '$phone',"; }
    if(!empty($email)) { $sql .= " email = '$email',"; }
    if(!empty($username)) { $sql .= " username = '$username',"; }
    if(!empty($dob)) { $sql .= " dob = '$dob',"; }
    if(!empty($hiredate)) { $sql .= " hiredate = '$hiredate',"; }
    if(!empty($address)) { $sql .= " address = '$address',"; }
    if(!empty($img)) { $sql .= " img = '$img',"; }

    $sql = substr($sql, 0, strlen($sql) -1) . " WHERE `id` = '$id' ";
    $success = mysqli_query($db, $sql);
    // Update users table too
    $sql_user = "UPDATE users SET";
    if(!empty($password)) { $sql_user .= " password = '$password',"; }
    if(!empty($name)) { $sql_user .= " name = '$name',"; }
    if(!empty($username)) { $sql_user .= " username = '$username',"; }
    $sql_user = substr($sql_user, 0, strlen($sql_user) ) . "  user_role = 'manager' WHERE `userid` = '$id' ";
    $success = mysqli_query($db, $sql_user)or die('Error: Could not Update data: '.mysqli_error($db));
    
    header('Location: ../school_manager/view_manager.php?id='.$id."&updated=true");
}



/**
 *  EVENTS SERVER - MANAGER... 
 */

// Create Event...
if(isset($_POST['create_event'])){
    $id = "";
    $type = $_POST['type'];
    $name = $_POST['name'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $description = $_POST['description'];
    $created_by = $_POST['created_by'];

    $start_time = ' '.$_POST['s_time_H'].':'.$_POST['s_time_M'].':00'; 
    $end_time = ' '.$_POST['e_time_H'].':'.$_POST['e_time_M'].':00'; 
    
    $start_date = $start_date.$start_time;
    $end_date = $end_date.$end_time;

    $sql = " INSERT INTO `calendar`
                    (`id`, `type`, `name`, `description`, `start_date`, `end_date`, `created_by`) 
            VALUES ('$id','$type','$name','$description','$start_date','$end_date','$created_by' ) ";
    
    $success = mysqli_query($db, $sql)or die('Could not enter data: '.mysqli_error($db));
    if($success) {
        $id = mysqli_insert_id($db);
        header('Location: ../events/index.php?created=true');
    }
}
/// UPDATE Event
if(!empty($_POST['update_event'])){
    $id = $_POST['id'];

    $type = $_POST['type'];
    $name = $_POST['name'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $description = $_POST['description'];

    $start_time = ' '.$_POST['s_time_H'].':'.$_POST['s_time_M'].':00'; 
    $end_time = ' '.$_POST['e_time_H'].':'.$_POST['e_time_M'].':00'; 

    // return var_dump($start_time.' - '.$end_time);

    if(!empty($start_date)){$start_date = $start_date.$start_time; }
    if(!empty($end_date)){$end_date = $end_date.$end_time; }
    
    $sql = "UPDATE calendar SET";
    if(!empty($type)) {$sql .= " type='$type',";}
    if(!empty($name)) {$sql .= " name='$name',";}
    if(!empty($start_date)) {$sql .= " start_date='$start_date',";}
    if(!empty($end_date)) {$sql .= " end_date='$end_date',";}
    if(!empty($description)) {$sql .= " description='$description',";}

    $sql = substr($sql, 0, strlen($sql) -1) . " WHERE id = '$id' ";
    $success = mysqli_query($db, $sql)or die('An error occu: '.mysqli_error($db));
    
    header('Location: index.php?id='.$id.'&updated=true');
}

//DELETE Event...
if(isset($_GET['id']) && isset($_GET['delete_event']) ) {
    if($_GET['delete_event'] == true){
        $id = $_GET['id'];
        $sql = "DELETE FROM calendar WHERE id = '$id';";
        $success = mysqli_query($db, $sql);
        if(!$success) {
            die('Could not Delete data: '.mysqli_error($db));
        }
        header("Location: ../functions/manager/events/index.php?deleted=true");
    }
}




/**
 *  Announcements SERVER - Manager... 
 */

// Create Announcements...
if(isset($_POST['create_announcement'])){
    $id = "";
    $title = $_POST['title'];
    $name = mysqli_real_escape_string($db,$_POST['name']);
    $audience = $_POST['audience'];
    $date = $_POST['date'];
    $created_by = $_POST['created_by'];

    $sql = " INSERT INTO `announcements`
                    (`title`, `name`,`audience`, `date`, `created_by`) 
            VALUES ('$title','$name', '$audience', '$date','$created_by' ) ";
    
    $success = mysqli_query($db, $sql)or die('Could not enter data: '.mysqli_error($db));
    if($success) {
        $id = mysqli_insert_id($db);
        header('Location: ../announcements/index.php?created=true');
    }
}
/// UPDATE Announcement
if(!empty($_POST['update_announcement'])){
    $id = $_POST['id'];

    $title = $_POST['title'];
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $audience = $_POST['audience'];
    $date = $_POST['date'];

    $sql = "UPDATE announcements SET";
    if(!empty($title)) {$sql .= " title='$title',";}
    if(!empty($name)) {$sql .= " name='$name',";}
    if(!empty($audience)) {$sql .= " audience ='$audience',";}
    if(!empty($date)) {$sql .= " date='$date',";}

    $sql = substr($sql, 0, strlen($sql) -1) . " WHERE id = '$id' ";
    $success = mysqli_query($db, $sql)or die('An error occured: '.mysqli_error($db));
    
    header('Location: index.php?id='.$id.'&updated=true');
}

//DELETE Announcement...
if(isset($_GET['id']) && isset($_GET['delete_announcement']) ) {
    if($_GET['delete_announcement'] == true){
        $id = $_GET['id'];
        $sql = "DELETE FROM announcements WHERE id = '$id';";
        $success = mysqli_query($db, $sql);
        if(!$success) {
            die('Could not Delete data: '.mysqli_error($db));
        }
        header("Location: ../functions/manager/announcements/index.php?deleted=true");
    }
}



