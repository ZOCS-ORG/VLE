<?php
require_once('../../../config/admin_server.php');   //contains db connection so we good 🤦🏾‍♂️
$add_side_bar = true;
include_once('../layouts/head_to_wrapper.php');
include_once('../layouts/topbar.php');

$logged_id = $_SESSION['id'];

?>

<hr />

<main>
    <div class="container-fluid col-md-10">

        <div id="tabs">

            <div id="lecturers">
                <div class="justify text-right">
                    <span><a class="btn btn-success btn-sm" href="add_staff.php">Add Teacher</a></span>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="staff_tea" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <td>Name</td>
                                    <td>Username</td>
                                    <td>Phone number</td>
                                    <td>Email</td>
                                    <td>School</td>
                                    <td>Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT u.name, u.username, u.phone, u.email, s.name AS school, u.id,
                                                    (SELECT `name` FROM `users` AS u2 WHERE u2.id = u.created_by) AS created_by
                                            FROM users u
                                            LEFT JOIN school_teachers st ON st.teacher_id = u.id
                                            LEFT JOIN schools s ON st.school_id = s.school_id
                                            WHERE user_role = 'teacher'
                                            AND created_by = '$logged_id'
                                            ORDER BY u.id DESC ";
                                $res = mysqli_query($db, $sql) or die('An error occured: ' . mysqli_error($db));
                                $string = "";
                                $images_dir = "../../../utils/images/users/";
                                while ($row = mysqli_fetch_array($res)) {
                                    $picname = $row['img'];
                                ?>
                                    <tr>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['username']; ?></td>
                                        <td><?php echo $row['phone']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['school']; ?></td>

                                        <th>
                                            <div class="btn-group"><a class="btn btn-success btn-sm text-light" href="view_staff.php?id=<?php echo $row["id"]; ?>">View</a>
                                                <a class="btn btn-primary btn-sm text-light " href="update_staff.php?id=<?php echo $row["id"]; ?>">Edit</a>

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

        </div>
    </div>
    </div>
</main>

<?php require_once('../layouts/footer_to_end.php'); ?>