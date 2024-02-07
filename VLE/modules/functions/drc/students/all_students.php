<?php 
    require_once('../../../config/admin_server.php');   //contains db connection so we good 🤦🏾‍♂️
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    
    include_once('../layouts/topbar.php');

?>
    						
<hr/>
<main>
    <div class="card-header text-center">
                <h3>Students list</h3>
            </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="4">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Picture</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            $sql = "SELECT * FROM students;";
                            $res= mysqli_query($db,$sql)or die('An error occured: '.mysqli_error($db));
                            $string = "";
                            $images_dir = "../../../utils/images/students/";

                            while($row = mysqli_fetch_array($res)){
                                $picname = $row['img'];
                        ?>
                        <tr>
                            <td><a href="view_student.php?id=<?php echo $row["id"]; ?>"><?php echo $row['id']; ?> </td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo "<img src='".$images_dir.$picname."' alt='".$picname."' width='50' height='50'> "?></td>
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
    </div>
</main>


<?php require_once('../layouts/footer_to_end.php'); ?>
