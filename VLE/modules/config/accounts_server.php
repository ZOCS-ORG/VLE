<?php
include_once('config.php');

//Update Account
if(!empty($_POST['update_accountant'])){
    $name = $_POST['name'];
    $password = md5($_POST['password']);
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    //$dob = $_POST['dob'];
    //$hiredate = $_POST['hiredate'];
    $address = $_POST['address'];
    $salary = $_POST['salary'];
    $filetmp =$_FILES['file']['tmp_name'];
    if(isset($filetmp) && !empty($filetmp)){
        $dir = "../../../utils/images/accountants/";
        $img = "_".rand(100,1000000).".jpg";
        //return var_dump($filetmp);
        // unlink($dir.$img);
        move_uploaded_file($filetmp, $dir.$img);  
    }else{
        $img = "";
    }

    $sql = "UPDATE accountants SET";
    //Check to see that value is not empty so we don't replace already existing value with null😋..
    if(!empty($password)) { $sql .= " password = '$password',"; }
    if(!empty($name)) { $sql .= " name = '$name',"; }
    if(!empty($phone)) { $sql .= " phone = '$phone',"; }
    if(!empty($email)) { $sql .= " email = '$email',"; }
    if(!empty($username)) { $sql .= " username = '$username',"; }
    // if(!empty($dob)) { $sql .= " dob = '$dob',"; }
    if(!empty($img)) { $sql .= " img = '$img',"; }
    if(!empty($salary)) { $sql .= " salary = '$salary',"; }
    if(!empty($address)) { $sql .= " address = '$address',"; }

    $sql = substr($sql, 0, strlen($sql) -1) . " WHERE `id` = '$id' ";
    $success = mysqli_query($db, $sql)or die('Error: Could not Update data - T: '.mysqli_error($db));

    // Update users table too
    $sql_user = "UPDATE users SET";
    if(!empty($password)) { $sql_user .= " password = '$password',"; }
    if(!empty($name)) { $sql_user .= " name = '$name',"; }
    if(!empty($username)) { $sql_user .= " username = '$username',"; }

    $sql_user = substr($sql_user, 0, strlen($sql_user) ) . "  user_role = 'accountant' WHERE `userid` = '$id' ";
    // return var_dump($sql_user);
    $success = mysqli_query($db, $sql_user)or die('Error: Could not Update data: '.mysqli_error($db));

    header('Location: ../lecturers/view_lecturer.php?id='.$id."&updated=true");
}

/**
 * 
 *     TUITION FEES SERVER - ACCOUNTS... 
 */

// Add Tuition Fees...
if(isset($_POST['create_tuition'])){
    $student_id = $_POST['student_id'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];
    $term = $_POST['term'];
    $method = $_POST['method'];
    $recieved_by = $_POST['recieved_by'];
    $bank_acc = $_POST['bank'];
    $year = date('Y');

    $sql = " INSERT INTO  `fees`
                        (`student_id`, `amount`, `date_paid`, `term`, `method`, `recieved_by`, `bank_acc`, `year`)
                VALUES ('$student_id','$amount','$date','$term','$method','$recieved_by','$bank_acc','$year') ";
    
    $success = mysqli_query($db, $sql)or die('Could not enter data: '.mysqli_error($db));

    $id = mysqli_insert_id($db);
    header('Location: ../../reports/tuition_reciept.php?created=true&tuition_id='.$id);
}



/**
 * 
 *     OTHER INCOME SERVER - ACCOUNTS... 
 */

// Add Payments Fees...
if(isset($_POST['create_payment'])){
    $paid_by = $_POST['paid_by'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];
    $desc = $_POST['desc'];
    $notes = $_POST['notes'];
    $method = $_POST['method'];
    $recieved_by = $_POST['recieved_by'];
    $bank_acc = $_POST['bank'];
    $year = date('Y');

    $sql = " INSERT INTO `payments`
                        (`amount`, `paid_by`, `description`, `date_paid`, `method`, `recieved_by`, `bank_acc`, `notes`)
                VALUES ('$amount','$paid_by','$desc','$date','$method','$recieved_by','$bank_acc', '$notes') ";
    
    $success = mysqli_query($db, $sql)or die('Could not enter data: '.mysqli_error($db));
    
    $id = mysqli_insert_id($db);
    //header('Location: ../payments/index.php?created=true');
    header('Location: ../../reports/payment_reciept.php?created=true&payment_id='.$id);
}



/**
 * 
 *     EXPENSES SERVER - ACCOUNTS... 
 */

