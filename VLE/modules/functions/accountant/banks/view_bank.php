<?php 
    require_once('../../../config/accounts_server.php');   //contains db connection so we good 🤦🏾‍♂️
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

    $bank_id = $_GET['id'];

?>

        <hr/>
        
        
        <?php 
            $query = "SELECT * FROM banks WHERE id = '$bank_id' ";

            $result = mysqli_query($db, $query) or die(mysqli_error($db));
            $count = 1;
            if (mysqli_num_rows($result) > 0){                   
                while($row = mysqli_fetch_assoc($result)){ 
        ?>

        <main>
            <div class="container-fluid col-md-9">
                <div class="card mb-4">
                        <div class="card-header text-center">
                            <h3> Bank Info </h3>
                        </div>                    

                    <div class="card-body">

                        <div class="row">

                            <div class="col-lg-6">
                                <div class="card-body text-right">
                                    <p>Bank name</p>
                                </div>
                            </div>
                            <div > </div>
                            <div class="col-lg-5">
                                <div class="card-body">
                                    <p> <?php echo $row['name']; ?> </p>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="card-body text-right">
                                    <p>Branch</p>
                                </div>
                            </div>
                            <div > </div>
                            <div class="col-lg-5">
                                <div class="card-body">
                                    <p> <?php echo $row['branch']; ?> </p>
                                </div>
                            </div>

                            <!-- <div class="col-lg-6">
                                    <div class="card-body text-right">
                                        <p>Date</p>
                                    </div>
                                </div>
                                <div > </div>
                                <div class="col-lg-5">
                                    <div class="card-body">
                                        <?php 
                                            // $raw_date = strtotime($row['date_paid']);
                                            // $date_paid = date('d F, Y', $raw_date);
                                            // echo "<p>".$date_paid."</p>";
                                        ?> 
                                    </div>
                            </div> -->
                            
                            <div class="col-lg-6">
                                <div class="card-body text-right">
                                    <p>Account name</p>
                                </div>
                            </div>
                            <div > </div>
                            <div class="col-lg-5">
                                <div class="card-body">
                                    <p> <?php echo $row['account_name']; ?> </p>
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="card-body text-right">
                                    <p>Account number</p>
                                </div>
                            </div>
                            <div > </div>
                            <div class="col-lg-5">
                                <div class="card-body">
                                    <p> <?php echo $row['account_no']; ?> </p>
                                </div>
                            </div>

                        </div>
                    </div>
            </div>
        </main>
        <?php
                }
            } else {
            echo 'Bank Not Found!';
            }
        ?>



<?php require_once('../layouts/footer_to_end.php'); ?>
