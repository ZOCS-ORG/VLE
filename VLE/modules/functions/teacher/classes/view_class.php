<?php
require_once('../../../config/admin_server.php');   //contains db connection so we good 🤦🏾‍♂️
$add_side_bar = true;
include_once('../layouts/head_to_wrapper.php');
include_once('../layouts/topbar.php');

$id = $_GET['id'];

?>

<hr />

<style>
    table {
        width: 500px;
        margin-left: auto;
        margin-right: auto;
    }
</style>

<?php
$query = "SELECT  t.name AS teacher, t.id AS teacher_id, s.name AS monitor, s.id AS monitor_id FROM classes c
                INNER JOIN teachers t ON t.id = c.teacher_id
                INNER JOIN students s ON s.id = c.monitor_id
                where c.id = '$id' ";

$result = mysqli_query($db, $query) or die(mysqli_error($db));
$count = 1;
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>

        <main>
            <div class="container-fluid col-md-9">
                <div class="card mb-4">
                    <div class="card-header text-center">
                        <h3> Class <?php echo $row['name']; ?></h3>
                    </div>

                    <div class="card-body">

                        <table>
                            <tbody>
                                <tr>
                                    <td>Class Teacher</td>
                                    <td>
                                        <p><a href='../lecturers/view_lecturer.php?id=<?php echo $row['teacher_id'] ?>'> <?php echo $row['teacher'] ?> </a></p>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Class Monitor</td>
                                    <td>
                                        <p><a href='../students/view_student.php?id=<?php echo $row['monitor_id'] ?>'> <?php echo $row['monitor'] ?> </a></p>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Students</td>
                                    <td>
                                        <ol>
                                            <?php
                                            // $query = "SELECT students.*
                                            //     FROM students
                                            //     INNER JOIN class_students ON students.id = class_students.student_id
                                            //     WHERE class_students.class_id = '$id' ";
                                            // $resultss = mysqli_query($db, $query) or die('Error getting students: ' . mysqli_error($db));
                                            // while ($res_student = mysqli_fetch_array($resultss)) {
                                            //     $student_name = $res_student['name'];
                                            //     $student_id = $res_student['id'];
                                            //     echo " </br>  ";
                                            //?? use students' class 
                                            $query = "SELECT students.*
                                                FROM students
                                                WHERE class_id = '$id' ";
                                            $resultss = mysqli_query($db, $query) or die('Error getting students: ' . mysqli_error($db));
                                            while ($res_student = mysqli_fetch_array($resultss)) {
                                                $student_name = $res_student['name'];
                                                $student_id = $res_student['id'];
                                                echo " </br>  ";
                                            ?>
                                                <li>
                                                    <a class='text-primary' href='../students/view_student.php?id=<?php echo $student_id ?>'> <u><?php echo $student_name ?> </u> </a>
                                                </li>
                                            <?php } ?>
                                        </ol>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
        </main>
<?php
    }
} else {
    echo 'No Records Found!';
}
?>

<?php require_once('../layouts/footer_to_end.php'); ?>