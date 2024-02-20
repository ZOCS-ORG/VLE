<?php
//set to false if you don't want the sidebar to show
$add_side_bar = true;
require_once('../layouts/head_to_wrapper.php');
?>
<!-- Main Content -->
<div id="content">

    <!-- Topbar -->
    <?php include('../layouts/topbar.php') ?>
    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"> Learning Materials</h1>
        </div>


        <div class="row" >
    <?php
    $query = $db->query("SELECT um.*, u.name AS teacher_name
    FROM upload_materials um
    JOIN users u ON um.teacher_id = u.id
    WHERE EXISTS (
        SELECT 1
        FROM users
        WHERE user_role = 'student'
        AND stu_parent = $id
        -- AND TIMESTAMPDIFF(YEAR, dob, CURDATE()) BETWEEN from_age AND to_age
    )");

    while ($row = $query->fetch_assoc()) {
        $name = $row['name'];
        $description = $row['description'];
        $from = $row['from_age'];
        $to = $row['to_age'];
        $file = $row['file'];
        $date = $row['date'];
        $from_name = $row['teacher_name'];
       

        $file_path = "../../../../lms/files/ass_notice/" . $file;
    ?>
        <div class="col-md-4 mb-4" >
            <div class="card" style="background: #BFE5FF;">
                <div class="card-body">
                    <h5 class="card-title">Title: <?php echo $name ?></h5>
                    <p class="card-text">Description:<?php echo $description ?></p>
                    <p class="card-text">Date: <?php echo $date ?></p>
                    <p class="card-text">From: <?php echo $from_name ?></p>
                    <p class="card-text">Age Group: <?php echo $from ?> To <?php echo $to ?></p>
                    <a href="<?php echo $file_path; ?>" class="btn btn-primary">Download</a>
                </div>
            </div>
        </div>
    <?php } ?>
</div>


    </div>
    <!-- /.container-fluid -->
    <script>
    $(document).ready(function () {
        $('#dataTable').DataTable();
    });
</script>
</div>
<!-- End of Main Content -->
<?php
require_once('../layouts/footer_to_end.php');
?>