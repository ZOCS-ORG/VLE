<?php
require_once('../../../config/admin_server.php');   //contains db connection so we good 🤦🏾‍♂️
$add_side_bar = true;
include_once('../layouts/head_to_wrapper.php');
include_once('../layouts/topbar.php');

$user_id = $_SESSION['id'];

$school ="SELECT school_id FROM school_teachers WHERE teacher_id = $user_id";
$school_query = mysqli_query($db,$school) or die(mysqli_error($db));
$school_row = mysqli_fetch_array($school_query);

$school_id = $school_row["school_id"];
echo "".$school_id."";
?>

<hr />
<main>
    <div class="container-fluid col-md-9">
        <div class="card mb-4">
            <div class="card-header text-center">
                <h3>Parents list</h3>
                <div class="text-right text-light">
                    <a class="btn btn-sm btn-success" href="add_parent.php">Add Parents</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <td>Mothers Name</td>
                                <td>Fathers Name</td>
                                <td>Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT u.name, s.name AS school_name
                            FROM users u
                            LEFT JOIN school_teachers st ON u.created_by = st.teacher_id
                            LEFT JOIN schools s ON st.school_id = s.school_id
                            WHERE u.user_role LIKE '%parent%'
                            AND s.school_id = $school_id";
                            $res = mysqli_query($db, $sql) or die('An error occured: ' . mysqli_error($db));
                            while ($row = mysqli_fetch_array($res)) {
                            ?>
                                <tr>
                                    <td><?php echo $row['par_mothername']; ?></td>
                                    <td><?php echo $row['par_fathername']; ?></td>
                                    <td><a href="view_parent.php?id=<?php echo $row["id"]; ?>" class="badge badge-lg badge-light" style="width:40px"> View </td>
                                </tr>
                            <?php

                            }

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>


<?php require_once('../layouts/footer_to_end.php'); ?>