<?php 
    require_once('../../../config/manager_server.php');   //contains db connection so we good 🤦🏾‍♂️
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

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
                    <h3>All subjects </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="4">
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Teacher</th>
                                    <th>Class</th>
                                    <th>Manage Results</th>
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
                                        $teacher_id = $row['teacher_id'];
                                        $q = "SELECT name, id
                                        FROM teachers
                                        WHERE id = $teacher_id";

                                        $res = mysqli_query($db, $q) or die(mysqli_error($db));

                                        if (mysqli_num_rows($res) > 0){
                                            while($r = mysqli_fetch_assoc($res)){ 
                                                $teacher_name = $r['name'];
                                                echo "<td><a  href='../account/myprofile.php?id=".$r['id']."'>".$teacher_name."</a></td>";
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
                                                $class_name = $r['name'];
                                                echo "<td><a href='../classes/view_class.php?id=$class_id'>".$class_name."</a></td>";
                                            }
                                        }
                                    ?>

                                    <th><div>
                                            <a class="btn btn-info btn-sm text-white " href="results.php?subject=<?php echo $subject_id ?>&class=<?php echo $class_id?>">View Results </a>
                                        </div>
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
