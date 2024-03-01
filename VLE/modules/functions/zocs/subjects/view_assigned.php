<?php 
    require_once('../scripts/parent_validation.php');
    require_once('../../../config/admin_server.php');   //contains db connection so we good 🤦🏾‍♂️
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

    //$id = $_GET['id'];

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
                    <h3>Subjects offered</h3>
                    <div class="text-right text-light">
                        <a class="btn btn-sm btn-success" href="create_subject.php">Add subject <i class="fas fa-plus "></i> </a>
                        <a class="btn btn-sm btn-success" href="assign_subject.php">Assign subject to teacher <i class="fas fa-check "></i> </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="4">
                            <thead>
                                <tr>
                                    <th>Teacher</th>
                                    <th>Subject</th>
                                    <th>Class</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>

                                    <?php 
                                        $query = "SELECT  * from teacher_subject_class ";

                                        $result = mysqli_query($db, $query) or die(mysqli_error($db));
                                        $count = 1;
                                        if (mysqli_num_rows($result) > 0){                   
                                            while($row = mysqli_fetch_assoc($result)){
                                                $classes[] = $row['class_id'];

                                                //return var_dump($classes);
                                                
                                    ?>

                                    <?php 
                                        $teacher_id = $row['teacher_id'];
                                        $q = "SELECT name, id
                                        FROM teachers
                                        WHERE id = $teacher_id";

                                        $res = mysqli_query($db, $q) or die(mysqli_error($db));

                                        if (mysqli_num_rows($res) > 0){
                                            while($r = mysqli_fetch_assoc($res)){ 
                                                $teacher_name = $r['name'];
                                                echo "<td><a  href='../lecturers/view_lecturer.php?id=".$r['id']."'>".$teacher_name."</a></td>";
                                            }
                                        }
                                    ?>

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
                                    
                                    <?php 
                                        $class_id = $row['class_id'];
                                        $q = "SELECT name, id
                                        FROM classes
                                        WHERE id = $class_id";

                                        $res = mysqli_query($db, $q) or die(mysqli_error($db));

                                        if (mysqli_num_rows($res) > 0){
                                            while($r = mysqli_fetch_assoc($res)){ 
                                                $teacher_name = $r['name'];
                                                echo "<td>".$teacher_name."</td>";
                                            }
                                        }
                                    ?>

                                    <th class="btn-group"><a class="btn btn-primary btn-sm text-light" href="update_subject.php?id=<?php echo $row['id']?>">Edit</a> 
                                        <a class="btn btn-danger btn-sm text-light disabled" href="#">Delete </a>
                                    </th>
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
