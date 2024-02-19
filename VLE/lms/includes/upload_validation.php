<?php
require '../includes/connect.php';

$teacher_id = $t_id;

if (isset($_POST['submit_ass_q'])) {
    //get from form 
    if (!empty($_POST['name'])) {
        $name = $_POST['name'];
    }
    if (!empty($_POST['description'])) {
        $description = $_POST['description'];
    }
    if (!empty($_POST['from'])) {
        $from = $_POST['from'];
    }
    if (!empty($_POST['to'])) {
        $to = $_POST['to'];
    }

    $file = $_FILES['nFile']['name'];
    $date_sub = date("d-m-Y");
    move_uploaded_file($_FILES['nFile']['tmp_name'], "../files/ass_notice/" . $file);

    $query = $db->query("INSERT INTO `upload_materials` (`name`, `from_age`, `to_age`, `teacher_id`, `file`, `description`)
							VALUES ('$name', '$from', '$to', '$teacher_id', '$file','$description') ")
            or die("An error occured: " . mysqli_error($db));

    if ($query) {
        ?>
        <div class="card-panel green">
            <span class="white-text"><?php echo "file successfully sent!"; ?> </span>
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

    if (!empty($_POST['name'])) {
        $name = $_POST['name'];
    }
    if (!empty($_POST['description'])) {
        $description = $_POST['description'];
    }
    if (!empty($_POST['from'])) {
        $from = $_POST['from'];
    }
    if (!empty($_POST['to'])) {
        $to = $_POST['to'];
    }

   
    $file = $_FILES['nFile']['name'];
    $date_sub = date("d-m-Y");
    move_uploaded_file($_FILES['nFile']['tmp_name'], "../files/ass_notice/" . $file);

    $sql = "UPDATE upload_materials SET";
    if (!empty($description)) {
        $sql .= " description = '$description',";
    }
    if (!empty($name)) {
        $sql .= " name = '$name',";
    }
    if (!empty($from)) {
        $sql .= " from = '$from',";
    }
    if (!empty($ro)) {
        $sql .= " to = '$to',";
    }
    if (!empty($teacher_id)) {
        $sql .= " teacher_id = '$teacher_id',";
    }
    if (!empty($file)) {
        $sql .= " file = '$file',";
    }
    $sql = substr($sql, 0, strlen($sql) - 1) . " WHERE `id` = '$ass_id' ";
    $success = mysqli_query($db, $sql) or die("An error occured: " . mysqli_error($db));

    if ($query) {
        ?>
        <div class="card-panel green">
            <span class="white-text"><?php echo "document successfully updated!"; ?> </span>
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
        $sql = "DELETE FROM upload_materials WHERE id = '$id';";
        $query = mysqli_query($db, $sql);

        if ($query) {
            ?>
            <div class="card-panel green">
                <span class="white-text"><?php echo "Document successfully deleted!"; ?> </span>
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