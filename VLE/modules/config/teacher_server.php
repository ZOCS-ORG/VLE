<?php
//session_start();
include_once('config.php');


//Update Teachers
if (!empty($_POST['update_teacher'])) {
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
        //return var_dump($filetmp);
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
        $sql .= " address = '$address',";
    }

    $sql = substr($sql, 0, strlen($sql) - 1) . " WHERE `id` = '$id' ";
    $success = mysqli_query($db, $sql) or die('Error: Could not Update data - T: ' . mysqli_error($db));

    // Update users table too
    $userid = "tea_" . $id;
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

    $sql_user = substr($sql_user, 0, strlen($sql_user)) . "  user_role = 'teacher' WHERE `userid` = '$userid' ";
    // return var_dump($sql_user);
    $success = mysqli_query($db, $sql_user) or die('Error: Could not Update data: ' . mysqli_error($db));

    header('Location: ../account/myprofile.php?id=' . $id . "&updated=true");
}




/**
 *  ATTENDANCE Server!!!
 */
// Create Attendance
if (isset($_POST['submmit_attendance'])) {
    $id = "";
    $class_id = $_POST['class_id'];
    $teacher_id = $_POST['teacher_id'];
    // Arrays
    $students = $_POST['students'];
    $attentance = $_POST['attendance'];

    array_map(function ($student, $status) {
        global $db, $class_id, $teacher_id;
        if (!empty($_POST['date'])) {
            $date = $_POST['date'];
        } else {
            $date = date('Y-m-d');
        }
        $query = "INSERT INTO `attendance`(`class_id`, `student_id`, `teacher_id`, `status`, `date`)
                                VALUES('$class_id','$student','$teacher_id', '$status', '$date')";
        $result = mysqli_query($db, $query) or die('Error saving data: ' . mysqli_error($db));
    }, $students, $attentance);
    header('Location: ../attendance/register.php?created=true&class=' . $class_id);
}


/**
 *  Results Server!!!
 */
// Create Results
if (isset($_POST['submmit_results'])) {

    $class_id = $_POST['class_id'];
    $subject_id = $_POST['subject_id'];
    // Arrays
    $students = $_POST['students'];
    $marks = $_POST['marks'];
    $comments = $_POST['comment'];

    array_map(function ($student, $mark, $comment) {
        global $db;
        $id = "";
        $class_id = $_POST['class_id'];
        $subject_id = $_POST['subject_id'];
        $name = $_POST['name'];
        if (!empty($_POST['date'])) {
            $date = $_POST['date'];
        } else {
            $date = date('Y-m-d');
        }

        $query = "INSERT INTO `results`(`student_id`, `class_id`, `subject_id`, `marks`,`name`, `date`, `comment`)
                VALUES('$student','$class_id','$subject_id','$mark', '$name', '$date','$comment')";
        $result = mysqli_query($db, $query) or die('Error saving data: ' . mysqli_error($db));
    }, $students, $marks, $comments);

    header('Location: ../subjects/results.php?created=true&subject=' . $subject_id . '&class=' . $class_id);
}

/** UPDATE RESULTS */
if (isset($_POST['update_results'])) {

    $class_id = $_POST['class_id'];
    $subject_id = $_POST['subject_id'];
    $default_name = $_POST['default_name'];
    $name = $_POST['name'];
    if (empty($name)) {
        $name = $default_name;
    }

    // Arrays
    $result_ids = $_POST['result_ids'];
    $marks = $_POST['marks'];
    $comments = $_POST['comment'];

    array_map(function ($result_id, $mark, $comment) {
        global $name, $db;
        $id = "";

        $sql = "UPDATE results SET";
        if (!empty($name)) {
            $sql .= " name='$name',";
        }
        if (!empty($mark)) {
            $sql .= " marks ='$mark',";
        }
        if (!empty($comment)) {
            $sql .= " comment = '$comment',";
        }

        $sql = substr($sql, 0, strlen($sql) - 1) . " WHERE id = '$result_id' ";

        //return var_dump($sql);
        $success = mysqli_query($db, $sql) or die('An error occured : ' . mysqli_error($db));
    }, $result_ids, $marks, $comments);

    header('Location: ../results/view_results.php?subject=' . $subject_id . '&class=' . $class_id . '&name=' . $name);
}





/**
 * 
 *      EVENTS SERVER - TEACHER... 
 */

