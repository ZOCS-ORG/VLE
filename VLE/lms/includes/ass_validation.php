<?php
require '../includes/connect.php';

$teacher_id = $t_id;

if (isset($_POST['submit_ass_q'])) {
    //get from form 
    if (!empty($_POST['name'])) {
        $name = $_POST['name'];
    }
    if (!empty($_POST['question'])) {
        $question = $_POST['question'];
    }
    if (!empty($_POST['class'])) {
        $class_id = $_POST['class'];
    }
    if (!empty($_POST['subject'])) {
        $subject_id = $_POST['subject'];
    }
    if (!empty($_POST['marks'])) {
        $marks = $_POST['marks'];
    }

    $date_due = $_POST['date_due'];
    $file = $_FILES['nFile']['name'];
    //Get current date
    $date_sub = date("d-m-Y");
    //Get subject
    // $sub_query = $db->query("SELECT * FROM subjects WHERE id = '$subject_id' ");
    // while($row=$sub_query->fetch_assoc()){
    // 	$sub_name = $row['subName'];
    // }
    move_uploaded_file($_FILES['nFile']['tmp_name'], "../files/ass_notice/" . $file);

    $query = $db->query("INSERT INTO `ass_notice` (`question`, `name`, `class_id`, `subject_id`, `teacher_id`, `assFile`, `date`, `date_due`, marks)
							VALUES ('$question', '$name', '$class_id', '$subject_id', '$teacher_id', '$file', '$date_sub', '$date_due', '$marks') ")
            or die("An error occured: " . mysqli_error($db));

    if ($query) {
        ?>
        <div class="card-panel green">
            <span class="white-text"><?php echo "Assignment successfully sent!"; ?> </span>
        </div>
    <?php } else { ?>
        <div class="card-panel red">
            <span class="white-text"><?php echo $error = "Some error occured please contact admin"; ?>
            </span>
        </div>
        <?php
    }
}

if (isset($_POST['upload_doc'])) {
    //get from form 

    $title = $_POST['title'];

    $description = $_POST['description'];
    $url = $_POST['url'];
    //$title = $_POST['title'];

    $file = $_FILES['nFile']['name'];
    //Get current date
    $date_sub = date("Y-m-d");
    //Get subject
    // $sub_query = $db->query("SELECT * FROM subjects WHERE id = '$subject_id' ");
    // while($row=$sub_query->fetch_assoc()){
    // 	$sub_name = $row['subName'];
    // }
    move_uploaded_file($_FILES['nFile']['tmp_name'], "../files/moe_uploads/" . $file);

    $query = $db->query("INSERT INTO `moe_uploads` (`title`, `description`, `file`, `url`,`date_added`, `uploaded_by`)
                                                    VALUES ('$title', '$description', '$file', '$url','$date_sub','$teacher_id') ")
            or die("An error occured: " . mysqli_error($db));

    if ($query) {
        ?>
        <div class="card-panel green">
            <span class="white-text"><?php echo "Upload was successful !"; ?> </span>
        </div>
    <?php } else { ?>
        <div class="card-panel red">
            <span class="white-text"><?php echo $error = "Some error occured please contact admin"; ?>
            </span>
        </div>
        <?php
    }
}

if (isset($_POST['update_ass_q'])) {

    // return var_dump($ass_id);
    //get from form 
    if (!empty($_POST['name'])) {
        $name = $_POST['name'];
    }
    if (!empty($_POST['question'])) {
        $question = $_POST['question'];
    }
    if (!empty($_POST['class'])) {
        $class_id = $_POST['class'];
    }
    if (!empty($_POST['subject'])) {
        $subject_id = $_POST['subject'];
    }
    if (!empty($_POST['marks'])) {
        $marks = $_POST['marks'];
    }

    $date_due = $_POST['date_due'];
    $file = $_FILES['nFile']['name'];
    //Get current date
    $date_sub = date("d-m-Y");
    //Get subject
    // $sub_query = $db->query("SELECT * FROM subjects WHERE id = '$subject_id' ");
    // while($row=$sub_query->fetch_assoc()){
    // 	$sub_name = $row['subName'];
    // }
    move_uploaded_file($_FILES['nFile']['tmp_name'], "../files/ass_notice/" . $file);

    $sql = "UPDATE ass_notice SET";
    //Check to see that value is not empty so we don't replace already existing value with null😋..
    if (!empty($question)) {
        $sql .= " question = '$question',";
    }
    if (!empty($name)) {
        $sql .= " name = '$name',";
    }
    if (!empty($class_id)) {
        $sql .= " class_id = '$class_id',";
    }
    if (!empty($subject_id)) {
        $sql .= " subject_id = '$subject_id',";
    }
    if (!empty($teacher_id)) {
        $sql .= " teacher_id = '$teacher_id',";
    }
    if (!empty($file)) {
        $sql .= " assFile = '$file',";
    }
    if (!empty($date_due)) {
        $sql .= " date_due = '$date_due',";
    }
    if (!empty($marks)) {
        $sql .= " marks = '$marks',";
    }
    $sql = substr($sql, 0, strlen($sql) - 1) . " WHERE `id` = '$ass_id' ";
    $success = mysqli_query($db, $sql) or die("An error occured: " . mysqli_error($db));

    if ($query) {
        ?>
        <div class="card-panel green">
            <span class="white-text"><?php echo "Assignment successfully updated!"; ?> </span>
        </div>
    <?php } else { ?>
        <div class="card-panel red">
            <span class="white-text"><?php echo $error = "An error occured please contact admin"; ?>
            </span>
        </div>
        <?php
    }
}


// Delete OTHER STAFF
if (isset($_GET['ass_id']) && isset($_GET['delete_ass'])) {
    if ($_GET['delete_ass'] == true) {
        $id = $_GET['ass_id'];
        $sql = "DELETE FROM ass_notice WHERE id = '$id';";
        $query = mysqli_query($db, $sql);

        if ($query) {
            ?>
            <div class="card-panel green">
                <span class="white-text"><?php echo "Assignment successfully deleted!"; ?> </span>
            </div>
        <?php } else { ?>
            <div class="card-panel red">
                <span class="white-text"><?php echo $error = "An error occured please contact admin"; ?>
                </span>
            </div>
            <?php
        }
    }
}

if (isset($_GET['ass_id']) && isset($_GET['delete_upload'])) {
    if ($_GET['delete_upload'] == true) {
        $id = $_GET['ass_id'];
        $sql = "DELETE FROM moe_uploads WHERE upload_id = '$id';";
        $query = mysqli_query($db, $sql);

        if ($query) {
            ?>
            <div class="card-panel green">
                <span class="white-text"><?php echo "Upload successfully deleted!"; ?> </span>
            </div>
        <?php } else { ?>
            <div class="card-panel red">
                <span class="white-text"><?php echo $error = "An error occured please contact admin"; ?>
                </span>
            </div>
            <?php
        }
    }
}