// Add expenses Fees...
if(isset($_POST['create_expense'])){
    $amount = $_POST['amount'];
    $date = $_POST['date'];
    $desc = $_POST['desc'];
    $notes = $_POST['notes'];
    $method = $_POST['method'];
    $bank_acc = $_POST['bank'];
    $paid_by = $_POST['paid_by'];

    $sql = " INSERT INTO `expenses`
                        (`amount`, `description`, `date`, `method`, `paid_by`, `bank_acc`, `notes`)
                VALUES ('$amount', '$desc','$date','$method','$paid_by','$bank_acc', '$notes') ";
    
    $success = mysqli_query($db, $sql)or die('Could not enter data: '.mysqli_error($db));
    
    $id = mysqli_insert_id($db);
    //header('Location: ../payments/index.php?created=true');
    header('Location: ../../reports/expense_report.php?created=true&expense_id='.$id);
}



/**
 *   BANK SERVER - ACCOUNTS... 
 */
// Add BANK...
if(isset($_POST['create_bank'])){
    $name = $_POST['name'];
    $branch = $_POST['branch'];
    $account_name = $_POST['account_name'];
    $account_no = $_POST['account_no'];

    $sql = " INSERT INTO  `banks`
                        ( `name`, `branch`, `account_no`, `account_name`)
                VALUES ('$name','$branch','$account_no','$account_name' ) ";
    
    $success = mysqli_query($db, $sql)or die('Could not enter data: '.mysqli_error($db));
    
    header('Location: ../banks/index.php?created=true');
}
/// UPDATE BANK
if(!empty($_POST['update_bank'])){
    $bank_id = $_POST['id'];
    $name = $_POST['name'];
    $branch = $_POST['branch'];
    $account_name = $_POST['account_name'];
    $account_no = $_POST['account_no'];

    $sql = "UPDATE banks SET";
    if(!empty($bank_id)) {$sql .= " id='$bank_id',";}
    if(!empty($name)) {$sql .= " name='$name',";}
    if(!empty($branch)) {$sql .= " branch='$branch',";}
    if(!empty($account_name)) {$sql .= " account_name='$account_name',";}
    if(!empty($account_no)) {$sql .= " account_no='$account_no',";}

    $sql = substr($sql, 0, strlen($sql) -1) . " WHERE id = '$bank_id' ";
    $success = mysqli_query($db, $sql)or die('An error occured : '.mysqli_error($db));
    
    header('Location: index.php?id='.$id.'&updated=true');
}
//DELETE Bank...
if(isset($_GET['id']) && isset($_GET['delete_bank']) ) {
    if($_GET['delete_bank'] == true){
        $id = $_GET['id'];
        $sql = "DELETE FROM banks WHERE id = '$id';";
        $success = mysqli_query($db, $sql);
        if(!$success) {
            die('Could not Delete data: '.mysqli_error($db));
        }
        header("Location: ../functions/accountant/banks/index.php?deleted=true");
    }
}




/**
 *   MODE OF PAYMENTS - ACCOUNTS... 
 */
// Add MODE OF PAYMENT...
if(isset($_POST['create_mode'])){
    $name = $_POST['name'];


    $sql = " INSERT INTO  `payment_modes`
                        ( `name`)
                VALUES ('$name') ";
    $success = mysqli_query($db, $sql)or die('Could not enter data: '.mysqli_error($db));
    header('Location: ../payment_modes/index.php?created=true');
}
/// UPDATE Payment MODE
if(!empty($_POST['update_mode'])){
    $mode_id = $_POST['id'];
    $name = $_POST['name'];
    $branch = $_POST['branch'];
    $account_name = $_POST['account_name'];
    $account_no = $_POST['account_no'];

    $sql = "UPDATE payment_modes SET";
    if(!empty($bank_id)) {$sql .= " id='$mode_id',";}
    if(!empty($name)) {$sql .= " name='$name',";}

    $sql = substr($sql, 0, strlen($sql) -1) . " WHERE id = '$mode_id' ";
    $success = mysqli_query($db, $sql)or die('An error occured : '.mysqli_error($db));
    
    header('Location: index.php?id='.$id.'&updated=true');
}
//DELETE PAYMENT MODE...
if(isset($_GET['id']) && isset($_GET['delete_mode']) ) {
    if($_GET['delete_mode'] == true){
        $id = $_GET['id'];
        $sql = "DELETE FROM payment_modes WHERE id = '$id';";
        $success = mysqli_query($db, $sql);
        if(!$success) {
            die('Could not Delete data: '.mysqli_error($db));
        }
        header("Location: ../functions/accountant/payment_modes/index.php?deleted=true");
    }
}



/**
 * 
 *      EVENTS SERVER - ACCOUNTS... 
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

