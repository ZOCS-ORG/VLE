
<?php
include_once('config.php');

/// UPDATE STUDENT
if(!empty($_POST['update_student'])){
    $stuId = $_POST['id'];
    $stuName = $_POST['name'];
    if(!empty($_POST['password']) ) 
    { $pw = $_POST['password']; $stuPassword = md5($pw); }
    $stuPhone = $_POST['phone'];
    $stuEmail = $_POST['email'];
    $username = $_POST['username'];
    // $stuDOB = $_POST['dob'];
    $stuAddmissionDate = $_POST['startDate'];
    $stuAddress = $_POST['address'];
    $stuParentId = $_POST['parentid'];
    $class_id = $_POST['class_id'];
    $filetmp =$_FILES['file']['tmp_name'];

    //return var_dump($stuAddmissionDate);

    if(isset($filetmp) && !empty($filetmp)){
        $img = $name."_".rand(100,1000000).".jpg";
        
        // unlink($dir.$img.".jpg");
        move_uploaded_file($filetmp, "../../../utils/images/students/".$img);  
    }else{
        $img = "";
    }
    $sql = "UPDATE students SET";
    //Check for data imputed before proceeding to proccessing it.
    if(!empty($stuName)) {$sql .= " name='$stuName',";}
    if(!empty($stuPassword)) {$sql .=" password = '$stuPassword',"; }
    if(!empty($stuPhone)){$sql .= " phone = '$stuPhone',";}
    if(!empty($stuEmail)){$sql .= " email = '$stuEmail',";}
    if(!empty($img)) {$sql .= " img='$img',";}
    if(!empty($username)) {$sql .=" username = '$username',"; }
    if(!empty($stuAddmissionDate)){$sql .= " addmissiondate = '$stuAddmissionDate',";}
    if(!empty($stuAddress)){$sql .= " address = '$stuAddress',";}
    if(!empty($class_id)) {$sql .=" class_id = '$class_id',"; }
    $sql = substr($sql, 0, strlen($sql) -1) . " WHERE id = '$stuId' ";
    $success = mysqli_query($db, $sql);

    $sql = substr($sql, 0, strlen($sql) -1) . " WHERE `id` = '$stuId' ";
    $success = mysqli_query($db, $sql);
    // Update users table too
    $userid = "stu_".$stuId;
    $sql_user = "UPDATE users SET";
    if(!empty($stuPassword)) { $sql_user .= " password = '$stuPassword',"; }
    if(!empty($stuName)) { $sql_user .= " name = '$stuName',"; }
    if(!empty($username)) { $sql_user .= " username = '$username',"; }
    $sql_user = substr($sql_user, 0, strlen($sql_user) ) . "  user_role = 'student' WHERE `userid` = '$userid' ";
    $success = mysqli_query($db, $sql_user)or die('Error: Could not Update data: '.mysqli_error($db));

    if(isset($_POST['subjects'])){
        $subjects = $_POST['subjects'];
        // EMPTY RECORDS FROM 'student_subjects' FOR CLASS...
        $delete = mysqli_query($db, "DELETE FROM student_subjects WHERE student_id ='$stuId' ")or die('An error occured : '.mysqli_error($db));
        // NOW ADD NEW RECORDEDS WITH UPDATED DATA...
        $stuId = $_POST['studentId'];
        foreach ($subjects as $key => $value) {
            $subject = $subjects[$key];
            $query = "INSERT INTO student_subjects VALUES(' ', '$stuId', '$subject' )";
            $result = mysqli_query($db, $query)or die('Error saving to mapping table: '.mysqli_error($db)); 
        }
    }
    header('Location: myprofile.php?id='.$stuId.'&updated=true');
}