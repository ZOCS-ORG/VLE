<?php
//set to false if you don't want the sidebar to show
$add_side_bar = true;
require_once('../layouts/head_to_wrapper.php');
?>

<style>
.center {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 100%;
}
</style>
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


        <div class="row">
            <?php
            $query = $db->query("SELECT um.*, u.name AS teacher_name, s.name AS school_name
    FROM upload_materials um
    JOIN users u ON um.teacher_id = u.id
    JOIN school_teachers st ON st.teacher_id = um.teacher_id
    JOIN schools s ON s.school_id = st.school_id
    ");

            while ($row = $query->fetch_assoc()) {
                $name = $row['name'];
                $description = $row['description'];
                $from = $row['from_age'];
                $to = $row['to_age'];
                $file = $row['file'];
                $cover = $row['cover'];
                $date = $row['date'];
                $from_name = $row['teacher_name'];
                $school_name = $row['school_name'];


                $file_path = "../../../../lms/files/ass_notice/" . $file;
                $cover_path = "../../../../lms/files/ass_notice/" . $cover;
            ?>
                <div class="col-md-4 mb-4">
                    <div class="card" style="background: #BFE5FF; padding:1rem;">
                        <div class="card-image center">
                            <img style="width:50%; height: 50%; margin-left:auto; margin-right: auto;" src="<?php echo $cover_path; ?>" alt="Cover Photo">
                        </div>
                        <div class="card-content">
                            <h5 class="card-title"><?php echo $name ?></h5>
                            <p>Description: <?php echo $description ?></p>
                            <p>Date: <?php echo $date ?></p>
                            <p>From: <?php echo $from_name ?></p>
                            <p>School: <?php echo $school_name ?></p>
                            <p>Age Group: <?php echo $from ?> To <?php echo $to ?></p>
                        </div>
                        <div class="card-action">
                            <a href="<?php echo $file_path; ?>" class="btn btn-primary">Download</a>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>


    </div>
    <!-- /.container-fluid -->
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
</div>
<!-- End of Main Content -->
<?php
require_once('../layouts/footer_to_end.php');
?>