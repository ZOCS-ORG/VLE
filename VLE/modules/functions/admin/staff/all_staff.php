<?php
require_once('../../../config/admin_server.php');   //contains db connection so we good 🤦🏾‍♂️
$add_side_bar = true;
include_once('../layouts/head_to_wrapper.php');
include_once('../layouts/topbar.php');


?>

<hr />

<main>
    <div class="container-fluid col-md-10">

        <div id="tabs">

            <div id="lecturers">
                <div class="justify text-right">
                    <span><a class="btn btn-success btn-sm" href="add_staff.php">Add User</a></span>
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
                                    <td>Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM users;";
                                $res = mysqli_query($db, $sql) or die('An error occured: ' . mysqli_error($db));
                                $string = "";
                                $images_dir = "../../../utils/images/lecturers/";
                                while ($row = mysqli_fetch_array($res)) {
                                    $picname = $row['img'];
                                ?>
                                    <tr>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['username']; ?></td>
                                        <td><?php echo $row['phone']; ?></td>
                                        <td><?php echo $row['email']; ?></td>

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