<?php 
    require_once('../../../config/accounts_server.php');   //contains db connection so we good 🤦🏾‍♂️
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

    $payment_id = $_GET['id'];

?>

        <hr/>
        
        
        <?php 
            $query = "SELECT  * from payments WHERE id = '$payment_id' ";

            $result = mysqli_query($db, $query) or die(mysqli_error($db));
            $count = 1;
            if (mysqli_num_rows($result) > 0){                   
                while($row = mysqli_fetch_assoc($result)){ 
        ?>

        <main>
            <div class="container-fluid col-md-9">
                <div class="card mb-4">
                        <div class="card-header text-center">
                            <h3> Payment Info <span style="padding-left:50px">
                                <a class="fas small" href='../../reports/payment_reciept.php?payment_id=<?php echo $payment_id ?>' >
                                Reciept <i class="fas fa fa-download"></i> </a> </span>
                            </h3>
                        </div>                    

                    <div class="card-body">

                        <div class="row">

                            <div class="col-lg-6">
                                <div class="text-right">
                                    <p>Description</p>
                                </div>
                            </div>
                            <div > </div>
                            <div class="col-lg-5">
                                <div class="">
                                    <p> <?php echo $row['description']; ?> </p>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class=" text-right">
                                    <p>Paid by</p>
                                </div>
                            </div>
                            <div > </div>
                            <div class="col-lg-5">
                                <div class="">
                                    <p> <?php echo $row['paid_by']; ?> </p>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class=" text-right">
                                    <p>Amount</p>
                                </div>
                            </div>
                            <div > </div>
                            <div class="col-lg-5">
                                <div class="">
                                    <p> <?php echo $row['amount']; ?> </p>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class=" text-right">
                                    <p>Date paid</p>
                                </div>
                            </div>
                            <div > </div>
                            <div class="col-lg-5">
                                <div class="">
                                    <?php 
                                        $raw_date = strtotime($row['date_paid']);
                                        $date_paid = date('d F, Y', $raw_date);
                                        echo "<p>".$date_paid."</p>";
                                    ?> 
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class=" text-right">
                                    <p>Method of Payment</p>
                                </div>
                            </div>
                            <div > </div>
                            <div class="col-lg-5">
                                <div class="">
                                    <p> <?php echo $row['method']; ?> </p>
                                </div>
                            </div>

                            <?php /** Use method to get the reciever/bank.. */ 
                                $method = $row['method'];
                                if ($method == "Cash") { ?>

                                    <div class="col-lg-6">
                                        <div class="text-right">
                                            <p>Recieved By</p>
                                        </div>
                                    </div>
                                    <div > </div>
                                    <div class="col-lg-5">
                                        <div class="">
                                            <?php 
                                                $accountant_id = $row['recieved_by'];
                                                $q = "SELECT name, id
                                                FROM accountants
                                                WHERE id = $accountant_id";

                                                $res = mysqli_query($db, $q) or die(mysqli_error($db));

                                                if (mysqli_num_rows($res) > 0){
                                                    while($r = mysqli_fetch_assoc($res)){ 
                                                        $accountant_name = $r['name'];
                                                        echo "<p>".$accountant_name."</p>";
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </div>
                            <?php
                                }elseif($method == "Bank"){ ?>

                                    <div class="col-lg-6">
                                        <div class=" text-right">
                                            <p>Bank account</p>
                                        </div>
                                    </div>
                                    <div > </div>
                                    <div class="col-lg-5">
                                        <div class="">
                                            <?php 
                                                $bank_id = $row['bank_acc'];
                                                $q = "SELECT name, id
                                                FROM banks
                                                WHERE id = $bank_id";

                                                $res = mysqli_query($db, $q) or die(mysqli_error($db));

                                                if (mysqli_num_rows($res) > 0){
                                                    while($r = mysqli_fetch_assoc($res)){ 
                                                        $bank_name = $r['name'];
                                                        echo "<p><a href='../banks/view_bank.php?id=$bank_id'>".$bank_name."</a></p>";
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </div>
                            <?php
                                }
                            ?>

                        </div>
                    </div>
            </div>
        </main>
        <?php
                }
            } else {
            echo 'Payment Not found';
            }
        ?>



<?php require_once('../layouts/footer_to_end.php'); ?>
