<?php 
    require_once('../../../config/admin_server.php');   //contains db connection so we good 🤦🏾‍♂️
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

    // Get students support data
    $get_class_res = mysqli_query($db, "SELECT class_id FROM students WHERE id = '$id' ")or die(mysqli_error($db));
    $get_class_row = mysqli_fetch_assoc($get_class_res);
    $class_id = $get_class_row['class_id'];
?>
        <hr/>
        <main>
            <div class="container-fluid col-md-9">
                <div class=" mb-4">
                    <!-- <div class="card-header text-center">
                        <h3> Class <?php echo "row['name'];"; ?></h3>
                    </div> -->

            <div class="card mb-4">
                <div class="card-header text-center">
                    <h3>My Subjects</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="4">
                            <thead>
                                <tr>
                                    <!-- <th>Teacher</th> -->
                                    <th>Subject</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>

                                    <?php 
                                        $query = "SELECT  * from student_subjects WHERE student_id = '$id'";

                                        $result = mysqli_query($db, $query) or die(mysqli_error($db));
                                        $count = 1;
                                        if (mysqli_num_rows($result) > 0){                   
                                            while($row = mysqli_fetch_assoc($result)){
                                                
                                    ?>

                                    <!-- <?php 
                                        $subject_id = $row['subject_id'];
                                        $q = "SELECT name, id
                                        FROM subjects
                                        WHERE id = $subject_id";

                                        $res = mysqli_query($db, $q) or die(mysqli_error($db));

                                        if (mysqli_num_rows($res) > 0){
                                            while($r = mysqli_fetch_assoc($res)){ 
                                                $teacher_name = $r['name'];
                                                echo "<td><a  href=''>".$teacher_name."</a></td>";
                                            }
                                        }
                                    ?> -->

                                    <?php 
                                        $subject_id = $row['subject_id'];
                                        $q = "SELECT name, id
                                        FROM subjects
                                        WHERE id = $subject_id";

                                        $res = mysqli_query($db, $q) or die(mysqli_error($db));

                                        if (mysqli_num_rows($res) > 0){
                                            while($r = mysqli_fetch_assoc($res)){ 
                                                $teacher_name = $r['name'];
                                                echo "<td>".$teacher_name."</td>";
                                            }
                                        }
                                    ?>
                                    

                                </tr>

                                    <?php
                                            }
                                        } else {
                                        echo 'No Records Found!';
                                        }
                                    ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>  


            <script>
                $(document).ready(function() {
                    $('#dataTable').DataTable();
                } );
            </script>








            </div>

        </main>


<?php require_once('../layouts/footer_to_end.php'); ?>
