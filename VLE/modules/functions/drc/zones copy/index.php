<?php
// require_once('../scripts/program_validation.php');
require_once('../../../config/manager_server.php');   //contains db connection so we good 🤦🏾‍♂️
$add_side_bar = true;
include_once('../layouts/head_to_wrapper.php');

include_once('../layouts/topbar.php');

?>

<style>
    .message-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .message {
        width: calc(50% - 20px);
        margin-bottom: 20px;
        padding: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        background-color: #f0f8ea;
    }

    @media (max-width: 768px) {
        .message {
            width: 100%;
        }
    }
</style>



<hr />
<main>
    <div class="container-fluid col-md-12">


        <div class="card mb-4">
            <div class="card-header text-center">
                <h3>Zones</h3>
                <div class="text-right text-light">
                    <a class="btn btn-sm btn-success" href="zones.php">Add new <i class="fa fa-plus "></i> </a>
                </div>
            </div>


            <div class="card-body">
                <div class="message-container">
                    <?php
                    $sql = "SELECT pta_notices.*, users.name AS creator_name FROM pta_notices LEFT JOIN users ON pta_notices.created_by = users.id WHERE pta_notices.created_by = '$id' ORDER BY pta_notices.id DESC";
                    $res = mysqli_query($db, $sql) or die('An error occured: ' . mysqli_error($db));

                    while ($row = mysqli_fetch_array($res)) {
                    ?>
                        <div class="message">
                            <div class="message-header">
                                <h5 class="message-title"><b><?php echo $row['title']; ?></b></h5>
                                <span class="message-date">Date:<?php echo $row['date']; ?></span>
                            </div>
                            <div class="message-body">
                                <p>Notice:<?php echo $row['name']; ?></p>
                                <p>From: <?php echo $row['creator_name']; ?></p>
                            </div>
                            <div class="message-actions">
                                <a class="btn btn-primary btn-sm text-light" href="update_pta.php?id=<?php echo $row['id'] ?>">Edit</a>
                                <a class="btn btn-danger btn-sm text-light" href="../../../config/manager_server.php?id=<?php echo $row['id'] ?>&delete_Notice=true">Delete</a>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>


        <script>
            $(document).ready(function() {
                $('#dataTable').DataTable();
            });
        </script>


    </div>
</main>


<?php

//!! some funcs??? maybe..?


// SELECT z.zone_id, z.zone FROM zones 
// INNER JOIN school_teachers st ON st.teacher_id = $teacher_id
// INNER JOIN schools s ON s.school_id = st.school_id
// INNER JOIN zones z ON z.zone_id = s.zone
// Group BY z.zone_id;




require_once('../layouts/footer_to_end.php');
?>