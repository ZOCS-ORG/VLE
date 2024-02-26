<?php
// require_once('../scripts/program_validation.php');
require_once('../../../config/manager_server.php');   //contains db connection so we good 🤦🏾‍♂️
$add_side_bar = true;
include_once('../layouts/head_to_wrapper.php');

include_once('../layouts/topbar.php');

?>

<hr />
<main>

    <div class="container-fluid col-md-10">
        <?php
        $sql = "SELECT pn.*, s.name AS school_name, u.name AS User  
            FROM pta_notices pn
            JOIN users u ON pn.created_by = u.id
            LEFT JOIN school_teachers st ON st.teacher_id = pn.created_by
            left JOIN schools s ON s.school_id = st.school_id";
        $res = mysqli_query($db, $sql) or die('An error occured: ' . mysqli_error($db));

        while ($row = mysqli_fetch_array($res)) {
        ?>
            <div class="card mb-4">
                <div class="card-header text-center">
                    <h5><?php echo $row['title']; ?></h5>
                </div>
                <div class="card-body">
                    <p class="card-text"><?php echo $row['name']; ?></p>
                    <p class="card-text">From: <?php echo $row['User']; ?></p>
                    <p class="card-text">Date: <?php echo $row['date']; ?></p>
                    <p class="card-text">School: <?php echo $row['school_name']; ?></p>
                    <!-- You can add additional content here if needed -->
                </div>
                <!-- <div class="card-footer text-muted">
                <a class="btn btn-primary btn-sm text-light" href="update_pta.php?id=<?php echo $row['id'] ?>">Edit</a> 
                <a class="btn btn-danger btn-sm text-light" href="../../../config/manager_server.php?id=<?php echo $row['id'] ?>&delete_Notice=true">Delete</a>
            </div> -->
            </div>
        <?php
        }
        ?>
    </div>

</main>


<?php require_once('../layouts/footer_to_end.php'); ?>