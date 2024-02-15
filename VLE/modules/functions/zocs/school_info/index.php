<?php 
    //require_once('../scripts/librarian_validation.php');  DELETE IF NOT REQUIRED
    require_once('../../../config/admin_server.php');   //contains db connection so we good 🤦🏾‍♂️
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

    //$id = $_GET['id'];

?>

        <hr/>
        
        
        <?php 
            $query = "SELECT * from school_info";

            $result = mysqli_query($db, $query) or die(mysqli_error($db));
            $count = 1;
            if (mysqli_num_rows($result) > 0){  
                $images_dir = "../../../utils/images/school_info/";
                   
                while($row = mysqli_fetch_assoc($result)){ 
                    $picname = $row['logo'];
        ?>

        <main>


                <div class="card mb-4">
                    <div class=" card-header text-center">
                        <div class="text-">
                            <?php echo "<img src='".$images_dir.$picname."' alt='".$picname."' width='240' height='150'> "?>
                        </div>    
                    </div>
                    
                    <div class="card-body">

                    <div class="row">
                            <div class="col-lg-6">
                                <div class=" mb-4">
                                    <div class="card-body text-right">
                                        <h5 style="color:lightblue"> General Info </h5>
                                        <hr>
                                        <p>Name</p>
                                        <p>Tagline</p>
                                        <p>Display Name</p>
                                        <p>Established</p>
                                        <p>Location</p>
                                        <h5 style="color:lightblue"> Contact Info </h5>
                                        <hr>
                                        <p>Email</p>
                                        <p>Phone Number</p>
                                        <p>Address</p>

                                    </div>
                                </div>
                            </div>
                            <div > <hr style="height:100%; width:2px; backgro~und-color:grey; "></div>
                            
                            <div class="col-lg-5">
                                <div class=" mb-4">
                                    <div class="card-body">
                                        <h5 style="color: transparent"> Personal Info</h5>
                                        <hr>
                                        <p> <?php echo $row['name']; ?> </p>
                                        <p> <?php echo $row['tag']; ?> </p>
                                        <p><?php echo $row['dn']; ?></p>
                                        <p> <?php echo $row['est']; ?> </p>
                                        <p> <?php echo $row['location']; ?> </p>
                                        <h5 style="color: transparent"> Contact Info</h5>
                                        <hr>
                                        <p> <?php echo $row['email']; ?> </p>
                                        <p> <?php echo $row['phone']; ?> </p>
                                        <p> <?php echo $row['address']; ?> </p>
                                        
                                    </div>
                                </div>
                                <div class="text-right text-white">
                                    <a href="update_school.php?id=<?php echo $row['id'] ?>" class="btn btn-info btn-sm">Edit</a>
                                    <!-- <a href="../../../config/admin_server.php?id=<?php echo $librarian_id;?>&delete_librarian=true" class="btn btn-danger btn-sm">Delete</a> -->
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </main>
        <?php
                }
            } else {
                $URL="create_school.php";
                echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
                echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
            }
        ?>


</div>
</div>
</div> 
<?php require_once('../layouts/footer_to_end.php'); ?>
