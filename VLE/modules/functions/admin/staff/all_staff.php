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
                                    <td>Role</td>
                                    <td>Status</td>
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
                                    $_role = $row['user_role'];
                                    $status = $row['status'];
                                ?>
                                    <tr>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['username']; ?></td>
                                        <td><?php echo $row['phone']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo ($_role == 'drc') ? "DEBS" : ucfirst($_role); ?></td>
                                        <td><?php echo ($status != 'Disabled') ? "Active" : ucfirst($status); ?></td>

                                        <th>
                                            <div class="btn-group">
                                                <a class="btn btn-info btn-sm text-light" href="view_staff.php?id=<?php echo $row["id"]; ?>">View</a>
                                                <a class="btn btn-primary btn-sm text-light " href="update_staff.php?id=<?php echo $row["id"]; ?>">Edit</a>
                                                <?php if ($status == 'Disabled') { ?>
                                                    <a class="btn btn-success btn-sm text-light " href="?act=<?php echo $row["id"]; ?>">Activate</a>
                                                <?php } else { ?>
                                                    <a class="btn btn-danger btn-sm text-light " href="?del=<?php echo $row["id"]; ?>">Disable</a>
                                                <?php } ?>
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

<?php

if (isset($_GET['del'])) {
    $id = $_GET['del'];

    $sql = "UPDATE users SET status = 'Disabled' WHERE id = '$id' ";
    $res = mysqli_query($db, $sql) or die('An error occured: ' . mysqli_error($db));
    if ($res) {
        echo "<script> window.location = '?updated' </script>";
    }
}
if (isset($_GET['act'])) {
    $id = $_GET['act'];

    $sql = "UPDATE users SET status = 'Offline' WHERE id = '$id' ";
    $res = mysqli_query($db, $sql) or die('An error occured: ' . mysqli_error($db));
    if ($res) {
        echo "<script> window.location = '?updated' </script>";
    }
}

require_once('../layouts/footer_to_end.php');
?>