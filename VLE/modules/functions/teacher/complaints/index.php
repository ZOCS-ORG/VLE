<?php
require_once('../../../config/admin_server.php');   //contains db connection so we good 🤦🏾‍♂️
$add_side_bar = true;
include_once('../layouts/head_to_wrapper.php');
include_once('../layouts/topbar.php');

$user_id = $_SESSION['id'];
// echo $user_id;
?>

<hr />
<style>
    table td,
    th {
        color: black;
    }
</style>
<main>
    <div class="container-fluid col-md-12">
        <div class="card mb-4">
            <div class="card-header text-center">
                <h3>Queries</h3>
                <div class="text-right text-light">
                    <a class="btn btn-sm btn-success" href="create_complaint.php">Raise a Query</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <td>Query #</td>
                                <td>Query</td>
                                <td>Attachment</td>
                                <td>Status</td>
                                <td>Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $dir = "../../../utils/complaints/";
                            $sql = "SELECT * FROM complaints WHERE created_by = $user_id";
                            $res = mysqli_query($db, $sql) or die('An error occured: ' . mysqli_error($db));
                            while ($row = mysqli_fetch_array($res)) {
                            ?>
                                <tr>
                                    <td><?php echo $row['ref']; ?></td>
                                    <td><?php echo $row['complaint']; ?></td>
                                    <td>
                                        <?php
                                        if (isset($row['file']) && strlen($row['file']) > 3) {
                                            if (file_exists($dir . $row['file'])) {
                                                echo '<a href="' . $dir . $row["file"] . '" target="_blank"> Attachment </a>';
                                            } else {
                                                echo "No attached files.";
                                            }
                                        } else {
                                            echo "No attached files";
                                        }
                                        ?>
                                    </td>
                                    <td style="background-color: <?php echo ($row['status'] == 'Open') ? '#E3242B' : '#0A6522'; ?>; font-weight: bold; color:white;"><?php echo $row['status']; ?></td>

                                    <td>
                                        <a href="view_complaint.php?id=<?php echo $row["id"]; ?>" class="btn btn-sm btn-primary" style="width:"> View </a>
                                        <?php if ($_SESSION['id'] == $row['created_by'] || $_SESSION['role'] == 'admin') { ?>
                                            <a href="?del_id=<?php echo $row["id"]; ?>" class="btn btn-sm btn-danger" style="width:"> Update </a>
                                            <a href="?del_id=<?php echo $row["id"]; ?>" class="btn btn-sm btn-danger" style="width:"> Delete </a>
                                        <?php } ?>

                                    </td>
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


<?php

if (isset($_GET['del_id'])) {
    $delete_id = $_GET['del_id'];
    // delete from db
    $sql = "DELETE FROM complaints WHERE id = $delete_id";
    $res = mysqli_query($db, $sql) or die('An error occured: '. mysqli_error($db));
    if ($res) {
        echo "<script>window.location.href='?deleted=';</script>";
    }

}

require_once('../layouts/footer_to_end.php');

?>