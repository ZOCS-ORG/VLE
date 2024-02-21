<?php
require '../includes/connect.php';


/**
 *  ATTENDANCE Server!!!
 */
// Create Attendance
if(isset($_POST['submmit_attendance'])){
    $id = "";
    $class_id = $_POST['class_id'];
    $teacher_id = $_POST['teacher_id'];
    // Arrays
    $students = $_POST['students'];
    $attentance = $_POST['attendance'];

    array_map(function($student, $status) {
        global $db, $class_id, $teacher_id;
        if(!empty($_POST['date']) ){$date = $_POST['date']; }
        else{$date = date('Y-m-d');}
        $query = "INSERT INTO `attendance`(`class_id`, `student_id`, `teacher_id`, `status`, `date`)
                                VALUES('$class_id','$student','$teacher_id', '$status', '$date')";
        $result = mysqli_query($db, $query)or die('Error saving data: '.mysqli_error($db));

    }, $students,$attentance);
    header('Location: ../attendance/register.php?created=true&class='.$class_id);
}


/**
 *  Results Server!!!
 */
// Create Results
if(isset($_POST['submmit_results'])){

    $student_id = $_POST['student_id'];
    $class_id = $_POST['class_id'];
    $subject_id = $_POST['subject_id'];
    $marks = $_POST['marks'];
    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $ass_id = $_POST['ass_id'];

    if(!empty($_POST['date']) ){$date = $_POST['date']; }
    else{$date = date('Y-m-d');}

    $query = "INSERT INTO `results`(`student_id`, `class_id`, `subject_id`, `marks`,`name`, `date`, `comment`)
                            VALUES('$student_id','$class_id','$subject_id','$marks', '$name', '$date','$comment')";        
    $result = mysqli_query($db, $query)or die('Error saving data: '.mysqli_error($db));

    if($result){
        $query = "UPDATE `assignments` SET graded = 'yes' WHERE student_id = '$student_id' && question_id = '$ass_id' ";        
        $result = mysqli_query($db, $query)or die('Error saving data: '.mysqli_error($db));
    }
    
    
                // array_map(function($student, $mark, $comment) {
                //     global $db;
                //     $id = "";
                
                // }, $students,$marks, $comments);
                    $_SESSION['created'] = "true";
    header("Location: view_ass_notice.php?ass_id=".$ass_id."&class_id=".$class_id."&sub_id=".$subject_id."&created=true" );
}

/** UPDATE RESULTS */
if(isset($_POST['update_results'])){
    
    $class_id = $_POST['class_id'];
    $subject_id = $_POST['subject_id'];
    $default_name = $_POST['default_name'];
    $name = $_POST['name'];
    if(empty($name)){$name = $default_name;}

    // Arrays
    $result_ids = $_POST['result_ids'];
    $marks = $_POST['marks'];
    $comments = $_POST['comment'];
    
    array_map(function($result_id, $mark, $comment) {
        global $name, $db;
        $id = "";

        $sql = "UPDATE results SET";
        if(!empty($name)) {$sql .= " name='$name',";}
        if(!empty($mark)) {$sql .= " marks ='$mark',";}
        if(!empty($comment)) {$sql .=" comment = '$comment',"; }
        
        $sql = substr($sql, 0, strlen($sql) -1) . " WHERE id = '$result_id' ";
        
        //return var_dump($sql);
        $success = mysqli_query($db, $sql)or die('An error occured : '.mysqli_error($db));
        
    }, $result_ids,$marks, $comments);

    header('Location: ../results/view_results.php?subject='.$subject_id.'&class='.$class_id.'&name='.$name);
}





/**
 * 
 *      EVENTS SERVER - TEACHER... 
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

    $start_time = ' 14:20:00';  $end_time = ' 17:20:00';
    
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

    $start_time = ' 14:20:00';  $end_time = ' 17:20:00';
    if(!empty($start_date)){$start_date = $start_date.$start_time; }
    if(!empty($end_date)){$end_date = $end_date.$end_time; }
    
    $sql = "UPDATE calendar SET";
    if(!empty($type)) {$sql .= " type='$type',";}
    if(!empty($name)) {$sql .= " name='$name',";}
    if(!empty($start_date)) {$sql .= " start_date='$start_date',";}
    if(!empty($end_date)) {$sql .= " end_date='$end_date',";}
    if(!empty($description)) {$sql .= " description='$description',";}

    $sql = substr($sql, 0, strlen($sql) -1) . " WHERE id = '$id' ";
    $success = mysqli_query($db, $sql)or die('An error occured : '.mysqli_error($db));
    
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
        header("Location: ../functions/teacher/events/index.php?deleted=true");
    }
}



