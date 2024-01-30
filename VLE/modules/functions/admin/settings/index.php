<?php 
    require_once('../../../config/admin_server.php');   //contains db connection so we good 🤦🏾‍♂️
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

?>
    <hr/>
    <?php 
        $query = "SELECT * from settings";

        $result = mysqli_query($db, $query) or die(mysqli_error($db));
        $count = 1;
        if (mysqli_num_rows($result) > 0){                  
            while($row = mysqli_fetch_assoc($result)){ 
    ?>



        <div class="card mb-4">
            <div class=" card-header text-center">  
            </div>
            
            <div class="card-body">

            <div class="row">
                    <div class="col-lg-6">
                        <div class=" mb-4">
                            <div class="card-body text-right">
                                <h5 style="color:lightblue"> Accounts Settings </h5>
                                <hr>
                                <p>Tuition fees/Term</p>
                                <p>Payments due - Term 1</p>
                                <p>Payments due - Term 2</p>
                                <p>Payments due - Term 3</p>
                                <p>Currency</p>
                            </div>
                        </div>
                    </div>
                    <div > <hr style="height:100%; width:2px; backgro~und-color:grey; "></div>
                    
                    <div class="col-lg-5">
                        <div class=" mb-4">
                            <div class="card-body">
                                <h5 style="color: transparent"> Accounts Settings </h5>
                                <hr>
                                <p> <?php echo $row['total_term_fees']; ?> </p>
                                <p> <?php echo $row['date_due_1']; ?> </p>
                                <p> <?php echo $row['date_due_2']; ?> </p>
                                <p> <?php echo $row['date_due_3']; ?> </p>
                                <p> <?php echo $row['currency']; ?> </p>
                            </div>
                        </div>
                        <div class="text-right text-white">
                            <a href="update_settings.php?id=<?php echo $row['id'] ?>" class="btn btn-info btn-sm">Edit</a>
                            <!-- <a href="../../../config/admin_server.php?id=<?php echo $_id;?>&delete_settings=true" class="btn btn-danger btn-sm">Delete</a> -->
                        </div>
                    </div>

            </div>
        </div>
        
        </div>
        </div>
        </div> 
    
    <?php
            }
        } else {
            $URL="create_settings.php";
            echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
            echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
        }
    ?>
            


<?php require_once('../layouts/footer_to_end.php'); ?>
