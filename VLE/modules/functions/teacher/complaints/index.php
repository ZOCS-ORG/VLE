<?php
require_once('../../../config/admin_server.php');   //contains db connection so we good 🤦🏾‍♂️
$add_side_bar = true;
include_once('../layouts/head_to_wrapper.php');
include_once('../layouts/topbar.php');

?>

<hr />
<main>
    <div class="container-fluid col-md-9">
        <div class="card mb-4">
            <div class="card-header text-center">
                <h3>Complaints</h3>
                <div class="text-right text-light">
                    <a class="btn btn-sm btn-success" href="create_complaint.php">Make a Complaints</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <td>Complaint #</td>
                                <td>Complaint</td>
                                <td>Attachment</td>
                                <td>Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $dir = "../../../utils/complaints/";
                            $sql = "SELECT * FROM complaints";
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
                                    <td><a href="view_complaint.php?id=<?php echo $row["id"]; ?>" class="btn btn-md btn-light" style="width:"> Open </td>
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