<?php 
    require_once('../scripts/hostel_validation.php');
    require_once('../../../config/admin_server.php');   //contains db connection so we good 🤦🏾‍♂️
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

    $hostel_id = $_GET['id'];

?>

        <hr/>
        
        
        <?php 
            $query = "SELECT * from hostels where id = '$hostel_id' ";

            $result = mysqli_query($db, $query) or die(mysqli_error($db));
            $count = 1;
            if (mysqli_num_rows($result) > 0){                     
                while($row = mysqli_fetch_assoc($result)){ 
        ?>

        <main>



                <div class="card mb-4">
                    <div class=" card-header text-center">
                        <h3 class="text-">Hostels Info</h3>
                        <div class="text-right text-light">
                            <a class="btn btn-sm btn-success" href="add_hostel.php">Add another <i class="fas fa-plus "></i> </a>
                        </div>  
                    </div>
                    
                    <div class="card-body">

                    <div class="row">
                            <div class="col-lg-6">
                                <div class=" mb-4">
                                    <div class="card-body text-right">
                                        <p>Hostel ID</p>
                                        <p>Name</p>
                                        <p>Total bed capacity</p>
                                        <p>Available beds</p>
                                        <p>Patreon</p>

                                    </div>
                                </div>
                            </div>
                            <div > <hr style="height:100%; width:1px; background-color:grey; "></div>
                            
                            <div class="col-lg-5">
                                <div class=" mb-4">
                                    <div class="card-body">
                                        <p> <?php echo $row['id']; ?> </p>
                                        <p> <?php echo $row['name']; ?> </p>
                                        <p> <?php echo $row['beds']; ?> </p>
                                        <?php
                                            /**
                                             *  @TODO Some Maths here to get available bed spaces
                                             */
                                            $avaible_beds = "23 - (This numberr is static)";
                                        ?>
                                        <p> <?php echo $avaible_beds; ?> </p>
                                        <p> <?php echo $row['patreon']; ?> </p>
                                    </div>
                                </div>
                                <div class="text-right text-white">
                                    <a href="update_hostel.php?id=<?php echo $hostel_id ?>" class="btn btn-info btn-sm">Edit</a>
                                    <a href="../../../config/admin_server.php?id=<?php echo $hostel_id;?>&delete_hostel=true" class="btn btn-danger btn-sm">Delete</a>
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
