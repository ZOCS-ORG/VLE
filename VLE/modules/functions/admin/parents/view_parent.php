<?php 
    require_once('../scripts/parent_validation.php');
    require_once('../../../config/admin_server.php');   //contains db connection so we good 🤦🏾‍♂️
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

    $parent_id = $_GET['id'];

?>

        <hr/>
        
        
        <?php 
            $query = "SELECT  * from parents where id = '$parent_id' ";

            $result = mysqli_query($db, $query) or die(mysqli_error($db));
            $count = 1;
            if (mysqli_num_rows($result) > 0){                   
                while($row = mysqli_fetch_assoc($result)){ 
        ?>

        <main>
            <div class="container-fluid col-md-9">
                <div class="card mb-4">
                    <div class="card-header text-center">
                        <h3>Parents Info</h3>
                    </div>
                    
                    

                    <div class="card-body">

                    <div class="row">
                            <div class="col-lg-6">
                                <div class=" mb-4">
                                    <div class="card-body text-right">
                                        <hr>
                                        <p>Parents ID</p>
                                        <p>Username</p>
                                        <p>Email</p>
                                        <p>Mother's Name</p>
                                        <p>Father's Name</p>
                                        <p>Mother's Phone Number</p>
                                        <p>Father's Phone Number</p>
                                        <p>Address</p>
                                    </div>
                                </div>
                            </div>
                            <div > </div>
                            
                            <div class="col-lg-5">
                                <div class=" mb-4">
                                    <div class="card-body">
                                        <hr>
                                        <p> <?php echo $row['id']; ?> </p>
                                        <p> <?php echo $row['username']; ?> </p>
                                        <p> <?php echo $row['email']; ?> </p>
                                        <p> <?php echo $row['mothername']; ?> </p>
                                        <p> <?php echo $row['fathername']; ?> </p>
                                        <p> <?php echo $row['motherphone']; ?> </p>
                                        <p> <?php echo $row['fatherphone']; ?> </p>
                                        <p> <?php echo $row['address']; ?> </p>
                                    </div>

                                </div>
                                <div class="text-right text-white">
                                    <a href="update_parent.php?id=<?php echo $parent_id ?>" class="btn btn-info btn-sm">Edit</a>
                                    <a href="../../../config/admin_server.php?id=<?php echo $parent_id;?>&delete_parent=true" class="btn btn-danger btn-sm">Delete</a>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </main>
        <?php
                }
            } else {
            echo 'No Records Found!';
            }
        ?>



<?php require_once('../layouts/footer_to_end.php'); ?>
