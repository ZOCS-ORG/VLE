<?php 
    require_once('../../../config/manager_server.php');   //contains db connection so we good 🤦🏾‍♂️
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    
    include_once('../layouts/topbar.php');

?>
<script src="bundle.min.js"></script>
        <hr/>

<main>
    <div class="container-fluid col-md-11">

            <div class="card mb-4">
                <div class="card-header text-center">
                    <h3>Classes</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="4">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Class Teacher</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $sql = "SELECT * FROM classes ";
                                    $results= mysqli_query($db,$sql)or die('An error occured: '.mysqli_error($db));

                                    if (mysqli_num_rows($results) < 1) {
                                        echo " <h5 class='text-center text-warning'> You have not been asssigned any classes. If you have
                                         and you're getting this, please contact the system administrator or person in charge of IT. </h5> " ;
                                    }

                                    while($row = mysqli_fetch_array($results)){
                                        $class_id = $row['id'];
                                ?>
                                <tr>
                                    <td><a href="view_class.php?id=<?php echo $row['id'];?>"> <?php echo $row['id']; ?> </a></td>
                                    <td> <?php echo $row['name']; ?></td>

                                    <td>
                                    <?php 
                                        $teacher_id = $row['teacher_id'];
                                        $q = "SELECT name, id
                                        FROM teachers
                                        WHERE id = $teacher_id";

                                        $res = mysqli_query($db, $q) or die(mysqli_error($db));

                                        if (mysqli_num_rows($res) > 0){
                                            while($r = mysqli_fetch_assoc($res)){ 
                                                $teacher_name = $r['name'];
                                                echo "<p><a  href='../lecturers/view_lecturer.php?id=".$r['id']."'>".$teacher_name."</a></p>";
                                            }
                                        }
                                    ?>
                                    </td>
                                    <th><div class="btn-group"><a class="btn btn-success btn-sm text-white" href="view_class.php?id=<?php echo $row['id']?>">View Class</a> 
                                            <a class="btn btn-warning btn-sm text-dark " href="../attendance/register.php?class=<?php echo $row['id']?>">View Class Register </a>
                                            <a class="btn btn-info btn-sm text-white " href="class_results.php?class=<?php echo $row['id']?>">View Results </a>
                                        </div>
                                    </th>
                                </tr>
                                <?php

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


<?php
    require_once('../layouts/footer_to_end.php');
?>