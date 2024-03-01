<?php
// require_once('../../../config/teacher_server.php');
require_once('../../../config/config.php');
$add_side_bar = true;
include_once('../layouts/head_to_wrapper.php');
include_once('../layouts/topbar.php');

$teacher_id = $_SESSION['id'];

?>

<style>
    .table-width {
        padding-right: 75px;
        padding-left: 75px;
        margin-right: auto;
        margin-left: auto;
    }

    @media (min-width: 768px) {
        .table-width {
            width: 750px;
        }
    }

    @media (min-width: 992px) {
        .table-width {
            width: 970px;
        }
    }

    @media (min-width: 1200px) {
        .table-width {
            width: 1170px;
        }
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-s border-0 rounded-lg mt-1">

                <div class="card-header">
                    <h5 class="text-center my-2">Create Subject Assign Class </h5>
                </div>
                <div class="card-body">
                    <form action="#" method="post" onsubmit="return librarian_validation();" enctype="multipart/form-data">

                        <table class="table" id="dataTable" width="100%" cellspacing="9">
                            <input id="id" type="hidden" name="id" value="<?php echo $teacher_id ?>">
                            <!-- <tr>
                                <td>Subject Name:</td>
                                <td class="text-right"><input type="text" name="name" placeholder="Subject Name" style="padding:4px; width:70%; border-radius:9px"></td>
                            </tr> -->
                            <tr>
                                <td>Subject Name:</td>
                                <td class="text-right">
                                    <!-- <input type="text" name="subject" id="" style="padding:1px; width:90%; border-radius:9px"> -->
                                    <select name="subject" id="subj" style="padding:4px; width:90%; border-radius:9px">
                                        <option value=""></option>
                                        <?php
                                        $res = mysqli_query($db, "SELECT * FROM subjects ");
                                        while ($row = mysqli_fetch_array($res)) { ?>
                                            <option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
                                        <?php   }     ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Select Classs:</td>
                                <td class="text-right">
                                    <select name="class" id="subj" style="padding:4px; width:90%; border-radius:9px">
                                        <option value=""></option>
                                        <?php
                                        $res = mysqli_query($db, "SELECT * FROM classes WHERE teacher_id = '$teacher_id' ");
                                        while ($row = mysqli_fetch_array($res)) { ?>
                                            <option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
                                        <?php   }     ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-left"><input class="btn btn-sm btn-primary " type="submit" name="assign_subject" value="Submit"></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

if (isset($_POST['assign_subject'])) {

    $subject_id = $_POST['subject'];

    $class_id = $_POST['class'];

    $query = "INSERT INTO teacher_subject_class VALUES('', '$teacher_id', '$subject_id', '$class_id' )";
    $result = mysqli_query($db, $query) or die('Error saving to mapping table: ' . mysqli_error($db));

    echo "<script> window.location = 'index.php?created=true' </script>";

    // foreach ($classes as $key => $value) {
    //     $class_id = $classes[$key];
    //     $query = "INSERT INTO teacher_subject_class VALUES(' ', '$teacher_id', '$subject_id', '$class_id' )";
    //     $result = mysqli_query($db, $query) or die('Error saving to mapping table: ' . mysqli_error($db));
    // }
    $_SESSION['created'] = "Added successfully";
    header('Location: ../subjects/view_assigned');
}

require_once('../layouts/footer_to_end.php');
?>