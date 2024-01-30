<?php 
    // require_once('../scripts/program_validation.php');
    require_once('../../../config/manager_server.php');   //contains db connection so we good 🤦🏾‍♂️
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    
    include_once('../layouts/topbar.php');

?>
    						
<hr/>
<main>
    <div class="container-fluid col-md-12">
           
            
            <div class="card mb-4">
                <div class="card-header text-center">
                    <h3>My Announcements</h3>
                    <div class="text-right text-light">
                        <a class="btn btn-sm btn-success" href="create_announcement.php">Add new announcement <i class="fas fa-plus "></i> </a>
                        </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="4">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Announcement</th>
                                    <th>For</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql = "SELECT * FROM announcements  WHERE created_by = '$id' ORDER BY id DESC ";
                                    $res= mysqli_query($db,$sql)or die('An error occured: '.mysqli_error($db));

                                    while($row = mysqli_fetch_array($res)){
                                ?>
                                <tr>
                                    <td> <?php echo $row['title']; ?> </td>
                                    <td> <?php echo $row['name']; ?></td>
                                    <td> <?php echo $row['audience']; ?> </td>
                                    <td> <?php echo $row['date']; ?> </td>
                                    <th class="btn-group"><a class="btn btn-primary btn-sm text-light" href="update_announcement.php?id=<?php echo $row['id']?>">Edit</a> 
                                        <a class="btn btn-danger btn-sm text-light" href="../../../config/manager_server.php?id=<?php echo $row['id']?>&delete_announcement=true">Delete </a>
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


<?php require_once('../layouts/footer_to_end.php'); ?>


