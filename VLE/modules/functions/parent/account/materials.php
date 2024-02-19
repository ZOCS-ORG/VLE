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
            <h1 class="h3 mb-0 text-gray-800">Materials</h1>
        </div>


        <!-- Content Row -->
        <div class="row">
        <div class="col s12 m8">
            <div class="card-panel">         
            </div>

            <table class="striped highlight responsive-table" id="dataTable">
                
                <thead>
                    <tr>
                        <th>Name</th>                       
                        <th>Description</th>
                        <th>Date</th>
                        <th>from</th>
                        <th>Download</th>                     
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $query = $db->query("SELECT um.*, u.name AS teacher_name
                    FROM upload_materials um
                    JOIN users u ON um.teacher_id = u.id
                    WHERE EXISTS (
                        SELECT 1
                        FROM users
                        WHERE user_role = 'student'
                        AND stu_parent = $id
                        AND TIMESTAMPDIFF(YEAR, dob, CURDATE()) BETWEEN from_age AND to_age
                    )");

                    while ($row = $query->fetch_assoc()) {
                        $name = $row['name'];
                        $description = $row['description'];
                        $from = $row['from_age'];
                        $to = $row['to_age'];
                        $file = $row['file'];                       
                        $date = $row['date'];                       
                        $up_id = $row['id'];
                        $from_name = $row['teacher_name'];

                        $file_path = "../../../../lms/files/ass_notice/" . $file;
                        /**File location */

                        $sub_query2 = $db->query("SELECT * FROM classes WHERE id='$class' ");
                        while ($row = $sub_query2->fetch_assoc()) {
                            $class_name = $row['name'];
                        }
                        $sub_query3 = $db->query("SELECT * FROM subjects WHERE id='$subject' ");
                        while ($row = $sub_query3->fetch_assoc()) {
                            $sub_name = $row['name'];
                        }
                    ?>
                        <tr>
                            <td><?php echo $name ?></td>                         
                            <td><?php echo $description ?></td>
                            <td><?php echo $date ?></td>
                            <td><?php echo $from_name ?></td>
                            <td> <a href="<?php echo $file_path; ?>"> File </a> </td>                                                      
                        </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>
       
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