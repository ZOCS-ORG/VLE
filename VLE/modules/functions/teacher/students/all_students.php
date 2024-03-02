<?php
// require_once('../scripts/student_validation.php');
require_once('../../../config/admin_server.php');   //contains db connection so we good 🤦🏾‍♂️
$add_side_bar = true;
include_once('../layouts/head_to_wrapper.php');

include_once('../layouts/topbar.php');

$user_id = $_SESSION['id'];

?>

<hr />
<main>
    <div class="card-header text-center">
        <h3>Learners list</h3>
        <div class="text-right text-light">
                    <a class="btn btn-sm btn-success" href="add_student.php">Add Learner</a>
                </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="4">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $sql = "SELECT * FROM users WHERE user_role = 'student' AND created_by = '$user_id'";
                    $res = mysqli_query($db, $sql) or die('An error occured: ' . mysqli_error($db));
                    $string = "";
                    $images_dir = "../../../utils/images/users/";

                    while ($row = mysqli_fetch_array($res)) {
                        $picname = $row['img'];
                    ?>
                        <tr>
                            <td><a href="view_student.php?id=<?php echo $row["id"]; ?>"><?php echo $row['id']; ?> </td>
                            <td><?php echo $row['name']; ?></td>
                            <td>
                                <?php
                                $class_id = $row['stu_class'];
                                $q_class = "SELECT name, id FROM classes WHERE id = '$class_id' ";
                                $res_class = mysqli_query($db, $q_class);
                                $r_class = mysqli_fetch_assoc($res_class);
                                echo $r_class['name'];
                                ?>
                            </td>
                            <!-- <td><?php ///echo "<img src='" . $images_dir . $picname . "' alt='" . $picname . "' width='50' height='50'> " ?></td> -->
                            <th>
                                <div class="btn-group"><a class="btn btn-success btn-sm text-light" href="../students/view_student.php?id=<?php echo $row["id"]; ?>">View</a>
                                    <a class="btn btn-primary btn-sm text-light " href="../students/update_student.php?id=<?php echo $row["id"]; ?>">Edit</a>
                                    <a class="btn btn-danger btn-sm text-light" href="../../../config/admin_server.php?id=<?php echo $row["id"] ?>&delete_student=true">Delete </a>
                                </div>
                            </th>
                        </tr>
                    <?php

                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>


    </div>
    </div>
</main>


<?php require_once('../layouts/footer_to_end.php'); ?>