// Create Event...
if (isset($_POST['create_event'])) {
    $id = "";
    $type = $_POST['type'];
    $name = $_POST['name'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $description = $_POST['description'];
    $created_by = $_POST['created_by'];

    $start_time = ' 14:20:00';
    $end_time = ' 17:20:00';

    $start_date = $start_date . $start_time;
    $end_date = $end_date . $end_time;

    $sql = " INSERT INTO `calendar`
                    (`id`, `type`, `name`, `description`, `start_date`, `end_date`, `created_by`) 
            VALUES ('$id','$type','$name','$description','$start_date','$end_date','$created_by' ) ";

    $success = mysqli_query($db, $sql) or die('Could not enter data: ' . mysqli_error($db));
    if ($success) {
        $id = mysqli_insert_id($db);
        header('Location: ../events/index.php?created=true');
    }
}
/// UPDATE Event
if (!empty($_POST['update_event'])) {
    $id = $_POST['id'];

    $type = $_POST['type'];
    $name = $_POST['name'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $description = $_POST['description'];

    $start_time = ' 14:20:00';
    $end_time = ' 17:20:00';
    if (!empty($start_date)) {
        $start_date = $start_date . $start_time;
    }
    if (!empty($end_date)) {
        $end_date = $end_date . $end_time;
    }

    $sql = "UPDATE calendar SET";
    if (!empty($type)) {
        $sql .= " type='$type',";
    }
    if (!empty($name)) {
        $sql .= " name='$name',";
    }
    if (!empty($start_date)) {
        $sql .= " start_date='$start_date',";
    }
    if (!empty($end_date)) {
        $sql .= " end_date='$end_date',";
    }
    if (!empty($description)) {
        $sql .= " description='$description',";
    }

    $sql = substr($sql, 0, strlen($sql) - 1) . " WHERE id = '$id' ";
    $success = mysqli_query($db, $sql) or die('An error occured : ' . mysqli_error($db));

    header('Location: index.php?id=' . $id . '&updated=true');
}

//DELETE Event...
if (isset($_GET['id']) && isset($_GET['delete_event'])) {
    if ($_GET['delete_event'] == true) {
        $id = $_GET['id'];
        $sql = "DELETE FROM calendar WHERE id = '$id';";
        $success = mysqli_query($db, $sql);
        if (!$success) {
            die('Could not Delete data: ' . mysqli_error($db));
        }
        header("Location: ../functions/teacher/events/index.php?deleted=true");
    }
}


/**
 * Update Classss
 */

/// UPDATE CLASS
if (!empty($_POST['update_class'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $monitor = $_POST['monitor'];
    $room = $_POST['room'];

    $students = $_POST['students'];
    //return var_dump($students);

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


/**
 *  *CLASS AND STUUDENT STUFF
 */

// Create CLASS...
if (isset($_POST['create_class'])) {

    $room = "";
    $name = $_POST['name'];
    $teacher = $_POST['id'];
    $monitor = '';//$_POST['monitor'];

    $sql = "INSERT INTO  `classes`(`name`, `teacher_id`, `monitor_id`) 
                    VALUES('$name','$teacher', '$monitor')";
    $success = mysqli_query($db, $sql) or die('Could not enter data: ' . mysqli_error($db));

    //? now do students
    $students = $_POST['students'];

    $class_id = mysqli_insert_id($db);


    array_map(function ($student) {
        global $db, $class_id;

        mysqli_query($db, "INSERT INTO  `class_students`(`class_id`, `student_id`) 
                    VALUES('$class_id', '$student')") or die('Could not enter students data: ' . mysqli_error($db));
    }, $students);


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
 *      ASSIGN SUBJECT... 
 */
// Assign...
if (isset($_POST['create_subject'])) {

    // print_r($_POST);
    // die();
    $id = $_POST['id']; //?teacher ID
    $name = $_POST['subject']; //? subject name ..
    $class = $_POST['class'];


    $query = "INSERT INTO teacher_subject_class(`teacher_id`, `subject_id`, `class_id`)
                            VALUES('$id', '$name', '$class' )";
    $result = mysqli_query($db, $query) or die('Error saving to mapping table: ' . mysqli_error($db));

    $_SESSION['created'] = "Added successfully";
    header('Location: ../subjects/index.php?created=true');
}

/**
 * ? Complaints
 */
if (!empty($_POST['submit_complaint'])) {

    // return var_dump($_POST);

    $id = $_POST['id'];
    $complaint = $_POST['complaint'];
    // generate 6 digit random number as ref
    $ref = rand(100000, 999999);

    $filetmp = $_FILES['file']['tmp_name'];
    if (isset($filetmp) && !empty($filetmp)) {
        $dir = "../../../utils/complaints/";
        $file = $_FILES['file']['name'];
        move_uploaded_file($filetmp, $dir . $file);
    } else {
        $file = "";
    }


    $sql = mysqli_query($db, "INSERT INTO complaints(`complaint`, `file`, `created_by`, `ref`, `status`)
                    VALUES('$complaint', '$file', '$id', '$ref', 'Open' )") or die("Error saving complaint: " . mysqli_error($db));

    $_SESSION['created'] = "Added successfully";
    header('Location: ../complaints/index.php?created=true');
}
