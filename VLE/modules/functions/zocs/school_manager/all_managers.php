<?php 
    require_once('../scripts/manager_validation.php');
    require_once('../../../config/admin_server.php');   //contains db connection so we good 🤦🏾‍♂️
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

?>
       
<hr/>
<main>
    <div class="container-fluid col-md-9">
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="text-center">Manager's list</h3>
                    <div class="text-right text-light">
                        <a class="btn btn-sm btn-success" href="add_manager.php">Add <i class="fas fa-plus "></i> </a>
                    </div>
                
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Name</td>
                                <td>Email</td>
                                <td>Picture</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT * FROM managers;";
                                $res= mysqli_query($db,$sql)or die('An error occured: '.mysqli_error($db));
                                $string = "";
                                $images_dir = "../../../utils/images/school_manager/";
                                while($row = mysqli_fetch_array($res)){
                                    $picname = $row['img'];
                            ?>
                            <tr>
                                <td><a href="view_manager.php?id=<?php echo $row["id"]; ?>"><?php echo $row['id']; ?> </td>
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
    </div>
</main>


<?php require_once('../layouts/footer_to_end.php'); ?>
