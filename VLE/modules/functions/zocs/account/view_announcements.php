<?php
// require_once('../scripts/program_validation.php');
require_once('../../../config/manager_server.php');   //contains db connection so we good 🤦🏾‍♂️
$add_side_bar = true;
include_once('../layouts/head_to_wrapper.php');

include_once('../layouts/topbar.php');

$announcement_id = $_GET['id'];

$sql = "SELECT * FROM announcements  WHERE id = '$announcement_id' ";
$res = mysqli_query($db, $sql) or die('An error occured: ' . mysqli_error($db));
$row22 = mysqli_fetch_array($res)

?>

<hr />
<main class='container'>
    <div class="container-fluid col-md-12">

        <div class="card mb-4">
            <div class="card-header text-center">
                <h3><?php echo $row22['title']; ?></h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="4">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Announcement</th>
                                <th>For</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM announcements  WHERE id = '$announcement_id' ";
                            $res = mysqli_query($db, $sql) or die('An error occured: ' . mysqli_error($db));

                            while ($row = mysqli_fetch_array($res)) {
                            ?>
                                <tr>
                                    <td> <?php echo $row['title']; ?> </td>
                                    <td> <?php echo $row['name']; ?></td>
                                    <td> <?php echo $row['audience']; ?> </td>
                                    <td> <?php echo $row['date']; ?> </td>
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